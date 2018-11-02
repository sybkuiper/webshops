<?php include('server.php'); 

  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index.php");
  }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Cardshop</title>

    <!-- Bootstrap core CSS -->
    <link href="style/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  </head>
  <body>
    <?php include('menu.php');?>

    <div class="container" style="background-color: white; color: black;">
    
    <?php if (isset($_SESSION['success'])) {
      
        if( isset($_POST['submit']) ) {
          $db = mysqli_connect("localhost", "root", "", "thecardshop");

          if (mysqli_errno($db)) {
            echo "<h2>Kon geen verbinding maken met database</h2>";
          }

          // Uitlezen $_POST en normaliseren data
          $productnaam = mysqli_real_escape_string($db, $_POST['productnaam']);
          $prijs = floatval(str_replace(',', '.',$_POST['prijs']));
          $categorie = mysqli_real_escape_string($db, $_POST['categorie']);
          $aantal = $_POST['aantal'];
          $omschrijving = mysqli_real_escape_string($db, $_POST['omschrijving']);

          // INSERT en kijk of het is gelukt
          $sql = "INSERT INTO producten (Naam, Beschrijving, Prijs, Voorraad, categorie) VALUES ('$productnaam', '$omschrijving', '$prijs', '$aantal', '$categorie')";
          mysqli_query($db, $sql); 
          if ( mysqli_errno($db) ) {
            echo "<h2>Er is iets fout gegaan...</h2>" . mysqli_error($db);
          } else {
            echo "<h2>Product succesvol toegevoegd!</h2>";
          }

        } else {
      ?>
        <!-- FORM -->
        <div class="container">
          <br>
          <h1 class="display-3">Verkoop kaart</h1>
          
          <!-- FORM ELEMENT -->
          <div class="row">
            <div class="col-md-6">
              <form action='' method='POST'>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Productnaam:</label>
                  </div>
                  <div class="form-group col-md-6">
                    <input type='text' maxlength='45' name='productnaam' required><br>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Prijs:</label>
                  </div>
                  <div class="form-group col-md-6">
                    <input type='text' pattern='\d+,\d{2}' title='Voer een bedrag in volgens het patroon: ..0001,23' name='prijs' required><br>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Categorie:</label>
                  </div>
                  <div class="form-group col-md-6">
                    <input type='text' maxlength='25' name='categorie' required><br>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Aantal:</label>
                  </div>
                  <div class="form-group col-md-6">
                    <input type='number' min="1" name='aantal' required><br>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Omschrijving:</label>
                  </div>
                  <div class="form-group col-md-6">
                    <textarea rows='2' cols='25' maxlength='200' title='Beschrijving kan maximaal 45 tekens lang zijn.' style='resize: none;' name='omschrijving' required></textarea><br>
                  </div>
                </div>
                <div class="form-row">
                  <input type='submit' name='submit' value='Aanbieden'>
                </div>
              </form>
            </div>
          </div>
          <!-- END FORM ELEMENT -->
        </div>
      </div> 


    <?php } } else {
      // Gebruiker niet ingelogd, redirect naar index
      header("location: index.php");
     } ?>

    <?php include('footer.php')?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
