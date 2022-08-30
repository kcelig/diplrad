<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>:: Studentski dom - Varaždin :: </title>
<link rel="stylesheet" type="text/css" href="styles/base.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
	<meta http-equiv="Content-Language" CONTENT="HR">

<!--	<link href="admin/stil.css" rel="stylesheet" type="text/css" /> -->

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



	<script type="text/javascript" src="datepicker.js"></script>
	<script type="text/javascript" src="ajax.js"></script>

		<script type="text/javascript">

			var ajax = new glavni();
			var sadrzajObj;
			var dolazakBox;
			var odlazakBox;

			function PrikaziSadrzaj()    // funkcija koja prikazuje sadrzaj (npr. odredjenu stranicu ili poruku i sl.) unutar definiranog <div> tag-a
			{
				sadrzajObj = document.getElementById('sadrzaj');
            	sadrzajObj.innerHTML = ajax.response;       // ajax.response - varijabla koja sadrzi value (sadrzaj) neke vanjske datoteke (npr. .html datoteke)
    		}

			function RezultatPretrage()
    		{
    			dol = document.getElementById('dolazak').value;
    			odl = document.getElementById('odlazak').value;
    			tip = document.getElementById('tip_sobe').value;
    			tv = document.getElementById('SobaOprema').checked;

				if(tv)
				{
					tv=1;
				}
				else
				{
					tv=0;
				}

    			//alert('pretrazi2.php?dolazak='+dol+'&odlazak='+odl+'&oprema='+tv);
       			 ajax.requestFile = 'pretrazi.php?dolazak='+dol+'&odlazak='+odl+'&oprema='+tv+'&tip_sobe='+tip;
        		 ajax.onCompletion = PrikaziSadrzaj;        // specificira funkciju koja ce se izvrsiti nakon sto je datoteka pronadjena
        		 ajax.pokreniAJAX();
    		}


			function ProvjeriFormu()
			{
				dolazakBox = document.getElementById('alert_dol');
				dolazakBox.innerHTML = "";

				odlazakBox = document.getElementById('alert_odl');
				odlazakBox.innerHTML = "";

				contentObj = document.getElementById('sadrzaj');
       			 contentObj.innerHTML = "";

				if(document.getElementById('dolazak').value == '')
				{
					dolazakBox.innerHTML = "Niste unijeli datum dolaska!";
					return false;
				}


				if(document.getElementById('dolazak').value != '' && document.getElementById('odlazak').value == '')
				{
					odlazakBox.innerHTML = "Niste unijeli datum odlaska!";
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
	<ol id="navlinks">
		<li class="first"><a href="index.php">O nama</a></li>

    <li><a href="rezerviranje.php">On-line rezervacija</a></li>
		<li><a href="kontakt.php">Kontakt</a></li>

    <li><a href="admin/index.php">Administrator</a></li>

	</ol>
	<p id="today">
		diplomski rad
	</p>
</div>

<div id="content">
	<h1><b>Studentski dom:</b> rezervacija sobe</h1>
	<h2></h2>




	<div class="div_unos">
	<form name="forma" id="dodaj" class="forma" action="pretrazi.php" onsubmit="return false;">

<FIELDSET  style="border-color: olive; background_color: white;">
<LEGEND class="legenda">Molimo, pretražite slobodnu sobu:</LEGEND>

		<TABLE width="auto">
      		<TR>
      			<TD><label for="dolazak" >Datum dolaska*:</label></TD>
				<TD><input class="input" type="text" name="dolazak" id="dolazak" value="<?php echo $_POST['dolazak']; ?>">
					<a href="javascript:void(0)" onclick="displayDatePicker('dolazak', false, 'ymd', '-');">Odaberi</a>

				</TD>
				<TD></TD>
			</TR>

      		<TR>
      			<TD><label for="odlazak" >Datum odlaska*:</label></TD>
				<TD><input class="input" type="text" name="odlazak" id="odlazak" value="<?php echo $_POST['odlazak']; ?>">
					<a href="javascript:void(0)" onclick="displayDatePicker('odlazak', false, 'ymd', '-'); ">Odaberi</a>
				</TD>
				<TD></TD>
			</TR>

    		<TR>
    			<TD><label for="tip_sobe">Tip sobe:</label></TD>
				<TD><select class="input" name="tip_sobe" id="tip_sobe">
						<option value="jednokrevetna" <?php if( $_POST['tip_sobe'] == 'jednokrevetna' ) echo 'selected="selected"'; ?>>Jednokrevetna</option>
						<option value="dvokrevetna" <?php if( $_POST['tip_sobe'] == 'dvokrevetna' ) echo 'selected="selected"'; ?>>Dvokrevetna</option>
					</select>
				</TD>
			</TR>

			<TR>
				<TD><label for="oprema">TV u sobi?</label></TD>
				<TD><input type="hidden" name="oprema"  value="0" id="SobaOprema_" />
						<input type="checkbox" name="oprema" id="SobaOprema" value="1" <?php if( $_POST['oprema'] == '1' ) echo 'checked="checked"'; ?> />
						<label for="da">DA</label>
				</TD>
			</TR>

			<TR>
				<TD><BR><BR></TD>
				<TD><input type="submit" value="pretraži" class="forma_gumb2" onclick=" return ProvjeriFormu();return false;"/>
					<input type="reset" value="očisti" class="forma_gumb2"/>
				</TD>
				<TD></TD>
			</TR>

			<TR>
				<TD><BR><BR><BR></TD>
				<TD><label for="nesto" style="text-align: right; background-color: #D0FF8C;">Polja označena sa znakom (*) su obvezna.</label></TD>
				<TD></TD>
			</TR>
		</TABLE>
	</FIELDSET>

	</form>

			<div class="alert" id="alert_dol" style="position:absolute; top: 29px; left: 330px; width: 200px; height: 20px;"></div>
			<div class="alert" id="alert_odl" style="position:absolute; top: 50px; left: 330px; width: 200px; height: 20px;"></div>
			<div id="sadrzaj"></div>
			<h2></h2>
	</div>


</div>

<div id="footer">
	<p>
		Ajax kao tehnologija web 2.0 sustava: Krunoslav Čelig (<a href="mailto:kcelig@gmail.com">kcelig@gmail.com</a>)</a>
	</p>
</div>

</body>
</html>
