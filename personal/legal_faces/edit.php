<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$USER_PROP = needAuth('/freg/', $_REQUEST["ID"]);
$APPLICATION->SetTitle("Настройки пользователя");
?><?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"user_profile_edit",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_CODE" => "",
		"ELEMENT_ID" => $_REQUEST["id"],
		"FIELD_CODE" => array(),
		"IBLOCK_ID" => 8,
		"IBLOCK_TYPE" => "person",
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Страница",
		"PROPERTY_CODE" => array(
			"FORM_OF_INCORPORATION",
			"INN",
			"KPP",
			"OGRN",
			"FG_UNIT",
			"LOCATION_REGION",
			"LOCALITY",
			"ACTUAL_ADDRESS",
			"PHONE",
			"EMAIL",
			"SITE_PAGE",
			"USER_ID",
			"MARK_FOR_A_TECHNICAL_SPECIALIST",
			"FINANCIAL_LITERACY_AREAS",
			"TYPE_ORGANIZATION",
			"TARGET_AUDIENCE",
			"REGIONS_THE_ORGANIZATION_WORKS_WITH",
			"CONTRACTOR_FOR_MATERIALS",
			"ADDITIONAL_INFORMATION",
			"INTERNAL_COMMENTS",
			"EXPERT_RATING",
			"SIGN_OF_USER_DATA_DELETION",
			"VERIFICATION_PASSED_BY_MODERATOR",
			"CUSTOMER_CARD_ACTIVITY",
		),
		"PROPERTY_CODE_VIEW" => array(
			"FORM_OF_INCORPORATION",
			"INN",
			"KPP",
			"OGRN",
			"FG_UNIT",
			"LOCATION_REGION",
			"LOCALITY",
			"ACTUAL_ADDRESS",
			"PHONE",
			"EMAIL",
			"SITE_PAGE",
			"USER_ID",
			"MARK_FOR_A_TECHNICAL_SPECIALIST",
			"FINANCIAL_LITERACY_AREAS",
			"TYPE_ORGANIZATION",
			"TARGET_AUDIENCE",
			"REGIONS_THE_ORGANIZATION_WORKS_WITH",
			"CONTRACTOR_FOR_MATERIALS",
			"ADDITIONAL_INFORMATION",
			"INTERNAL_COMMENTS",
			"EXPERT_RATING",
			"SIGN_OF_USER_DATA_DELETION",
			"VERIFICATION_PASSED_BY_MODERATOR",
			"CUSTOMER_CARD_ACTIVITY",
		),
		"PROPERTY_GROOP"=>array(
			"REGIONS_THE_ORGANIZATION_WORKS_WITH"=>"REGIONS_THE_ORGANIZATION_WORKS_WITH_CUSTOM",
			"TYPE_ORGANIZATION"=>"TYPE_ORGANIZATION_CUSTOM",
			"TARGET_AUDIENCE"=>"TARGET_AUDIENCE_CUSTOM",
			"LOCATION_REGION"=>"LOCATION_REGION_CUSTOM",
			"EXPERT_RATING"=>"EXPERT_RATING_CUSTOM",
			"FORM_OF_INCORPORATION"=>"FORM_OF_INCORPORATION_CUSTOM",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_SHARE" => "N"
	)
);?>
<?//echo "<pre>"; print_r($USER_PROP); echo "</pre>";?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>