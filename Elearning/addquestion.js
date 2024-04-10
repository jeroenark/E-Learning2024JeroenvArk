
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
  