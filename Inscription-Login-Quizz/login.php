<?php

require('bdconnexion.php');

$pseudo = $_POST['pseudo'];
$password = $_POST['password'];
$email = $_POST['email'];


// Check connection
if (!$conn) { 
    echo "Connection failed! : " . mysqli_connect_error(); 
} else {
    echo "Connection successful!";}

// Check if pseudo, password and email are in the database
$sql = "SELECT * FROM utilisateur WHERE pseudo = '$pseudo' AND mdp = '$password' AND email = '$email'";
$result = mysqli_query($conn, $sql);

// If the user is in the database, redirect to the home page
if (mysqli_num_rows($result) > 0) {
    echo "You are logged in!";
    header('Location: home.html');
    
} else {
    // NE PAS OUBLIER DE FAIRE LE MESSAGE D'ERREUR LORS DE MAUVAIS PSEUDO, MDP, EMAIL.
    $errorMessage = 'Nom d\'utilisateur ou mot de passe incorrect';
}



mysqli_close($conn);

// If the user is not in the database, display a message "wrong pseudo or mail or password" in the redirection of the login page
 if (mysqli_num_rows($result) == 0) {
     header('Location: loginerreur.html');
 }

?> -->
