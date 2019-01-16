<?php
try {

	$login_id = $_POST["login_id"]//jsondata;
	$word = $_POST["password"]//jsondata;

	// connect
	$db = new PDO("sqlite:\maruoka\maruoka_db");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$sql = "PRAGMA foreign_keys = ON";
	$db->query($sql);

	$sql = "select user_id, adminFlg from users
where login_id = '$login_id'
and password = '$word'";
	$res = $db -> query($sql);
	$data = $res -> fetch();

	// cutting
	$db = null;

	if($data["adminFlg"] == "1"){
		$sql = "select store_id, name from stores
		where user_id = $data["user_id"]";
		$res = $db -> query($sql);
		$store_data = $res -> fetchAll();

		$result["info"] = json_encode($store_data)
	} else {
		$result = null;
	}

} catch (Exception $e) {

	//echo $e->getMessage() . PHP_EOL;
	$resutl = null;

}
?>
