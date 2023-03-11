

<?php 

require ('bdconnexion.php');
$submit=isset($_POST['submit']);
$pseudo=($_POST['pseudo']);
$mdp=($_POST['password']);
$mdp2=($_POST['password2']);
$email=($_POST['email']);
$role=($_POST['role']);

$verifpseudo = mysqli_query($conn, "SELECT * FROM utilisateur WHERE pseudo = '$pseudo'");
$verifmail = mysqli_query($conn, "SELECT * FROM utilisateur WHERE email = '$email'");


$expression = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-z]{2,4}$/';


switch (true) {
    case (empty($pseudo) || empty($mdp) || empty($mdp2) || empty($email) || empty($role)):
        echo "Veuillez remplir tous les champs.";
        break;
    case (mysqli_num_rows($verifpseudo)):
        echo "Ce pseudo est déjà utilisé.";
        break;
    case (mysqli_num_rows($verifmail)):
        echo "Cet email est déjà utilisé.";
        break;
    case ($mdp != $mdp2):
        echo "Les mots de passe ne correspondent pas.";
        break;
    case (strlen($pseudo) < 3):
        echo "Votre pseudo est trop court.";
        break;
    case (!preg_match($expression, $email)):
        echo "L'email n'est pas valide. ";
        break;
    default:
        
    $query = "INSERT INTO `utilisateur`(`pseudo`, `email`, `password`, `role_utilisateur`) VALUES ('$pseudo','$email','$mdp','$role')";
    $result = mysqli_query($conn, $query);
    if($result){
        header('Location: login.html');
    }else{
        echo "Erreur d'inscription";}
    break;
}

?>
