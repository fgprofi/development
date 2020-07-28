<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Авторизация");?>
<?if(isset($_GET["confirm_code"])):?>
	<?$APPLICATION->IncludeComponent("bitrix:system.auth.confirmation","",Array(
	        "USER_ID" => "confirm_user_id", 
	        "CONFIRM_CODE" => "confirm_code", 
	        "LOGIN" => "login" 
	    )
	);?>
<?elseif($_GET['change_password']):?>
	<?$APPLICATION->IncludeComponent("deus:system.auth.changepasswd","",Array(
			"USER_CHECKWORD" => "USER_CHECKWORD",
			"USER_LOGIN" => "USER_LOGIN",
			'AUTH_RESULT' => $APPLICATION->arAuthResult
		)
	);?>
<?else:?>
	<?redirAfterAuth();?>
	<?$APPLICATION->IncludeComponent("bitrix:system.auth.form","",Array(
	     "REGISTER_URL" => "/freg/",
	     "FORGOT_PASSWORD_URL" => "/auth/restore_password/",
	     "PROFILE_URL" => "/auth/success/",
	     "SHOW_ERRORS" => "Y" 
	     )
	);?>
<?endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>