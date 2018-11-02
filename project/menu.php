<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">Cardshop</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link disabled" href="#">Spelkaarten</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" 
            href="#" id="navbarDropdown" 
            role="button" 
            data-toggle="dropdown" 
            aria-haspopup="true" 
            aria-expanded="false">Ruil kaarten</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Pokemon</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item disabled" href="#">Yu-Gi-Oh!</a>
              <a class="dropdown-item disabled" href="#">Magic: The Gathering</a>
            </div><!--dropdown-menu-->
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <ul class="navbar-nav">
          <?php if(isset($_SESSION['username'])){ ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" 
              href="#" 
              id="logoutDropdown" 
              role="button" 
              data-toggle="dropdown" 
              aria-haspopup="true" 
              aria-expanded="false"><?php echo ucfirst($_SESSION['username']);?></a>
              <div class="dropdown-menu dropdown-menu-right logoutMenu" aria-labelledby="loginDropwdown">
                <a class="dropdown-item" href="profile.php">Profiel</a>
                <?php if ( $_SESSION['role'] == 1 ) { ?>
                  <a class="dropdown-item" href="overzicht.php">Orderoverzicht</a>
                <?php } ?>
                <a class="dropdown-item" href="#">Winkelwagen</a>
                <a class="dropdown-item" href="index.php?logout='1'">Logout</a>
              </div>
            </li>
          <?php }else{ ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" 
            href="#" 
            id="loginDropdown" 
            role="button" 
            data-toggle="dropdown" 
            aria-haspopup="true" 
            aria-expanded="false">Login</a>
            <div class="dropdown-menu dropdown-menu-right loginMenu <?php if(count($errors) > 0 && isset($_POST['login_user'])){ echo 'show'; } ?>" aria-labelledby="loginDropwdown">
              <form id="login-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <?php if (isset($_POST['login_user'])){ include('errors.php'); }?>
                  <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <a href="#">Wachtwoord vergeten?</a><br/><br/>
                    <button type="submit" class="btn btn-primary" id="loginDropdown" name="login_user">Login</button> of 
                    <a href="register.php">Registreer</a>
                  </div>
              </form>
            </div><!-- login-->

          </li>
          <?php } ?>
          </ul>
        </div><!--navbar-->
    </nav>
