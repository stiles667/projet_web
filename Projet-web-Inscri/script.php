<h1> Formulaire </h1>

<?php

$pseudo = $_POST['pseudo'];               // On récupère les données du formulaire 
$mdp = $_POST['mdp'];
$caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';        // Caractères possibles
$role = $_POST['role'];



if (empty($pseudo)) {                  // On vérifie si les champs sont vides
    echo "Le pseudo est vide. <br>";
    
} else {            // Si le champ n'est pas vide, on affiche le nom
    echo "Bonjour $pseudo. <br>";
}

if (empty($mdp)) {                  // On vérifie si les champs sont vides
    echo "Le mot de passe est vide. <br>";
    
} else {            // Si le champ n'est pas vide, on affiche le nom
    echo "Votre mot de passe a bien été enregistré. <br>";
}

if ($pseudo == "admin" && $mdp == "admin") {
    $role = "administrateur";
    echo "Vous êtes $role. <br>";
    echo "Vous êtes connecté en tant qu'administrateur.";
    
} else if (empty($role)) {                  // On vérifie si les champs sont vides
    echo "Le rôle est vide. <br>";
    
} else {            // Si le champ n'est pas vide, on affiche le nom
    echo "Vous êtes $role. <br>";
}

?>



