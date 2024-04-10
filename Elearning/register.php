<?php
include "header.php";
include "databaseconnection.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])){

    $name = htmlspecialchars($_POST['name']);
    $wachtwoord = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);
    $sql2 = "SELECT name FROM gebruikers WHERE name = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("s", $name);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    if ($row = $result2->fetch_array() == true) {
        echo '<div id="result-goed" class="alert alert-danger">
                <p>Naam bestaal al</p>
              </div>';
    } else {
        $sql = "INSERT INTO `gebruikers` (`name`, `password`) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $name, $wachtwoord);
        $result = $stmt->execute();
        $realResult = true;
        header("Location: login.php");
        die();
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registeren</title>
    <link rel="stylesheet" href="waves.css">
</head>
<body>
</div>
<form class="register" method="post" action="">
        <label>Registreren</label>
        <input type="text" name="name" required placeholder="Gebruikersnaam">
        <input type="password" name="wachtwoord" required placeholder="Wachtwoord">
        <input type="submit" name="submit" value="Registreer">
</form>
</body>
</html>