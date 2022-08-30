<?php
require_once("auth.php");
//require_once("conf.poruke.php");
if (session_is_registered("userid")) {
header("Location:admin.php");
exit;
}
if ($_SERVER["REQUEST_METHOD"]=="POST") {
$err = auth_login($_POST["username"],$_POST["password"]);
if ($err==1)
header("Location:admin.php");
}
?>
<HTML>

<HEAD>

<TITLE>:: ADMIN Prijava ::</TITLE>

<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1250">

<!--<link href="stil.css" rel="stylesheet" type="text/css" /> -->
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


</HEAD>

<BODY>
<div id="masthead">
	<a href="#" id="homelink"><img src="images/javacotea.gif" alt="JavaCo Tea home" /></a>


	<p id="today">
		diplomski rad
	</p>
</div>

<div id="content">
	<h1><b>Administrator:</b> Prijava</h1>
<!--	<h2><img src="images/log.jpg"></h2> -->

<div></div>

<div id="sadrzaj" class="div_unos" >

	<form action="index.php" method="POST">

	<FIELDSET  style="border-color: olive;">
	<LEGEND class="legenda">Prijava za administratora:</LEGEND>

 	 	<TABLE width="auto">


  		    <TD colspan="6"> <div align="center" class="greska">
     	    <?php if($err!=1) echo $err; ?>

            <tr>
              <td>Korisničko ime*:</td>
              <td><input class="input" name="username" type="text" id="username"></td>
            </tr>

            <tr>
              <td>Lozinka*:</td>
              <td><input class="input" name="password" type="password" id="password"></td>
            </tr>

            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>

            <tr>
              <td></td>
              <td><input name="Submit" type="submit" class="forma_gumb2" value="Prijavi">
                  &nbsp; &nbsp;
                  <input name="Reset" type="reset" class="forma_gumb2" value="Očisti">
              </td>
              <td>&nbsp;</td>
            </tr>

            <tr>
			  <td></td>
			  <td><BR><BR></td>
		   	  <td></td>
			</tr>

			<tr>
			  <td><div></div></td>
			  <td><label for="nesto" style="text-align: right; background-color: #D0FF8C;">Polja označena sa znakom (*) su obvezna.</label></td>
			  <td></td>
			</tr>

  		</TABLE>

	</FIELDSET>
	</form>
</div>


</div>

<div id="footer">
	<p>
		Ajax kao tehnologija web 2.0 sustava: Krunoslav Čelig (<a href="mailto:kcelig@gmail.com">kcelig@gmail.com</a>)</a>
	</p>
</div>

</BODY>

</HTML>









