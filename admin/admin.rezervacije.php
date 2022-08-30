<?php
require_once ('conf.db.php');
require_once ('conf.poruke.php');
require_once ('conf.glavni.php');
require_once("auth.php");

session_start();
if (!session_is_registered("userid")) {
header("Location:index.php");
exit;
}
if ($_GET["a"]=="0") {
session_unset();
header("Location:index.php");
exit;
}


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>::ON-LINE REZERVACIJA::</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<meta http-equiv="Content-Language" CONTENT="HR">
<link href="../styles/base.css" rel="stylesheet" type="text/css" />

<style type="text/css">
#footer {position:fixed; bottom:0px; left:0; padding:0; width: 100%;}
#footer p{padding:4px; }

body {height:100%; overflow-y:auto; margin-bottom:40px; }
</style>
<!--[if lte IE 6]>
   <style type="text/css">
   /*<![CDATA[*/
html {overflow-x:auto; overflow-y:hidden;}
   /*]]>*/
   </style>
<![endif]-->

<!--[if lte IE 6]>
<style>
   /*<![CDATA[*/
#footer {position:absolute; bottom:0px; left:0;}
   /*]]>*/
</style>
<![endif]-->

<script src="sortable.js" type="text/javascript"></script>
<script src="ajax.js" type="text/javascript"></script>
<script type="text/javascript">
ajax = new glavni();
function ObrisiRezervaciju(rid, oid){
	ajax.requestFile = "ajax.php?funkcija=brisi_rezervaciju&rid="+rid;
	ajax.pokreniAJAX();
	var x=oid.parentNode.parentNode;
	x.parentNode.removeChild(x);
}
</script>
</head>

<body>
<div id="masthead">
	<a href="#" id="homelink"><img src="images/javacotea.gif" alt="JavaCo Tea home" /></a>


	<p id="today">
		diplomski rad
	</p>
</div> <!-- masthead div -->

<div id="content">
	<h1><b>Administrator:</b> </h1>
	<h2>Upravljanje rezervacijama</h2>

<p>&nbsp;</p><TABLE WIDTH=738 BORDER=0 CELLPADDING=0 CELLSPACING=0>

	<TR>

		<TD colspan="6" rowspan="16" valign="top">
			<!--	<p><a href="<?php $root?>">Povratak na izbornik!</a></p> -->
            <p><a href="admin.php">Povratak</a></p>
</td>
</tr>

</table>

	<?php izlistaj_podatke(); ?> <p>&nbsp;</p>


</div>

<div id="footer">
	<p>
		Ajax kao tehnologija web 2.0 sustava: Krunoslav Čelig (<a href="mailto:kcelig@gmail.com">kcelig@gmail.com</a>)</a>
	</p>
</div>

</body>
</html>

<?php



			function izlistaj_podatke() {
				$db=spoji_na_bazu();

echo "<div id='sadrzaj' class='div_unos'>";
				echo"	<FIELDSET  style='border-color: olive;'>";
				echo "	<LEGEND class='legenda'>Rezervacije:</LEGEND>";
				echo "<table  class='sortable' id='anyid' width='auto' border='1' cellpadding='1' cellspacing='1' style='border-collapse:collapse;'>";
				echo "<tr class='tablica_stupac'>";
				echo "<td class='tablica_stupac'>Ime i prezime</td>";
				echo "<td class='tablica_stupac'>E-mail</td>";
				echo "<td class='tablica_stupac'>Broj sobe</td>";
				echo "<td class='tablica_stupac'>Tip sobe</td>";
				echo "<td class='tablica_stupac'>Datum dolaska</td>";
				echo "<td class='tablica_stupac'>Datum odlaska</td>";
				echo "<td class='tablica_stupac'>Akcija</td>";

				echo "</tr>";

				$qry=mysql_query("SELECT broj, tip_sobe, dolazak, odlazak, ime_prezime, email, rezervacija.id FROM soba, rezervacija, gost WHERE soba.id=rezervacija.id_sobe AND gost.id=rezervacija.id_gosta");
				$br=0;
				while (list($broj, $tip_sobe, $dolazak, $odlazak, $ime_prezime, $email, $id) = mysql_fetch_row ($qry)) {
					$br++;
					//echo "<form action='admin.rezervacije.php' method='get'>";
					//echo "<input type='hidden' name='act' value='delete'>";
					//echo "<input type='hidden' name='ident' value='".$id."'>";
					echo "<tr>";

						echo "<td style='background-color: #FFFFFF;'>$ime_prezime</td>";
						echo "<td style='background-color: #FFFFFF;'><a href='mailto:$email'>$email</td>";
						echo "<td style='background-color: #FFFFFF;'>$broj</td>";
						echo "<td style='background-color: #FFFFFF;'>$tip_sobe</td>";
						echo "<td style='background-color: #FFFFFF;'>$dolazak</td>";
						echo "<td style='background-color: #FFFFFF;'>$odlazak</td>";


						echo "<td style='background-color: #FFFFFF;'><a href='' onclick='ObrisiRezervaciju(\"".$id."\",this);return false;'>Otkaži</a></td>";

					echo "</tr>\n";
					//echo "</form>";

					}
					echo "</table>";
					echo "	</fieldset>";
					echo "</div>";



					mysql_close();
					}
			/*		function set_get() {
						echo "<script language='Javascript'>";
						echo "location.href='admin.rezervacije.php'";
						echo "</script>";
						}
			*/
				?>






