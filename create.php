<?php

require('bdconnexion.php');

if(isset($_GET['user'])) {
    $id_user = $_GET['user'];
}

if(isset($_GET['role'])) {
    $role_user = $_GET['role'];
}

switch ($role_user) {
    case "1":
        $role_user = "Utilisateur";
        break;
    case "2":
        $role_user = "Quizzeur";
        break;
    case "3":
        $role_user = "Administrateur";
        break;
}

$pseudo ="";
$email ="";
$password ="";
$role ="";

$errorMessage = "";
$successMessage = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo = $_POST["pseudo"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    
    if (empty($pseudo) || empty($email) || empty($password) || empty($role)) {
        $errorMessage = "Veuillez remplir tous les champs";
    } else {
        
        
        if (!$conn) {
            $errorMessage = "Erreur de connexion : ".mysqli_connect_error();
        } else {
            
            $pseudo = mysqli_real_escape_string($conn, $pseudo);
            $email = mysqli_real_escape_string($conn, $email);
            $password = mysqli_real_escape_string($conn, $password);
            $role = mysqli_real_escape_string($conn, $role);
            
            $sql = "INSERT INTO `utilisateur`(`pseudo`, `email`, `password`, `role_utilisateur`) VALUES ('$pseudo','$email','$password','$role')";
            $result = mysqli_query($conn, $sql);
 
            if (!$result) {
                $errorMessage = "Erreur lors de l'ajout de l'utilisateur : ".mysqli_error($conn);
            } else {
                

                $successMessage = "Utilisateur ajouté avec succès";

                

                header("Location: dashboard.php?role=$role_user&user=$id_user");
                exit;
            }
            mysqli_close($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://img.icons8.com/sf-black/64/000000/search.png">
    <link rel="stylesheet" href="updateuser.css">
    <title>Quizzeo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
    <header>
        <?php
        echo "<a class='home' href='home.php?role=$role_user&user=$id_user'>";
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

            echo "<h2>$pseudo</h2>";
            echo "<a id='profil' href='dashboard.php?role=$role_user&user=$id_user'>";
            echo "<img src='https://cdn-icons-png.flaticon.com/512/149/149071.png' alt='Photo de profil'>";
            echo "</a>";
            ?>
        </div>
    </header>
    <div class="container my-5">
        <h2>Ajout d'un nouvel utilisateur</h2>

        <?php 
            if (!empty($errorMessage)) {
                echo "
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>$errorMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                    ";
            } 
        ?>

        <form method="post">
            <div>
                <label for='name'>Nom d'utilisateur</label>
                <input type='text' name='pseudo' id='pseudo' value='<?php echo $pseudo?>' required>
            </div>
            <div>
                <label for='Email'>Email</label>
                <input type='email' name='email' id='email' value='<?php echo $email?>' required>
            </div>
            <div>
                <label for='password'>Mot de passe</label>
                <input type='password' name='password' id='password' value='<?php echo $password?>' required>
            </div>
            <div>
                <label for='role'>Role</label>
                <select name='role' id='role'>
                    <option value='1'>Utilisateur</option>
                    <option value='2'>Quizzeur</option>
                    <option value='3'>Administrateur</option>
                </select>
            </div>
            <div>
                <input type='submit' name='submit' value="Modifier">
            </div>
            <?php 
                if (!empty($successMessage)) {
                    echo "
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                        ";
                }
            ?>
        </form>
    </div>
</body>
</html>