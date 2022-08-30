<?php

session_start();

function auth_login($uname, $pass) {
//include("conf.db.php");
include("conf.auth.php");



$uname = mysql_escape_string($uname);
$pass = md5(mysql_escape_string($pass));


if ($uname==$u_admin && $pass== $p_admin){
$_SESSION["userid"] = $u_admin;
$_SESSION["userclass"] = "1";

return 1;
} elseif ($uname!=$uadmin || $pass!=$p_admin) {

return "<p>Pogrešno korisnièko ime ili lozinka!</p>";

//echo "<span style='position:absolute; top: 38px; left: 230px; width: 200px; height: 20px;' border-style: solid; border-color: red; border-width:thin;'>Pogrešno korisnièko ime ili lozinka!</span>";

}


}

function build_menu($a) {

if ($a=="1") {
echo "<a href=\"admin.sobe.php\">Upravljanje sobama<br><br><img src='images/soba.gif'></a><br><br>";

echo "<a href=\"admin.rezervacije.php\">Pregled rezerviracija<br><br><img src='images/rezerva.gif'></a><br>";


}


}

?>
