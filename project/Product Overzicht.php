

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Product Overzicht</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

 <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
</head>
<body>

<?php include('menu.php');?><br/><br/>

<?php
include 'database.php';
?>
<div class="container">


<hr><p />
<table class="table table-striped" border="1" width="50%"  align="left">
<tr>	<td colspan="7"><h2 align="center">Product Overzicht</h2></td></tr>
<tr>
	<th>ProductID</th><th>Productnaam</th><th>Prijs</th><th>Omschrijving</th><th>Voorraad</th><th>Actie</th>
</tr>

<?php 
$sql = ("SELECT * FROM producten"); 
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
	echo "<tr>";
	echo "<td>" . $row['Product_id'] . "</td>";
 	echo "<td>" . $row['Naam'] . "</td>";
  	echo "<td>" . $row['Prijs']. "</td>";
  	echo "<td>" . $row['Beschrijving']  . "</td>";
  	echo "<td>" . $row['Voorraad']  . "</td>";

	echo ("<td> <a href=\"deleteProduct.php?Product_id=".$row['Product_id']."\">Verwijder | </a>   

		<a href=\"Wijzigen.php?Product_id=".$row['Product_id']."\">Wijzgen</a>");

	
	echo "</tr>";
  }
echo "</table>";	
		
	   
} else {
    echo "Geen records gevonden";
}
mysqli_free_result($result);

mysqli_close($db);
?> 
  
</div>
<br>
<br>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<br>

<?php
include('footer.php');
?>
<!-- Placed at the end of the document so the pages load faster -->
    <!--  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>