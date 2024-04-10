<?php

include "header.php";
include "databaseconnection.php";

$con = new mysqli($servername, $username, $password, 'mydb');

$ID = $_GET['id'];

$sql = "SELECT * FROM lijst_vragen WHERE lists_id=$ID";

$result = mysqli_query($con, $sql);

   echo '<div id="vragen">';

if (mysqli_num_rows($result) > 0) {

  while ($row = mysqli_fetch_assoc($result)) {

    ?>
    <div class="card">
      <div class="card-body ">
        <h3>Question:</h3>
        <p name="vraag"><?php echo $row['question']; ?></p>
        <input type="hidden" id="vraag-<?php echo $row['id'] ?>" value="vraag-<?php echo $row['id'] ?>" />
        <form onsubmit="return false;">
          <div>
            <label for="answer-<?php echo $row['id'] ?>" class="form-label">Your answer:</label>
            <input type="text" id="answer-<?php echo $row['id'] ?>" name="answer-<?php echo $row['id'] ?>" class="form-control w-50 mx-auto">
          </div>
          <button type="button" id="button-<?php echo $row['id'] ?>" class="submit btn-primary" onclick="checkAnswer(<?php echo $row['id'] ?>)">Bevestig antwoord</button>
          <div id="result-<?php echo $row['id'] ?>-goed" hidden>
          </div>
          <div id="result-<?php echo $row['id'] ?>-fout" hidden>
          </div>
        </form>
      </div>
      </div>
    <?php     

  }

}

?>

</div>
        <div id="check-score" class="row" hidden>
            

                <div class="score-card">

                    <h2 class="mb-4">Your Score</h2>

                    <div>
                    <?php
                    $score = 0;
                    $totalQuestions = mysqli_num_rows($result);

                    while ($row = mysqli_fetch_assoc($result)) {
                      $questionId = $row['id'];
                      $userAnswer = $_POST['answer-' . $questionId];
                      $correctAnswer = $row['correct_answer'];
                      
                      if ($userAnswer == $correctAnswer) {
                        $score++;
                      }
                    }
                    
                    echo "<p>Your score: " . "<span id='score-value'></span>". "/" . $totalQuestions . "</p>";
                    ?>
                    </div>
                    <p class="mt-4">Gefeliciteerd met je score, goed bezig!</p>
                </div>
            </div>
    </div>
<button type="button" name="check-score" id="check-score" hidden>Check mijn score!</button>