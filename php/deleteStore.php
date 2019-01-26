<?php
try {

	$json_str = file_get_contents('php://input');
	$json_data = json_decode($json_str, true);
	$store_id = $json_data["store_id"];//jsondata;
	$user_id = $json_data["user_id"];//jsondata;

	// connect
	$db = new PDO("sqlite:\maruoka\maruoka_db");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$sql = "PRAGMA foreign_keys = ON";
	$db->query($sql);

	$db -> beginTransaction();
	try {
			$sql =	"delete * from stores
		where store_id = $store_id";
			$db -> query($sql);

			$sql =	"delete * from users
		where user_id = $user_id";
			$db -> query($sql);

			$db -> commit();

			// cutting
			$db = null;
			$response = "true";
	} catch (Exception $e) {
			$db -> rollback();
			throw $e;
	}

} catch (Exception $e) {

	//echo $e->getMessage() . PHP_EOL;
	$response = "false";

}
?>
