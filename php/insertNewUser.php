<?php
try {

	$login_id = $_POST["login_id"];
	$name = $_POST["name"];
	$ruby = $_POST["ruby"];
	$word = $_POST["password"];
	$waon = $_POST["waon"];
	$security = $_POST["security"];
	$point = 100;//$_POST["point"];

	// connect
	$db = new PDO("sqlite:\maruoka\maruoka_db");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$sql = "PRAGMA foreign_keys = ON";
	$db->query($sql);

	$sql = "select user_id from users where login_id = $login_id and password = $waon";
	$res = $db -> quary($sql);
	$data = $res -> fetchAll();

	if (empty($data)) {

		$data = array($login_id, $name, $ruby, $word, $waon, $security, $point);

		$db -> beginTransaction();
		try {
				$sql = "insert into users (login_id, name, ruby, password, waon,security, adminFlg,
			     store_id, point, createDate, updateDate) values (
				?, ?, ?, ?, ?, ?, ‘0’, NULL,  ?, current_timestamp, current_timestamp)";
				$stmt = $db -> prepare($sql);
				$stmt-> execute($data);

				$db -> commit();

				// cutting
				$db = null;
				echo "true";
		} catch (Exception $e) {
				$db -> rollback();
				throw $e;
		}
	} else {
		echo "false";
	}

} catch (Exception $e) {

	//echo $e->getMessage() . PHP_EOL;
	echo "false";

}
?>
