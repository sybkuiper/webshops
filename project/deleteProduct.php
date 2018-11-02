<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Product Wijzigen</title>
    <?php
    include 'database.php';
    ?>
  </head>
    <body style="background-color:#fefbd8 ">
    	<div class="container">

	
 <?php include('menu.php');?><br/><br/><br>


<?php 
	include 'database.php';

//controleer van hidden-fields

if (isset($_POST["confirmation"])){
	$query="DELETE FROM producten WHERE product_id=".$_POST["Product_id"].";";

	$result = mysqli_query($db, $query) or die (mysqli_error());
	
	if ($result){
		echo ("Klantnummer " .$_POST["Product_id"] . " is verwijderd.<p>\n");
?>
		<form><input type="button" value="Naar Product Overzicht" onclick="window.location.href='http://localhost/jaar1/Project/Product%20Overzicht.php'" /></form>
		<?php
		
	}
}else{
	 $query = "SELECT * FROM producten WHERE Product_id=" .$_GET["Product_id"] .";";
	
	if (mysqli_query($db, $query)) {
    $result = mysqli_query($db, $query);
} else {
    echo "Error updating record: " . mysqli_error($db);
}
   //output data of each row
  while($row = mysqli_fetch_assoc($result)) {
	echo "<h3>Verwijder dit record?</h3>" . "<p>";
		echo "<table>";
		echo "<tr><td>Product id:</td><td> " . $row['Product_id']. "</td></tr> ";
		echo "<tr><td>Product Naam:</td><td> ".$row['Naam']. "</td></tr> " ;
		echo "<tr><td>Prijs:</td><td> ".$row['Prijs']. "</td></tr> " ;
		echo "<tr><td>Omschrijven:</td><td> ".$row['Beschrijving']. "</td></tr> " ;
		
		
		echo "</table><p><hr>";
    
} 

?>
<p />
 
 <form action="<?php echo($_SERVER["PHP_SELF"]);?>" method="POST">
	<input type="hidden" name="confirmation" value="1">
	<input type="hidden" name="Product_id" value="<?php echo($_GET["Product_id"]);?>">
	<input type="Submit" value="Yeah, verwijder">
	<input type="Button" value="Nee, terug" onclick="javascript:history.back();">
</form>
<?php

}
?>
</div>
</div>


<!-- Placed at the end of the document so the pages load faster -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>
