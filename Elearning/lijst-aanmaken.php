<?php
include "header.php";

if(isset($_POST['submit'])) {

    onSubmit();

}

function onSubmit() {

    $servername = "localhost";

    $username = "root";

    $password = "";

    $beschrijving = htmlspecialchars($_POST['beschrijving']);

    $conn = new mysqli($servername, $username, $password, 'mydb');    

    $sql = "INSERT INTO `lijst`(`users_id`, `name`, `description`, `mode_id`) VALUES (?,?,?,?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param('issi', $_SESSION['gebruikersID'], $_POST['titel'], $_POST['beschrijving'], $_POST['mode']);

    $stmt->execute();

    echo '<div id="result-goed" class="alert alert-success">

                <p>Lijst toegevoegd!</p>

              </div>';

    $sql = "SELECT * FROM `lijst` WHERE lijst.description='$beschrijving'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

            $id_lijst = $row['id'];

        }



    $num_questions = 0;

    foreach ($_POST as $key => $value) {

      if (strpos($key, 'Vraag') === 0) {

        $num_questions++;

      }

      }    

        

    

    for ($i = 1; $i <= $num_questions; $i++) {

    $vraag_id = htmlspecialchars($_POST['Vraag' . $i]);

    $antwoord_id = $_POST['Antwoord' . $i];

    $sql = "INSERT INTO `lijst_vragen`(`lists_id`, `question`, `good_answer`) VALUES (?,?,?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param('iss', $id_lijst, $vraag_id, $antwoord_id);

    if (!$stmt->execute()) {

      echo "Error inserting row: " . mysqli_error($conn);

    }
    header("Location: lijst.php");
}

}

}



?>


<script>

function addQuestion() {

  var questionsContainer = document.getElementById('questions-container');



  // Create a new question element

  var newQuestion = document.createElement('div');

  newQuestion.className = 'question form-group';



  // Create a new label element for the question

  var questionLabel = document.createElement('label');

  questionLabel.innerHTML = 'Vraag';

  questionLabel.setAttribute('for', 'Vraag' + (questionsContainer.children.length / 2 + 1));



  // Create a new input element for the question

  var questionInput = document.createElement('input');

  questionInput.className = 'form-control question-input';

  questionInput.setAttribute('type', 'text');

  questionInput.setAttribute('id', 'Vraag' + (questionsContainer.children.length / 2 + 1));

  questionInput.setAttribute('name', 'Vraag' + (questionsContainer.children.length / 2 + 1));

  questionInput.setAttribute('aria-describedby', 'Vraag' + (questionsContainer.children.length / 2 + 1));

  questionInput.setAttribute('placeholder', 'Vul je vraag in');



  // Append the label and input elements to the question element

  newQuestion.appendChild(questionLabel);

  newQuestion.appendChild(questionInput);



  // Create a new answer element

  var newAnswer = document.createElement('div');

  newAnswer.className = 'answer form-group';



  // Create a new label element for the answer

  var answerLabel = document.createElement('label');

  answerLabel.innerHTML = 'Antwoord';

  answerLabel.setAttribute('for', 'Antwoord' + (questionsContainer.children.length / 2 + 1));



  // Create a new input element for the answer

  var answerInput = document.createElement('input');

  answerInput.className = 'form-control answer-input';

  answerInput.setAttribute('type', 'text');

  answerInput.setAttribute('id', 'Antwoord' + (questionsContainer.children.length / 2 + 1));

  answerInput.setAttribute('name', 'Antwoord' + (questionsContainer.children.length / 2 + 1));

  answerInput.setAttribute('placeholder', 'Vul je antwoord in');



  // Append the label and input elements to the answer element

  newAnswer.appendChild(answerLabel);

  newAnswer.appendChild(answerInput);



  // Append the question and answer elements to the questions container

  questionsContainer.appendChild(newQuestion);

  questionsContainer.appendChild(newAnswer);

}



</script>

<div class="vraag_toevoegen">

<form method="POST">

  <div class="form-group">

    <label for="exampleInputEmail1">Titel Lijst</label>

    <input type="text" class="form-control" id="titel" name="titel" aria-describedby="Titel lijst" placeholder="Vul hier je titel in">

  </div>

  <div class="form-group">

    <label for="exampleInputEmail1">Beschrijving lijst</label>

    <input type="text" class="form-control" id="beschrijving" name="beschrijving" aria-describedby="Vraag1" placeholder="Vul je beschrijving">

  </div>

  <div class="form-group">

    <label for="mode">Wil je hem prive of openbaar</label>

    <select class="form-select" name="mode" id="mode" aria-label="Default select example">

      <option selected>Maak een keuze</option>

      <option value="1">Prive</option>

      <option value="2">Openbaar</option>

    </select>

  </div>

  <div id="questions-container">

    <div class="form-group question">

      <label for="Vraag1">Vraag 1</label>

      <input type="text" class="form-control" id="Vraag1" name="Vraag1" placeholder="Vul je vraag in">

    </div>

    <div class="form-group answer">

      <label for="Antwoord1">Antwoord 1</label>

      <input type="text" class="form-control" id="Antwoord1" name="Antwoord1" placeholder="Vul je antwoord in">

    </div>

  </div>

  <button type="button" class="submit" onclick="addQuestion()">Add Question</button>

  <button type="submit" class="submit" name="submit" class="btn btn-primary">Submit</button>

</form>
</div>
