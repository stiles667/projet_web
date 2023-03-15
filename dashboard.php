<?php
                            
require('bdconnexion.php');         // Connection to the database

if(isset($_GET['user'])) {          // Get the user id from the url
    $id_user = $_GET['user'];
}

if(isset($_GET['role'])) {          // Get the user role from the url
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
    <title>Quizzeo</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
    <header>
        <?php       //Bouton home
            echo "<a class='home' href='home.php?role=$role&user=$id_user'>";       // Send the user id and role to the home page
            echo "<span>Quiz</span><span>zeo.</span>";                       // Logo
            echo "</a>";
        ?>
        <div class="options">
        <?php       //Bouton profil
                $sqlutilisateur = "SELECT * FROM utilisateur WHERE Id_utilisateur = '$id_user'";        // Get the user information
                $resultutilisateur = mysqli_query($conn, $sqlutilisateur);      // Execute the query

                $row = mysqli_fetch_assoc($resultutilisateur);      // Get the result
                $role_user = $row['role_utilisateur'];        // Get the role
                $pseudo = $row['pseudo'];       // Get the pseudo
                $email = $row['email'];         // Get the email
                $id_utilisateur = $row['Id_utilisateur'];       // Get the user id

                echo "<h2>$pseudo</h2>";        // Display the pseudo
                echo "<a id='profil' href='dashboard.php?role=$role&user=$id_user'>";       // Send the user id and role to the dashboard page
                echo "<img src='https://cdn-icons-png.flaticon.com/512/149/149071.png' alt='Photo de profil'>";
                echo "</a>";
    
            ?>
        </div>
    </header>
    <div class="container">
        <div class="onglets">
            <div>
                <div class="button active" data-onglet ="onglet-1">
                    <img src="https://img.icons8.com/fluency-systems-regular/256/home.png" alt="home">
                </div>
                <div class="button" data-onglet="onglet-2">
                    <img src="https://img.icons8.com/fluency-systems-regular/256/plus-math.png" alt="add">
                </div>
                <hr>
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
                <a href="accueil.html">
                    <div class="button">
                        <img src="https://img.icons8.com/fluency-systems-regular/256/logout-rounded-left.png" alt="deconnexion">
                    </div>
                </a>
            </div>
        </div>

        <div class="container-onglet active" id="onglet-1">
            <div class="info">
                <div class="title">
                    <h2>Bienvenue, <?php echo $pseudo?></h2>
                    <div>
                        <img src="https://cdn-icons-png.flaticon.com/512/5197/5197842.png" alt="Pouce en l'air">
                    </div>
                </div>
                <p><?php echo $role ?></p>
            </div>
            <div id="statistics">
                <div class="box">
                    <h3>Dernier quiz</h3>
                    <p>
                        <?php       // Get the last quiz title
                            $sql = "SELECT * FROM quizz ORDER BY Id_quizz DESC LIMIT 1";        // Get the last quiz
                            $result = mysqli_query($conn, $sql);        // Execute the query
                            $row = mysqli_fetch_assoc($result);     // Get the result
                            $nom = $row['Titre'];       // Get the title
                            echo $nom;      // Display the title
                        ?>
                    </p>
                </div>
                <div class="box">
                    <h3>Quiz joué(s)</h3>
                    <p class="number">
                        <?php       // Get the number of quiz played
                            $sqltotal = "SELECT COUNT(*) AS total FROM jouer WHERE Id_utilisateur = '$id_user'";      // Get the number of quiz played by the user
                            $resulttotal = mysqli_query($conn, $sqltotal);      // Execute the query
                            $row = mysqli_fetch_assoc($resulttotal);        // Get the result
                            $total = $row['total'];     // Get the number
                            echo $total;        // Display the number
                        ?>
                    </p>
                </div>
                <div class="box">
                    <h3>Total score</h3>
                    <p class="number">
                        <?php       // Get the total score
                            $sqlscore = "SELECT SUM(Score) AS total FROM jouer WHERE Id_utilisateur = '$id_user'";      // Get the total score of the user
                            $resultscore = mysqli_query($conn, $sqlscore);      // Execute the query
                            $row = mysqli_fetch_assoc($resultscore);        // Get the result
                            $score = !empty($row['total']) ? $row['total'] : 0;     // Get the score
                            echo $score;        // Display the score
                        ?>
                    </p>
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
                        $url = $row['url'];
                        $date_quizz = $row['date_creation'];

                        
                        echo "<div class='quiz2'>";
                        echo "</a>";
                        echo "<a href='deletequiz.php?role=$role&user=$id_user&deletequizz=$id_quiz' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer ce quiz?')\">";  // Delete the quiz
                        echo "<img class='trash2' src='https://cdn-icons-png.flaticon.com/512/7641/7641678.png' alt='Supprimer'>";
                        
                        echo "<a href='updatequizz.php?role=$role&user=$id_user&updatequizz=$id_quiz'>";
                        echo "<h3 class='Name'>$nom_quiz</h3>";
                        echo "</a>";    
                        
                        echo "<img class='illustration' src='$url' alt='Sport'>";
                        
                        echo "</div>";
                    }
                    
                ?>

                <?php       // Bouton for creating a quiz
                    echo "<a href='creation.php?role=$role&user=$id_user'>";    // Link to the creation page     
                        echo "<div class='quiz2'>";     
                        echo "<img id='add' src='https://img.icons8.com/fluency-systems-regular/256/plus-math.png' alt='Ajouter'>";
                        echo "</div>";
                    echo "</a>";
                ?>
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
                            <th id="id">Id</th>
                            <th>Utilisateur</th>
                            <th>Titre</th>
                            <th>Difficulté</th>
                            <th>Date</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>

                        <?php

                            $sqlcreation = "SELECT * FROM creer";           // Get the quiz created by the user
                            $resultcreation = mysqli_query($conn, $sqlcreation);
                            
                            while($row=mysqli_fetch_assoc($resultcreation)) {       // Get the result
                                $id_utilisateur = $row['Id_utilisateur'];       // Get the user id
                                $id_quiz = $row['Id_quizz'];            // Get the quiz id

                                $sqlquizz = "SELECT * FROM quizz WHERE Id_quizz = '$id_quiz'";          // Get the quiz from the quiz id                                                         
                                $resultquizz = mysqli_query($conn, $sqlquizz);

                                $rowquizz = mysqli_fetch_assoc($resultquizz);
                                
                                $nom_quizz = $rowquizz['Titre'];        // Get the title
                                $url = $rowquizz['url'];      // Get the category
                                $date_quizz = $rowquizz['date_creation'];       // Get the date of creation
                                $difficulte_quizz = $rowquizz['difficulte'];        // Get the difficulty
                                

                                $sqlutilisateur = "SELECT * FROM utilisateur WHERE Id_utilisateur = '$id_utilisateur'";       // Get the user from the user id
                                $resultutilisateur = mysqli_query($conn, $sqlutilisateur);      
                                
                                $rowutilisateur = mysqli_fetch_assoc($resultutilisateur);       
                                
                                $pseudo_utilisateur = $rowutilisateur['pseudo'];        // Get the pseudo

                                echo "<tr>";        

                                echo "<td>" .$id_quiz ."</td>";     // Display the quiz id
                                echo "<td>" .$pseudo_utilisateur ."</td>";      // Display the pseudo
                                echo "<td>" .$nom_quizz ."</td>";       // Display the title
                                echo "<td>" .$difficulte_quizz ."</td>";        // Display the difficulty
                                echo "<td>" .$date_quizz ."</td>";          // Display the date of creation

                                echo "<td>";        // Display the edit button
                                echo "<a href='updatequizz.php?role=$role&user=$id_user&updatequizz=$id_quiz'>";        // Link to the update page
                                echo "<img class='edit' src='https://cdn-icons-png.flaticon.com/512/5204/5204758.png' alt='Modifier'>";
                                echo "</a>";
                                echo "</td>";
                                
                                echo "<td>";        // Display the delete button
                                echo "<a href='deletequiz.php?role=$role&user=$id_user&deletequizz=$id_quiz'>";     // Link to the delete page
                                echo "<img class='trash' src='https://cdn-icons-png.flaticon.com/512/7641/7641678.png' alt='Supprimer'>";
                                echo "</a>";
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
                        <?php           //Bouton pour ajouter un utilisateur
                            echo "          
                            <a href='create.php?role=$role_user&user=$id_user'>     
                            <input class='button-save' type='submit' value='+ Ajouter'>
                            </a>
                            ";
                        ?>
                    </div>
                </div>
            </div>
            <div id="list-user">
                <table>
                    <tr>
                        <th id="id">Id</th>
                        <th>Utilisateur</th>
                        <th>Rôle</th>
                        <th>E-mail</th>
                        <th>Mot de passe</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>

                    <?php       
                        $sql2utilisateur = "SELECT * FROM utilisateur";     // Get all the users
                        $result2utilisateur = mysqli_query($conn, $sql2utilisateur);

                        while($row2utilisateur = mysqli_fetch_assoc($result2utilisateur)) {     
                            $id_utilisateur = $row2utilisateur['Id_utilisateur'];       // Get the user id
                            $pseudo_user = $row2utilisateur['pseudo'];    // Get the pseudo     
                            $email_user = $row2utilisateur['email'];        // Get the email
                            $password_user = $row2utilisateur['password'];      // Get the password
                            $role_user = $row2utilisateur['role_utilisateur'];      // Get the role

                            switch ($role_user) {       //Switch to display the role
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
                            echo "<td>$id_utilisateur</td>";        // Display the user id
                            echo "<td>$pseudo_user</td>";       // Display the pseudo
                            echo "<td>$role_user</td>";     // Display the role
                            echo "<td>$email_user</td>";        // Display the email
                            echo "<td>$password_user</td>";     // Display the password
                            
                            echo "<td>";
                            echo "<a href='updateuser.php?role=$role&user=$id_user&updateId=$id_utilisateur&updateRole=$role_user'>";   // Link to the update user page
                            echo "<img class='edit' src='https://cdn-icons-png.flaticon.com/512/5204/5204758.png' alt='Modifier'>";
                            echo "</a>";
                            echo "</td>";
                            
                            echo "<td>";
                            echo "<a href='delete.php?role=$role&user=$id_user&deleteId=$id_utilisateur'>";    // Link to the delete user page
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
                <form method="post" action="" class="update-user">
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
                        <input type="password" name="new-password" placeholder="Nouveau mot de passe">
                        <input type="password" name="confirm-password" placeholder="Confirmer le mot de passe">
                    </div>
                    <input type="submit" class="button-save" name="update-user" value="Modifier">

                    <?php 
                        if(isset($_POST['update-user'])) {      // If the user click on the button update user
                            $pseudo = $_POST["pseudo"];         
                            $email = $_POST["e-mail"];
                            $password = $_POST["password"];
                            $new_password = $_POST["new-password"];
                            $confirm_password = $_POST["confirm-password"];

                            $sqlmodif = "SELECT * FROM utilisateur WHERE pseudo = '$pseudo' AND email = '$email' AND password = '$password'";    // Get the user
                            $resultmodif = mysqli_query($conn, $sqlmodif);

                            if (mysqli_num_rows($resultmodif) > 0) {
                                $rowmodif = mysqli_fetch_assoc($resultmodif);   
                                $id = $rowmodif["Id_utilisateur"];
                                $pseudobd = $rowmodif["pseudo"];
                                $emailbd = $rowmodif["email"];
                                $passwordbd = $rowmodif["password"];

                                if ($passwordbd === $password) {        // If the password is correct
                                    if ($new_password === $confirm_password) {   // If the new password is the same as the confirm password
                                        $sqlupdate = "UPDATE utilisateur SET pseudo = '$pseudo', email = '$email', password = '$new_password' WHERE Id_utilisateur = '$id'";    // Update the user
                                        $resultupdate = mysqli_query($conn, $sqlupdate);
                                        echo "<script>alert('Modification réussie')</script>";
                                    } else {
                                        echo "<script>alert('Les mots de passe ne correspondent pas.')</script>"; 
                                    }
                                } else {
                                    echo "<script>alert('Mot de passe incorrect')</script>";
                                }
                            }
                        }
                    ?>

                </form>
            </div>
        </div>
    </div>
    <script>
        if ('<?php echo $id_user ?>' !== '1') {         // If the user is not the admin
            $('#onglet-3, #onglet-4, .button[data-onglet="onglet-3"], .button[data-onglet="onglet-4"],hr').remove();     // Remove the button admin and the container
        }

        if ('<?php echo $role ?>' !== 'Administrateur' && '<?php echo $role ?>' !== 'Quizzeur') {       // If the user is not the admin or the quizzeur
            $('.button[data-onglet="onglet-2"]').remove();      // Remove the button quizzeur
        }

        $(".button").click(function () {                // When the user click on a button
            $(".button").removeClass("active");        // We remove the actual the page that we see
            $(".container-onglet").removeClass("active");       

            $(this).addClass("active");             //We add the page that we want to see
            var tab = $(this).data("onglet");       //We get the id of the page that we want to see
            $("#" + tab).addClass("active");    //We add the page that we want to see
        });

        $('input[type="search"]').focus(function () {           // When the user click on the search bar
            $(".search-container").css("width", "400px");       // We increase the size of the search bar
        });

        $('input[type="search"]').blur(function () {            // When the user click outside the search bar
            $(".search-container").css("width", "220px");       // We decrease the size of the search bar
        });

        $(".searchBar").on("input", function() {            // When the user type something in the search bar
                const query = $(this).val().toLowerCase();
                $("tr:not(:first-child)").each(function() {     // We get all the rows of the table
                const utilisateur = $(this).find("td:nth-child(2)").text().toLowerCase();   // We get the name of the user
                const titre = $(this).find("td:nth-child(3)").text().toLowerCase();
                if (utilisateur.includes(query) || titre.includes(query)) {     // If the name of the user or the title of the quiz contains the query
                    $(this).show();     // We show the row
                } else {        // If not
                    $(this).hide();     // We hide the row
                }
            });
        });
    </script>
</body>

</html>