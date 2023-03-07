<?php 

require ('bdconnexion.php');

if(isset($_GET['id_quizz'])) {
    $id_quizz = $_GET['id_quizz'];
    $sql = "SELECT * FROM question WHERE Id_quizz = " . $id_quizz;
    $result = mysqli_query($conn, $sql);
    $sql2 = "SELECT * FROM choix WHERE Id_question = " . $id_quizz;
    $result2 = mysqli_query($conn, $sql2);
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
    <link href='https://css.gg/search.css' rel='stylesheet'>
    <title>Quizzeo</title>
</head>

<body>
    <audio id="audio" preload="auto" loop>
        <source src="quiz-show-timer-30-sec-music-for-content-creator.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
      </audio>
      
      <script>
        document.addEventListener('DOMContentLoaded', () => {
          const audio = document.querySelector('#audio');
          audio.play();
        });
      </script>
    <header>
        <a class="home" href="accueil.html">
            <span>Quiz</span><span>zeo.</span>
        </a>
        <div class="options">
            <h2>Utilisateur</h2>
            <a id="profil" href="dashboard.html">
                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Photo de profil">
            </a>
            <a id="deconnexion" href="accueil.html">
                <img src="https://img.icons8.com/fluency-systems-regular/256/login-rounded-right.png"
                    alt="Se déconnecter">
            </a>
        </div>
        </div>
    </header>
    <div class="container">

        <!-- <div class="icons">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218113.png" alt="Ballon de basket">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218472.png" alt="Lettres">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218484.png" alt="Globe terrestre">
            <img src="https://cdn-icons-png.flaticon.com/512/4058/4058331.png" alt="Fruit">
            <img src="https://cdn-icons-png.flaticon.com/512/5204/5204758.png" alt="Crayon">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218478.png" alt="Couleurs">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218493.png" alt="Loupe">
        </div> -->
        <div class="container-question">
            <div class="number-question">
                <h2>
                    <?php 
                    $numquestion = 1;
                    echo "Question " . $numquestion . "/10";
                    $numquestion++;
                    if ($numquestion > 10) {
                        $numquestion = 1;
                    }
                    ?>
                </h2>
                <div class="container-countdown">
                    <h2 id="countdown">60</h2>
                </div>
            </div>
        </div>
        <div class="container-answer">
            <div class="question">
                <h3>
                    <?php
                    while($row=mysqli_fetch_assoc($result)) {
                        echo $row['question'];
                    }
                    ?>
                </h3>
            </div>
            <form action="#">
                <div class="answers">
                    <?php
                    if (mysqli_num_rows($result2) > 0) {
                        while($row2=mysqli_fetch_assoc($result2)) {
                            $reponses = array(
                                'reponse1' => $row2['rep1'],
                                'reponse2' => $row2['rep2'],
                                'reponse3' => $row2['rep3'],
                                'Bonne_rep'=> $row2['Bonne_reponse']
                            );

                            shuffle($reponses);

                            foreach ($reponses as $index => $reponse) {
                        
                                echo '<label class="answer">
                                <input type="radio" name="option" value="'.$index.'">
                                '.$reponse.'
                                </label>';
                            }
                            
                        } 
                    }
                    ?>

                    <!-- <label class="answer">
                        <input type="radio" name="option" value="option1">
                        Rouge
                    </label>

                    <label class="answer">
                        <input type="radio" name="option" value="option2">
                        Blanc
                    </label>

                    <label class="answer">
                        <input type="radio" name="option" value="option3">
                        Noir
                    </label>

                    <label class="answer">
                        <input type="radio" name="option" value="option3">
                        Vert
                    </label> -->

                    <!-- <input type="radio" name="answer" id="answer">
                    <input type="radio" name="answer" id="answer">
                    <input type="radio" name="answer" id="answer">
                    <input type="radio" name="answer" id="answer"> -->
                    <!-- <div class="answer">Rouge</div>
                    <div class="answer">Blanc</div>
                    <div class="answer">Noir</div>
                    <div class="answer">Vert</div> -->
                </div>
                <button type="submit" id="submit">Valider</button>
            </form>
        </div>
    </div>

    <script>
        // const countdown = document.getElementById('countdown');
        // const submit = document.getElementById('submit');
        // let time = 60;
        // let timer = setInterval(function () {
        //     time--;
        //     countdown.innerHTML = time;
        //     if (time == 0) {
        //         clearInterval(timer);
        //         submit.click();
        //     }
        // }, 1000);

        submit.addEventListener('click', function () {
            clearInterval(timer);
            
        });

        //fonction pour afficher les questions 1 par 1
        function showQuestion() {
            const question = document.getElementById('question');
            const answer = document.getElementById('answer');
            const submit = document.getElementById('submit');
        
            let time = 60;
            let timer = setInterval(function () {
                time--;
                countdown.innerHTML = time;
                if (time == 0) {
                    clearInterval(timer);
                    submit.click();
                }
            }, 1000);
        
            submit.addEventListener('click', function () {
                clearInterval(timer);
                question.style.display = 'none';
                answer.style.display = 'none';
                submit.style.display = 'none';
                showQuestion();
            });
        }

        showQuestion();





        // const audio = document.querySelector('#audio');
        // audio.play();

        // document.addEventListener('DOMContentLoaded', () => {
        //   const audio = document.querySelector('#audio');
        //   audio.play();
        // });

        







    </script>
        <!-- <footer>
       