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

    <div class="headerImage jumbotron" style="background-color: white; color: black;">
      <div class="container">

        <?php
          if (isset($_SESSION['success'])) {
            $db = mysqli_connect("localhost", "root", "", "thecardshop");
            $uname = mysqli_real_escape_string($db, $_SESSION['username']);
            
            if ( isset($_POST['submit']) ) {
              // Save fields in form
              extract($_POST);

              // check of ww klopt
              $encww = md5($huidigWachtwoord);
              $sql = "SELECT gebruikersnaam, wachtwoord FROM gebruikers WHERE gebruikersnaam='$uname'";
              $res = mysqli_query($db, $sql);
              $res = mysqli_fetch_assoc($res);

              if ( $encww == $res['wachtwoord'] ) {
                $kill = 0; //Check if error, if error, don't update
                $sql = "UPDATE gebruikers SET"; //Build query

                // Kijk of wachtwoord veranderd moet en kan worden
                if ( $nieuwWachtwoord || $nieuwWachtwoord2 ) {
                  if ( $nieuwWachtwoord == $nieuwWachtwoord2 ) {
                    $sql .= " wachtwoord='" . md5($nieuwWachtwoord) . "',";
                  } else {
                    echo "<h2>Nieuwe wachtwoorden komen niet overeen</h2>";
                    $kill = 1;
                  }
                }

                // Kijk of gebruikersnaam veranderd moet en kan worden
                if ( $gebruikersnaam != $uname ) {
                  $check = mysqli_query($db, "SELECT 1 FROM gebruikers WHERE gebruikersnaam='$gebruikersnaam'");
                  // Controleer of username al in gebruik is
                  if ( mysqli_fetch_assoc($check) ) {
                    $kill = 1;
                    echo "<h2>Gebruikersnaam is al in gebruik</h2>";
                  } else {
                    $sql .= " gebruikersnaam='$gebruikersnaam',";
                  }
                }

                // Kijk of email veranderd moet en kan worden
                if ( $nieuwEmail != $email ) {
                  $check = mysqli_query($db, "SELECT 1 FROM gebruikers WHERE gebruikersnaam='$nieuwEmail'");
                  // Controleer of email al in gebruik is
                  if ( mysqli_fetch_assoc($check) ) {
                    $kill = 1;
                    echo "<h2>Emailadres is al in gebruik</h2>";
                  } else {
                    $sql .= " email='$nieuwEmail',";
                  }
                }
                
                // Als er geen errors zijn, UPDATE
                if (!$kill) {
                  $voornaam = mysqli_real_escape_string($db, $voornaam);
                  $achternaam = mysqli_real_escape_string($db, $achternaam);
                  $adres = mysqli_real_escape_string($db, $adres);

                  $sql .= " voornaam='$voornaam', achternaam='$achternaam', adres='$adres'";

                  // Exectuur de query
                  mysqli_query($db, $sql);
                  
                  if ( mysqli_errno($db) ) {
                      echo "<h2>Er ging iets mis bij het invoeren van de gegevens</h2>";
                      echo mysqli_error($db);
                  } else {
                      echo "<h2>Gegevens zijn succesvol veranderd</h2>";
                      $_SESSION['username'] = $gebruikersnaam;
                  }
                }

              } else {
                echo "<h2>Wachtwoord komt niet overeen</h2>";
              }
            } else {
              // Lees gegevens uit database voor default value in FORM
              $sql = "SELECT gebruikersnaam, voornaam, achternaam, adres, email FROM gebruikers WHERE gebruikersnaam='" . $uname . "'";

              $res = mysqli_query($db, $sql);
              $res = mysqli_fetch_assoc($res);

              if ( mysqli_errno($db) ) {
                echo "<h2>Kon gegevens niet ophalen.</h2>" . mysqli_error($db);
              } else if ( !$res ) {
                  echo "<h2>Geen gegevens gevonden!</h2>";
                  include('footer.php');
                  die();
              } else {
                // Extract reasults into namespace
                extract($res);
                $nieuwEmail = $email; //Otherwise new email cannot be show immediately
              }
            } // end isset submit
          ?>
            <h2>Gegevens wijzigen:</h2>
            <!-- FORM -->
            <div class="row">
              <div class="col-md-6">
                <form action='' method='POST'>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      Gebruikersnaam
                    </div>
                    <div class="form-group col-md-6">
                      <input type='text'  name='gebruikersnaam' required value='<?php echo $gebruikersnaam ?>'><br>
                    </div>  
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      Voornaam
                    </div>  
                    <div class="form-group col-md-6">
                      <input type='text'  name='voornaam'       required value='<?php echo $voornaam ?>'><br>
                    </div>  
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      Achternaam
                    </div>  
                    <div class="form-group col-md-6">
                      <input type='text' name='achternaam' required value='<?php echo $achternaam ?>'><br>
                    </div>  
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      Email
                    </div>  
                    <div class="form-group col-md-6">
                      <input type='email' name='nieuwEmail' required value='<?php echo $nieuwEmail ?>'><br>
                      <input type='hidden'name='email' value='<?php echo $email ?>'>
                    </div>  
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      Adres
                    </div>  
                    <div class="form-group col-md-6">
                      <input type='text' name='adres' required value='<?php echo $adres ?>'><br>
                    </div>  
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      Huidige wachtwoord
                    </div>  
                    <div class="form-group col-md-6">
                      <input type='password' name='huidigWachtwoord' required><br>
                    </div>  
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      Nieuw wachtwoord*
                    </div>  
                    <div class="form-group col-md-6">
                      <input type='password' name='nieuwWachtwoord'>
                    </div>  
                    <div class="form-group col-md-6">
                      Herhaal nieuw wachtwoord*
                    </div>  
                    <div class="form-group col-md-6">
                      <input type='password' name='nieuwWachtwoord2'>
                    </div>  
                  </div>
                  <div class="form-row">
                      <input type='submit' name='submit' value='Wijzig gegevens'>
                  </div>
                </form>
                <p>* Vul alleen in als je je wachtwoord wilt wijzigen</p>
              </div>
            </div> <!-- END FORM ELEMENT -->


          <?php
          } else {
            header("location: index.php");
          }
        ?>
      </div>
    </div>

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
