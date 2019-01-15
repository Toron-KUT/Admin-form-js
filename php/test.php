<?php
try {

	// connect
	$db = new PDO("sqlite:\maruoka\maruoka_db");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$sql = "PRAGMA FOREIGN_KEYS = ON";
	$db->query($sql);

	$sql = "select * from products";
	$res = $db -> query($sql);


	// cutting
	$db = null;

	foreach ($res as $row) {
		print ($row["price"]);
	}
} catch (Exception $e) {

	echo $e->getMessage() . PHP_EOL;

}
?>
