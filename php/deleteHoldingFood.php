<?php
try {

	$user_id = $_POST["user_id"];//jsondata;
	$product_name = $_POST["product_name"];// jsondata;
	$createDate = $_POST["createDate"];// jsondata;

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
			$sql =	"delete * from hold
		where user_id = $user_id
		and product_id = $data["product_id"]
		and createDate = $createDate";
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