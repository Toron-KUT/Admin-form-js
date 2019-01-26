<?php
try {

	$json_str = file_get_contents('php://input');
	$json_data = json_decode($json_str, true);
	$name = $json_data["name"];
	$clerk_id = $json_data["clerk_id"];

	// connect
	$db = new PDO("sqlite:\maruoka\maruoka_db");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$sql = "PRAGMA foreign_keys = ON";
	$db->query($sql);

	$sql = "select store_id from stores where name = '$name'";
	$res = $db -> query($sql);
	$d = $res -> fetchAll();

	if (empty($d)) {

		$data = array($name, $clerk_id);

		$db -> beginTransaction();
		try {
				$sql = "insert into stores(name, clerk_id, createDate, updateDate) values (
				?, ?, current_timestamp, current_timestamp)";
				$stmt = $db -> prepare($sql);
				$stmt-> execute($data);

				$db -> commit();

				// cutting
				$db = null;
				$response = "true";
				echo $response;
		} catch (Exception $e) {
				$db -> rollback();
				throw $e;
		}
	} else {
		$response = "false";
		echo $response;
	}

} catch (Exception $e) {

	echo $e->getMessage() . PHP_EOL;
	$response = "false";
echo $response;
}
?>
