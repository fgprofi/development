<?
namespace reestr;
class HLWorker extends \reestr\mainConfig {
	public $filed_types = array(
		10 => 'text',
		11 => 'textarea',
		12 => 'checkbox',
		13 => 'radio',
		14 => 'date',
		15 => 'select',
		28 => 'tel'
	);

	/**
	 * @return array
	 */
	public function getFiledTypes() {
		return $this->filed_types;
	}


	/** Запрос всего из HLB */
	public function getDataFromHL($hl,$filter=array(),$select,$order=false){

		$hl_query = $hl::getList(array(
			'order'=>($order)?$order:array(),
			'select' => $select,
			'filter' => $filter
		));
		while ( $hl_result = $hl_query->Fetch()) {
			$result[] = $hl_result;
		}

		return $result;
	}

	/**
	 * @brief Инициируем HLB
	 * @param $hlblock_id - id необходимого hlb
	 * @return bool|mixed
	 */
	public function init($hlblock_id){
		$hlblock_id = intval($hlblock_id);
		if($hlblock_id <= 0) {
			return false;
		}

		static $_cache = [];
		if(!isset($_cache[$hlblock_id])) {
			\Bitrix\Main\Loader::IncludeModule('highloadblock');
			$hlblock   = \Bitrix\Highloadblock\HighloadBlockTable::getById($hlblock_id)->fetch();
			$entity   = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity( $hlblock );
			$_cache[$hlblock_id] = $entity->getDataClass();
		}

		return $_cache[$hlblock_id];
	}
}