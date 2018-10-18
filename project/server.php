<?php
session_start();

$username = "";
$email    = "";
$errors = array(); 

$db = mysqli_connect('localhost', 'root', 'root', 'registration');

// Registreer user
if (isset($_POST['reg_user'])) {

  $username = mysqli_real_escape_string($db, $_POST['username']);
  $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
  $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // ---------------------------------- Input controle bij fout array_push melding -----------------------//
  if (empty($username)) { array_push($errors, "Gebruikernaam is verplicht!"); }
  if (empty($firstname)) { array_push($errors, "Voornaam is verplicht!"); }
  if (empty($lastname)) { array_push($errors, "Achternaam is verplicht!"); }
  if (empty($email)) { array_push($errors, "Email is verplicht!"); } 
  else { 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      array_push($errors, "Email adres is niet valide");
    }
  }
  if (empty($password_1)) { array_push($errors, "Wachtwoord is verplicht!"); }
  if ($password_1 != $password_2) {
	array_push($errors, "De wachtwoorden komen niet overeen!");
  }

  // ---------------------------------- Controlleer of gegevens niet al in database zitten -----------------------//
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
    if ($user['username'] === $username) {
      array_push($errors, "Gebruikernaam bestaat al!");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email wordt al gebruikt!");
    }
  }

  // ---------------------------------- Bij geen error registeren user -----------------------//
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt het wachtwoord
    $hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.

  	$query = "INSERT INTO users (username, voornaam, achternaam, email, password, hash) 
  			     VALUES('$username','$firstname','$lastname', '$email', '$password','$hash')";

  	mysqli_query($db, $query);
    sendEmail($username,$email,$hash,$password_1);
  	//$_SESSION['username'] = $username;
  	//$_SESSION['success'] = "Je bent nu ingelogd";
  	header('location: verify.php');
  }
}

// Login user
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) { array_push($errors, "Gebruikernaam is verplicht"); }
  if (empty($password)) { array_push($errors, "Wachtwoord is verplicht"); }

  $password = md5($password);
  $queryNotActive = "SELECT * FROM users WHERE username='$username' AND password='$password' AND active='0'";
  $resultsNotActive = mysqli_query($db, $queryNotActive);
  if (mysqli_num_rows($resultsNotActive) == 1){ array_push($errors, "Activeer uw account eerst"); }

  if (count($errors) == 0) {
    $queryActive = "SELECT * FROM users WHERE username='$username' AND password='$password' AND active='1'";
    
    $resultsActive = mysqli_query($db, $queryActive);
    if (mysqli_num_rows($resultsActive) == 1) {
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "Je bent ingelogd";
      header('location: index.php');
    } else {
      array_push($errors, "Login mislukt, controlleer alstublief of u de correcte gegevens heeft ingevoerd en of u uw account al heeft geactiveerd");
    }
  }
}

function sendEmail($name,$mail,$hash1,$passw) {
  $to      = $mail; // Send email to our user
  $subject = 'Signup | Verificatie'; // Give the email a subject 
  $message = '
   
  Bedankt voor het aanmelden!
  Je acount is aangemaakt, u kunt het gebruiken na de email verificatie door op de link in deze mail te klikken hier beneden.
   
  ------------------------
  Username: '.$name.'
  Password: '.$passw.'
  ------------------------
   
  Klik op deze link om uw account te activeren :
  http://localhost:8888/hanze/testomgeving/project/verify.php?email='.$mail.'&hash='.$hash1.'
   
  ';
                       
  $headers = 'From:noreply@ytest.com' . "\r\n";
  mail($to, $subject, $message, $headers);
}

?>