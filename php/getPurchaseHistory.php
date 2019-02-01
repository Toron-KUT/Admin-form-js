<?php
try {

	$user_id = $_POST["user_id"];
	
	// connect
	$db = new PDO("sqlite:../../maruoka_db");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$sql = "PRAGMA foreign_keys = ON";
	$db->query($sql);

	$sql = "select b.name, a.num, a.price, a.createDate from buy a, products b
			where a.product_id = b.product_id
			and a.user_id = $user_id;";
	$res = $db -> query($sql);
	$data = $res -> fetchAll();

	// cutting
	$db = null;

	$response["purchase"] = $data;

	header("Content-type: application/json; charset=UTF-8");
	echo json_encode($response);

} catch (Exception $e) {

	//echo $e->getMessage() . PHP_EOL;
	echo "false";

}
?>
