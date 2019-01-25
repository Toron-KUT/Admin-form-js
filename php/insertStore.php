<?php
try {

	$store_id = $_POST["store_id"];
	$name = $_POST["name"];
	$user_id = $_POST["user_id"];

	// connect
	$db = new PDO("sqlite:\maruoka\maruoka_db");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$sql = "PRAGMA foreign_keys = ON";
	$db->query($sql);

	$sql = "select store_id from stores where name = $store";
	$res = $db -> query();
	$data = $res -> fetchAll();

	if (empty($data)) {

		$data = array($name, $user_id);

		$db -> beginTransaction();
		try {
				$sql = "insert into stores(name, user_id, createDate, updateDate) values (
				?, ?, ?, current_timestamp, current_timestamp)";
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
