var score = -1;

var questions_answered = 0;



function checkAnswer(a) {

    var answer = document.getElementById("answer-" + a).value;

    var question = document.getElementById("vraag-" + a).value;

    var xhr = new XMLHttpRequest();

    var test = "result-" + a + "-goed";

    var test1 = "result-" + a + "-fout";

    xhr.onreadystatechange = function() {

      if (this.readyState == 4 && this.status == 200) {

        var result = document.getElementById(test);

        var result1 = document.getElementById(test1)

        var response = JSON.parse(this.responseText);

        console.log(this.responseText);

        if (response.has_rows) {

          result.innerHTML = "Correct! Dat is het goede antwoord";

          document.getElementById(test).removeAttribute("hidden");

          score++;

          questions_answered++;

        }  

        else {

          result1.innerHTML = "Helaas, dat is het foute antwoord, het juist antwoord is: " + response.answer;

          document.getElementById(test1).removeAttribute("hidden");

          questions_answered++;

        }

      }

    };

    xhr.open("POST", "checkAnswer.php", true);

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.send("answer=" + answer + "&question=" + question);

    document.getElementById("button-" + a).disabled = true;

    var num_questions = document.querySelectorAll('.card').length;

    var num_answered = document.querySelectorAll('.btn-primary[disabled]').length;

    if (num_answered == num_questions) {

      score++;

      document.getElementById("check-score").removeAttribute("hidden");

      document.getElementById("vragen").style.display = "none";

      document.getElementById("score-value").innerHTML = score;

    }

  }
// 


function checkAnswerEng(a) {

  var answer = document.getElementById("answer-" + a).value;

  var question = document.getElementById("vraag-" + a).value;

  var xhr = new XMLHttpRequest();

  var test = "result-" + a + "-goed";

  var test1 = "result-" + a + "-fout";

  xhr.onreadystatechange = function() {

    if (this.readyState == 4 && this.status == 200) {

      var result = document.getElementById(test);

      var result1 = document.getElementById(test1)

      var response = JSON.parse(this.responseText);

      console.log(this.responseText);

      if (response.has_rows) {

        result.innerHTML = "Correct! Dat is het goede antwoord";

        document.getElementById(test).removeAttribute("hidden");

        score++;

        questions_answered++;

      }  

      else {

        result1.innerHTML = "Helaas, dat is het foute antwoord, het juist antwoord is: " + response.answer;

        document.getElementById(test1).removeAttribute("hidden");

        questions_answered++;

      }

    }

  };

  xhr.open("POST", "checkAnswer1.php", true);

  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.send("answer=" + answer + "&question=" + question);

  document.getElementById("button-" + a).disabled = true;

  var num_questions = document.querySelectorAll('.card').length;

  var num_answered = document.querySelectorAll('.btn-primary[disabled]').length;

  if (num_answered == num_questions) {

    score++;

    document.getElementById("check-score").removeAttribute("hidden");

    document.getElementById("vragen").style.display = "none";

    document.getElementById("score-value").innerHTML = score;

  }

}