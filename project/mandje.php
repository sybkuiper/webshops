<?php
	include 'server.php';
	$items = $_SESSION['items'];
	$manditems = explode(",", $items);
	$total = 0;
	$i=1;
	$_SESSION['aantal']=count($manditems);
?>
	<table border="1" class="table">
	<tr>
	<th>Artikel</th>
	<th>Naam</th>
	<th>Prijs</th>
	<th>Verwijder</th>
	</tr>
<?php
	foreach($manditems as $key=>$id){
		$query = "SELECT * FROM producten WHERE Product_id = $id";
		$res= mysqli_query($db, $query);
		$r = mysqli_fetch_assoc($res);
?>

	<tr>
	<td><?php echo $i; ?></td>
	<td><?php echo $r['Naam']; ?></td>
	<td>€<?php echo $r['Prijs']; ?></td>
	<td><a href="delcart.php?remove=<?php echo $key;?>">verwijder</a></td>
	</tr>
<?php 
	$total = $total + $r['Prijs'];
	$i++;
	}
?>
	<tr>
	<td><strong>Totaal Prijs</strong></td>
	<td><strong>€<?php echo $total; ?></strong></td>
	<td colspan="2"><a href="addord.php" >Afrekenen</a></td>
	</tr>
</table>
<a href="voorbeeld.php">Terug naar overzicht</a>