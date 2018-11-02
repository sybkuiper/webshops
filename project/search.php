<?php
  include 'server.php';
  include 'menu.php';
?>

<html>	
	<head>
		<link href="style/style.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body>
    
    <br><br>
    <div class="container">
      <?php
        // Kijk of er een zoekterm is ingevoerd
        if ( !isset($_POST['zoekterm']) ) {
          echo "<h2>Voer een zoekterm in!</h2>";
        } else {
          echo "<h4>Zoekterm: " . htmlspecialchars($_POST['zoekterm']) . "</h4>";

          $zoekterm = mysqli_real_escape_string($db, $_POST['zoekterm']); 
          $sql = "SELECT DISTINCT * FROM producten WHERE naam='$zoekterm' OR beschrijving LIKE '%$zoekterm%' OR categorie='$zoekterm'";

          $res = mysqli_query($db, $sql);
          
          if (mysqli_errno($db)) {
            echo "<h5>Er ging iets fout bij het uitvoeren van de query.</h5>" . mysqli_error($db);
          } else if (mysqli_num_rows($res) == 0) {
            echo "<h5>Geen gegevens gevonden</h5>";
          } else { ?>
            <table class='table'>
              <thead>
                <th>Naam</th>
                <th>Beschrijving</th>
                <th>Prijs</th>
                <th>Voorraad</th>
                <th>Categorie</th>
                <th> </th>
              </thead>
            <?php
            while ($row = mysqli_fetch_assoc($res)) {
              $pro_id = $row['Product_id'];
              $naam = $row['Naam'];
              $beschrijving = substr($row['Beschrijving'], 0, 40);
              $prijs = htmlspecialchars("€") . $row['Prijs'];
              $voorraad = $row['Voorraad'];
              $categorie = $row['categorie']; ?>
            <tr>
              <td><?php echo $naam; ?></td>
              <td><?php echo $beschrijving; ?></td>
              <td><?php echo $prijs; ?></td>
              <td><?php echo $voorraad; ?> in voorraad</td>
              <td><?php echo $categorie; ?></td>
              <td><a href='pokemon.php/?pro_id=<?php echo $pro_id; ?>'>Ga naar pagina</a></td>
            </tr>
            <?php ;} // END WHILE
            echo "</table>";
          } // END IF-ELSE
           
        }  // END isset zoekterm
      ?>
    </div>
     
     
    <?php include 'footer.php'; ?>
	</body>
</html>
