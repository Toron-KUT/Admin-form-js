<?php
try {

	$user_id = $_POST["user_id"]//jsondata;
	$password = $_POST["password"]// jsondata;

	// connect
	$db = new PDO("sqlite:\maruoka\maruoka_db");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$sql = "PRAGMA foreign_keys = ON";
	$db->query($sql);

	$db -> beginTransaction();
	try {
			$sql =	"update users set password = '$password', updateDate = current_timestamp
					where user_id = $user_id;";
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
