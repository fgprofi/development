<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(CModule::IncludeModule("iblock")){ 
	// $rsUser = CUser::GetByLogin("1234567890123");
	// $arUser = $rsUser->Fetch();
	// $iterator = CIBlockElement::GetPropertyValues(7, array('ID' => 517), true, array('ID' => 10));
	// if ($row = $iterator->Fetch())
	// {
	//   print_r($row);
	// }
	// echo "<pre>"; print_r($arUser); echo "</pre>";
	// $properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>8));

	// while ($prop_fields = $properties->GetNext())
	// {
	//   $arAllProp[$prop_fields["ID"]] = $prop_fields;
	// }
	// echo "<pre>"; print_r($arAllProp); echo "</pre>";
	/*foreach ($arProp as $propName => $prop) {
		if($propName == "HIDDEN_VIEW"){

			foreach ($arData["HIDDEN_VIEW"] as $value) {
				if($value != 0 && $value != ""){
					unset($arAllProp[$value]);
				}
			}
			$dataValHiddenProp = implode(",", $arAllProp);
		}else{
			if(is_array($prop) && count($prop)>=1){
				if($prop[0] == ""){
					unset($prop[0]);
				}
			}
		}
	}*/
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>