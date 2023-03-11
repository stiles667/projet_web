<?php

    require ('bdconnexion.php');

    if(isset($_GET['id_quizz'])) {
        $id_quizz = $_GET['id_quizz'];
        $sql = "SELECT * FROM question WHERE Id_quizz = " . $id_quizz;
        $result = mysqli_query($conn, $sql);
        
    }

    if(isset($_GET['user'])) {
        $id_user = $_GET['user'];
    }

    if(isset($_GET['role'])) {
        $role = $_GET['role'];
    }


    $questions = array();
                        
    if (mysqli_num_rows($result) > 0) {
        while($row1 = mysqli_fetch_assoc($result)) {
            $id_question = $row1['Id_question'];
            $question = $row1['question'];
                                
            $sql2 = "SELECT * FROM choix WHERE Id_question = " . $id_question;
            $result2 = mysqli_query($conn, $sql2);
            $reponsesjs = array();
            if (mysqli_num_rows($result2) > 0) {
                while($row2=mysqli_fetch_assoc($result2)) {
                    // $idquest = $row2['Id_question'];

                    $reponses = array(
                        // 'idquestion ' => $row2['Id_question'],
                        'reponse1' => $row2['rep1'],
                        'reponse2' => $row2['rep2'],
                        'reponse3' => $row2['rep3'],
                        'Bonne_rep'=> $row2['Bonne_reponse']
                    );

                    $rep1 = $row2['rep1'];
                    $rep2 = $row2['rep2'];
                    $rep3 = $row2['rep3'];
                    $bonnerep = $row2['Bonne_reponse'];

                    $reponsesjs[] = $reponses;
                }
            }
                                
            $questions[] = array(
                // 'id' => $id_question,
                'question' => $question
                // 'reponses' => $reponsesjs
            );

            $rep[] = array(
                // 'idquestion' => $id_question,
                'reponse1' => $rep1,
                'reponse2' => $rep2,
                'reponse3' => $rep3,
                'Bonne_rep' => $bonnerep
            );
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://img.icons8.com/sf-black/64/000000/search.png">
    <link rel="stylesheet" href="quiz.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
        integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <title>Quizzeo</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
    <audio id="audio" preload="auto" loop>
        <source src="quiz-show-timer-30-sec-music-for-content-creator.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <header>
        <?php
            echo "<a class='home' href='home.php?role=$role&user=$id_user'>";
            echo "<span>Quiz</span><span>zeo.</span>";
            echo "</a>";
        ?>
        <div class="options">
            <?php
                $sqlutilisateur = "SELECT * FROM utilisateur WHERE Id_utilisateur = '$id_user'";
                $resultutilisateur = mysqli_query($conn, $sqlutilisateur);

                $row = mysqli_fetch_assoc($resultutilisateur);
                $role_user = $row['role_utilisateur'];
                $pseudo = $row['pseudo'];
                $email = $row['email'];
                $id_utilisateur = $row['Id_utilisateur'];

                echo "<h2>$pseudo</h2>";
                echo "<a id='profil' href='dashboard.php?role=$role&user=$id_user'>";
                echo "<img src='https://cdn-icons-png.flaticon.com/512/149/149071.png' alt='Photo de profil'>";
                echo "</a>";
            ?>
        </div>
    </header>
    <div class="container">
        <div class="container-question">
            <h2 id="number-question"></h2>
            <div class="container-countdown" id="container-countdown">
                <h2 id="countdown">60</h2>
            </div>
        </div>
        <div class="container-answer">
            <div class="question" id="question"></div>
            <div class="answers" id="answers"></div>
            <button type="submit" id="valider">Valider</button>
            <button type="submit" id="home">Accueil</button>
            <button type="submit" id="retry">Recommencer</button>
        </div>
    </div>
</body>

</html>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const audio = document.querySelector('#audio');
        audio.play();
    });

    $(".answer").click(function () {
        console.log("clicked");
    });

    const _quest = document.getElementById('question');
    const _answers = document.querySelector('.answers');
    const _submit = document.getElementById('valider');
    const _nbquestion = document.getElementById('number-question');
    const _countdown = document.getElementById('container-countdown');
    const _home = document.getElementById('home');
    const _retry = document.getElementById('retry');

    var questions = <?php echo json_encode($questions) ?>;
    var reponses = <?php echo json_encode($rep) ?>;
    var user = <?php echo json_encode($id_user) ?>;
    var idquizz = <?php echo json_encode($id_quizz) ?>;
    var role = <?php echo json_encode($role) ?>;
    var quizz = [];

    _home.style.display = "none";
    _retry.style.display = "none";

    for (let i = 0; i < questions.length; i++) {
        let quiz = {
            question: questions[i].question,
            options: [
                reponses[i].reponse1,
                reponses[i].reponse2,
                reponses[i].reponse3,
                reponses[i].Bonne_rep
            ],
            correct: reponses[i].Bonne_rep
        };
        quizz.push(quiz);
    }

    var numberquestion = 1;
    var numquestion = 0;
    var score = 0;
    var isanswered = false;

    
    for (let i = 0; i < quizz[numquestion].options.length; i++) {
        _answers.innerHTML = "<label class='answer'>" + "<input type='radio' name='option' value='option1'>" + quizz[numquestion].options[0] + "</label>" + "<label class='answer'>" + "<input type='radio' name='option' value='option3'>" + quizz[numquestion].options[1] + "</label>" + "<label class='answer'>" + "<input type='radio' name='option' value='option3'>" + quizz[numquestion].options[2] + "</label>" + "<label class='answer'>" + "<input type='radio' name='option' value='option3'>" + quizz[numquestion].options[3] + "</label>";
    }

    displayQuestion(numquestion);  

    let downloadTimer = null;

    function timer() {
        let timeleft = 60;

        downloadTimer = setInterval(function() {
            if(timeleft <= 0){
                clearInterval(downloadTimer);
                document.getElementById("countdown").innerHTML = "Temps écoulé !";
                _quest.innerHTML = "<h1>Vous avez terminé le quizz !</h1>";
                _answers.innerHTML = "<h2>Votre score est de " + score + " sur " + quizz.length + "</h2>";
                _submit.style.display = 'none';
                _nbquestion.style.display = 'none';
                _countdown.style.display = 'none';

                _home.style.display = "block";
                _retry.style.display = "block";

                var xhr = new XMLHttpRequest();
                var url = 'score.php';
                var data = 'score=' + score + '&user=' + user + '&idquizz=' + idquizz;

                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        console.log(xhr.responseText);
                    }
                };
                xhr.send(data);
            } else {
                document.getElementById("countdown").innerHTML = timeleft;
            }
            timeleft -=1;
        }, 1000);
    }

    timer();

    function reset() {
        clearInterval(downloadTimer);
        timer();
    }

    
    function displayQuestion(num) {
        _nbquestion.innerHTML = 'Question ' + numberquestion + '/' + quizz.length;
        _quest.innerHTML = '<h1>' + quizz[num].question + '</h1>';
        
        let optionsHtml = '';
        for (let i = 0; i < quizz[num].options.length; i++) {
            optionsHtml += '<label class="answer">';
            optionsHtml += '<input type="radio" name="option" value="' + quizz[num].options[i] + '">';
            optionsHtml += quizz[num].options[i];
            optionsHtml += '</label>';
        }
        
        _answers.innerHTML = optionsHtml;
    }
    
    _submit.addEventListener('click', () => {
        let selectedOption = document.querySelector('input[type=radio]:checked');
        if (!selectedOption) {
            $('#valider').addClass('shake');
            setTimeout(function(){
                $(".shake").removeClass("shake");
            }, 500)
            // alert('Veuillez sélectionner une réponse.');
            return;
        }
        
        let answer = selectedOption.value;
        if (answer == quizz[numquestion].correct) {
            score++;
        }
        
        selectedOption.checked = false;
        
        numquestion++;
        numberquestion++;
        
        if (numquestion < quizz.length) {
            displayQuestion(numquestion);
            reset();
        } else {
            timer();
        };
    });

    _home.addEventListener('click', () => {
        window.location.href = "home.php?user=" + user + "&role=" + role;
    });

    _retry.addEventListener('click', () => {
        window.location.href = "quiz.php?id_quizz=" + idquizz + "&user=" + user + "&role=" + role;
    });

    var boxes = document.querySelectorAll(".answer");

    for (var i = 0; i < boxes.length; i++) {
        boxes[i].addEventListener("click", function () {
            for (var j = 0; j < boxes.length; j++) {
            boxes[j].classList.remove("clicked");
            }
            if (!this.classList.contains("clicked")) {
            this.classList.add("clicked");
            console.log("clicked");
            }
        });
    }
</script>


