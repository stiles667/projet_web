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
                    $num_question = 1;
                    while($row=mysqli_fetch_assoc($result)) {
                        $id_question = $row['Id_question'];
                        $question = $row['question'];
                        
                        //affiche la premiere question
                        echo "" .$num_question .". " .$question;
                        $num_question++;
                        if ($numquestion > 10) {
                            $numquestion = 1;
                        }

                        $sql2 = "SELECT * FROM choix WHERE Id_question = " . $id_question;
                        $result2 = mysqli_query($conn, $sql2);

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

                        
                    }
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
            </form> -->
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="script.js"></script>
</body>