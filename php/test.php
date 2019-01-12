<?php
try {

	$id = // jsondata;

	// connect
	$db = new PDO(“sqlite:~/maruoka_db”);

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$sql = “PRAGMA foreign_keys = ON”;
	$db->query($sql);

	$sql = “select * from products”;
	$hold_res = $db -> query($sql);

	// cutting
	$db = null;

} catch (Exception $e) {

	echo $e->getMessage() . PHP_EOL;

}
