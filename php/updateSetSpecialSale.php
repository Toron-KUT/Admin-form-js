<?php
try {

	$json_str = file_get_contents('php://input');
	$json_data = json_decode($json_str, true);
	$product_id = $json_data["product_id"];//jsondata;

	// connect
	$db = new PDO("sqlite:../../maruoka_db");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$sql = "PRAGMA foreign_keys = ON";
	$db->query($sql);

	$db -> beginTransaction();
	try {
			$sql =	"update products set bargainFlg = '1', updateDate = current_timestamp
					where product_id = ‘$product_id’";
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
