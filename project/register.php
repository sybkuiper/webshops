<?php include('server.php')?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Cardshop - Register</title>

    <!-- Bootstrap core CSS -->
    <link href="style/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
<body>
<?php include('menu.php');?><br/><br/>
<div class="container">
	<h1>Registreren</h1><br/>
	<div class="row">
		<div class="col-md-6">
			<form method="post" action="register.php" class="register">
			  	<?php if (isset($_POST['reg_user'])) { include('errors.php');} ?>
			  	<div class="form-group">
			  	  	<label for="regUsername">Gebruikersnaam :</label><br/>
			  	 	<input id="regUsername" type="text" name="username" value="<?php echo $username; ?>">
			  	</div>
				<div class="form-row">
				  	<div class="form-group col-md-6">
				  	  	<label for="regFirstname">Voornaam :</label><br/>
				  	 	<input id="regFirstname" type="text" name="firstname" value="<?php echo $firstname; ?>">
				  	</div>
				  	<div class="form-group col-md-6">
				  	  	<label for="regLastname">Achternaam :</label><br/>
				  	 	<input id="regLastname" type="text" name="lastname" value="<?php echo $lastname; ?>">
				  	</div>
				</div>
			  	<div class="form-group">
			  		<label for="regEmail">Email</label><br/>
			  	 	<input id="regEmail" type="email" name="email" value="<?php echo $email; ?>">
			  	</div>
			  	<div class="form-row">
				  	<div class="form-group col-md-6">
				  	 	<label for="regPassword1">Wachtwoord</label><br/>
				  	 	<input id="regPassword1" type="password" name="password_1">
				  	</div>
				  	<div class="form-group col-md-6">
				  	 	<label for="regPassword2">Herhaal wachtwoord</label><br/>
				  	 	<input id="regPassword2" type="password" name="password_2">
				  	</div>
				</div>
			  	<button type="submit" class="btn btn-primary" name="reg_user">Registreer</button>
			</form>
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