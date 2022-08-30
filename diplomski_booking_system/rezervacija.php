
			<?php
			if(	isset($_GET['ime_prezime'])	&& isset($_GET['email'])	)
			{

				require_once ('admin/conf.db.php');

				$db = spoji_na_bazu();
				$dolazak = mysql_escape_string ($_GET["dolazak"]);
				$odlazak = mysql_escape_string ($_GET["odlazak"]);
		//		$tip_sobe = mysql_escape_string ($_GET["tip_sobe"]);
				$id_sobe = mysql_escape_string ($_GET["id_sobe"]);

				$ime_prezime = mysql_escape_string ($_GET["ime_prezime"]);
				$email = mysql_escape_string ($_GET["email"]);
//mysql_query ("SELECT `id` FROM `gost` WHERE `email`=$email");
	//	$qry = mysql_query "SELECT `id` FROM `gost` WHERE `email`='".$_GET['email']."'";
	//	$qry = mysql_query "SELECT `id` FROM `gost` WHERE `email`='".$email."'";
$qry = mysql_query("SELECT `id` FROM `gost` WHERE `email`='".$email."'");
  //  echo $qry;
//     $result = mysql_query ($qry);



    // AKO ovaj gost nije već upisan
  //  if( mysql_num_rows($result)==0 )



				//	AKO ovaj gost nije već upisan
				if(	mysql_num_rows($qry)==0	)
				{
					$qry2 = mysql_query ("INSERT INTO `gost` (`ime_prezime`, `email`)  VALUES ('".$ime_prezime."','".$email."')");
				}



				//	Ponovno vadimo id gosta
				$qry = mysql_query ("SELECT `id` FROM `gost` WHERE `email`='".$email."'");
				$result = mysql_fetch_array($qry, MYSQL_ASSOC);
				$id_gosta = $result['id'];

				//provjera dal vec postoji ta rezervacija


			$qry = mysql_query ("INSERT INTO `rezervacija` (`dolazak`, `odlazak`, `id_gosta`, `id_sobe`) VALUES ('".$dolazak."', '".$odlazak."', '".$id_gosta."', '".$id_sobe."')");
			echo "Hvala Vam, Rezervacija je dodana u bazu.  <a href='index.php'>Početna</a>";
			//echo "greska";

			}

			?>