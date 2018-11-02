<?php
include 'server.php';
$aantal = $_SESSION['aantal'];
$query = "SELECT Gebruikers_id FROM gebruikers WHERE gebruikersnaam = 'ADMINNI'";//later $_SESSION['username']
$res= mysqli_query($db, $query) or die("ERROR");
if(empty($res)){
	die("Geen artikelen gevonden");
}
while($row=mysqli_fetch_assoc($res)){
	$gebruiker = $row['Gebruikers_id'];
}
$sql = "INSERT INTO `order`(Orderdatum, Gebruikers_Gebruikers_id, Bestelstatus, Aantal_pro) VALUES(SYSDATE(), $gebruiker, 1, $aantal)";
	if(mysqli_query($db,$sql)){
		echo "<h1> De items zijn besteld </h1>";
		mysqli_close($db);
		echo "<a href=\"voorbeeld.php\">Terug naar overzicht</a>";
	}else{
		echo "Er is iets fout gegaan";
	}
?>