<?php
include 'server.php';
?>
<html lang="en">
	<head>
		<link href="style/style.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	</head>
	<body>
	<br>
	<div class="container">
			<?php
			include 'menu.php';
			if(!isset($_SESSION['items'])){
				$_SESSION['items']=array();
			}
			$query= "SELECT Product_id, Naam, Beschrijving, Prijs, Categorie FROM producten";
			$res= mysqli_query($db, $query) or die("ERROR querying database");
			if(empty($res)){
				die("Geen artikelen gevonden");
			}
			?>
				<table class="table">
				<thead>
				<th>Kaart</th><th>Naam</th><th>Beschrijving</th><th>Categorie</th><th>Prijs</th>
				</thead>
				<tbody>
				<?php
				while($row= mysqli_fetch_assoc($res)){
				?>
					<tr><td><img class ="thump" src="img/<?php echo $row['Naam'];?>.jpg"></td>
					<td><?php echo $row['Naam'];?></td>
					<td><?php echo $row['Beschrijving']; ?></td>
					<td><?php echo $row['Categorie']; ?></td>
					<td>€<?php echo $row['Prijs']; ?></td>
					<td><a href="shopp.php?id=<?php echo $row['Product_id'];?>" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Add to cart</a></td></tr>
				<?php
				}
				?>	
				</tbody>
				</table>
			<form method="POST" action="mandje.php">
				<input type="submit" value="Naar winkelmandje">
			</form>
	</div>
	<?php 
	include 'footer.php';