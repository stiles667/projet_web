<?php

require('bdconnexion.php');

$pseudo = $_POST['pseudo'];
$password = $_POST['password'];
$email = $_POST['email'];
$role = "";


// Check connection
if (!$conn) { 
    echo "Connection failed! : " . mysqli_connect_error(); 
} else {
    echo "Connection successful!";}

// Check if pseudo, password and email are in the database
$sql = "SELECT * FROM utilisateur WHERE pseudo = '$pseudo' AND password = '$password' AND email = '$email'";
$result = mysqli_query($conn, $sql);
$sql2 = "SELECT role_utilisateur FROM utilisateur WHERE pseudo = '$pseudo' AND password = '$password' AND email = '$email'";
$result2 = mysqli_query($conn, $sql2);

// If the user is in the database, redirect to the home page
if (mysqli_num_rows($result) > 0) {
    echo "Vous êtes connecté !";
    $row = mysqli_fetch_assoc($result2);
    $role = $row['role_utilisateur'];
    switch ($role) {
        case '1':
            $role = "Utilisateur";
            header('Location: panel.html');
            break;
        case '2':
            $role = "Quizzeur";
            header('Location: panel.html');
            break;
        case '3':
            $role = "Administrateur";
            header('Location: panel.html');
            break;
        default :
            echo "Erreur de connexion";
            break;
    }
    

} else {
    // NE PAS OUBLIER DE FAIRE LE MESSAGE D'ERREUR LORS DE MAUVAIS PSEUDO, MDP, EMAIL.
    $errorMessage = 'Nom d\'utilisateur ou mot de passe incorrect';
}



mysqli_close($conn);

// If the user is not in the database, display a message "wrong pseudo or mail or password" in the redirection of the login page
 if (mysqli_num_rows($result) == 0) {
     header('Location: loginerreur.html');
 }

?>
