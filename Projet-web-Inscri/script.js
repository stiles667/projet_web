

fetch('question.php') // On récupère les questions
  .then(response => response.json()) // On les transforme en JSON
  .then(questions => { // On les affiche
    const quizContainer = document.getElementById("quiz-container"); // On récupère le conteneur du quiz
    for (const question of questions) { // Pour chaque question
      const questionContainer = document.createElement("div"); // On crée un conteneur pour la question
      const questionText = document.createElement("p"); // On crée un élément pour le texte de la question
      questionText.innerHTML = question.question; // On y met le texte de la question
      questionContainer.appendChild(questionText); // On ajoute le texte à la question
        
      const choicesContainer = document.createElement("ul"); // On crée un conteneur pour les choix
      for (const choice of question.choices) { // Pour chaque choix
        const choiceItem = document.createElement("li"); // On crée un élément pour le choix
        const choiceInput = document.createElement("input"); // On crée un élément pour le bouton radio
        choiceInput.type = "radio"; // On définit le type du bouton radio
        choiceInput.name = question.question; // On définit le nom du bouton radio
        choiceInput.value = choice; // On définit la valeur du bouton radio
        choiceItem.appendChild(choiceInput); // On ajoute le bouton radio au choix
        const choiceLabel = document.createElement("label"); // On crée un élément pour le texte du choix
        choiceLabel.innerHTML = choice; // On y met le texte du choix
        choiceItem.appendChild(choiceLabel); // On ajoute le texte au choix
        choicesContainer.appendChild(choiceItem); // On ajoute le choix à la liste des choix
      } // Fin de la boucle des choix
      questionContainer.appendChild(choicesContainer); // On ajoute la liste des choix à la question
      quizContainer.appendChild(questionContainer); // On ajoute la question au quiz
    }
  });
