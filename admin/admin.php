<?php
//require_once("conf.poruke.php");
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

<HTML>
<HEAD>
<TITLE>:: ADMINISTRATOR: on-line rezervacije ::</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1250">
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
	<h1><b>Administrator:</b> Upravljanje</h1>

<div id="sadrzaj" class="div_unos">

 <FIELDSET  style="border-color: olive;">
<!--<LEGEND class="legenda">Administratorska sekcija</LEGEND> -->

<TABLE >

	<TR>
		<TD colspan="6" rowspan="16" valign="top"><p style="font-size:12px; color: olive;">Dobrodošao <?php echo $_SESSION["userid"] ?></p>
		<p>&nbsp;</p>
			<a href="admin.php?a=0">Odjava<br><br><img src="images/odjava.gif"></a>
			<p>&nbsp;</p>
	    <p><?php build_menu($_SESSION["userclass"]); ?></p>
    </TD>
  </TR>


</TABLE>

 </FIELDSET>

</div>

</div>

<div id="footer">
	<p>
		Ajax kao tehnologija web 2.0 sustava: Krunoslav Čelig (<a href="mailto:kcelig@gmail.com">kcelig@gmail.com</a>)</a>
	</p>
</div>

</BODY>
</HTML>
