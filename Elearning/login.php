<?php
include "header.php";
include "databaseconnection.php";

if (isset($_POST['login'])) {
    $name = htmlspecialchars($_POST['username']);
    $wachtwoord = htmlspecialchars($_POST['password']);

    $sql = "SELECT * FROM gebruikers WHERE name = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param('s', $name);

    $stmt->execute();

    $result = $stmt->get_result();

    try {

        while ($row = $result->fetch_array()) {

            $passwordreturn = password_verify($wachtwoord, $row['password']);

            if ($passwordreturn) {

                $_SESSION['gebruikersnaam'] = $name;

                $_SESSION['gebruikersID'] = $row['id'];

                header("Location: index.php");
                die();
            }

            else {

                echo '<div id="result-goed" class="alert alert-danger">

                <p>Verkeerde inlog gegevens</p>

              </div>';

            }

        }

    } catch (Exception $e) {

        $e->getMessage();

    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="waves.css">
    <title>Login Pagina</title>
</head>
<body>
    <form class="login" method="post" action="login.php">
        <label>Login</label>
        <input type="text" required name="username" placeholder="Gebruikersnaam">
        <input type="password" required name="password" placeholder="Wachtwoord">
        <input type="submit" name="login" value="Login">
    </form>
</div>
</body>
</html>