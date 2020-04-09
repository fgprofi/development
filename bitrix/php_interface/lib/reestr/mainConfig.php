<?php


namespace reestr;
use \Bitrix\Main\Loader;

class mainConfig {
	public $IBLOCK_UR = 8;
	public $IBLOCK_FZ = 7;

	/**
	 * @return int
	 */
	public function getIBLOCKFZ() {
		return $this->IBLOCK_FZ;
	}

	/**
	 * @return int
	 */
	public function getIBLOCKUR() {
		return $this->IBLOCK_UR;
	}

	public function FindFizByUr($ogrn){
		\CModule::IncludeModule("iblock");
		$usr = \CUser::GetByLogin($ogrn)->Fetch();
		$arEmails = array();
		$obRes =\CIBlockElement::GetList(array(),array("IBLOCK_ID" => $this->getIBLOCKFZ(), 'PROPERTY_REPRESENTATIVE_OF_LEGAL_FACES' => $usr['UF_USER_INFO_TYPE_U']), false, false, array('ID','PROPERTY_EMAIL'));
		while($res = $obRes->GetNext()){
			$arEmails[$res['ID']] = $res['PROPERTY_EMAIL_VALUE'];
		}
		return $arEmails;
	}
}
