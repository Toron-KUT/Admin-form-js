<?php
try {

	// connect
	$db = new PDO("sqlite:../../maruoka_db");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$sql = "PRAGMA FOREIGN_KEYS = ON";
	$db->query($sql);

	$sql = "create table if not exists buy(
	user_id integer,
	product_id integer,
	num integer,
	store_id integer,
	price integer,
	createDate numeric,
	updateDate numeric,
	primary key(user_id, product_id, createDate),
	foreign key(user_id) references users,
	foreign key(product_id) references products,
	foreign key(store_id) references stores
	)";
	$db->query($sql);

	$sql = "create table if not exists users(
	user_id integer primary key autoincrement,
	login_id text,
	name text,
	ruby text,
	password text,
	waon text,
	security text,
	store_id integer,
	point integer,
	createDate numeric,
	updateDate numeric,
	foreign key(store_id) references stores
	)";
	$db->query($sql);

	$sql = "create table if not exists clerks(
	clerk_id integer primary key autoincrement,
	login_id text,
	name text,
	ruby text,
	password text,
	adminFlg text,
	createDate numeric,
	updateDate numeric
	)";
	$db->query($sql);

	$sql = "create table if not exists products(
	product_id integer primary key autoincrement,
	name text,
	ruby text,
	price integer,
	category_id integer,
	bargainFlg text,
	createDate numeric,
	updateDate numeric,
	foreign key(category_id) references category
	)";
	$db->query($sql);

	$sql = "create table if not exists hold(
	user_id integer,
	product_id integer,
	num integer,
	createDate numeric,
	updateDate numeric,
	foreign key(user_id) references users,
	foreign key(product_id) references products
	)";
	$db->query($sql);

	$sql = "create table if not exists stores(
	store_id integer primary key autoincrement,
	name text,
	clerk_id integer,
	createDate numeric,
	updateDate numeric,
	foreign key(clerk_id) references clerks
	)";
	$db->query($sql);

	$sql = "create table if not exists category(
	category_id integer primary key autoincrement,
	name text,
	createDate numeric,
	updateDate numeric
	)";
	$db->query($sql);

	$sql = "create table if not exists sp_price(
	product_id integer,
	discntVal integer,
	rateFlg text,
	soldOutFlg text,
	store_id integer,
	createDate numeric,
	updateDate numeric,
	primary key(product_id, store_id),
	foreign key(product_id) references products,
	foreign key(store_id) references stores
	)";
	$db->query($sql);

	// cutting
	$db = null;

	echo "true";

} catch (Exception $e) {

	echo $e->getMessage() . PHP_EOL;
	echo "false";

}
?>
