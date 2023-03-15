<?php

require('bdconnexion.php');

if (isset($_GET['user'])) {
    $id_user = $_GET['user'];
}

if (isset($_GET['role'])) {
    $role = $_GET['role'];
}

if (isset($_GET['updateId'])) {
    $updateId = $_GET['updateId'];
}

if (isset($_GET['updateRole'])) {
    $updateRole = $_GET['updateRole'];
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

            echo "<h2>$pseudo</h2>";
            echo "<a id='profil' href='dashboard.php?role=$role&user=$id_user'>";
            echo "<img src='https://cdn-icons-png.flaticon.com/512/149/149071.png' alt='Photo de profil'>";
            echo "</a>";
            ?>
        </div>
    </header>
    <div class="container-fluid">
        <?php
        $sqlutilisateur = "SELECT * FROM utilisateur WHERE Id_utilisateur = '$updateId'";
        $resultutilisateur = mysqli_query($conn, $sqlutilisateur);

        while ($row = mysqli_fetch_assoc($resultutilisateur)) {
            $id_utilisateur = $row['Id_utilisateur'];
            $pseudo_utilisateur = $row['pseudo'];
            $email_utilisateur = $row['email'];
            $password_utilisateur = $row['password'];
            $role_utilisateur = $row['role_utilisateur'];
        }
        ?>

        <h1>Modification de l'utilisateur <span><?php echo $pseudo_utilisateur ?></span></h1>
        <form method='post'>
            <div>
                <label for='name'>Nom d'utilisateur</label>
                <input type='text' name='pseudo' id='pseudo' value='<?php echo $pseudo_utilisateur ?>' required>
            </div>
            <div>
                <label for='Email'>Email</label>
                <input type='email' name='email' id='email' value='<?php echo $email_utilisateur ?>' required>
            </div>
            <div>
                <label for='password'>Mot de passe</label>
                <input type='password' name='password' id='password' value='<?php echo $password_utilisateur ?>' required>
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
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $pseudo = $_POST['pseudo'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $sql = "UPDATE utilisateur SET pseudo = '$pseudo', email = '$email', role_utilisateur = '$role' WHERE Id_utilisateur = '$updateId'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header('Location: dashboard.php?role='.$role.'&user='.$id_user.'');
            } else {
                echo "Une erreur est survenue";
            }
        }
        ?>
    </div>
</body>

</html>