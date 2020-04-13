<?

use reestr\sendMessage;

require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php' );
require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/php_interface/include/spreadsheet-reader-master/php-excel-reader/excel_reader2.php' );
require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/php_interface/include/spreadsheet-reader-master/SpreadsheetReader.php' );
require( $_SERVER['DOCUMENT_ROOT'] . "/admin/mass_reg/classes/autoregistration.php" );
// загрузчик файла в папку
//phpinfo();
//
$APPLICATION->SetTitle("Массовая загрузка пользователей");
$USER_PROP = needAuth('/auth/');

if(isset($_GET["success_send"]) && $_GET["success_send"] == "true"){
	CModule::IncludeModule("iblock");
	$el = new CIBlockElement;

	// перебираем данные и создаем пользователей
	$files  = $_SERVER['DOCUMENT_ROOT'] . "/upload/autofill_reestr/reestr.xlsx";
	$Reader = new SpreadsheetReader( $files );
	$Sheets = $Reader->Sheets();

	// подключаем рассыльщика
	$event = new reestr\sendMessage();

	//здесь храним массив со всеми данными, которые нужно залить в реестр
	$file_as_array = array();
	foreach ( $Sheets as $Index => $Name ) {
		$Reader->ChangeSheet( $Index );

		foreach ( $Reader as $ind => $Row ) {
			if ( $ind == 0 ) {
				$file_as_array[ $Name ]['NAMES'] = $Row;
			}
			if ( $ind == 1 ) {
				$file_as_array[ $Name ]['FIELDS'] = $Row;
			}
			if ( $ind > 1 ) {
				$ar = array();
				foreach ( $Row as $i => $line ) {
					$ar[ str_replace( array( '`', ' ' ), '', $file_as_array[ $Name ]['FIELDS'][ $i ] ) ] = $Row[ $i ];
				}
				$file_as_array[ $Name ]['DATA'][] = $ar;
			}
		}
	}

	// перебираем созданный выше массив согласно условию
	$Autoregistration = new Autoregistration();
	$arRes            = array();
	foreach ( $file_as_array['Физлица']['DATA'] as $person ) {

		//проверяем наличие пользователя
		$ready_user = CUser::GetByLogin( $person['EMAIL'] )->Fetch();

		if ( ! $ready_user && $person['EMAIL']) {
			// создаем пользователя и отправляем письмо пользователю с приглашением к дальнейшему заполнению профиля
			$user_id = $Autoregistration->create_user( $person );
			// создаем элементы в инфоблоке согласно типу пользователя
			if ( $user_id ) {
				$PROP     = array();
				$PROP[1]  = $person['LAST_NAME'];
				$PROP[2]  = $person['SECOND_NAME'];
				$PROP[75] = $person['FIRST_NAME'];
				$PROP[10] = $person['EMAIL'];
				$PROP[12] = $person['WORK_PLACE'];
				$PROP[72] = $person['ENTITY_NET'];
				$PROP[73] = $user_id;
				$PROP[19] = explode( ';', $person['MATERIAL_AUTHOR'] );

				$arLoadProductArray = Array(
					"IBLOCK_ID"       => 7,
					"PROPERTY_VALUES" => $PROP,
					"NAME"            => $person['LAST_NAME'] . ' ' . $person['FIRST_NAME'] . ' ' . $person['SECOND_NAME'],
					"ACTIVE"          => "Y",            // активен
				);
				//echo "<pre>"; print_r($arLoadProductArray); echo "</pre>";
				$PRODUCT_ID         = $el->Add( $arLoadProductArray );
				$user               = new CUser;
				$userInfoField      = "UF_USER_INFO_TYPE_F";
				$fields             = Array(
					$userInfoField => $PRODUCT_ID,
				);
				if($user->Update( intval( $user_id ), $fields )){
					$event->sendInviteFiz($person);
	            }
			}
		}
	}


	foreach ( $file_as_array['ЮрЛица']['DATA'] as $person ) {
		//проверяем наличие пользователя
		$ready_user = CUser::GetByLogin( $person['OGRN'] )->Fetch();

		if ( ! $ready_user && $person['OGRN'] ) {

			// создаем элементы в инфоблоке согласно типу пользователя
			$resp = CIBlockElement::GetList( array(), array( "IBLOCK_ID"         => 7,
			                                                 "PROPERTY_MARGE_ID" => $person['ID']
			),false,false,array("ID","NAME","PROPERTY_FIRST_NAME","PROPERTY_SURNAME","PROPERTY_EMAIL","PROPERTY_REPRESENTATIVE_OF_LEGAL_FACES") )->Fetch();

			// создаем пользователя и отправляем письмо пользователю с приглашением к дальнейшему заполнению профиля
			$person['EMAIL'] = $resp["PROPERTY_EMAIL_VALUE"];
			$user_id = $Autoregistration->create_user( $person, true );

			$PROP     = array();
			$PROP[33] = $person['OGRN'];
			$PROP[31] = $person['INN'];
			$PROP[30] = $person['ORGANIZATION_TYPE'];
			$PROP[34] = $person['FG_DEPARTAMENT'];
			$PROP[37] = $person['ADDRESS'];
			$PROP[38] = $person['PHONE'];
			$PROP[40] = $person['SITE'];
			$PROP[71] = $person['ID'];
			$PROP[76] = $person['NAME'];
			$PROP[74] = $user_id;
			$PROP[47] = explode( ';', $person['MATERIAL_WORKER'] );
			$PROP[41] = array( $resp['ID'] );

			$arLoadProductArray = Array(
				"IBLOCK_ID"       => 8,
				"PROPERTY_VALUES" => $PROP,
				"NAME"            => $person['ORGANIZATION_TYPE'] . ' ' . $person['NAME'],
				"ACTIVE"          => "Y",            // активен
			);
			//echo "<pre>"; print_r($arLoadProductArray); echo "</pre>";
			$PRODUCT_ID         = $el->Add( $arLoadProductArray );
			$user               = new CUser;
			$userInfoField      = "UF_USER_INFO_TYPE_U";
			$fields             = Array(
				$userInfoField => $PRODUCT_ID,
			);
			//обновляем связку через пользовательские свойства
			if($user->Update( intval( $user_id ), $fields )){
			    $person['FIRST_NAME'] = $resp["PROPERTY_FIRST_NAME_VALUE"];
			    $person['LAST_NAME'] = $resp["PROPERTY_SURNAME_VALUE"];
				$event->sendInviteUr($person);
	        }
			//добавляем привязку пользователя к юрлицу
            $curUr = array("REPRESENTATIVE_OF_LEGAL_FACES",$resp['PROPERTY_REPRESENTATIVE_OF_LEGAL_FACES_VALUE']);
			$curUr["REPRESENTATIVE_OF_LEGAL_FACES"][] = $PRODUCT_ID;
			CIBlockElement::SetPropertyValuesEx($resp['ID'], 7, $curUr);
		}

	}
	//header("Refresh:0");
}
?>
<main class="main">
	<div class="content">
		<div class="containered">
			<div class="sidebar">
				<div class="sidebar__name">
					 Модерация
				</div>

				<ul class="sidebar__list">
					<li class="sidebar__item active"> <a class="sidebar__link" href="/admin/">Пользователи</a> </li>
					<li class="sidebar__item f_need_moderation"> <a class="sidebar__link" href="/admin/queries_f/">Запросы физ.лица</a> </li>
					<li class="sidebar__item u_need_moderation"> <a class="sidebar__link" href="/admin/queries_u/">Запросы юр.лица</a> </li>
					<li class="sidebar__item"> <a class="sidebar__link" href="/admin/report">Отчет</a> </li>
					<?/*<li class="sidebar__item">
	                    <a class="sidebar__link"
	                       href="/support/">Техподдержка</a>
	                </li>
	                <li class="sidebar__item">
	                    <a class="sidebar__link"
	                       href="/vote/">Опросы</a>
	                </li>*/?>
					 <!--                    <li class="sidebar__item">--> <!--                        <a class="sidebar__link"--> <!--                           href="#">Настройки</a>--> <!--                    </li>-->
					<li class="sidebar__item"> <a class="sidebar__link logout_href" href="#">Выход</a> </li>
				</ul>
			</div>
			<div class="main-content">
			    <form method="GET">
			    	<?if(isset($_GET["success_send"]) && $_GET["success_send"] == "true"):?>
						<h3 class="success_res">Данные загружены!</h3>
						<script>
							window.history.pushState({}, "Hide", 'https://fgprofi.ru/admin/mass_reg/');
						</script>
					<?endif;?>
			        <div class="download_input" data-input-name="REESTR">
						<?
						$APPLICATION->IncludeComponent( "bitrix:main.file.input", "drag_n_drop",
							array(
								"INPUT_NAME"       => "REESTR",
								"MULTIPLE"         => "N",
								"MODULE_ID"        => "main",
								"MAX_FILE_SIZE"    => "",
								"ALLOW_UPLOAD"     => "A",
								"ALLOW_UPLOAD_EXT" => ""
							),
							false
						); ?>
			        </div>
			        <br>
			        <div class="download_mass_reg_file">Загрузить файл</div>
			        <br>
			        <input type="hidden" name="success_send" value="">
			        <div class="send_mass_reg_file">Отправить</div>
			    </form>
			    <script>
			        $ (function () {
			            //$ (".download_input>a>span").addClass ("btn");
			        });
			        $(document).ready(function(){
			        	$(".download_mass_reg_file").click(function(e){
			        		e.preventDefault();
			        		var data = $(this).parents("form").serializeArray();
			        		console.log(data);
				        	$.ajax( {
							    type: "POST",
							    url: "/ajax/uploadFile.php",
							    data: data,
							    dataType: "html",
							    success: function( responseData ) {
							    	console.log(responseData);
							    	if(responseData != ""){
							    		$(".download_input span.del-but").each(function(){
							    			$(this).click();
							    		});
							    		$(".download_input").append("<div class='file_upload_success'>Файл загружен, и готов к отправке</div>");
							    		$(".send_mass_reg_file").addClass("active");
							    		$("[name=success_send]").val("true");
							    	}
							    }
							});
						});
						$(".send_mass_reg_file.active").click(function(e){
							$(this).parents("form").submit();
						});
			        });
			    </script>
			</div>
		</div>
	</div>
 </main>
<?
//echo "<pre>"; print_r($_POST); echo "</pre>";



require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php' );
