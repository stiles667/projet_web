<?php

require ('bdconnexion.php');

if(isset($_GET['user'])) {
    $id_user = $_GET['user'];
}

if(isset($_GET['role'])) {
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
    <link rel="stylesheet" href="home.css">
    <title>Quizzeo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
    <audio id="audio" preload="auto" loop>             
        <source src="ilyass (1).mp3" type="audio/mpeg">
        Your browser does not support the audio element.
      </audio>
      
      <script>         //play audio home
        document.addEventListener('DOMContentLoaded', () => {
          const audio = document.querySelector('#audio');
          audio.play();
        });
      </script>
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
        <div class="search">
            <h2>Mettez vos connaissances à l'épreuve en jouant ou en créant des quiz</h2>
            <div class="search-container" class="container-fluid">
                <div id="search-icon">
                    <img src="https://img.icons8.com/fluency-systems-regular/256/search.png" alt="Rechercher">
                </div>
                <input id="search-box" class="searchBar" type="search" placeholder="Rechercher">
            </div>
        </div>
        <div class="categories">
        <?php
            $sql = "SELECT * FROM quizz";
            $resultquizz = mysqli_query($conn, $sql);

            while($row=mysqli_fetch_assoc($resultquizz)) {
                $quizz_title = $row["Titre"];
                $id_quizz = $row["Id_quizz"];
                $quizz_category = $row["Categorie"];

                echo "<a href='quiz.php?role=$role&user=$id_user&id_quizz=$id_quizz' class='imgCategorie' data-category='$quizz_title' id='$id_quizz'>";
                echo "<h3 class='Name'>$quizz_title</h3>";

                echo "<img src='$quizz_category' alt='Image'>";
 
                echo "</a>";       
                echo "<a href='quiz.php?role=$role&user=$id_user&id_quizz=$id_quizz' class='imgCategorie' data-category='$quizz_title' id='$id_quizz'>";
                echo "<h3 class='Name'>$quizz_title</h3>";

                echo "<img src='$quizz_category' alt='Image'>";
 
                echo "</a>";       
                echo "<a href='quiz.php?role=$role&user=$id_user&id_quizz=$id_quizz' class='imgCategorie' data-category='$quizz_title' id='$id_quizz'>";
                echo "<h3 class='Name'>$quizz_title</h3>";

                echo "<img src='$quizz_category' alt='Image'>";
 
                echo "</a>";       
                echo "<a href='quiz.php?role=$role&user=$id_user&id_quizz=$id_quizz' class='imgCategorie' data-category='$quizz_title' id='$id_quizz'>";
                echo "<h3 class='Name'>$quizz_title</h3>";

                echo "<img src='$quizz_category' alt='Image'>";
 
                echo "</a>";       
                echo "<a href='quiz.php?role=$role&user=$id_user&id_quizz=$id_quizz' class='imgCategorie' data-category='$quizz_title' id='$id_quizz'>";
                echo "<h3 class='Name'>$quizz_title</h3>";

                echo "<img src='$quizz_category' alt='Image'>";
 
                echo "</a>";       
            }
            
        ?>
        </div>
    </div>
    <script>
        $("#search-box").on("input", function () {
            const query = $(this).val().toLowerCase();
            $(".imgCategorie").each(function() {
                const title = $(this).data("category").toLowerCase();

                if (title.includes(query)) {
                    $(this).css("display", "initial");
                } else {
                    $(this).css("display", "none");
                }
            });
        });
    </script>
</body>

</html>