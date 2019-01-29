<?php
try {

// 2store_id, 3name, 1old_user_id, 4new_user_id
	$json_str = file_get_contents('php://input');
	$json_data = json_decode($json_str, true);
	$old_clerk_id = $json_data["old_user_id"];
	$store_id = $json_data["store_id"];//jsondata;
	$name = $json_data["name"];// jsondata;
  $new_clerk_id = $json_data["new_user_id"];

	// connect
	$db = new PDO("sqlite:../../maruoka_db");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$sql = "PRAGMA foreign_keys = ON";
	$db->query($sql);

	$db -> beginTransaction();
	try {
			$sql =	"update stores set name = '$name', updateDate = current_timestamp
					where store_id = $store_id";
			$db -> query($sql);

			if (strcmp($old_clerk_id, $new_clerk_id) != 0) {
		      $sql =	"update clerks set adminFlg = '0', updateDate = current_timestamp
							where clerk_id = $old_clerk_id";
					$db -> query($sql);

		      $sql =	"update clerks set adminFlg = '1', updateDate = current_timestamp
							where clerk_id = $new_clerk_id";
					$db -> query($sql);
		}

			$db -> commit();

			// cutting
			$db = null;
			$response = "true";
			echo $response;
	} catch (Exception $e) {
			$db -> rollback();
			throw $e;
	}

} catch (Exception $e) {

	//echo $e->getMessage() . PHP_EOL;
	$response = "false";
	echo $response;

}
?>
