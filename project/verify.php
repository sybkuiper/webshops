<?php include('server.php')?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Cardshop - Verify</title>

    <!-- Bootstrap core CSS -->
    <link href="style/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
<body>
<?php include('menu.php');?><br/><br/>
<div class="container">
    <h1>Validatie</h1><br/>
    <div class="row">
        <div class="col-md-6">
            <?php
            if (empty($_GET['email']) && empty($_GET['hash'])) {
                echo "<h3>U kunt uw account gebruiken zodra u de email Validatie heeft voltooid.</h3><br/>";
                echo "<p>Klick op de link die in de mail staat die u ontvangen heeft.</p><br/>";           
            } else {      
                if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
                    $email = mysql_escape_string($_GET['email']); // Set email variable
                    $hash = mysql_escape_string($_GET['hash']); // Set hash variable
                    echo "$email<br/>$hash";
                                 
                    $search = mysqli_query($db,"SELECT email, hash, active FROM users WHERE email='".$email."' AND hash='".$hash."' AND active='0'"); //or die(mysqli_error()); 
                    $match  = mysqli_num_rows($search);
                                 
                    if($match > 0){
                        // We have a match, activate the account
                        mysqli_query($db,"UPDATE users SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'"); //or die(mysqli_error());
                        $_SESSION['username'] = $username;
                        $_SESSION['success'] = "Je bent nu ingelogd";
                        echo '<div>Your account has been activated, you can now login</div>';
                        header('location: index.php');
                    }else{
                        // No match -> invalid url or account has already been activated.
                        echo '<div>The url is either invalid or you already have activated your account.</div>';
                    }
                                 
                }else{
                    // Invalid approach
                    echo '<div>Invalid approach, please use the link that has been send to your email.</div>';
                }
            }
            ?>
        </div>
    </div>
</div>
    <?php include('footer.php');?>
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