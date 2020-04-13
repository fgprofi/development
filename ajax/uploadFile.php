<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
function reSaveFile($fileId){
	$fileInfo = CFile::GetFileArray( $fileId );
	$exten = explode('.',$fileInfo["ORIGINAL_NAME"]);
//	echo "<pre>"; print_r($exten); echo "</pre>";
	if($fileInfo != ""){
		$file = $_SERVER["DOCUMENT_ROOT"].$fileInfo["SRC"];
		$newfile = $_SERVER["DOCUMENT_ROOT"].'/upload/autofill_reestr/reestr.'.$exten[1];
		if(file_exists($newfile)){
			unlink($newfile);
		}
		// echo "<pre>"; print_r(__DIR__); echo "</pre>";
		//echo "<pre>"; print_r($newfile); echo "</pre>";
		if (!copy($file, $newfile)) {
		    //echo "не удалось скопировать $file...\n";
		}else{

		}
		CFile::Delete($fileId);
	}
}

if(isset($_POST["REESTR"]) && $_POST["REESTR"] != ""){
	if(is_array($_POST["REESTR"])){
		foreach ($_POST["REESTR"] as  $fileData) {
			reSaveFile($fileData);
		}
	}else{
		reSaveFile($_POST["REESTR"]);
	}
	print_r($_POST["REESTR"]);
}

?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>