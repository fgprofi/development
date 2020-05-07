<?
// if (file_exists($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/PDOExtReestr.php")){
//    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/PDOExtReestr.php");
// }
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/php_interface/autoload.php';

function getRusMonth($d, $when){
	$months = array(
		'01' => 'январь',
		'02' => 'февраль',
		'03' => 'март',
		'04' => 'апрель',
		'05' => 'май',
		'06' => 'июнь',
		'07' => 'июль',
		'08' => 'август',
		'09' => 'сентябрь',
		'10' => 'октябрь',
		'11' => 'ноябрь',
		'12' => 'декабрь',
	);
	if($when){
		$months = array(
			'01' => 'января',
			'02' => 'февраля',
			'03' => 'марта',
			'04' => 'апреля',
			'05' => 'мая',
			'06' => 'июня',
			'07' => 'июля',
			'08' => 'августа',
			'09' => 'сентября',
			'10' => 'октября',
			'11' => 'ноября',
			'12' => 'декабря',
		);
	}
	return $months[$d];
}
function getFacesNeedModeration($ib){
	if(CModule::IncludeModule("iblock")){
		if(isAdministrator()){
			$arVal = array(
				7 => 4,
				8 => 10
			);
			$arSelect = Array("ID", "NAME", "CODE");
			$arFilter = Array("IBLOCK_ID"=>$ib, "ACTIVE"=>"Y", "!PROPERTY_VERIFICATION_PASSED_BY_MODERATOR" => $arVal[$ib]);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			$arResult = array();
			while($ob = $res->Fetch())
			{
				$arResult[$ob['ID']] = $ob;
			}
			return $arResult;
		}else{
			return false;
		}
	}
}
function getRubricators($rubId){
	if(isset($rubId)){
		$ib = $rubId;
		if(CModule::IncludeModule("iblock")){
			$arSelect = Array("ID", "NAME", "CODE");
			$arFilter = Array("IBLOCK_ID"=>$ib, "ACTIVE"=>"Y");
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ob = $res->Fetch())
			{
				$arResult[$ob['ID']] = $ob;
			}
			ksort($arResult);
		}
	}else{
		$arResult = "test";
	}
	return $arResult;
}
AddEventHandler("main", "OnAfterUserAdd", Array("UserRegisterHandler", "OnAfterUserRegisterHandler"));
function isAdministrator(){
	global $USER;
	if ($USER->IsAuthorized()){
		$arGroups = CUser::GetUserGroup($USER->getID());
		if(in_array(10, $arGroups) || in_array(1, $arGroups)){
			return true;
		}else{
			return false;
		}
	}
}
function redirAfterAuth(){
	global $USER;
	if ($USER->IsAuthorized()){
		if(isAdministrator()){
			LocalRedirect("/admin/");
		}else{
			LocalRedirect("/personal/");
		}
	}
}
function needAuth_v2($redir, $face_id = false){
	global $USER;
	$arUserFields = array();
	if (!$USER->IsAuthorized()){
		if($redir != false){
			LocalRedirect($redir);
		}
	}else{
		$arDataParamsProp = array(
			"TYPE_F" => array(
				"IBLOCK_ID" => 7,
				"PROP_DETAIL" => array(
					"1"
				)
			),
			"TYPE_U" => array(
				"IBLOCK_ID" => 8,
				"PROP_DETAIL" => array(
					"1"
				)
			),
		);

		if(isAdministrator())
		{
			$uID = base64_decode($face_id);
		}
		else
		{
			$uID = $USER->getID();
		}

		$rsUser = CUser::GetList(($by="ID"), ($order="desc"), array("ID"=>$uID),array("SELECT"=>array("UF_*")));

		$arDataUserFields = $rsUser->Fetch();
//		echo"<pre>";
//		print_r($arDataUserFields);
//		echo"</pre>";
		foreach ($arDataParamsProp as $face => $params) {
			if($arDataUserFields["UF_USER_INFO_".$face] != ""){
				$params["USER_INFO"] = $arDataUserFields;
				$params["ID_USER_INFO"] = $arDataUserFields["UF_USER_INFO_".$face];

				if(CModule::IncludeModule("iblock")){
					$res = CIBlockElement::GetProperty($params["IBLOCK_ID"], $params["ID_USER_INFO"], "sort", "asc", array("CODE" => "REPRESENTATIVE_OF_LEGAL_FACES"));
					while ($ob = $res->GetNext())
					{
						$params["USER_LEGAL_FACES"][] = $ob['VALUE'];
					}
					$rsUser = CUser::GetList(($by="ID"), ($order="desc"), array("ID"=>implode('|', $params["USER_LEGAL_FACES"])),array("SELECT"=>array("UF_*")));
					while($arDataUserLegalFaceFields = $rsUser->Fetch()){
						$params["PROFILE_LEGAL_FACES"][] = $arDataUserLegalFaceFields["UF_USER_INFO_TYPE_U"];
					}
				}

				$arUserFields = $params;
				break;
			}
		}

	}
	return $arUserFields;
}
function needAuth($redir, $legal_face_id = false){
	global $USER;
	$arUserFields = array();
	if (!$USER->IsAuthorized()){
		if($redir != false){
			LocalRedirect($redir);
		}
	}else{
		$arDataParamsProp = array(
			"TYPE_F" => array(
				"IBLOCK_ID" => 7,
				"PROP_DETAIL" => array(
					"1"
				)
			),
			"TYPE_U" => array(
				"IBLOCK_ID" => 8,
				"PROP_DETAIL" => array(
					"1"
				)
			),
		);

		if(isAdministrator())
		{
			$uID = CIBlockElement::getList(array(),array("IBLOCK_ID"=>7,"ID"=>$_GET['id']),false,false,array("PROPERTY_USER_ID"))->Fetch()['PROPERTY_USER_ID_VALUE'];
			if(!$uID)
				$uID = CIBlockElement::getList(array(),array("IBLOCK_ID"=>8,"ID"=>$_GET['id']),false,false,array("PROPERTY_USER_ID"))->Fetch()['PROPERTY_USER_ID_VALUE'];
		}
		else
		{
			$uID = $USER->getID();
		}

		$rsUser = CUser::GetList(($by="ID"), ($order="desc"), array("ID"=>$uID),array("SELECT"=>array("UF_*")));

		$arDataUserFields = $rsUser->Fetch();
		foreach ($arDataParamsProp as $face => $params) {
			if($arDataUserFields["UF_USER_INFO_".$face] != ""){
				$params["USER_INFO"] = $arDataUserFields;
				$params["ID_USER_INFO"] = $arDataUserFields["UF_USER_INFO_".$face];

				if(CModule::IncludeModule("iblock") && $face == "TYPE_F"){
					$res = CIBlockElement::GetProperty($params["IBLOCK_ID"], $params["ID_USER_INFO"], "sort", "asc", array("CODE" => "REPRESENTATIVE_OF_LEGAL_FACES"));
					while ($ob = $res->GetNext())
					{
						$params["USER_LEGAL_FACES"][] = $ob['VALUE'];
					}
					$rsUser = CUser::GetList(($by="ID"), ($order="desc"), array("ID"=>implode('|', $params["USER_LEGAL_FACES"])),array("SELECT"=>array("UF_*")));
					while($arDataUserLegalFaceFields = $rsUser->Fetch()){
						$params["PROFILE_LEGAL_FACES"][] = $arDataUserLegalFaceFields["UF_USER_INFO_TYPE_U"];
					}

					if($legal_face_id){
						$legal_face_id = intval($legal_face_id);
						// if(!in_array($legal_face_id, $params["PROFILE_LEGAL_FACES"])){
						// 	LocalRedirect("/personal/");
						// }
					}
				}

				$arUserFields = $params;
				break;
			}
		}

	}
	return $arUserFields;
}
class UserRegisterHandler
{
    function OnAfterUserRegisterHandler(&$arFields) {
    	//die();
        if ($arFields['ID'] > 0) {
			if(CModule::IncludeModule("iblock")){
				$el = new CIBlockElement;
				$arIblock = array(
					"TYPE_F" => array(
						"IBLOCK_ID" => 7,
						"U_IBLOCK_ID" => 8,
						"USER_GROUP" => 8,
						"MERGE" => 'FIZ_USER_ID',
						"PROPS" => array(
							"SURNAME"=>"SURNAME",
							"FIRST_NAME"=>"NAME_TYPE_F",
							"REGION_OF_RESIDENCE" => "REGION_OF_RESIDENCE",
							"KIND_OF_ACTIVITY" => "KIND_OF_ACTIVITY",
						),
					),
					"TYPE_U" => array(
						"IBLOCK_ID" => 8,
						"U_IBLOCK_ID" => 7,
						"USER_GROUP" => 9,
						"MERGE" => 'REPRESENTATIVE_OF_LEGAL_FACES',
						"PROPS" => array(
							"FORM_OF_INCORPORATION" => "FORM_OF_INCORPORATION",
							"FIZ_USER_ID" => "ID_USER_PR",
							"FIRST_NAME"=>"NAME_TYPE_U",
						),
					),
				);
				$PROP = array();
				foreach($arIblock[$_POST["FACE"]]["PROPS"] as $key => $pr){
					$PROP[$key] = $_POST[$pr];
				}
				$PROP["OGRN"] = $_POST['REGISTER']['LOGIN'];
				$PROP["EMAIL"] = $arFields["EMAIL"];
				$PROP['USER_ID'] = $arFields['ID'];
				if($arFields['PRIVATE_POLICY'] == 'on')
					$PROP['PERSONAL_DATA'] = 2;
				if($_POST["FACE"] == 'TYPE_U'){
					$PROP['FIRST_NAME'] = $PROP['FORM_OF_INCORPORATION'].' '.$PROP['FIRST_NAME'];
				}
				$name = "NAME_".$_POST["FACE"];
				$arLoadProductArray = Array(
					"MODIFIED_BY"    => 1,
					"IBLOCK_SECTION_ID" => false,
					"IBLOCK_ID"      => $arIblock[$_POST["FACE"]]["IBLOCK_ID"],
					"PROPERTY_VALUES"=> $PROP,
					"NAME"           => $PROP['SURNAME'].' '.$PROP['FIRST_NAME'].' '.$PROP['MIDDLENAME'],
					"ACTIVE"         => "Y",
				);

				$PRODUCT_ID = $el->Add($arLoadProductArray);

				//идет обратная связка с пользователем
				$user = new CUser;
				$userInfoField = "UF_USER_INFO_".$_POST["FACE"];
				$fields = Array( 
					$userInfoField => $PRODUCT_ID, 
				);
				$user->Update(intval($arFields['ID']), $fields);
				// прописываем в элемент пользователя привязку к юрлицу
				// а в элемент юрлица пользователя физлица
				$obRes = CIBlockElement::GetList(array(),array('IBLOCK_ID'=>$arIblock[$_POST["FACE"]]["U_IBLOCK_ID"],"ID" => $_POST['ID_USER_PR']))->GetNextElement();
				if($obRes){
					$pProps = $obRes->GetProperties();
					$arU = array();
					// собираем уже записанные данные
					if(is_array($pProps[$arIblock[$_POST["FACE"]]["MERGE"]]['VALUE']))
					{
						$r = $pProps[$arIblock[$_POST["FACE"]]["MERGE"]]['VALUE'];
						$r[] = $PRODUCT_ID;
						$arU[$arIblock[$_POST["FACE"]]["MERGE"]]['VALUE'][] = $r;
					}
					else
					{
						$arU[$arIblock[$_POST["FACE"]]["MERGE"]]['VALUE'][] = $PRODUCT_ID;
					}

					CIBlockElement::SetPropertyValuesEx(
						$PROP['FIZ_USER_ID'],
						$arIblock[$_POST["FACE"]]["U_IBLOCK_ID"],
						array(
							$arIblock[$_POST["FACE"]]["MERGE"] => $arU[$arIblock[$_POST["FACE"]]["MERGE"]]['VALUE']
						)
					);
				}

				$arGroups = CUser::GetUserGroup(intval($arFields['ID']));
				$arGroups[] = $arIblock[$_POST["FACE"]]["USER_GROUP"];
				CUser::SetUserGroup(intval($arFields['ID']), $arGroups);
			}
//			 echo "<pre>"; print_r($PROP['FIZ_USER_ID']); echo "</pre>";
//			 echo "<pre>"; print_r($arIblock[$_POST["FACE"]]["U_IBLOCK_ID"]); echo "</pre>";
//			 echo "<pre>"; print_r($arIblock[$_POST["FACE"]]["MERGE"]); echo "</pre>";
//	         echo "<pre>"; print_r($arU[$arIblock[$_POST["FACE"]]["MERGE"]]['VALUE']); echo "</pre>";
//			 die();
        }
    }
}
?>