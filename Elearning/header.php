<?php
session_start();
?>

<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Learning</title>
    <script src='check-answer.js'></script>
    <link rel='stylesheet' href='style.css'>
    </head>

  <header class="header">
      <ul class="header__ul">
        <li><a href="index.php" class="header__li">Home</a></li>
        <?php
        if (isset($_SESSION['gebruikersnaam'])) {
            echo '<li><a href="lijst.php">Lijsten</a></li>';
            echo '<li><a href="lijst-aanmaken.php">Lijst aanmaken</a></li>';
        }
        ?>
        <div class="header__message">
        <?php
        if (isset($_SESSION['gebruikersnaam']))
            {
                echo'<span class="username">' . 'Ingelogd als:' . " " .  $_SESSION['gebruikersnaam'] . '</span>';
                echo '<li><a class="logout" href="uitlog.php">Log uit</a></li>';

            }
            else
            {
                echo '<a href="login.php" class="header__login">Login</a>
                <a href="register.php" class="header__signup">Sign-up</a>';
            }
        ?>
      </div>
      </ul>
      
    </header>