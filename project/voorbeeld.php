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
			<td><a href="shoppingcart.php?id=<?php echo $row['Product_id'];?>" role="button">Add to cart</a></td></tr>
		<?php
		}
		?>	
		</table>
	<?php
	/*if(isset($_SESSION['items']) && !empty($_SESSION['items'])){
		$items= $_SESSION['items'];
		$cartitems= explode(",", $items);
		$items .="," . $_GET['id'];
		$_SESSION['items']= $items;
		header('location: voorbeeld.php?status=success');
	}else{
		$items = $_GET['id'];
		$_SESSION['items'] = $items;
		header('location: voorbeeld.php?status=failed');
	}*/
	/*if($_SERVER["REQUEST_METHOD"]=="POST"){
		//$prod_id= $_POST[$row['Product_id']];
		array_push($_SESSION['items'], $_POST["$i"]);
		var_dump($_SESSION['items']);*/
	?>
	<form method="POST" action="mandje.php">
		<input type="submit" value="Naar winkelmandje">
	</form>