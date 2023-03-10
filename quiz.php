<?php 

require ('bdconnexion.php');

if(isset($_GET['id_quizz'])) {
    $id_quizz = $_GET['id_quizz'];
    $sql = "SELECT * FROM question WHERE Id_quizz = " . $id_quizz;
    $result = mysqli_query($conn, $sql);
    
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
        <div class="question">
                <h3></h3>
            </div>
        <div class="container-answer">
            
            <form action="#">
                <div class="answers">

                    <label class="answer">
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
                    </label>

                    <?php
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
                    
                    // print_r($questions);
                    // print_r($questions);
                    // print_r($rep);
                    // $num_question = 1;
                    // $questions = array ();
                    // while($row=mysqli_fetch_assoc($result)) {
                    //     $id_question = $row['Id_question'];
                    //     $question = $row['question'];
                        
                        
                        
                        
                        
                        

                        // foreach ($questions as $index => $question) {
                        //     echo $question['question'];
                        // }

                        //affiche la premiere question
                        // echo "" .$num_question .". " .$question;
                        // $num_question++;
                        // if ($numquestion > 10) {
                        //     $numquestion = 1;
                        // }
                        

                        // $sql2 = "SELECT * FROM choix WHERE Id_question = " . $id_question;
                        // $result2 = mysqli_query($conn, $sql2);
                        // $reponsesjs = array();
                        // if (mysqli_num_rows($result2) > 0) {
                        //     while($row2=mysqli_fetch_assoc($result2)) {
                        //         $reponses = array(
                        //             // 'idquestion ' => $row2['Id_question'],
                        //             'reponse1' => $row2['rep1'],
                        //             'reponse2' => $row2['rep2'],
                        //             'reponse3' => $row2['rep3'],
                        //             'Bonne_rep'=> $row2['Bonne_reponse']
                        //         );

                        //         foreach ($reponses as $index => $reponse) {
                        //             $reponsesjs[] = $reponses;
                        //         }

                                
                                
                                

                        //         shuffle($reponses);


                                // foreach ($reponses as $index => $reponse) {
                            
                                //     echo '<label class="answer">
                                //     <input type="radio" name="option" value="'.$index.'">
                                //     '.$reponse.'
                                //     </label>';
                                // }
                                
                    //         } 
                    //     }

                        
                    // }
                    
                        // echo "<ol>";
                        // for ($i = 0; $i < 10 && $i < count($questions); $i++) {
                        //     echo "<li>" . $questions[$i]['question'] . "</li>";
                        // }
                        // echo "</ol>";
                        // echo "<ol>";


                        // echo json_encode($questions);
                        // print_r($questions);
                        // echo "<br>";
                        // print_r($reponsesjs);


                    ?>
                </h3>
            </div>
            
            <!-- <form action="#">
                <div class="answers">
                    
                    // $sql2 = "SELECT * FROM choix WHERE Id_question = " . $id_question;
                    // $result2 = mysqli_query($conn, $sql2);
                    // if (mysqli_num_rows($result2) > 0) {
                    //     while($row2=mysqli_fetch_assoc($result2)) {
                    //         $reponses = array(
                    //             'reponse1' => $row2['rep1'],
                    //             'reponse2' => $row2['rep2'],
                    //             'reponse3' => $row2['rep3'],
                    //             'Bonne_rep'=> $row2['Bonne_reponse']
                    //         );

                    //         shuffle($reponses);

                    //         foreach ($reponses as $index => $reponse) {
                        
                    //             echo '<label class="answer">
                    //             <input type="radio" name="option" value="'.$index.'">
                    //             '.$reponse.'
                    //             </label>';
                    //         }
                            
                    //     } 
                    // }
                    ?>
                </div>
                <button type="submit" id="submit">Valider</button>
            </form>
        </div>
    </div> -->
        <script>
            const _quest = document.getElementById('question');
            const _answers = document.querySelector('.answers');


            
            

            var questions = <?php echo json_encode($questions) ?>;
            // console.log(questions);
            
            var reponses = <?php echo json_encode($rep) ?>;
            // console.log(reponses);

            var numquestion = 1;
            var quizzarray = 0;
            
            var quizz = [questions, reponses];
            console.log(quizz);



            function AfficherQuizz() {
                for (var i = 0; i < quizz[0].length; i++) {
                var question = quizz[0][i];
                var reponse = quizz[1][i];
                var questionString = JSON.stringify(question);
                var reponseString = JSON.stringify(reponse);
                console.log("Question " + (i+1) + ": " + questionString);
                console.log("Réponse " + (i+1) + ": " + reponseString);
                
                console.log(question);
                _quest.innerHTML = question;
                

            }

            }

            AfficherQuizz();
        </script>
    </body>
    </html>
    