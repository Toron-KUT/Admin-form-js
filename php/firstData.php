<?php

try {
    // connect
    $db = new PDO("sqlite:../../maruoka_db");

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $sql = "PRAGMA foreign_keys = ON";
    $db->query($sql);

    $store_data = array (
      0 => array ( "マルナカ高知工科大学店", 2),
      1 => array ("マルナカ土佐山田店", 3),
      2 => array ("マルナカ南国店", 4)
    );

    $category_data = array (
      0 => array ("野菜・果物"),
      1 => array ("肉・卵"),
      2 => array ("魚介類"),
      3 => array ("米・パン・粉類"),
      4 => array ("乳製品"),
      5 => array ("惣菜"),
      6 => array ("インスタント・レトルト"),
      7 => array ("菓子・冷凍"),
      8 => array ("飲料水"),
      9 => array ("その他(食品)"),
      10 => array ("その他(食品外)")
    );

    $user_data = array (
      0 => array ("tosa", "土佐", "トサ", "root1", "aaaaaa", "123", 1, 100),
      1 => array ("kaki", "板垣", "イタガキ", "root2", "bbbbbb", "234", 2, 100),
      2 => array ("mae", "前田", "マエダ", "root3", "cccccc", "345", 2, 100),
      3 => array ("toki", "常盤", "トキワ", "root4", "dddddd", "456", 1, 100),
      4 => array ("nana", "七海", "ナナミ", "root5", "eeeeee", "567", 3, 100),
      5 => array ("hati", "八田", "ハッタ", "root6", "ffffff", "678", 1, 100),
      6 => array ("maki", "牧田", "マキタ", "root7", "gggggg", "789", 2, 100),
      7 => array ("toto", "戸塚", "トツカ", "root8", "hhhhhh", "890", 3, 100),
      8 => array ("saki", "佐々木", "ササキ", "root9", "iiiiii", "901", 3, 100),
      9 => array ("momo", "百田", "モモダ", "root10", "jjjjjj", "012", 2, 100),
      10 => array ("kuku", "久保田", "クボタ", "root11", "kkkkkk", "134", 3, 100),
      11 => array ("ai", "逢田", "アイダ", "root12", "llllll", "124", 1, 100),
      12 => array ("kome", "米田", "ヨネダ", "root13", "mmmmmm", "156", 1, 100),
      13 => array ("tada", "多田", "タダ", "root14", "nnnnnn", "178", 3, 100),
      14 => array ("baka", "馬場", "ババ", "root15", "oooooo", "190", 3, 100),
      15 => array ("mura", "丸井", "マルイ", "100t16", "pppppp", "257", 2, 100)
    );

    $clerk_data = array (
      0 => array ("admin", "菅", "スガ", "root000", "2"),
      1 => array ("tona", "田中", "タナカ", "root001", "1"),
      2 => array ("yama", "山田", "ヤマダ", "root002", "1"),
      3 => array ("taka", "高橋", "タカハシ", "root003", "1"),
      4 => array ("oo", "大平", "オオヒラ", "root004", "0"),
      5 => array ("saku", "佐久間", "サクマ", "root005", "0")
    );

    $product_data = array (
      0 => array ("大根", "ダイコン", 150, 1, "0"),
      1 => array ("レモン", "レモン", 50, 1, "0"),
      2 => array ("ピーマン", "ピーマン", 60, 1, "0"),
      3 => array ("砂肝", "スナギモ", 100, 2, "1"),
      4 => array ("ウズラの卵", "ウズラノタマゴ", 100, 2, "0"),
      5 => array ("鰹のたたき", "カツオノタタキ", 300, 3, "1"),
      6 => array ("お好み焼き", "オコノミヤキ", 300, 4, "0"),
      7 => array ("レーズンパン", "レーズンパン", 100, 4, "1"),
      8 => array ("牛乳", "ギュウニュウ", 200, 5, "1"),
      9 => array ("とろけるチーズ", "トロケルチーズ", 180, 5, "0"),
      10 => array ("ほうれん草のお浸し", "ホウレンソウノオヒタシ", 100, 6, "0"),
      11 => array ("若鳥の唐揚げ", "ワカドリノカラアゲ", 300, 6, "0"),
      12 => array ("ごつ盛り", "ゴツモリ", 90, 7, "1"),
      13 => array ("カレーメシ", "カレーメシ", 200, 7, "1"),
      14 => array ("レトカレ", "レトカレ", 300, 7, "0"),
      15 => array ("冷凍枝豆", "レイトウエダマメ", 350, 8, "0"),
      16 => array ("ポテトチップス塩味", "ポテトチップスシオアジ", 60, 8, "1"),
      17 => array ("モンスターエナジー", "モンスターエナジー", 200, 9, "0"),
      18 => array ("アンパンマンのオレンジジュース", "アンパンマンノオレンジジュース", 70, 9, "0"),
      19 => array ("みりん", "ミリン", 300, 10, "0"),
      20 => array ("フライパン", "フライパン", 1800, 11, "0")
    );

    $buy_data = array (
      0 => array (1, 1, 1, 1, 150),
      1 => array (1, 3, 2, 1, 120),
      2 => array (1, 9, 1, 1, 200),
      3 => array (1, 10, 1, 1, 180),
      4 => array (1, 7, 3, 1, 300),
      5 => array (1, 6, 2, 1, 600),
      6 => array (1, 16, 1, 1, 350),
      7 => array (1, 14, 3, 1, 600),
      8 => array (1, 12, 2, 1, 600),
      9 => array (1, 4, 1, 1, 100),
      10 => array (3, 1, 3, 1, 450),
      11 => array (3, 19, 5, 3, 350),
      12 => array (3, 21, 1, 3, 1800),
      13 => array (3, 20, 1, 3, 300),
      14 => array (3, 15, 2, 3, 600),
      15 => array (3, 17, 3, 3, 180),
      16 => array (3, 5, 2, 3, 200),
      17 => array (3, 7, 1, 3, 300),
      18 => array (3, 11, 2, 3, 200),
      19 => array (3, 13, 3, 3, 270),
      20 => array (3, 18, 1, 3, 200),
      21 => array (14, 21, 1, 2, 1800),
      22 => array (14, 12, 2, 2, 600),
      23 => array (14, 2, 1, 2, 50),
      24 => array (14, 16, 1, 2, 350),
      25 => array (1, 20, 1, 1, 300),
      26 => array (1, 11, 2, 1, 200),
      27 => array (5, 3, 3, 1, 180),
      28 => array (5, 6, 1, 1, 300),
      29 => array (5, 16, 1, 1, 350),
      30 => array (5, 8, 2, 1, 200),
      31 => array (5, 9, 1, 1, 200),
      32 => array (5, 14, 2, 1, 400),
      33 => array (5, 15, 1, 1, 300),
      34 => array (5, 17, 3, 1, 180),
      35 => array (5, 19, 3, 1, 210)
    );

    $spPrice_data = array (
      0 => array (1, 10, "1", "0", 1),
      1 => array (3, 10, "0", "0", 1),
      2 => array (12, 30, "1", "0", 1),
      3 => array (15, 50, "0", "0", 1)
    );

    $time = "current_timestamp";

    $db -> beginTransaction();
		try {

        $sql = "insert into category(name, createDate, updateDate) values (
				?, $time, $time)";
        foreach ($category_data as $row) {
    				$stmt = $db -> prepare($sql);
    				$stmt-> execute($row);
        }

         $sql = "insert into clerks (login_id, name, ruby, password, adminFlg, createDate, updateDate) values (
 				 ?, ?, ?, ?, ?, $time, $time)";
          foreach ($clerk_data as $row) {
      				$stmt = $db -> prepare($sql);
      				$stmt-> execute($row);
          }

          $sql = "insert into stores(name, clerk_id, createDate, updateDate) values (
  				?, ?, $time, $time)";
          foreach ($store_data as $row) {
      				$stmt = $db -> prepare($sql);
      				$stmt-> execute($row);
          }

          $sql = "insert into users (login_id, name, ruby, password, waon, security,
  			     store_id, point, createDate, updateDate) values (
  				 ?, ?, ?, ?, ?, ?, ?, ?, $time, $time)";
           foreach ($user_data as $row) {
       				$stmt = $db -> prepare($sql);
       				$stmt-> execute($row);
           }

          $sql = "insert into products (name, ruby, price, category_id, bargainFlg, createDate, updateDate) values (
  				 ?, ?, ?, ?, ?, $time, $time)";
           foreach ($product_data as $row) {
       				$stmt = $db -> prepare($sql);
       				$stmt-> execute($row);
           }

           $sql = "insert into buy (user_id, product_id, num, store_id, price, createDate, updateDate) values (
   				 ?, ?, ?, ?, ?, $time, $time)";
            foreach ($buy_data as $row) {
        				$stmt = $db -> prepare($sql);
        				$stmt-> execute($row);
            }

            $sql = "select user_id, a.product_id, num from buy a, products b where a.product_id = b.product_id and category_id <> '11'";
            $res = $db -> query($sql);
            $hold_data = $res -> fetchAll();

            $sql = "insert into hold (user_id, product_id, num, createDate, updateDate) values (
    				 ?, ?, ?, $time, $time)";
             foreach ($hold_data as $row) {
               $data = array ($row["user_id"], $row["product_id"], $row["num"]);
         				$stmt = $db -> prepare($sql);
         				$stmt-> execute($data);
             }

             $sql = "insert into sp_price (product_id, discntVal, rateFlg, soldOutFlg, store_id, createDate, updateDate) values (
     				 ?, ?, ?, ?, ?, $time, $time)";
              foreach ($spPrice_data as $row) {
          				$stmt = $db -> prepare($sql);
          				$stmt-> execute($row);
              }

				$db -> commit();

				// cutting
				$db = null;
				echo "true";
		} catch (Exception $e) {
				$db -> rollback();
				throw $e;
		}
  } catch (Exception $e) {

    echo $e->getMessage() . PHP_EOL;
    echo "false";

  }
 ?>
