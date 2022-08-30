<?php
require_once ('conf.db.php');
if($_GET['funkcija'] == "brisi_rezervaciju"){
	if(isset($_GET['rid']) && trim($_GET['rid']) != ""){
		$db=spoji_na_bazu();
		$sql = mysql_query("SELECT id_gosta FROM rezervacija WHERE id = '".$_GET['rid']."'");
		$id_gosta = mysql_fetch_row($sql);
		//slanje emaila
		$sql2 = mysql_query("DELETE FROM rezervacija WHERE id = '".$_GET['rid']."'") or die (mysql_error());
		$sql = mysql_query("DELETE FROM gost WHERE id = '".$id_gosta[0]."'") or die (mysql_error());

	}
}
elseif($_GET['funkcija'] == "brisi_sobu"){
	if(isset($_GET['ident']) && trim($_GET['ident']) != ""){
		$db=spoji_na_bazu();
		$ident=$_GET["ident"];
		mysql_query("DELETE FROM rezervacija WHERE id_sobe = '".$_GET['ident']."'") or die(mysql_error());
		mysql_query ("DELETE FROM soba WHERE id='$ident'") or die(mysql_error());
		mysql_query("DELETE FROM gost WHERE id IN (SELECT id_gosta FROM rezervacija WHERE id_sobe = '".$_GET['ident']."')")  or die(mysql_error());
	}
}