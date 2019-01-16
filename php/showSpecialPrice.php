<?php
try {

  $store_id = $_POST["store_id"];

	// connect
	$db = new PDO("sqlite:\maruoka\maruoka_db");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$sql = "PRAGMA foreign_keys = ON";
	$db->query($sql);

	$sql = "select a.product_id, b.name, b.price, a.discntVal, rateFlg from sp_price a, products b
			where a.product_id = b.product_id
      and a.store_id = $store_id";
	$res = $db -> query($sql);
	$data = $res -> fetchAll();

	// cutting
	$db = null;

	$response["sp_price"] = $data;

	$spPrice_data = json_encode($response);

} catch (Exception $e) {

	//echo $e->getMessage() . PHP_EOL;
  $spPrice_data = null;

}
?>
