<?php
try {

	// connect
	$db = new PDO("sqlite:../../maruoka_db");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$sql = "PRAGMA foreign_keys = ON";
	$db->query($sql);

	$sql = "select category_id, name, price from products
			where bargainFlg = '1'";//product_id - category_id
	$res = $db -> query($sql);
	$data = $res -> fetchAll();

	// cutting
	$db = null;

	$response["sp_sale"] = $data;

	$spSale_data = json_encode($response);

} catch (Exception $e) {

	echo $e->getMessage() . PHP_EOL;
  $spSale_data = null;

}
?>
