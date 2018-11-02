<html lang="en">
	<head>
		<link href="style/style.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	</head>
	<body>
		<div class="container">
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
					?><a href="voorbeeld.php" class="btn btn-primary" role="button" aria-pressed="true">Terug naar overzicht</a><?php
					unset($_SESSION['items']);
				}else{
					echo "Er is iets fout gegaan";
				}
			?>
		</div>
	</body>
</html>