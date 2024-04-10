<?php

include "databaseconnection.php";




$answer = $_POST["answer"];

$question = $_POST["question"];

$modified_question = str_replace("vraag-", "", $question);



$con = new mysqli($servername, $username, $password, 'mydb');

$sql = "SELECT * FROM `lijst_vragen` WHERE lijst_vragen.id='$modified_question' AND lijst_vragen.question='$answer'";



$result = $con->query($sql);



$response = array();

if ($result->num_rows > 0) {

  $response['has_rows'] = true;

} else {

  $response['has_rows'] = false;

}



echo json_encode($response);



  







?>