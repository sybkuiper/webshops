<?php
include 'server.php' 
?>
<html>	
	<head>
		<link href="style/style.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	</head>
	<body>
		<?php
			include 'menu.php';
			$query= "SELECT Order_id FROM `order`;"; 
			$res= mysqli_query($db, $query) or die('ERROR querying database');
				if(empty($res)){
					die("Geen artikelen gevonden");
				}
		?>
		<br><br>
		<div class="container">
			<?php /*<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				Order Nummer: <select name="nummer" class="form-control">
			<?php
				while($row= mysqli_fetch_assoc($res)){
					$ordernr = $row["Order_id"];
			?>
			<option value="<?php echo $ordernr; ?>"> <?php echo $ordernr; ?></option>					
			<?php
				}
			?>
			</select><br>
				<input type="submit" value="zoeken" class="btn btn-primary">
			</form>*/?>
			<?php
				if($_SERVER["REQUEST_METHOD"]=="POST"){
					$query = "SELECT * FROM `order`";//"WHERE Order_id =".$_POST['nummer'];
					$res= mysqli_query($db, $query) or die('ERROR querying database');
					if(empty($res)){
						die("Geen artikelen gevonden");
					}
					?>
					<table class="table">
						<thead>
						<th colspan="5">Bestelde artikelen</th>
						<tr><td><b>Order nr</b></td><td><b>Datum</b></td><td><b>Gebruiker</b></td><td><b>Status</b></td><td><b>Aantal Producten</b></td></tr>
						</thead>
						<?php
							while($row= mysqli_fetch_assoc($res)){
								$ordernr= $row['Order_id'];
								$datum= $row["Orderdatum"];
								$gebruiker= $row["Gebruikers_Gebruikers_id"];
								$status= $row["Bestelstatus"];
								$aantal= $row["Aantal_pro"];
						?>
						<tbody>
						<tr><td><?php echo $ordernr; ?></td>
						<td><?php echo $datum; ?></td>
						<td><?php echo $gebruiker; ?></td>
						<td><?php echo $status; ?></td>
						<td><?php echo $aantal; ?></td></tr>						
						<?php
							}
						?>
						</tbody>
						</table>
					<?php
					}	
					?>
		</div>
		<?php
		include 'footer.php';
		?>
	</body>
</html>