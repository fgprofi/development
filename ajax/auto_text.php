<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(isset($_REQUEST)){
	$arData = $_REQUEST;
	if(CModule::IncludeModule("iblock")){
		$arParams = array(
			"TYPE_F" => 7,
			"TYPE_U" => 8,
		);
		$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
		$arFilter = Array("IBLOCK_ID"=>$arParams[$arData["face"]], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
		$filterField = $arData["input"];
		$pr = "";
		if($arData["input"] != "NAME"){
			$filterField = "PROPERTY_".$arData["input"];
			$arSelect[] = $filterField;
			$pr = "_VALUE";
		}
		$arFilter[$filterField] = "%".$arData[$arData["input"]]."%";
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ob = $res->Fetch())
		{
			$arResult[] = $ob[$filterField.$pr];
			$arResultFio[] = $ob["NAME"];
		}
		$arFioProp = array("FIRST_NAME", "SURNAME");
		$str = "<div class='selector-input'>";
		if(!empty($arResult)){
			foreach ($arResult as $key => $value) {
				$valueText = $value;
				// if(in_array($arData["input"], $arFioProp)){
				// 	$valueText = $arResultFio[$key];
				// }
				$str .= "<div class='selector-value' data-value='".$value."'>".$valueText."</div>";
			}
			$str .= "<div class='selector-value' data-value=''>Сбросить</div>";
		}else{
			$str .= "<div class='selector-value disabled'>Нет подходящих значений</div>";
		}

		$str .= "</div>";
		//echo $str;
		// echo "<pre>"; print_r($arResult); echo "</pre>";
		// echo "<pre>"; print_r($arFilter); echo "</pre>";
	}
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>