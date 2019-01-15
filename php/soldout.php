<?php
try {

	$product_name = $_POST["product_name"]//jsondata;
	$store_id = $_POST["store_id"]// jsondata;

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

	$db -> beginTransaction();
	try {
			$sql =	"update sp_price set soldOutFlg = ‘1’, updateDate = current_timestamp
					where product_id = $data["product_id"] and store_id = $store_id;";
			$db -> query($sql);

			$db -> commit();

			// cutting
			$db = null;
			echo true;
	} catch (Exception $e) {
			$db -> rollback();
			throw $e;
	}

} catch (Exception $e) {

	//echo $e->getMessage() . PHP_EOL;
	echo false;

}
?>
