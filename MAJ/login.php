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
$sql = "SELECT * FROM utilisateur WHERE pseudo = '$pseudo' AND password = '$password' AND email = '$email'";
$result = mysqli_query($conn, $sql);
$sql2 = "SELECT role_utilisateur FROM utilisateur WHERE pseudo = '$pseudo' AND password = '$password' AND email = '$email'";
$result2 = mysqli_query($conn, $sql2);
$sql3 = "SELECT Id_utilisateur FROM utilisateur WHERE pseudo = '$pseudo' AND password = '$password' AND email = '$email'";
$result3 = mysqli_query($conn, $sql3);


// If the user is in the database, redirect to the home page
if (mysqli_num_rows($result) > 0) {
    // echo "Vous êtes connecté !";
    $row = mysqli_fetch_assoc($result2);
    $role = $row['role_utilisateur'];
    $row2 = mysqli_fetch_assoc($result3);
    $id_user = $row2['Id_utilisateur'];
    switch ($role) {
        case '1':
            $role = "Utilisateur";
            header('Location: home.php?role='.$role.'&user='.$id_user.'');
            break;
        case '2':
            $role = "Quizzeur";
            header('Location: home.php?role='.$role.'&user='.$id_user.'');
            break;
        case '3':
            $role = "Administrateur";
            header('Location: dashboard.php?role='.$role.'&user='.$id_user.'');
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
    header('Location: login.html');
 }

?>
