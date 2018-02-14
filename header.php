<?php

session_start();

?>

<!DOCTYPE html>
<html>
  <title></title>
  <head>
    <link rel="stylesheet" type="text/css" href="css/main.css">
  </head>
  <body>
    <header>
      <nav>
        <div class="main-wrapper">
          <ul>
            <li><a href="index.php">Home</a></li>
          </ul>
          <div class="nav-login">

            <?php
              if (isset($_SESSION['u_id'])) {
                echo '<form action="includes/logout.inc.php" method="POST">
                        <button type="submit" name="submit">Logout</button>
                      </form>';
              } else {
                echo '<form action="includes/login.inc.php" method="post">
                        <input type="text" name="uid" placeholder="Username/email">
                        <input type="password" name="password" placeholder="password">
                        <button type="submit" name="submit">Login</button>
                      </form>
                      <a href="signup.php">Sign Up</a>'
              }
            ?>
          </div>
        </div>
      </nav>
    </header>