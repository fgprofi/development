<?
ob_start();
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//$APPLICATION->SetTitle("");

CModule::IncludeModule("iblock");

$data = $_REQUEST;
$arIblocks = array('TYPE_F' => 7, 'TYPE_U' => 8);
$iblock = $arIblocks[$data['user_type']];

$users = CIBlockElement::getList(array('NAME'=>'ASC'), array('IBLOCK_ID' => $iblock));
$ar_users        = explode(',',$_REQUEST['users']);
$ar_result  = array();

while($res = $users->GetNextElement())
{
	if(in_array($res->GetFields()['ID'], $ar_users)){
		$ar_result[$res->GetFields()['ID']]['fields'] = $res->GetFields();
		$ar_result[$res->GetFields()['ID']]['props'] = $res->GetProperties();
	}
}
$a=0;
$arHeads = array();
$exceptions = array('MARGE_ID','CUSTOMER_CARD_ACTIVITY','HIDDEN_VIEW','CONFIRMED','USER_ID','PHOTO');
foreach($ar_result as $k=>$v){
	if($a == 0){
		foreach($v['props'] as $val){
			if(!in_array($val['CODE'],$exceptions))
			$arHeads[$val['CODE']] = $val['NAME'];
		}
	}
	$a++;
}

//$heads = array(
//	7 => array(
//		'SURNAME' => 'Фамилия',
//		'FIRST_NAME' => 'Имя',
//		'MIDDLENAME' => 'Отчество',
//		'DATE_OF_BIRTH' => 'Отчество',
//		'EDUCATION' => 'Отчество',
//		'LANGUAGE_SKILLS' => 'Отчество',
//		'REGION_OF_RESIDENCE' => 'Отчество',
//		'LOCALITY' => 'Отчество',
//		'PHONE' => 'Отчество',
//		'EMAIL' => 'Отчество',
//		'SOC' => 'Отчество',
//		'PLACE_OF_WORK' => 'Отчество',
//		'POSITION' => 'Отчество',
//		'KIND_OF_ACTIVITY' => 'Отчество',
//		'FINANCIAL_LITERACY_COMPETENCIES' => 'Отчество'
//	),
//	8 => array(
//		'FIRST_NAME' => 'Название',
//	),
//);

$str  = implode(";",$arHeads)."\n";
foreach($ar_result as $key=>$val)
{
	foreach($arHeads as $kH => $kV){
		if(isset($val['props'][$kH]['LINK_IBLOCK_ID']) && !empty($val['props'][$kH]['LINK_IBLOCK_ID']) && !empty($val['props'][$kH]['VALUE'])){
			$vArName = array();
			$arIbRes = array();
			$obRes = CIBlockElement::GetList(array(),array('IBLOCK_ID'=>$val['props'][$kH]['LINK_IBLOCK_ID']),false,false,array('ID','NAME'));
			while($r = $obRes->getNext()){
				$arIbRes[$r['ID']] = $r['NAME'];
			}
			foreach($val['props'][$kH]['VALUE'] as $kHid)
			{
				$vArName[] = str_replace("&quot;","\"",htmlspecialchars_decode($arIbRes[$kHid]));
			}
			$myArray[$kH] = implode(', ',$vArName);
		}else{
			if(is_array($val['props'][$kH]['VALUE'])){
				$arNn = array();
				foreach($val['props'][$kH]['VALUE'] as $nN){
					$arNn[] = str_replace("&quot;","\"",htmlspecialchars_decode($nN));
				}
				$myArray[$kH] = implode(', ',$arNn);
			}else{
				$myArray[$kH] = str_replace("&quot;","\"",htmlspecialchars_decode(str_replace(array('\"',),'',$val['props'][$kH]['VALUE'])));
			}
		}

	}

	$str.= implode(';', $myArray)."\n";
}

//echo"<pre>";
//print_r($str);
//die();
header("Content-type: csv/plain");
header("Content-Disposition: attachment; filename=users_by_filter_".date("d_m_Y").".csv");
ob_end_clean();
echo $str;
exit;

?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>