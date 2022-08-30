<?php
require_once ('conf.db.php');
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

<title>:: ADMIN - sobe ::</title>

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

<script language="javascript" src="sortable.js"></script>
<script language="javascript" src="ajax.js"></script>




<script type="text/javascript">

			var ajax = new glavni();
			var broj_sobeBox;
			var cijenaBox;
			var sadrzajObj;

			function PrikaziSadrzaj()    // funkcija koja prikazuje sadrzaj (npr. odredjenu stranicu ili poruku i sl.) unutar definiranog <div> tag-a
			{
				sadrzajObj = document.getElementById('sadrzaj');
            	sadrzajObj.innerHTML = ajax.response;       // ajax.response - varijabla koja sadrzi vrijednost (sadrzaj) neke vanjske datoteke (npr. .html datoteke)

    		}
			function ObrisiSobu(sid, oid){
				//alert(sid);
				ajax.requestFile = "ajax.php?funkcija=brisi_sobu&ident="+sid;
				ajax.pokreniAJAX();
				var x=oid.parentNode.parentNode;
				x.parentNode.removeChild(x);
			}


			function RezultatPretrage()
    		{
    			idenif = document.getElementById('id').value;
    			br = document.getElementById('broj').value;
    			tip = document.getElementById('tip_sobe').selected;
    			tv = document.getElementById('oprema').checked;
    			cij=document.getElementById('cijena').value;


       			 ajax.requestFile = 'admin.sobe.php?id='+identif+'&broj='+br+'&oprema='+tv+'&tip_sobe='+tip+'&cijena='+cij;
        		 ajax.onCompletion = PrikaziSadrzaj;        // specificira funkciju koja ce se izvrsiti nakon sto je datoteka pronadjena
        		 ajax.pokreniAJAX();
    		}


			function ProvjeriFormu()
			{
				broj_sobeBox = document.getElementById('alert_broj');
				broj_sobeBox.innerHTML = "";

				cijenaBox = document.getElementById('alert_cijena');
				cijenaBox.innerHTML = "";



				if(document.getElementById('broj').value == '')
				{
					broj_sobeBox.innerHTML = "Niste unijeli broj sobe!";
					return false;
				}


				if(document.getElementById('broj').value != '' && document.getElementById('cijena').value == '')
				{
					cijenaBox.innerHTML = "Niste unijeli cijenu sobe!";
					return false;

				}

				RezultatPretrage();
			return false;
			}

		</script>


</head>

<body>
<div id="masthead">
	<a href="#" id="homelink"><img src="images/javacotea.gif" alt="JavaCo Tea home" /></a>


	<p id="today">
		diplomski rad
	</p>
</div>

<div id="content">
	<h1><b>Administrator:</b> </h1>
	<h2>Upravljanje sobama</h2>

<div id="sadrzaj" class="div_unos">
<TABLE >

	<TR>

		<TD >
			<!--	<p><a href="<?php $root?>">Povratak na izbornik!</a></p> -->
            <p><a href="admin.php">Povratak</a></p>



	<p>&nbsp;</p>
	<form action="admin.sobe.php" method = "GET" name="forma" onsubmit="return true;" >
	<?php
		if ($_GET["act"] == "update") {
			$db = spoji_na_bazu();

			$id = mysql_escape_string ($_GET["ident"]);
			$broj = mysql_escape_string ($_GET["broj"]);
			$tip_sobe = mysql_escape_string ($_GET["tip_sobe"]);
			$cijena = mysql_escape_string ($_GET["cijena"]);
			$oprema = mysql_escape_string ($_GET["oprema"]);


			mysql_query ("UPDATE soba set broj='$broj', tip_sobe='$tip_sobe', cijena='$cijena', oprema='$oprema' WHERE id='$id'");

			mysql_close($dbs);
		//	set_get();
		}

		if ($_GET["akcija_x"]>0 && $_GET["akcija_x"]<18) {
			$db=spoji_na_bazu();
			$ident=$_GET["ident"];
			$qry = mysql_query ("SELECT id, broj, tip_sobe, cijena, oprema FROM soba WHERE id='$ident'");
			list($id, $broj, $tip_sobe, $cijena, $oprema) = mysql_fetch_row ($qry);

			echo "<input type='hidden' name='act' value='update'>";
			echo "<input type='hidden' name='ident' value='$id'>";
			mysql_close($dbs);
		}

		if ($_GET["akcija_x"]>18 && $_GET["akcija_x"]<35) {
			/*$db=spoji_na_bazu();
			$ident=$_GET["ident"];
			//$qry = mysql_query("SELECT id_gosta FROM rezervacija WHERE id_sobe = '".$_GET['ident']."'");
			mysql_query("DELETE FROM rezervacija WHERE id_sobe = '".$_GET['ident']."'") or die(mysql_error());
			mysql_query ("DELETE FROM soba WHERE id='$ident'") or die(mysql_error());
			//while(list($gost) = mysql_fetch_row($qry))
			mysql_query("DELETE FROM gost WHERE id IN (SELECT id_gosta FROM rezervacija WHERE id_sobe = '".$_GET['ident']."')")  or die(mysql_error());
			mysql_close($db);
			set_get();*/
		}

		if (is_null($_GET["akcija_x"]))
			echo "<input type='hidden' name='act' value='dodaj'>";

		if($tip_sobe=='jednokrevetna')
		{
			$tip_sobe_selected_1 = ' selected="selected" ';
		} else	{
			$tip_sobe_selected_2 = ' selected="selected" ';
		}

		if($oprema == 1)
		{
			$oprema_checked = " checked='checked' ";
		}

echo "<div id='sadrzaj' class='div_unos'>";
echo"	<FIELDSET  style='border-color: olive;'>";
echo "	<LEGEND class='legenda'>Unos sobe:</LEGEND>";

		echo "<table width='auto'>";
		echo "<br>";
		echo "<tr>";
			echo "<td>Broj sobe*:</td>";
			echo "<td><input type='text' name='broj' value='$broj' class='input' id='broj'></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Tip sobe:</td>";
		echo "<td><select name='tip_sobe' class='input'>
					<option value='jednokrevetna' $tip_sobe_selected_1>Jednokrevetna</option>
					<option value='dvokrevetna' $tip_sobe_selected_2>Dvokrevetna</option></select></td>";
		echo "</tr>";
			echo "<td>Cijena*:</td>";
			echo "<td><input type='text' name='cijena' value='$cijena' class='input' id='cijena'></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>TV u sobi?</td>";
			echo "<td><input type='checkbox' name='oprema' value='1' $oprema_checked class='input' id='oprema'>DA</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td></td>";
			echo "<td><input type='submit' name='submit' value='upiši'  class='forma_gumb2' onclick='return ProvjeriFormu();return false;'>&nbsp; &nbsp;<input type='reset' name='submit2' value='očisti' class='forma_gumb2'></td>";
			echo "<td></td>";
		echo "</tr>";
			echo "<tr>";
			echo "<td><br><br><br></td>";

			echo "<td> <label for='nesto' style='text-align: right; background-color: #D0FF8C;'>Polja označena sa znakom (*) su obvezna.</label></td>";
		echo "</tr>";
		echo "</table>";
	echo "	</fieldset>";

	echo "<div class='alert' id='alert_broj' style='position:absolute; top: 38px; left: 230px; width: 200px; height: 20px;' border-style: solid; border-color: red; border-width:thin;'></div>";
	echo "<div class='alert' id='alert_cijena' style='position:absolute; top: 82px; left: 230px; width: 200px; height: 20px;' border-style: solid; border-color: red; border-width:thin;'></div>";
//	echo "<div class='alert' id='alert_cijena' style='position:absolute; top: 82px; left: 220px; width: 200px; height: 20px; border-style: solid; border-color: red; border-width:thin;'></div>";


	echo "</div>";

	?>

		  </form>

    <p>&nbsp;</p>
    </TD>

	</TR>
</TABLE>

<?php izlistaj_podatke(); ?>
</div>

</div>

<div id="footer">
	<p>
		Ajax kao tehnologija web 2.0 sustava: Krunoslav Čelig (<a href="mailto:kcelig@gmail.com">kcelig@gmail.com</a>)</a>
	</p>
</div>


</body>
</html>

<?php

			if ($_GET["act"]=="dodaj") {
				$db=spoji_na_bazu();
				$broj = mysql_escape_string ($_GET["broj"]);
				$tip_sobe = mysql_escape_string ($_GET["tip_sobe"]);
				$cijena = mysql_escape_string ($_GET["cijena"]);
				$oprema = mysql_escape_string ($_GET["oprema"]);


				mysql_query("INSERT INTO soba(broj, tip_sobe, cijena, oprema) VALUES ('$broj', '$tip_sobe', '$cijena', '$oprema')");
				mysql_close();
			//	set_get();
			}

			function izlistaj_podatke() {
				$db=spoji_na_bazu();

				echo "<div id='sadrzaj' class='div_unos'>";
				echo"	<FIELDSET  style='border-color: olive;'>";
				echo "	<LEGEND class='legenda'>Popis soba:</LEGEND>";

				echo "<table class='sortable' id='anyid' width='100%' border='1' cellpadding='1' cellspacing='1' style='border-collapse:collapse;'>";
				echo " <br>";
				echo "<tr class='tablica_stupac'>";


				echo "<td class='tablica_stupac'>Broj sobe</td>";
				echo "<td class='tablica_stupac'>Tip sobe</td>";
				echo "<td class='tablica_stupac'>Cijena</td>";
				echo "<td class='tablica_stupac'>Oprema</td>";
				echo "<td class='tablica_stupac'>Akcija</td>";

				echo "</tr>";

				$qry=mysql_query("SELECT id, broj, tip_sobe, cijena, oprema FROM soba");
				$br=0;
				while (list($id, $broj, $tip_sobe, $cijena, $oprema) = mysql_fetch_row ($qry)) {
					$br++;
					echo "<form action='admin.sobe.php' method='GET' onsubmit='return false;'>";
					echo "<input type='hidden' name='act' value='update_delete'>";
						echo "<input type='hidden' name='act' value='update'>";
					echo "<input type='hidden' name='ident' value='".$id."'>";
					echo "<tr>";
				//		echo "<td>$id</td>";
						echo "<td style='background-color: #FFFFFF;'>$broj</td>";
						echo "<td style='background-color: #FFFFFF;'>$tip_sobe</td>";
						echo "<td style='background-color: #FFFFFF;'>$cijena</td>";
						echo "<td style='background-color: #FFFFFF;'>$oprema</td>";
					//	echo "<td><input type='image', name='akcija' src='images/brisi_icon.gif' width='16' height='16' border='0' onclick=\"ObrisiSobu('".$id."',this);return false;\">";
						echo "<td style='background-color: #FFFFFF;'><a href='' onclick='ObrisiSobu(\"".$id."\",this);return false;'>Obriši</a></td>";

					echo "</tr>";
					echo "</form>";

					}
					echo "</table>";
echo "	</fieldset>";
						echo "</div>";
					mysql_close();
					}

	/*				function set_get() {
						echo "<script language='Javascript'>";
						echo "location.href='admin.sobe.php'";
						echo "</script>";
						}
*/
				?>





