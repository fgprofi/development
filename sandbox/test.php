<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
//phpinfo();
//$res = \CUser::SendPassword(
//	'svisor84@mail.ru',
//	'svisor84@mail.ru',
//	's1',
//	'',
//	''
//);
$event = new CEvent;
$event->Send("USER_PASS_REQUEST", "s1", array("EMAIL"=>'svisor84@mail.ru'));
//echo"<pre>";
//print_r($res);
//var_dump(mail('stnslvmukhin@gmail.com', 'My Subject', "test"));

//require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php' );
//CModule::IncludeModule("iblock");
//
//$PROP[ "FORM_OF_INCORPORATION" ] = "JJJ";
//	$PROP[ "FIZ_USER_ID" ]           = "405";
//	$PROP[ "FIRST_NAME" ]            = "JJJ gggg";
//	$PROP[ "OGRN" ]                  = "0987654321098";
//	$PROP[ "EMAIL" ]                 = "svisor84@mail.ru";
//	$PROP[ "USER_ID" ]               = 213;
//	$PROP[ "PERSONAL_DATA"] = 2;
//;
//
//CIBlockElement::SetPropertyValuesEx(405,7,array("REPRESENTATIVE_OF_LEGAL_FACES"=>array(427)));
