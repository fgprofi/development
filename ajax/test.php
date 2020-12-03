<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//$APPLICATION->SetTitle("");

CModule::IncludeModule("iblock");
$lang = getRubricators( 1 );
$ca = getRubricators( 3 );
$regions = getRubricators( 4 );
$ndyc = getRubricators( 6 );
$konc = getRubricators( 5 );
$vd = getRubricators( 2 );
$arRubricators[7]["LANGUAGE_SKILLS"] = $lang;
$arRubricators[7]["TARGET_AUDIENCE"] = $ca;
$arRubricators[7]["REGION_OF_RESIDENCE"] = $regions;
$arRubricators[7]["WORK_REGIONS"] = $regions;
$arRubricators[7]["FINANCIAL_LITERACY_COMPETENCIES"] = $konc;
$arRubricators[7]["KIND_OF_ACTIVITY"] = $vd;
$arRubricators[8]["TARGET_AUDIENCE"] = $ca;
$arRubricators[8]["LOCATION_REGION"] = $regions;
$arRubricators[8]["REGIONS_THE_ORGANIZATION_WORKS_WITH"] = $regions;
$arRubricators[8]["FINANCIAL_LITERACY_AREAS"] = $ndyc;
$arRubricators[8]["TYPE_ORGANIZATION"] = $vd;
$data = $_REQUEST;
$arIblocks = array('TYPE_F' => 7, 'TYPE_U' => 8);
$iblock = $arIblocks['TYPE_F'];

$users = CIBlockElement::getList(array('NAME'=>'ASC'), array('IBLOCK_ID' => $iblock));
$ar_result  = array();
$ar_users = array(830);
while($res = $users->GetNextElement())
{
	if(in_array($res->GetFields()['ID'], $ar_users)){
		$ar_result[$res->GetFields()['ID']]['fields'] = $res->GetFields();
		$ar_result[$res->GetFields()['ID']]['props'] = $res->GetProperties();
	}
}
echo "<pre>"; print_r($ar_result); echo "</pre>";
die();
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
?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>