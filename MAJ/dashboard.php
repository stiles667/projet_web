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
            <div>
                <div class="button active" data-onglet="onglet-1">
                    <img src="https://img.icons8.com/fluency-systems-regular/256/home.png" alt="home">
                </div>
                <div class="button" data-onglet="onglet-2">
                    <img src="https://img.icons8.com/fluency-systems-regular/256/plus-math.png" alt="add">
                </div>
                <div class="button" data-onglet="onglet-3">
                    <img src="https://img.icons8.com/fluency-systems-regular/256/test.png" alt="quiz">
                </div>
                <div class="button" data-onglet="onglet-4">
                    <img src="https://img.icons8.com/fluency-systems-regular/256/security-user-male.png"
                        alt="admin">
                </div>
            </div>
            <div>
                <div class="button" data-onglet="onglet-5">
                    <img src="https://img.icons8.com/fluency-systems-regular/256/settings.png" alt="settings">
                </div>
                <div class="button">
                    <a href="accueil.html">
                        <img src="https://img.icons8.com/fluency-systems-regular/256/logout-rounded-left.png"
                            alt="deconnexion">
                    </a>
                </div>
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
                <p>Pseudo</p>
            </div>
            <div id="statistics">
                <div id="box">
                    <h3>Dernier quiz</h3>
                    <p>Sport</p>
                    <h3>Difficulté 3</h3>
                </div>
                <div id="box">
                    <h3>Total quiz</h3>
                    <p class="number">23</p>
                    <h3>quiz</h3>
                </div>
                <div id="box">
                    <h3>Total quiz</h3>
                    <p class="number">53</p>
                    <h3>quiz</h3>
                </div>
                <div id="box">
                    <h3>Photo de profil</h3>
                    <p>Changer</p>
                    <h3>Changer</h3>
                </div>
                <div id="box">
                    <h3>Membre depuis</h3>
                    <p id="date">03/10/2023</p>
                    <h3>Date</h3>
                </div>
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

                        echo "<div class='quiz2'>";
                        echo "<img class='trash2' src='https://cdn-icons-png.flaticon.com/512/7641/7641678.png' alt='Supprimer'>";
                        echo "<h3 class='Name'>$nom_quiz</h3>";
                        
                        switch ($categorie_quizz) {
                            case 'Sport':
                                echo "<img class='trash2' src='https://cdn-icons-png.flaticon.com/512/7641/7641678.png' alt='Supprimer'>";

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
                    <?php 
                        echo "<a href='creation.php?role=$role&user=$id_user'>";
                        echo "<img class='trash' src='https://cdn-icons-png.flaticon.com/512/7641/7641678.png' alt='Supprimer'>";
                        echo "<img class='edit' src='https://cdn-icons-png.flaticon.com/512/5204/5204758.png' alt='Modifier'>";
                        echo "<img id='add' src='https://img.icons8.com/fluency-systems-regular/256/plus-math.png' alt='Ajouter'>";
                        echo "</a>";
                    ?>
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
                            <th id="id">id</th>
                            <th>Utilisateur</th>
                            <th>Titre</th>
                            <th>Difficulté</th>
                            <th>Date</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
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

                                echo "<td>" .$id_quiz ."</td>";
                                echo "<td>" .$pseudo_utilisateur ."</td>";
                                echo "<td>" .$nom_quizz ."</td>";
                                echo "<td>" .$difficulte_quizz ."</td>";
                                echo "<td>" .$date_quizz ."</td>";

                                
                                echo "<td>";
                                echo "<a href='#'>";
                                echo "<img class='edit' src='https://cdn-icons-png.flaticon.com/512/5204/5204758.png' alt='Modifier'>";
                                echo "</a>";
                                echo "</td>";
                                
                                echo "<td>";
                                echo "<a href='#'";
                                echo "<img class='trash' src='https://cdn-icons-png.flaticon.com/512/7641/7641678.png' alt='Supprimer'>";
                                echo "</a>";
                                echo "</td>";
                                
                                // echo "<td>";
                                // echo "<div class='icons'>";
                                // echo "<img class='edit' src='https://cdn-icons-png.flaticon.com/512/5204/5204758.png' alt='Modifier'>";
                                // echo "<img class='trash' src='https://cdn-icons-png.flaticon.com/512/7641/7641678.png' alt='Supprimer'>";
                                // echo "</div>";
                                // echo "</td>";

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
                        <th id="id">id</th>
                        <th>Utilisateur</th>
                        <th>Rôle</th>
                        <th>E-mail</th>
                        <th>Mot de passe</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
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
                            echo "<td>$id_user</td>";
                            echo "<td>$pseudo_user</td>";
                            echo "<td>$role_user</td>";
                            echo "<td>$email_user</td>";
                            echo "<td>$password_user</td>";
                            
                            echo "<td>";
                            echo "<a href='updateuser.php?role=$role_user&user=$id_utilisateur'>";
                            echo "<img class='edit' src='https://cdn-icons-png.flaticon.com/512/5204/5204758.png' alt='Modifier'>";
                            echo "</a>";
                            echo "</td>";
                            
                            echo "<td>";
                            echo "<a href='#'";
                            echo "<img class='trash' src='https://cdn-icons-png.flaticon.com/512/7641/7641678.png' alt='Supprimer'>";
                            echo "</a>";
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
                <form method="post" action="" class="UpdateUser">
                    <div>
                        <label for="pseudo">Nom d'utilisateur</label>
                        <input type="text" name="pseudo" placeholder="Nom d'utilisateur" value="<?php echo $pseudo?>">
                    </div>
                    <div>
                        <label for="e-mail">Email</label>
                        <input type="text" name="e-mail" placeholder="Email" value="<?php echo $email?>">
                    </div>
                    <div>
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" placeholder="Ancien mot de passe">
                        <input type="password" name="Newpassword" placeholder="Nouveau mot de passe">
                        <input type="password" name="Confirmpassword" placeholder="Confirmer le mot de passe">
                    </div>
                    <input type="submit" class="button-save" name="updateuser" type="submit" value="Modifier">

                    <?php 

                        if(isset($_POST['updateuser'])) {
                            $pseudo = $_POST["pseudo"];
                            $email = $_POST["e-mail"];
                            $password = $_POST["password"];
                            $newpassword = $_POST["Newpassword"];
                            $confirmpassword = $_POST["Confirmpassword"];
                            $sqlmodif = "SELECT * FROM utilisateur WHERE pseudo = '$pseudo' AND email = '$email' AND password = '$password'";
                            $resultmodif = mysqli_query($conn, $sqlmodif);
                            if (mysqli_num_rows($resultmodif) > 0) {
                                while ($rowmodif = mysqli_fetch_assoc($resultmodif)) {
                                    $id = $rowmodif["Id_utilisateur"];
                                    $pseudobd = $rowmodif["pseudo"];
                                    $emailbd = $rowmodif["email"];
                                    $passwordbd = $rowmodif["password"];
                                    if ($passwordbd = $password) {
                                        $sqlupdate = "UPDATE utilisateur SET pseudo = '$pseudo', email = '$email', password = '$newpassword' WHERE Id_utilisateur = '$id'";
                                        $resultupdate = mysqli_query($conn, $sqlupdate);
                                        echo "<script>alert('Modification réussie')</script>";
                                    } else {
                                        echo "<script>alert('Mot de passe incorrect')</script>";
                                    }
                                }
                            }
                        }
                    
                    ?>
                </form>
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