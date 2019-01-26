<?php
try {

	$json_str = file_get_contents('php://input');
	$json_data = json_decode($json_str, true);
	$store_id = $json_data["store_id"];
	$name = $json_data["name"];
	$user_id = $json_data["user_id"];

	// connect
	$db = new PDO("sqlite:\maruoka\maruoka_db");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$sql = "PRAGMA foreign_keys = ON";
	$db->query($sql);

	$sql = "select store_id from stores where name = '$name'";
	$res = $db -> query($sql);
	$data = $res -> fetchAll();

	if (empty($data)) {

		$data = array($name, $user_id);

		$db -> beginTransaction();
		try {
				$sql = "insert into stores(name, user_id, createDate, updateDate) values (
				?, ?, current_timestamp, current_timestamp)";
				$stmt = $db -> prepare($sql);
				$stmt-> execute($data);

				$db -> commit();

				// cutting
				$db = null;
				$response = "true";
		} catch (Exception $e) {
				$db -> rollback();
				throw $e;
		}
	} else {
		$response = "false";
	}

} catch (Exception $e) {

	//echo $e->getMessage() . PHP_EOL;
	$response = "false";

}
?>
