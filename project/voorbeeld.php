<?php
include 'server.php';
?>
<html>
	<body>
	<?php
	if(!isset($_SESSION['items'])){
		$_SESSION['items']=array();
	}
	$query= "SELECT Product_id, Naam, Beschrijving, Prijs, Categorie FROM producten";
	$res= mysqli_query($db, $query) or die("ERROR querying database");
	if(empty($res)){
		die("Geen artikelen gevonden");
	}
	?>
		<table border="1">
		<th>Naam</th><th>Beschrijving</th><th>Categorie</th><th>Prijs</th>
		<?php
		while($row= mysqli_fetch_assoc($res)){
		?>
			<tr><td><?php echo $row['Naam'];?></td>
			<td><?php echo $row['Beschrijving']; ?></td>
			<td><?php echo $row['Categorie']; ?></td>
			<td>€<?php echo $row['Prijs']; ?></td>
			<td><a href="shopp.php?id=<?php echo $row['Product_id'];?>" role="button">Add to cart</a></td></tr>
		<?php
		}
		?>	
		</table>
	<form method="POST" action="mandje.php">
		<input type="submit" value="Naar winkelmandje">
	</form>