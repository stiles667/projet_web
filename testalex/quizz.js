function Recup(conn) {
    // Récupération des titres de quizz dans la base de données
    let quizzlist = "SELECT * FROM quizz";
    // Exécution de la requête
    let resultquizz = conn.query(quizzlist);
    // Boucle pour afficher chaque titre de quizz avec un bouton
    resultquizz.forEach(row => {
      let quizz_title = row["Titre"];
      let id_quizz = row["Id_quizz"];
      let quizzDiv = document.createElement("div");
      let quizzTitle = document.createElement("h3");
      let showButton = document.createElement("button");
      let quizzContent = document.createElement("div");
      quizzTitle.innerHTML = quizz_title;
      showButton.innerHTML = "Afficher";
      showButton.addEventListener("click", () => {
        affichage_quizz(id_quizz);
      });
      quizzContent.id = "quizz" + id_quizz;
      quizzContent.style.display = "none";
      quizzDiv.appendChild(quizzTitle);
      quizzDiv.appendChild(showButton);
      quizzDiv.appendChild(document.createElement("br"));
      quizzDiv.appendChild(document.createElement("br"));
      quizzDiv.appendChild(quizzContent);
      // Récupération des questions à partir des id_quizz
      let sql_questions = "SELECT * FROM `question` WHERE Id_quizz = " + id_quizz;
      // Exécution de la requête
      let result_questions = conn.query(sql_questions);
      // Boucle pour afficher chaque question
      if (result_questions.length > 0) {
        let num_question = 1;
        result_questions.forEach(row_question => {
          // Récupération de l'id de la question
          let id_question = row_question["Id_question"];
          // Récupération de la question
          let question = row_question["question"];
          // Affichage de la question
          let questionDiv = document.createElement("div");
          questionDiv.innerHTML = "Question " + num_question + ": " + question + "<br>";
          quizzContent.appendChild(questionDiv);
          num_question++;
          // Si le numéro de la question est supérieur à 10, on remet à 1
          if (num_question > 10) {
            num_question = 1;
          }
          // Récupération des réponses à partir des id_question
          let sql_reponses = "SELECT * FROM choix WHERE Id_question = " + id_question;
          // Exécution de la requête
          let result_reponses = conn.query(sql_reponses);
          if (result_reponses.length > 0) {
            result_reponses.forEach(row_reponse => {
              let reponses = {
                "reponse1": row_reponse["rep1"],
                "reponse2": row_reponse["rep2"],
                "reponse3": row_reponse["rep3"],
                "Bonne_reponse": row_reponse["Bonne_reponse"]
              };
              // Affichage des réponses avec un bouton radio pour chaque réponse
              for (let index in reponses) {
                let input = document.createElement("input");
                input.type = "radio";
                input.name = "question" + id_question;
                input.value = index;
                let label = document.createElement("label");
                label.innerHTML = reponses[index] + "<br>";
                quizzContent.appendChild(input);
                quizzContent.appendChild(label);
              }
            });
          } else { // Si aucune réponse n'est trouvée, on affiche un message d'erreur
            let error = document.createElement("p");
            error.innerHTML = "Aucune réponse trouvée";
            quizzContent.appendChild(error);
            }
        });
    }
    });
    }
