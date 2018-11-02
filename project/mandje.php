<?php
	include 'server.php';
	if(empty($_SESSION['items'])){
		echo "<h1>Nog geen items oin het winkelmandje</h1>";
	}else{
		$items = $_SESSION['items'];
		$manditems = explode(",", $items);
		$total = 0;
		$i=1;
		$_SESSION['aantal']=count($manditems);
?>
	<html lang="en">
	<head>
	<link href="style/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	</head>
	<body>
	<div class="container">
		<?php
			include 'menu.php';
		?>
		<br><br>
		<table class="table">
			<thead>
			<th>Artikel</th>
			<th>Naam</th>
			<th>Prijs</th>
			<th>Verwijder</th>
			</thead>
			<?php
				foreach($manditems as $key=>$id){
					$query = "SELECT * FROM producten WHERE Product_id = $id";
					$res= mysqli_query($db, $query);
					$r = mysqli_fetch_assoc($res);
			?>
			<tbody>
			<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $r['Naam']; ?></td>
			<td>€<?php echo $r['Prijs']; ?></td>
			<td><a href="delcart.php?remove=<?php echo $key;?>" class="btn btn-outline-danger" role="button" aria-pressed="true">verwijder</a></td>
			</tr>
			<?php 
				$total = $total + $r['Prijs'];
				$i++;
				}
			?>
			<tr>
			<td><strong>Totaal Prijs</strong></td>
			<td><strong>€<?php echo $total; ?></strong></td>
			<td colspan="2"><a href="addord.php" class="btn btn-primary" role="button" aria-pressed="true">Afrekenen</a></td>
			</tr>
			</tbody>
		</table>
		<a href="voorbeeld.php" class="btn btn-outline-success" role="button" aria-pressed="true">Terug naar overzicht</a>
		<?php
			}//sluit de else loop
		?>
	</div>
	<?php
	include 'footer.php';
	?>
</body>