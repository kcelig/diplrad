<?php
#podaci za prijavljivanje u bazu

function spoji_na_bazu() {


$db ="";
$db_host = "localhost";
$db_name = "trashhr_dbaza";
$db_user = "trashhr_kcelig";
$db_password = "root";

 $db =mysql_connect($db_host,$db_user,$db_password);
 if (!$db) {
     die('Not connected : ' . mysql_error());
 }

 $dbs = mysql_select_db($db_name,$db);
 if (!$dbs) {
     die ('Can\'t select db : ' . mysql_error());
 } else {
  return $dbs;
 }

}

?>