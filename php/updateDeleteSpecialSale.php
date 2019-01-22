<?php
try {

	$product_id = $_POST["product_id"]//jsondata;

	// connect
	$db = new PDO("sqlite:\maruoka\maruoka_db");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$sql = "PRAGMA foreign_keys = ON";
	$db->query($sql);

	$db -> beginTransaction();
	try {
			$sql =	"update products set bargainFlg = '0', updateDate = current_timestamp
					where product_id = $product_id";
			$db -> query($sql);

			$db -> commit();

			// cutting
			$db = null;
			echo "true";
	} catch (Exception $e) {
			$db -> rollback();
			throw $e;
	}

} catch (Exception $e) {

	//echo $e->getMessage() . PHP_EOL;
	echo "false";

}
?>
