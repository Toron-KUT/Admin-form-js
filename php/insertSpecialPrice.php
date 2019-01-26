<?php
try {

  $json_str = file_get_contents('php://input');
	$json_data = json_decode($json_str, true);
  $product_name = $json_data["product_name"];
	$discntVal = $json_data["discntVal"];
  $rateFlg = $json_data["rateFlg"];
	$store_id = $json_data["store_id"];

	// connect
	$db = new PDO("sqlite:\maruoka\maruoka_db");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$sql = "PRAGMA foreign_keys = ON";
	$db->query($sql);

  $sql = "select product_id from products
  where name = '$product_name'";
  $res = $db -> query($sql);
	$data = $res -> fetch();

	$data = array($data["product_id"], $discntVal, $rateFlg, $store_id);

	$db -> beginTransaction();
	try {
			$sql = "insert into sp_price(product_id, discntVal, rateFlg, soldOutFlg, store_id, createDate, updateDate) values (
			?, ?, ?, '0', ?, current_timestamp, current_timestamp)";
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

} catch (Exception $e) {

	//echo $e->getMessage() . PHP_EOL;
	$response = "false";

}
?>
