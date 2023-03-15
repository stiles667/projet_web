<?php 

require ('bdconnexion.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://img.icons8.com/sf-black/64/000000/search.png">
    <link rel="stylesheet" href="inscription.css">
    <title>Quizzeo</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
    <header>
        <a class="home" href="accueil.html">
            <span>Quiz</span><span>zeo.</span>
        </a>
    </header>
    <div class="container">
        <div class="icons">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218472.png" alt="Lettres">
            <img src="https://cdn-icons-png.flaticon.com/512/4058/4058331.png" alt="Fruit">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218113.png" alt="Ballon de basket">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218478.png" alt="Couleurs">
            <img src="https://cdn-icons-png.flaticon.com/512/5204/5204758.png" alt="Crayon">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218493.png" alt="Loupe">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218484.png" alt="Globe terrestre">
        </div>
        <div class="container-login">
            <div class="imgLogin">
                <h1>Compte</h1>
            </div>
            <?php

            if(isset($_POST['submit'])) {           //Get the values from the form
                $pseudo = $_POST["pseudo"];     
                $email = $_POST["email"];

                $password = $_POST["password"];
                $uppercase = preg_match('@[A-Z]@', $password);  
                $lowercase = preg_match('@[a-z]@', $password);
                $number = preg_match('@[0-9]@', $password);
                $special = preg_match('@[^\w]@', $password);

                $confirm_password = $_POST["confirm-password"];
                $role = $_POST["role"];

                $verifpseudo = mysqli_query($conn, "SELECT * FROM utilisateur WHERE pseudo = '$pseudo'");    //Check if the pseudo is already used
                $verifmail = mysqli_query($conn, "SELECT * FROM utilisateur WHERE email = '$email'");   //Check if the email is already used


                $expression = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-z]{2,4}$/';        //Check if the email is valid

                switch (true) {
                    case (strlen($pseudo) < 3):         //Check if the pseudo is valid
                        echo "<h2>Votre pseudo est trop court</h2>";
                        break; 
                    case (mysqli_num_rows($verifpseudo)):       //Check if the pseudo is already used
                        echo "<h2>Ce pseudo est déjà utilisé</h2>";
                        break;
                    case (!preg_match($expression, $email)):        //Check if the email is valid
                        echo "<h2>L'email n'est pas valide</h2>";
                        break;
                    case (mysqli_num_rows($verifmail)):     //Check if the email is already used
                        echo "<h2>Cet email est déjà utilisé</h2>";
                        break;
                    case ($password != $confirm_password):      //Check if the password and the confirm password are the same
                        echo "<h2>Les mots de passe ne correspondent pas</h2>";
                        break;
                    case (!$uppercase || !$lowercase || !$number || !$special || strlen($password) < 8):    //Check if the password is valid
                        echo "<h2>Votre mot de passe doit comporter au moins huit caractères, avec au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial</h2>";
                        break;
                    default:
                        
                    //Insert the user in the database
                    $query = "INSERT INTO `utilisateur`(`pseudo`, `email`, `password`, `role_utilisateur`) VALUES ('$pseudo','$email','$password','$role')";
                    $result = mysqli_query($conn, $query);
                    if($result){        //If the user is inserted in the database, redirect to the login page
                        header('Location: login.php');  
                    }else{      //If the user is not inserted in the database, display an error message
                        echo "Erreur d'inscription";}
                    break;
                }
            }
            ?>
            <form method="post">
                <input type="text" name="pseudo" placeholder="Nom d'utilisateur" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <input type="password" name="confirm-password" placeholder="Confirmer le mot de passe" required>
                <select name="role" id="role">
                    <option value="1">Utilisateur</option>
                    <option value="2">Quizzeur</option>
                </select>
                <input class="submit" type="submit" name="submit" value="Continuer">
                <div class="other">
                    <div>
                        <span>Tu as déjà un compte ?</span>
                        <a href="login.php">Se connecter</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>