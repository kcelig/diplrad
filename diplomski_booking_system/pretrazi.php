		<html>
	<head>
			<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
	<meta http-equiv="Content-Language" CONTENT="HR">
	<link href="styles/base.css" rel="stylesheet" type="text/css" />

	<script language="javascript" src="admin\sortable.js"></script>
	</head>
<body>
			<?php

			if(	isset($_GET['dolazak']) && isset($_GET['odlazak'])	){

				require_once ('admin/conf.db.php');

				$db = spoji_na_bazu();

				$dolazak = mysql_escape_string ($_GET["dolazak"]);
				$odlazak = mysql_escape_string ($_GET["odlazak"]);
				$tip_sobe = mysql_escape_string ($_GET["tip_sobe"]);
				$oprema = mysql_escape_string ($_GET["oprema"]);

		/*
				echo $dolazak . '<br />' . $odlazak .'<br />';
				$dan=date('d');
				$mjesec=date('m');
				$godina=date('Y');
				$godina_dolaska = substr($dolazak,0,4);
				$mjesec_dolaska = substr($dolazak,5,2);
				$dan_dolaska = substr($dolazak,8,2);
				$godina_odlaska = substr($odlazak,0,4);
				$mjesec_odlaska = substr($odlazak,5,2);
				$dan_odlaska = substr($odlazak,8,2);

				if(
					intval($godina_dolaska) < intval($godina) ||
					( intval($godina_dolaska) == intval($godina) && intval($mjesec_dolaska) < intval($mjesec) ) ||
					( intval($godina_dolaska) == intval($godina) && intval($mjesec_dolaska) == intval($mjesec) && intval($dan_dolaska) < intval($dan) )
				 )
				{
				 	echo 'Prošao datum';
				}

*/

 $query="
     SELECT DISTINCT `Soba`.`id`,`Soba`.`broj`,`Soba`.`tip_sobe`,`Soba`.`cijena`,`Soba`.`oprema`
     FROM `soba` AS `Soba`
     LEFT JOIN `rezervacija` AS `Rezervacija` ON `Rezervacija`.`id_sobe`=`Soba`.`id`
     WHERE (`Soba`.`tip_sobe` = '$tip_sobe' AND `Soba`.`oprema` = '$oprema' ) AND
     (
      `Soba`.`id` NOT IN
      (
        SELECT `Rezervacija`.`id_sobe`
        FROM `rezervacija` AS `Rezervacija`
      WHERE (`Rezervacija`.`dolazak` < '$dolazak' AND `Rezervacija`.`odlazak` < '$dolazak' OR `Rezervacija`.`dolazak` > '$odlazak' AND `Rezervacija`.`odlazak` > '$odlazak')



       )

     );
    ";
    $qry = mysql_query($query);
//echo $query;

/*

				$qry = mysql_query
				("
					SELECT DISTINCT `Soba`.`id`,`Soba`.`broj`,`Soba`.`tip_sobe`,`Soba`.`cijena`,`Soba`.`oprema`
					FROM `soba` AS `Soba`
					LEFT JOIN `rezervacija` AS `Rezervacija` ON `Rezervacija`.`id_sobe`=`Soba`.`id`
					WHERE (`Soba`.`tip_sobe` = '$tip_sobe' AND `Soba`.`oprema` = '$oprema' ) AND
					(
						`Soba`.`id` NOT IN
						(
								SELECT `Rezervacija`.`id_sobe`
								FROM `Rezervacija`
						WHERE (`Rezervacija`.`dolazak` < '$dolazak' AND `Rezervacija`.`odlazak` < '$dolazak' OR `Rezervacija`.`dolazak` > '$odlazak' AND `Rezervacija`.`odlazak` > '$odlazak');



							)

					)
				");

*/


				if(	mysql_num_rows($qry)==0	)
				{
					echo "Nema rezultata";

				}	else	{

				?>


				<FIELDSET  style="border-color: olive; background_color: white;">
				<LEGEND class="legenda">Slobodne sobe:</LEGEND>
				<br>
				<table class="sortable" id="anyid" align="center" width="100%" border="1" cellpadding="1" cellspacing="1" style="border-collapse:collapse;" >
					<tr class="tablica_stupac">
						<td style="color: #595900;" class="tablica_stupac">Broj sobe</td>
						<td style="color: #595900;" class="tablica_stupac">Cijena</td>
						<td style="color: #595900;" class="tablica_stupac">Ukupan iznos</td>
						<td style="color: #595900;" class="tablica_stupac">Akcija</td>
					</tr>

					<?php	while ($row = mysql_fetch_array($qry, MYSQL_ASSOC)) {	?>
					<tr>
						<td style='background-color: #FFFFFF;'><?php echo $row['broj'];?></td>
						<td style='background-color: #FFFFFF;'><?php echo $row['cijena'];?> kn</td>
						<td style='background-color: #FFFFFF;'><?php echo $row['cijena']*round((strtotime($odlazak)-strtotime($dolazak))/(24*60*60),0);?> kn</td>
						<td style='background-color: #FFFFFF;'>
							<a href="<?php echo	'/dipl/unos_gosta.php?akcija=rezerviraj&id_sobe='.$row['id'].'&dolazak='.$dolazak.'&odlazak='.$odlazak;?>">rezerviraj</a>
						</td>
					</tr>
					<?php	}	?>

				</table>
				</FIELDSET>
				<?php
				}
				mysql_close();

			}
			elseif ($_GET['akcija'] == 'rezerviraj'){
				echo "Ovdje ide forma za rezervaciju sobe";
			}
		?>

	</body>
	</html>