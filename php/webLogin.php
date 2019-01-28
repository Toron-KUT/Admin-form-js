<?php
try {

	$json_str = file_get_contents('php://input');
	$json_data = json_decode($json_str, true);
	$login_id = $json_data["login_id"];
	$word = $json_data["password"];

	// connect
	$db = new PDO("sqlite:../../maruoka_db");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$sql = "PRAGMA foreign_keys = ON";
	$db->query($sql);

	$sql = "select clerk_id, adminFlg from clerks
where login_id = '$login_id'
and password = '$word'";
	$res = $db -> query($sql);
	$data = $res -> fetch();

	if(!empty($data) && strcmp($data["adminFlg"], "0") != 0){
		$clerk_id = $data["clerk_id"];
		$sql = "select store_id from stores
		where clerk_id = $clerk_id";
		$res = $db -> query($sql);
		$store_data = $res -> fetch();

		$response["flg"] = $data["adminFlg"];
		$response["info"] = $store_data["store_id"];
		$result = json_encode($response);
		echo $result;
	} else {
		$result = null;
		echo $result;
	}

	// cutting
	$db = null;

} catch (Exception $e) {

	//echo $e->getMessage() . PHP_EOL;
	$resutl = null;
	echo $reslt;

}
?>
