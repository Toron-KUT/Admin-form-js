<?php
// connect
$db = new PDO("sqlite:\maruoka\maruoka_db");

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$sql = "PRAGMA foreign_keys = ON";
$db->query($sql);

$store_data = array (
  0 => array ( "マルナカ高知工科大学店", 10)
  1 => array ("マルナカ土佐山田店", 5)
  2 => array ("マルナカ南国店", 12)
)

$category_data = array (
  0 => array ("野菜・果物")
  1 => array ("肉・卵")
  2 => array ("魚介類")
  3 => array ("米・パン・粉類")
  4 => array ("乳製品")
  5 => array ("惣菜")
  6 => array ("インスタント・レトルト")
  7 => array ("菓子・冷凍")
  8 => array ("飲料水")
  9 => array ("その他(食品)")
  10 => array ("その他(食品外)")
)

$user_data = array (
  0 => array ("tosa", "土佐", "トサ", "", "", "", "0", , 100)
  1 => array ("kaki", "板垣", "イタガキ", "", "", "", "0", , 100)
  2 => array ("mae", "前田", "マエダ", "", "", "", "0", , 100)
  3 => array ("toki", "常盤", "トキワ", "", "", "", "0", , 100)
  4 => array ("nana", "七海", "ナナミ", "", "", "", "0", , 100)
  5 => array ("tosayamada", "田中", "タナカ", "root11", NULL, NULL, "1", 2, 0)
  6 => array ("hati", "八田", "ハッタ", "", "", "", "0", , 100)
  7 => array ("maki", "", "", "", "", "", "0", , 100)
  8 => array ("toto", "", "", "", "", "", "0", , 100)
  9 => array ("saki", "", "", "", "", "", "0", , 100)
  10 => array ("kut", "山田", "ヤマダ", "root22", NULL, NULL, "1", 1, 0)
  11 => array ("momo", "", "", "", "", "", "0", , 100)
  12 => array ("nankoku", "高橋", "タカハシ", "root33", NULL, NULL, "1", 3, 0)
  13 => array ("kuku", "", "", "", "", "", "0", , 100)
  14 => array ("ai", "", "", "", "", "", "0", , 100)
  15 => array ("kome", "", "", "", "", "", "0", , 100)
  16 => array ("tada", "", "", "", "", "", "0", , 100)
  17 => array ("baka", "", "", "", "", "", "0", , 100)
  18 => array ("mura", "", "", "", "", "", "0", , 100)
  19 => array ("admin", "菅", "スガ", "root00", NULL, NULL, "2", NUll, 0)
  )
)
 ?>
