<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>:: Studentski dom - Varaždin :: </title>
<link rel="stylesheet" type="text/css" href="styles/base.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
	<meta http-equiv="Content-Language" CONTENT="HR">
<link rel="icon" href="/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

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


<!--	<link href="admin/stil.css" rel="stylesheet" type="text/css" />  -->

	<script type="text/javascript" src="ajax.js"></script>

		<script type="text/javascript">

			var ajax = new glavni();
			var sadrzajObj;
			var ime_prezimeBox;
			var emailBox;

			function PrikaziSadrzaj()        // funkcija koja prikazuje sadrzaj (npr. odredjenu stranicu ili poruku i sl.) unutar definiranog <div> tag-a
    		{
				sadrzajObj = document.getElementById('sadrzaj');
				var x = ajax.response;

           		 if(x.match('greska'))
           		 {
            		sadrzajObj.innerHTML = 'Rezervacija nije uspjela! <a href="JavaScript:location.reload(true);">Pokušajte ponovo</a>';
            	 }
            	 else
            	 {
            		sadrzajObj.innerHTML = ajax.response;
				 }       // ajax.response - varijabla koja sadrzi vrijednost (sadrzaj) neke vanjske datoteke (npr. .html datoteke)
    		}

			function RezervirajGosta()
    		{
    			dol = document.getElementById('dolazak').value;
    			odl = document.getElementById('odlazak').value;
    			id_sobe = document.getElementById('id_sobe').value;

				ip = document.getElementById('ime_prezime').value;
    			email = document.getElementById('email').value;

    			//alert('pretrazi.php?dolazak='+dol+'&odlazak='+odl+'&oprema='+tv);
      		  	ajax.requestFile = 'rezervacija.php?dolazak='+dol+'&odlazak='+odl+'&id_sobe='+id_sobe+'&ime_prezime='+ip+'&email='+email;
      		  	ajax.onCompletion = PrikaziSadrzaj;        // specificira funkciju koja ce se izvrsiti nakon sto je datoteka pronadjena
      		  	ajax.pokreniAJAX();
   		    }

			function ProvjeriFormu() //funkcija koja provjerava da li su uneseni svi podaci u formu
			{
				ime_prezimeBox = document.getElementById('alert_imeprez');
				ime_prezimeBox.innerHTML = "";
				emailBox = document.getElementById('alert_email');
				emailBox.innerHTML = "";

				if(document.getElementById('ime_prezime').value == '')  // provjera da li je uneseno ime i prezime
				{
					ime_prezimeBox.innerHTML = "Niste unijeli ime i prezime!";
					return false;
				} // kraj if-a

				if(document.getElementById('ime_prezime').value != '' && document.getElementById('email').value == '') // provjera da li je unesena email adresa
				{
					emailBox.innerHTML = "Niste unijeli adresu e-pošte!";
					return false;
				} // kraj if-a

				if(/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(document.getElementById('email').value) == false) // provjera da li je email adresa isprevno unesena (regular exp.)
				{
					emailBox.innerHTML = "Neispravna adresa e-pošte!";
					return false;

				}


				RezervirajGosta();
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
	<h1><b>Studentski dom:</b> rezervacija</h1>
	<h2></h2>

<div id="sadrzaj" class="div_unos">
	<form name="forma" id="forma" class="forma" method="post" action="rezervacija.php" onsubmit="return false;" >
		<input type="hidden" name="id_sobe" id="id_sobe" value="<?php echo $_GET['id_sobe'];?>" />
		<input type="hidden" name="dolazak" id="dolazak" value="<?php echo $_GET['dolazak'];?>" />
		<input type="hidden" name="odlazak" id="odlazak" value="<?php echo $_GET['odlazak'];?>" />

		<FIELDSET  style="border-color: olive;">
		<LEGEND class="legenda">Molimo, unesite svoje podatke:</LEGEND>

			<TABLE width="auto">
    			<TR>
      				<TD><label for="ime_prezime">Ime i prezime*:</label></TD>
					<TD><input class="input" type="text" size="35" name="ime_prezime" id="ime_prezime" class="ime" value="<?php echo $_GET['ime_prezime'];?>"></TD>
				</TR>

      			<TR>
      				<TD><label for="email">E-pošta*:</label></TD>
					<TD><input class="input" size="35" type="text" name="email" id="email" value="<?php echo $_GET['email'];?>"></TD>
				</TR>

      			<TR>
      				<TD><BR><BR></TD>
					<TD><input type="submit" name="Submit" value="rezerviraj" id="submit" class="forma_gumb2" onclick="return ProvjeriFormu(); return false;" />
						<input type="reset" class="forma_gumb2" value="očisti" />
					</TD>
					<TD></TD>
				</TR>

				<TR>
					<TD></TD>
					<TD><BR><BR></TD>
					<TD></TD>
				</TR>

				<TR>
					<TD></TD>
					<TD><label for="nesto" style="text-align: right; background-color: #D0FF8C;">Polja označena sa znakom (*) su obvezna.</label></TD>
					<TD></TD>
				</TR>
			</TABLE>
		</FIELDSET>

		<div class="alert" id="alert_imeprez" style="position:absolute; top: 29px; left: 345px; width: 200px; height: 20px;"></div>
		<div class="alert" id="alert_email" style="position:absolute; top: 52px; left: 345px; width: 200px; height: 20px;"></div>

	</form>
	</div>



			<h2></h2>
	</div>


</div>

<div id="footer">
	<p>
		Programiranje & dizajn: Krunoslav Čelig (<a href="mailto:kcelig@gmail.com">kcelig@gmail.com</a>)</a>
	</p>
</div>

</body>
</html>
