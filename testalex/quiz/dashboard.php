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
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
        integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <title>Quizzeo</title>
</head>

<body>
    <header>
        <a class="home" href="home.html">
            <span>Quiz</span><span>zeo.</span>
        </a>
        <div class="options">
            <h2>Utilisateur</h2>
            <a id="profil" href="dashboard.html">
                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Photo de profil">
            </a>
            <a href="accueil.html">
                <img id="deconnexion" src="https://img.icons8.com/fluency-systems-regular/256/login-rounded-right.png"
                    alt="Se déconnecter">
            </a>
        </div>
    </header>
    <div class="container">
        <!-- <div class="icons opacity">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218472.png" alt="Lettres">
            <img src="  " alt="Fruit">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218113.png" alt="Ballon de basket">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218478.png" alt="Couleurs">
            <img src="https://cdn-icons-png.flaticon.com/512/5204/5204758.png" alt="Crayon">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218493.png" alt="Loupe">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218484.png" alt="Globe terrestre">
        </div> -->
        <div class="onglets">
            <div class="button active" data-onglet="onglet-1">
                <img src="https://img.icons8.com/fluency-systems-regular/256/home.png" alt="Accueil">
            </div>
            <div class="button" data-onglet="onglet-2">
                <img src="https://img.icons8.com/fluency-systems-regular/256/plus-math.png" alt="Ajouter">
            </div>
            <div class="button" data-onglet="onglet-3">
                <img src="https://img.icons8.com/fluency-systems-regular/256/test.png" alt="Quiz">
            </div>
            <div class="button" data-onglet="onglet-4">
                <img src="https://img.icons8.com/fluency-systems-regular/256/security-user-male.png"
                    alt="Administrateur">
            </div>
            <div class="button" data-onglet="onglet-5">
                <img src="https://img.icons8.com/fluency-systems-regular/256/settings.png" alt="Paramètre">
            </div>
        </div>

        <div class="container-onglet active" id="onglet-1">
            <div class="info">
                <div class="title">
                    <h2>Bienvenue</h2>
                    <div>
                        <img src="https://cdn-icons-png.flaticon.com/512/5197/5197842.png" alt="Pouce en l'air">
                    </div>
                </div>

                <details>
                    <summary>I have keys but no doors. I have space but no room. You can enter but can’t leave. What am
                        I?</summary>
                    <p>Question 1</p>
                    <p>Question 2</p>
                    <p>Question 3</p>
                </details>
            </div>

        </div>

        <div class="container-onglet" id="onglet-2">
            <div class="info">
                <div class="title">
                    <h2>Création</h2>
                    <div>
                        <img src="https://cdn-icons-png.flaticon.com/512/5204/5204758.png" alt="Crayon">
                    </div>
                </div>
                <p>Gérer vos quiz</p>
            </div>
            <div class="categories">
                <?php 
                    $sqlcreation = "SELECT * FROM creer WHERE Id_utilisateur = '$id_user'";
                    $resultcreation = mysqli_query($conn, $sqlcreation);

                    while($rowcreation = mysqli_fetch_assoc($resultcreation)) {
                        $id_quiz = $rowcreation['Id_quizz'];

                        $sqlquiz = "SELECT * FROM quizz WHERE Id_quizz = '$id_quiz'";
                        $resultquiz = mysqli_query($conn, $sqlquiz);

                        $row = mysqli_fetch_assoc($resultquiz);
                            $nom_quiz = $row['Titre'];
                            $difficulte_quizz = $row['difficulte'];
                            $categorie_quizz = $row['Categorie'];
                            $date_quizz = $row['date_creation'];

                            echo "<div class='quiz2'";
                            echo "<img class='trash2' src='https://cdn-icons-png.flaticon.com/512/7641/7641678.png' alt='Supprimer'>";
                            echo "<h3 class='Name'>$nom_quiz</h3>";
                            switch ($categorie_quizz) {
                                case 'Sport':
                                    echo "<img src='https://cdn-icons-png.flaticon.com/512/4218/4218113.png' alt='Sport'>";
                                    break;
                                case 'Cinema':
                                    echo "<img src='https://cdn-icons-png.flaticon.com/512/5198/5198228.png' alt='Cinéma'>";
                                    break;
                                case 'Musique':
                                    echo "<img src='https://cdn-icons-png.flaticon.com/512/5198/5198104.png' alt='Musique'>";
                                    break;
                                case 'Geographie':
                                    echo "<img src='https://cdn-icons-png.flaticon.com/512/4218/4218484.png' alt='Géographie'>";
                                    break;
                                case 'Animal':
                                    echo "<img src='https://cdn-icons-png.flaticon.com/512/8176/8176142.png' alt='Animal'>";

                            }
                            echo "</div>"; 
                        
                        
                    }
                    

                ?>
                
                <div class="quiz2">
                    <a href="create.html">
                        <img class="trash" src="https://cdn-icons-png.flaticon.com/512/7641/7641678.png"
                            alt="Supprimer">
                        <img class="edit" src="https://cdn-icons-png.flaticon.com/512/5204/5204758.png" alt="Modifier">
                        <img id="add" src="https://img.icons8.com/fluency-systems-regular/256/plus-math.png"
                            alt="Ajouter">
                    </a>
                </div>
            </div>
        </div>

        <div class="container-onglet" id="onglet-3">
            <div class="info">
                <div class="title">
                    <h2>Administrateur</h2>
                    <div>
                        <img src="https://cdn-icons-png.flaticon.com/512/7128/7128197.png" alt="Bouclier">
                    </div>
                </div>
                <div id="status">
                    <p>Quiz en ligne</p>
                    <div id="online"></div>
                </div>
                <div class="search-container">
                    <div id="search-icon">
                        <img src="https://img.icons8.com/fluency-systems-regular/256/search.png" alt="Rechercher">
                    </div>
                    <input class="searchBar" type="search" placeholder="Rechercher">
                </div>
            </div>

            <div class="container-list">
                <div id="list-user">
                    <table>
                        <tr>
                            <th>Utilisateur</th>
                            <th>Titre</th>
                            <th>Difficulté</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                        <?php

                            $sqlcreation = "SELECT * FROM creer";
                            $resultcreation = mysqli_query($conn, $sqlcreation);
                        

                            while($row=mysqli_fetch_assoc($resultcreation)) {
                                $id_utilisateur = $row['Id_utilisateur'];
                                $id_quiz = $row['Id_quizz'];

                                $sqlquizz = "SELECT * FROM quizz WHERE Id_quizz = '$id_quiz'";                                                                
                                $resultquizz = mysqli_query($conn, $sqlquizz);

                                $rowquizz = mysqli_fetch_assoc($resultquizz);
                                
                                $nom_quizz = $rowquizz['Titre'];
                                $categorie_quizz = $rowquizz['Categorie'];
                                $date_quizz = $rowquizz['date_creation'];
                                $difficulte_quizz = $rowquizz['difficulte'];
                                

                                $sqlutilisateur = "SELECT * FROM utilisateur WHERE Id_utilisateur = '$id_utilisateur'";
                                $resultutilisateur = mysqli_query($conn, $sqlutilisateur);
                                
                                $rowutilisateur = mysqli_fetch_assoc($resultutilisateur);
                                
                                $pseudo_utilisateur = $rowutilisateur['pseudo'];

                                
                                    
                                

                                // echo "L'utilisateur " .$id_utilisateur ." a créé le quiz " .$id_quiz ."<br>";
                                echo "<tr>";
                                echo "<td>" .$pseudo_utilisateur ."</td>";
                                echo "<td>" .$nom_quizz ."</td>";
                                echo "<td>" .$difficulte_quizz ."</td>";
                                echo "<td>" .$date_quizz ."</td>";
                                echo "<td>";
                                echo "<img class='edit' src='https://cdn-icons-png.flaticon.com/512/5204/5204758.png' alt='Modifier'>";
                                echo "<img class='trash' src='https://cdn-icons-png.flaticon.com/512/7641/7641678.png' alt='Supprimer'>";
                                echo "</td>";
                                echo "</tr>";


                            }
                        

                        ?>
                    </table>
                </div>
            </div>
        </div>

        <div class="container-onglet" id="onglet-4">
            <div class="info">
                <div class="title">
                    <h2>Administrateur</h2>
                    <div>
                        <img src="https://cdn-icons-png.flaticon.com/512/3962/3962402.png" alt="Bouclier">
                    </div>
                </div>
                <div id="status">
                    <p>Liste utilisateurs</p>
                    <div id="online"></div>
                </div>
                <div class="buttons">
                    <div class="search-container">
                        <div id="search-icon">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/search.png" alt="Rechercher">
                        </div>
                        <input class="searchBar" type="search" placeholder="Rechercher">
                    </div>
                    <div class="buttons">
                        <input class="button-save" type="submit" value="Enregistrer">
                        <input class="button-cancel" type="submit" value="Annuler">
                    </div>
                </div>
            </div>
            <div id="list-user">
                <table>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Rôle</th>
                        <th>E-mail</th>
                        <th>Mot de passe</th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                        $sql2utilisateur = "SELECT * FROM utilisateur";
                        $result2utilisateur = mysqli_query($conn, $sql2utilisateur);

                        while($row2utilisateur = mysqli_fetch_assoc($result2utilisateur)) {
                            $id_user = $row2utilisateur['Id_utilisateur'];
                            $pseudo_user = $row2utilisateur['pseudo'];
                            $email_user = $row2utilisateur['email'];
                            $password_user = $row2utilisateur['password'];
                            $role_user = $row2utilisateur['role_utilisateur'];

                            switch ($role_user) {
                                case 1:
                                    $role_user = "Utilisateur";
                                    break;
                                case 2:
                                    $role_user = "Quizzeur";
                                    break;
                                case 3:
                                    $role_user = "Administrateur";
                                    break;
                            }

                            echo "<tr>";
                            echo "<td>$pseudo_user</td>";
                            echo "<td>$role_user</td>";
                            echo "<td>$email_user</td>";
                            echo "<td>$password_user</td>";
                            echo "<td>";
                            echo "<img class='edit' src='https://cdn-icons-png.flaticon.com/512/5204/5204758.png' alt='Modifier'>";
                            echo "<img class='trash' src='https://cdn-icons-png.flaticon.com/512/7641/7641678.png' alt='Supprimer'>";
                            echo "</td>";
                            echo "</tr>";

                        }
                    ?>
                </table>
            </div>
        </div>
        <div class="container-onglet" id="onglet-5">
            <div class="info">
                <div class="title">
                    <h2>Paramètre</h2>
                    <div>
                        <img src="https://cdn-icons-png.flaticon.com/512/8633/8633246.png" alt="Crayon">
                    </div>
                </div>
                <p>Modifier vos informations</p>
            </div>
            <div class="passwd">
                <div>
                    <label for="pseudo">Nom d'utilisateur</label>
                    <input type="text" name="pseudo" placeholder="Nom d'utilisateur">
                </div>
                <div>
                    <label for="e-mail">E-mail</label>
                    <input type="text" name="e-mail" placeholder="Email">
                </div>
                <div>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" placeholder="Ancien mot de passe">
                    <input type="password" placeholder="Nouveau mot de passe">
                    <input type="password" placeholder="Confirmer le mot de passe">
                </div>
                <input class="button-save" type="submit" value="Modifier">
            </div>
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