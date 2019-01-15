<?php
try {

	// connect
	$db = new PDO("sqlite:\maruoka\maruoka_db");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$sql = "PRAGMA foreign_keys = ON";
	$db->query($sql);

	$sql = "select name from stores;";
	$res = $db -> query($sql);
	$data = $res -> fetchAll();

	// cutting
	$db = null;

	$response["stores"] = $data;

	header("Content-type: application/json; charset=UTF-8");
	echo json_encode($response);

} catch (Exception $e) {

	//echo $e->getMessage() . PHP_EOL;

}
