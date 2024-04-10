<?php

include "databaseconnection.php";




$answer = $_POST["answer"];

$question = $_POST["question"];

$modified_question = str_replace("vraag-", "", $question);



$con = new mysqli($servername, $username, $password, 'klas4s22_575014');

$sql = "SELECT * FROM `lijst_vragen` WHERE lijst_vragen.id='$modified_question'";


$result = $con->query($sql);

$response = array();

if ($result->num_rows > 0) {
  $data = array();

  // Loop through each row in the result set
  while($row = $result->fetch_assoc()) {
      // Add each row to the data array
      $data = $row;
  }
  $response['is_correct'] = $answer === $data['good_answer'];
  $response['answer'] = $data['good_answer'];

} else {

  $response['is_correct'] = false;

}

$response['id'] = $modified_question;

echo json_encode($response);



  







?>