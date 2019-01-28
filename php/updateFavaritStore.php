<?php
try {

	$user_id = $_POST["user_id"];//jsondata;
	$store_name = $_POST["store_name"];// jsondata;

	// connect
	$db = new PDO("sqlite:../../maruoka_db");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$sql = "PRAGMA foreign_keys = ON";
	$db->query($sql);

	$sql = "select store_id from stores
	where name = '$store_name'";
	$res = $db -> query($sql);
	$store_data = $res -> fetch();

	$db -> beginTransaction();
	try {
			$store_id = $store_data["store_id"];
			$sql =	"update users set store_id = $store_id, updateDate = current_timestamp
					where user_id = $user_id";
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
