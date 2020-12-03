<?php
namespace reestr;

use \Bitrix\Main\Loader;
use \Bitrix\Main\Event;

class sendMessage extends \reestr\mainConfig {

	public $mainConfig;
	public $event;

	public function __construct() {
		$this->mainConfig = new mainConfig();
		$this->event = new \CEvent;
	}
	public function sendChangePassUser($arUser, $emailStr){
		
		$arEventFields = array(
			'LAST_NAME' => $arUser["LAST_NAME"],
			'NAME' => $arUser["NAME"],
			'MESSAGE' => "Вы запросили ваши регистрационные данные.",
			'CHECKWORD' => $arUser["CHECKWORD"],
			'URL_LOGIN' => urlencode($arUser["LOGIN"]),
			'LOGIN' => $arUser["LOGIN"],
			'EMAIL' => $emailStr
		);
		// отправка сообщений
			//echo "<pre>"; print_r($arEventFields); echo "</pre>";
			//die();
		if($arUser["LOGIN"])
			return $this->event->Send( "USER_PASS_REQUEST", SITE_ID, $arEventFields );
		else
			return false;
	}
	public function sendChangePassUL($arUser, $emailStr){
		$arEm = explode(',',$emailStr);
		$arEventFields = array(
			'UL' => $arUser,
			'EMAIL' => $emailStr
		);
		// отправка сообщений
			//echo "<pre>"; print_r($arEventFields); echo "</pre>";
			//die();
		return $this->event->Send( "CHANGE_PASS_UL", SITE_ID, $arEventFields );
	}
	public function sendDeleteUser($arUser){
		$props = $arUser['props'];
		$arEventFields = array(
			'NAME' => $props['FIRST_NAME']['VALUE'].' '.$props['MIDDLENAME']['VALUE'],
			'EMAIL' => $props['EMAIL']['VALUE'],
			'THEME' => "Ваша запись удалена модератором",
			'TEXT' => "Ваш профиль был удалён модератором. <br>
		                                     Чтобы узнать причину удаления необходимо связаться с <a href=\"mailto:info@fgprofi.ru\">администратором (info@fgprofi.ru)</a>."
		);
		// отправка сообщений
		return $this->event->Send( "USER_BLOCK", SITE_ID, $arEventFields );

	}
	public function sendRefurbUser($arUser){
		$props = $arUser['props'];
		$arEventFields = array(
			'NAME' => $props['FIRST_NAME']['VALUE'].' '.$props['MIDDLENAME']['VALUE'],
			'EMAIL' => $props['EMAIL']['VALUE'],
			'THEME' => "Ваша запись восстановлена модератором",
			'TEXT' => "Ваш профиль был восстановлен модератором. <br>
		                                     Связаться с <a href=\"mailto:info@fgprofi.ru\">администратором (info@fgprofi.ru)</a>.<br>"
		);
		// отправка сообщений
		return $this->event->Send( "USER_BLOCK", SITE_ID, $arEventFields );
	}
	public function sendRefreshDataUser($arUser){
		$props = $arUser['props'];
		$arEventFields = array(
			'NAME' => $props['SURNAME']['VALUE'].' '.$props['FIRST_NAME']['VALUE'],
			'EMAIL' => $props['EMAIL']['VALUE'],
		);
		//echo "<pre>"; print_r($arEventFields); echo "</pre>";
		//return true;
		// отправка сообщений
		return $this->event->Send( "REFRESH_DATA_USER", SITE_ID, $arEventFields );
	}
	public function sendDeactivateUser($arUser){
		$props = $arUser['props'];
		$arEventFields = array(
			'NAME' => $props['FIRST_NAME']['VALUE'].' '.$props['MIDDLENAME']['VALUE'],
			'EMAIL' => $props['EMAIL']['VALUE'],
			'THEME' => "Ваш профиль заблокирован",
			'TEXT' => "Ваш профиль заблокирован.<br>Для того, чтобы узнать причину блокировки, необходимо связаться с <a href=\"mailto:info@fgprofi.ru\">администратором (info@fgprofi.ru)</a>.<br>"
		);
		// отправка сообщений
		return $this->event->Send( "USER_DEACTIVATE", SITE_ID, $arEventFields );

	}
	public function sendActivateUser($arUser){
		$props = $arUser['props'];
		$arEventFields = array(
			'NAME' => $props['FIRST_NAME']['VALUE'].' '.$props['MIDDLENAME']['VALUE'],
			'EMAIL' => $props['EMAIL']['VALUE'],
			'THEME' => "Ваш профиль разблокирован",
			'TEXT' => "Ваш профиль разблокирован.<br>Связаться с <a href=\"mailto:info@fgprofi.ru\">администратором (info@fgprofi.ru)</a>.<br>"
		);
		// отправка сообщений
		$this->event->Send( "USER_DEACTIVATE", SITE_ID, $arEventFields );
	}
	 public function sendChangePassUserByAdmin($arUser,$new_pass){
	 	$props = $arUser['props'];
	 	$arEventFields = array(
	 		'NAME' => $props['FIRST_NAME']['VALUE'].' '.$props['MIDDLENAME']['VALUE'],
	 		'PASSWORD' => $new_pass,
	 		'EMAIL' => $props['EMAIL']['VALUE']
	 	);
	 	$this->event->Send( "USER_CHANGE_PASS", SITE_ID, $arEventFields );
	 }
	public function sendNewUser($arEventFields){
		$this->event->Send("NEW_USER_CONFIRM", SITE_ID, $arEventFields);
	}
	public function sendModerateUser($arUser){
		$props = $arUser['props'];
		$arEventFields = array(
			'NAME' => $props['FIRST_NAME']['VALUE'].' '.$props['MIDDLENAME']['VALUE'],
			'EMAIL' => $props['EMAIL']['VALUE'],
			'THEME' => "Ваш профиль проверен модератором",
			'TEXT' => "Ваш профиль прошел модерацию.<br>Связаться с <a href=\"mailto:info@fgprofi.ru\">администратором (info@fgprofi.ru)</a>.<br>"
		);
		// отправка сообщений
		$this->event->Send( "USER_DEACTIVATE", SITE_ID, $arEventFields );
	}
	public function sendInviteFiz($arUser){
		$arEventFields = array(
			'NAME' => $arUser['FIRST_NAME'],
			'SURNAME' => $arUser['LAST_NAME'],
			'EMAIL' => $arUser['EMAIL'],
			'PASSWORD' => $arUser['PASSWORD'],
			'USER_ID' => $arUser['USER_ID'],
			'CONFIRM_CODE' => $arUser['CONFIRM_CODE'],
		);
		// отправка сообщений
		$this->event->Send( "INVITE_F", SITE_ID, $arEventFields );
	}
	public function sendInviteUr($arUser){
		$arEventFields = array(
			'NAME' => $arUser['NAME'],
			'EMAIL' => $arUser['EMAIL'],
			'FIRST_NAME' => $arUser['FIRST_NAME'],
			'LAST_NAME' => $arUser['LAST_NAME'],
			'PASSWORD' => $arUser['PASSWORD'],
			'USER_ID' => $arUser['USER_ID'],
			'CONFIRM_CODE' => $arUser['CONFIRM_CODE'],
			'LOGIN' => $arUser['OGRN'],
		);
		// отправка сообщений
		if($arUser['EMAIL'])
			$this->event->Send( "INVITE_U", SITE_ID, $arEventFields );
	}

}