<?class PDOExtReestr
{
	function GetMatchingFields($face){
		$res = array(
			"TYPE_F"=>array(
				"ID"=>"",
				"ACTIVE"=>array(
					"TYPE_FIELD"=>"",
				),
				"CREATE_DATE"=>array(
					"FORMAT"=>array(
						"DATE"=>"Y-m-d H:i:s",
					),
				),
				"CREATE_PERSON"=>array(
					"TYPE_FIELD"=>"PERSON",
				),
				"UPDATE_DATE"=>array(
					"FORMAT"=>array(
						"DATE"=>"Y-m-d H:i:s",
					),
				),
				"UPDATE_PERSON"=>array(
					"TYPE_FIELD"=>"PERSON",
				),
				"SURNAME"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"LAST_NAME",
				),
				"NAME"=>array(
					"TYPE_FIELD"=>"",
					"DB_FIELD_NAME"=>"FIRST_NAME",
				),
				"MIDDLENAME"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"SECOND_NAME",
				),
				"PHOTO"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"PHOTO",
					"FORMAT"=>"JSON"
				),
				"DATE_OF_BIRTH"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"BIRTHDAY",
					"FORMAT"=>array(
						"DATE"=>"Y-m-d",
					),
				),
				"EDUCATION"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"EDUCATION",
				),
				"LANGUAGE_SKILLS"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"LANGUAGES",
					"FORMAT"=>"JSON"
				),
				"REGION_OF_RESIDENCE"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"REGION",
				),
				"LOCALITY"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"TOWN",
				),
				"PHONE"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"PHONE",
				),
				"EMAIL"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"EMAIL",
				),
				"SOC"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"SOCNET",
					"FORMAT"=>"JSON"
				),
				"PLACE_OF_WORK"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"WORK_PLACE",
				),
				"POSITION"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"POSITION",
				),
				"KIND_OF_ACTIVITY"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"WORK_TYPE",
				),
				"FINANCIAL_LITERACY_COMPETENCIES"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"FG_COMPETENCE",
				),
				"TARGET_AUDIENCE"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"AUDITORIYA",
				),
				"SIFLAS"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"SPECIALIZATION",
				),
				"WORK_REGIONS"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"WORK_REGION",
				),
				"AUTHOR_OF_MATERIALS"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"MATERIAL_AUTHOR",
				),
				"ADDITIONAL_INFORMATION"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"EDITIONAL_INFO",
				),
				"PERSONAL_DATA"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"CONFURMATION",
				),
				"BRIEF_MESSAGE"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"BRIF",
				),
				"MEMBER_INFORMATION_SOURCE"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"ABOUT_INFO",
				),
				"INTERNAL_COMMENTS"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"IN_COMMENT",
				),
				"EXPERT_RATING"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"EXPERT_RAITING",
				),
				"VERIFICATION_PASSED_BY_MODERATOR"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"MODERATOR_CHECK",
				),
				"SIGN_OF_USER_DATA_DELETION"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"DELETE_STATUS",
				),
				"DATA_SERVER_CONFURMATION"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"DATA_SERVER_CONFURMATION",
				),
				"REPRESENTATIVE_OF_LEGAL_FACES"=>array(
					"TYPE_FIELD"=>"PROPERTY",
					"DB_FIELD_NAME"=>"ENTITY_NET",
				),
			),
			"TYPE_U"=>array(
				"",
			)
		);
		$ans = false;
		if(isset($res[$face])){
			$ans = $res[$face];
		}
		return $ans;
	}
	function GetDataArrayRequest(){
		$str = '
				Добавление
				----------------------------------------------
				$create_date = date("Y-m-d H:i:s");
				$update_date = date("Y-m-d H:i:s");
				$birthDay = date("Y-m-d H:i:s");
				$params = array(
					"request" => array(
						"event"=>"insert",
						"face"=>"TYPE_F",
						"values"=>array(
							NULL,
							1,
							$create_date,
							"2",
							$update_date,
							"3",
							"4",
							"5",
							"6",
							"7",
							$birthDay,
							"8",
							"9",
							"10",
							"11",
							"12",
							"13",
							"14",
							"15",
							"16",
							"17",
							"18",
							"19",
							"20",
							"21",
							"22",
							"23",
							1,
							"24",
							"25",
							"26",
							"27",
							1,
							1,
							"28",
							"29",
						),
					),
				);
				Выборка
				----------------------------------------------
				$paramss = array(
					"request" => array(
						"event"=>"select",
						"face"=>"TYPE_F",
						"filter"=>"ID=10",
						"select"=>array(
							"ID",
							"FIRST_NAME",
							"PHONE"
						),
					),
				);
				Обновление
				----------------------------------------------
				$params = array(
					"request" => array(
						"event"=>"update",
						"face"=>"TYPE_F",
						"values"=>array(
							"PHONE"=>"99999999999",
							"FIRST_NAME"=>"TEST"
						),
						"filter"=>"ID=10",
					),
				);
				Удаление
				----------------------------------------------
				$params = array(
					"request" => array(
						"event"=>"delete",
						"face"=>"TYPE_F",
						"filter"=>"ID=10",
					),
				);
				Просмотр полей таблицы
				----------------------------------------------
				$params = array(
					"request" => array(
						"event"=>"view_fields",
						"face"=>"TYPE_F",
					),
				);
				Вызов
				----------------------------------------------
				$result = PDOExtReestr::requestBase($params);';
		return $str;
	}
	function getTable($face){
		$arTables = array(
			"TYPE_F" => "t_individual",
			"TYPE_U" => "t_entity",
		);
		$table = false;
		if(isset($arTables[$face])){
			$table = $arTables[$face];
		}
		return $table;
	}
	function requestBase($params){
		/*$database = "cc18971_extreest";
		$user = "cc18971_extreest";
		$password = "QzafsV7g";*/
		$database = "cc18971_reestrt";
		$user = "cc18971_reestrt";
		$password = "rKZDKsU3";
		$face = $params["request"]["face"];
		$table = self::getTable($face);
		if(!isset($params["request"]) || empty($params["request"])){
			$result["error"][] = "Нет данных";
		}
		if(!$table){
			$result["error"][] = "Не найдена таблица";
		}
		if(!isset($params["request"]["event"]) || empty($params["request"]["event"])){
			$result["error"][] = "Нет действия";
		}
		if(!isset($result["error"])){
			$params["request"]["table"] = $table;
			try {
				$dbh = new PDO('mysql:host=localhost;dbname='.$database, $user, $password);

				$q = $dbh->prepare("DESCRIBE ".$params["request"]["table"]);
				$q->execute();
				$table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
				if($params["request"]["event"] == "view_fields"){
					return $table_fields;
				}
			    if(in_array($params["request"]["event"], array("insert"))){
			    	if(!isset($params["request"]["values"]) || empty($params["request"]["values"])){
						$result["error"][] = "Нет значений";
					}
					if(isset($result["error"])){
						return $result;
					}
			    }
			    $resFields = self::fieldFormat($face, $params["request"]["values"], $params["request"]["event"]);
			    echo "<pre>"; print_r($resFields["data"]); echo "</pre>";
			    $request = self::greateRequest($params["request"], $table_fields, $resFields["request"], $resFields["data"]);
			    echo "<pre>"; print_r($request); echo "</pre>";
			    //die();
			    if(isset($request["error"])){
			    	$result["error"] = $request["error"];
					return $result;
				}
			    $sth = $dbh->prepare($request);
				$sth->execute($resFields["data"]);
				$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			    $dbh = null;
			} catch (PDOException $e) {
			    print "Error!: " . $e->getMessage() . "<br/>";
			    die();
			}
		}
		return $result;
	}
	function fieldFormat($face, $values, $event){
		$mFields = self::GetMatchingFields($face);
		$res = array();
		$res["data"] = array();
		if(!in_array($event, array("insert", "update"))){
			return $res;
		}
		foreach ($mFields as $key => $fieldSetting) {
			$dbField = strtolower($key);
			if(isset($fieldSetting["DB_FIELD_NAME"])){
				$dbField = strtolower($fieldSetting["DB_FIELD_NAME"]);
			}
			if(isset($values[$key])){
				$data = $values[$key];
				if(isset($fieldSetting["FORMAT"])){
					if(isset($fieldSetting["FORMAT"]["DATE"])){
						$data = MakeTimeStamp($data);
						//echo $fieldSetting["FORMAT"]["DATE"];
						$data = date($fieldSetting["FORMAT"]["DATE"], $data);
					}
					if($fieldSetting["FORMAT"] == "JSON"){
						$data = json_encode($data);
					}
				}
				$res["request"][$dbField] = $data;
				$res["data"][$dbField] = $data;
			}else{
				$res["request"][$dbField] = NULL;
				if($event == "insert"){
					$res["data"][$dbField] = NULL;
				}
			}

		}
		return $res;
	}
	public function greateRequest($params, $data_table_fields, $value_request, $data_value_request){
		$arEvents = array(
			"select"=>"SELECT",
			"insert"=>"INSERT INTO",
			"update"=>"UPDATE",
			"delete"=>"DELETE FROM",
		);
		$strRequest = "";
		if($arEvents[$params["event"]]){
			$strRequest = $arEvents[$params["event"]];
		}
		//echo "<pre>"; print_r($data_value_request); echo "</pre>";
		switch ($params["event"]) {
			case 'insert':
				$valuesPr = "";
				foreach ($data_table_fields as $key => $field) {
					$valuesPr .= ":".strtolower($field);
					if(isset($data_table_fields[$key+1])){
						$valuesPr .= ", ";
					}
				}
				$table_fields_str = implode(", ", $data_table_fields);
				$strRequest .= " ".$params["table"]." (".$table_fields_str.") VALUES (".$valuesPr.")";
				break;
			case 'select':
				$select = "*";
				if(isset($params["select"]) && $params["select"] != ""){
					if(count($params["select"])>1){
						$select = implode(", ", $params["select"]);
					}else{
						$select = $params["select"][0];
					}
				}
				$filter = "";
				if(isset($params["filter"]) && $params["filter"] != ""){
					$filter = " WHERE ".$params["filter"];
				}
				$strRequest .= " ".$select." FROM ".$params["table"].$filter;
				break;
			case 'update':
				if(isset($data_value_request) && $data_value_request != ""){
					$set = "";
					foreach ($data_value_request as $key => $val) {
						$key = strtoupper($key);
						if(is_string($val)){
							$val = "'".$val."'";
						}
						$set .= $key."=".$val.", ";
					}
					$set = substr($set, 0, -2);
				}else{
					$strRequest["error"] = "Нет значений";
					return $strRequest;
				}
				$filter = "";
				if(isset($params["filter"]) && $params["filter"] != ""){
					$filter = " WHERE ".$params["filter"];
				}else{
					$strRequest["error"] = "Нет данных для фильтрации";
					return $strRequest;
				}
				$strRequest .= " ".$params["table"]." SET ".$set." ".$filter;
				break;
			case 'delete':
				$filter = "";
				if(isset($params["filter"]) && $params["filter"] != ""){
					$filter .= $params["filter"];
				}else{
					$strRequest["error"] = "Нет данных для фильтрации";
					return $strRequest;
				}
				$strRequest .= " ".$params["table"]." WHERE ".$filter;
				break;
		}
		echo $strRequest;
		// die();
		return $strRequest;
	}
}?>