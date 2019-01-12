<?php
try {

	// connect
	$db = new PDO(“sqlite:/maruoka_db”);

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$sql = “PRAGMA foreign_keys = ON”;
	$db->query($sql);

	$sql = “create table buy(
						user_id text,
						product_id text,
						num integer,
						store_id text,
						price integer,
						createDate numeric,
						updateDate numeric,
						primary key(user_id, product_id, createDate),
						foreign key(store_id) references stores
		);”;
	$db->query($sql);

	$sql = “create table users(
						user_id text autoincrement,
						login_id text,
						name text,
						ruby text,
						password text,
						waon text,
						security text,
						adminFlg text,
						store_id text,
						point integer,
						createDate numeric,
						updateDate numeric,
						primary key(user_id),
						foreign key(store_id) references stores
		);”;
	$db->query($sql);

	$sql = “create table products(
						product_id text autoincrement,
            name text,
						ruby text,
						price integer,
						category_id text,
						bargainFlg text,
						createDate numeric,
						updateDate numeric,
						primary key(product_id),
						foreign key(category_id) references category
		);”;
	$db->query($sql);

	$sql = “create table hold(
						user_id text,
						product_id text,
						num integer,
						createDate numeric,
						updateDate numeric,
						foreign key(user_id) references users,
						foreign key(product_id) references products
		);”;
	$db->query($sql);

	$sql = “create table stores(
						store_id text autoincrement,
name text,
user_id text,
						createDate numeric,
						updateDate numeric,
						primary key(store_id),
						foreign key(user_id) references users
		);”;
	$db->query($sql);

	$sql = “create table category(
						category_id text autoincrement,
						name text,
						product_id text,
						createDate numeric,
						updateDate numeric,
						primary key(category_id),
						foreign key(product_id) references products
		);”;
	$db->query($sql);

	$sql = “create table sp_price(
  product_id text,
  discntVal integer,
  rateFlg text,
  soldOutFlg text,
  store_id text,
  createDate numeric,
  updateDate numeric,
  primary key(produuct_id, store_id),
  foreign key(product_id) references products,
  foreign key(store_id) references stores
);”;
$db->query($sql);

// cutting
$db = null;

echo ‘success’;

} catch (Exception $e) {

echo $e->getMessage() . PHP_EOL;

}
