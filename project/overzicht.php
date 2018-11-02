<?php
include 'server.php' 
?>
<html>	
	<head>
		<link href="style/style.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body>
	<?php
		$query= "SELECT Order_id FROM `order`;"; 
		$res= mysqli_query($db, $query) or die('ERROR querying database');
			if(empty($res)){
				die("Geen artikelen gevonden");
			}
	?>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			Order Nummer: <select name="nummer">
	<?php
		while($row= mysqli_fetch_assoc($res)){
			$ordernr = $row["Order_id"];
			?>
				
					<option value="<?php echo $ordernr; ?>"> <?php echo $ordernr; ?></option>
				
		<?php
		}
		?>
			</select><br>
				<input type="submit" value="zoeken">
			</form>
		<?php
			if($_SERVER["REQUEST_METHOD"]=="POST"){
				$query = "SELECT * FROM `order` WHERE Order_id =".$_POST['nummer'];
				$res= mysqli_query($db, $query) or die('ERROR querying database');
				if(empty($res)){
					die("Geen artikelen gevonden");
				}
				?>
				<table border="1">
					<th colspan="5">Bestelde artikelen</th>
					<tr><td><b>Order nr</b></td><td><b>Datum</b></td><td><b>Gebruiker</b></td><td><b>Status</b></td><td><b>Aanral Producten</b></td></tr>
					<?php
					while($row= mysqli_fetch_assoc($res)){
						$ordernr= $row['Order_id'];
						$datum= $row["Orderdatum"];
						$gebruiker= $row["Gebruikers_Gebruikers_id"];
						$status= $row["Bestelstatus"];
						$aantal= $row["Aantal_pro"];
				?>
					
						<tr><td><?php echo $ordernr; ?></td>
						<td><?php echo $datum; ?></td>
						<td><?php echo $gebruiker; ?></td>
						<td><?php echo $status; ?></td>
						<td><?php echo $aantal; ?></td></tr>
					
				<?php
					}
				?>
				</table>
			<?php
			}
			?>
	</body>
</html>