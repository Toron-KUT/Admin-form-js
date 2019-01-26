<?php
try {

	// connect
	$db = new PDO("sqlite:\maruoka\maruoka_db");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	//$sql = "PRAGMA FOREIGN_KEYS = ON";
	//$db->query($sql);

	$sql = "drop table if exists buy";
	$db->query($sql);

	$sql = "drop table if exists users";
	$db->query($sql);

	$sql = "drop table if exists clerks";
	$db->query($sql);

	$sql = "drop table if exists products";
	$db->query($sql);

	$sql = "drop table if exists hold";
	$db->query($sql);

	$sql = "drop table if exists stores";
	$db->query($sql);

	$sql = "drop table if exists category";
	$db->query($sql);

	$sql = "drop table if exists sp_price";
	$db->query($sql);

	// cutting
	$db = null;

	echo "true";

} catch (Exception $e) {

	echo $e->getMessage() . PHP_EOL;
	echo "false";

}
?>
