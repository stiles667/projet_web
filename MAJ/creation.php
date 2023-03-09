<?php 
require('bdconnexion.php');

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
    <link rel="stylesheet" href="creation.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
        integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <title>Quizzeo</title>
</head>

<body>
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

                // if(isset($_GET['user'])) {
                //     $id_user = $_GET['user'];
                // }
                
                // if(isset($_GET['role'])) {
                //     $role = $_GET['role'];
                // }

                echo "<h2>$pseudo</h2>";
                echo "<a id='profil' href='dashboard.php?role=$role&user=$id_user'>";
                echo "<img src='https://cdn-icons-png.flaticon.com/512/149/149071.png' alt='Photo de profil'>";
                echo "</a>";

            ?>
            <!-- <h2>Utilisateur</h2>
            <a id="profil" href="dashboard.html">
                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Photo de profil">
            </a>
            <a id="deconnexion" href="accueil.html">
                <img src="https://img.icons8.com/fluency-systems-regular/256/login-rounded-right.png"
                    alt="Se déconnecter">
            </a> -->
        </div>
    </header>
    <div class="container">
        <div class="info">
            <h3>Créer votre propre quiz</h3>
            <img src="https://img.icons8.com/color/256/add-folder.png">
        </div>
        <input id="input-title" type="text" placeholder="Nom du quiz">
        <div id="pageCreate">
            <form action="test.php" method="post">
                <div class="container-question">
                    <div class="question">
                        <div class="number">
                            <h3>1</h3>
                        </div>
                        <!-- <h3>Question</h3> -->
                        <input type="text" id="textarea"
                            placeholder="Quel est la couleur du cheval blanc de Henri IV ?">
                        <img class="trash" src="https://cdn-icons-png.flaticon.com/512/7641/7641678.png"
                            alt="Supprimer">
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="answer1">
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="answer2">
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="answer3">
                            </div>
                            <div>
                                <label for="answer4" class="letter">D</label>
                                <input type="text" name="answer4">
                            </div>
                            <div class="check">
                                <img src="https://img.icons8.com/fluency/256/checkmark.png">
                                <label for="correctAnswer">Sélectionner la bonne réponse</label>
                                <select name="correctAnswer" id="correctAnswer">
                                    <option value="answer1">A</option>
                                    <option value="answer2">B</option>
                                    <option value="answer3">C</option>
                                    <option value="answer4">D</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="question add">+</div>
                <input id="button-submit" type="submit" value="Créer">
            </form>
        </div>
    </div>
    <!-- <footer>
        <ul>
            <li><a href="#">À propos</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Conditions d'utilisation</a></li>
        </ul>
        <p>&copy; Quizzeo 2023</p>
    </footer> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="script.js"></script>
</body>

</html>