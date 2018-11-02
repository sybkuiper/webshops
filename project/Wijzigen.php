 
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


    <!-- Optional JavaScript -->
    
 <?php include('menu.php');?><br/><br/>

<?php 
	$ProductnaamErr = $PrijsErr = $OmschrijvingErr = "";
	$Productnaam = $Prijs = $Omschrijving =  "";
	$Product_id=$_GET['Product_id'];


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["Productnaam"])) {
		$ProductnaamErr= "Productnaam is verplicht";
		}
		else {
		$Productnaam = test_input($_POST["Productnaam"]);
		}
		if (empty($_POST["Prijs"])) {
		$PrijsErr = "Prijs is verplicht";
		}
		else {
		$Prijs = test_input($_POST["Prijs"]);
		}
		if (empty($_POST["Omschrijving"])) {
		$OmschrijvingErr = "Omschrijving is verplicht";
		}
		else {
		$Omschrijving = test_input($_POST["Omschrijving"]);
		}

   }

   function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



?>

<?php
   
$query = "select * from producten where Product_id=".$Product_id
.";";

$result = mysqli_query($db, $query);
if (!$result) {
die("Database query failed.");
}

while($row= mysqli_fetch_assoc($result))
  {  
            $NaamO=$row['Naam'];
            $PrijsO=$row['Prijs'];
            $OmshrijvenO=$row['Beschrijving'];



  }
  mysqli_free_result($result);
    ?>


<div class="container">
	<br>
<h2>Product Wijzigen</h2>



 <form method="POST">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="Productnaam">Product naam</label>
      <input type="text" class="form-control " name="Productnaam" value= <?php if(!empty($_POST['submit'])){
        echo $Productnaam;}
        else{
          echo $NaamO;
        }
      
      ?>  

      required>
     
    </div>
    <div class="col-md-4 mb-3">
      <label for="Prijs">Prijs:</label>
      <input type="number" class="form-control " name="Prijs"  value= <?php if(!empty($_POST['submit'])){
        echo $Prijs;}
        else{
          echo $PrijsO;
        }
      
      ?>   required>
     
    </div>
    
  </div>
 <div class="form-row">

    <div class="col-md-4 mb-3">
      <label for="Omschrijving">Omschrijving</label>
      <input type="text" class="form-control " name="Omschrijving"  value= <?php if(!empty($_POST['submit'])){
        echo $Omschrijving;}
        else{
          echo $OmshrijvenO;
        }
      
      ?>   required>
      
    </div>
 </div>


  <input class="btn btn-primary" type="submit" name="submit"
  onclick="window.location.href='http://localhost/jaar1/Project/Product%20Overzicht.php'"
  >
<input class="btn btn-primary" type="button" value="Naar products" onclick="window.location.href='http://localhost/jaar1/Project/Product%20Overzicht.php'" />
</form>
</div>

<?php


if(!empty($_POST["submit"])){

 // ' , Beschrijving= '.$Omschrijving.' , Naam='.$Productnaam.
$queryDD = 'UPDATE producten
SET Prijs='.$Prijs.' , Beschrijving= "'.$Omschrijving.'"'
.' , Naam="'.$Productnaam
.'"  WHERE Product_id='.$_GET['Product_id'].';';
 
if (mysqli_query($db, $queryDD)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($db);
}


// 5. Connectie verbreken
mysqli_close($db);
}

?>
</div>
<br>
<?php
    include 'footer.php';
    ?>
    <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>
