<?php
include "databaseconnection.php";
$con = new mysqli($servername, $username, $password, 'klas4s22_575014');
var_dump($_POST);
// Check if the 'id' parameter is set in the $_GET array
if(isset($_POST['id'])) {
    // Fetching the 'id' parameter from the GET request
    $id = $_POST['id'];

    // Sanitize the id parameter
    $id = $con->real_escape_string($id);

    $sql = "DELETE FROM lijst WHERE id = $id";

    if ($con->query($sql) === TRUE) {
        header("Location: lijst.php");

    } else {
        echo "Error deleting list: " . $con->error;
    }
} else {
    // Handle the case where the 'id' parameter is not set
    echo "Error: 'id' parameter is not set.";
}
?>
