<h1> Formulaire </h1>

<?php

$pseudo = $_POST['pseudo'];               // On récupère les données du formulaire (nom, email, message)
$role = $_POST['role'];


if (empty($pseudo)) {                  // On vérifie si les champs sont vides
    echo "Le pseudo est vide. <br>";
    
} else {            // Si le champ n'est pas vide, on affiche le nom
    echo "Bonjour $pseudo. <br>";
}

if (empty($role)) {                  // On vérifie si les champs sont vides
    echo "Le rôle est vide. <br>";
    
} else {            // Si le champ n'est pas vide, on affiche le nom
    echo "Vous êtes $role. <br>";
}





