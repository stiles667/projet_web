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
</head>

<body>
    <audio id="audio" preload="auto" loop>
        <source src="ilyass (1).mp3" type="audio/mpeg">
        Your browser does not support the audio element.
      </audio>
      
      <script>
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
    <div class="container">
        <!-- <div class="icons">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218113.png" alt="Ballon de basket">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218472.png" alt="Lettres">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218484.png" alt="Globe terrestre">
            <img src="https://cdn-icons-png.flaticon.com/512/4058/4058331.png" alt="Fruit">
            <img src="https://cdn-icons-png.flaticon.com/512/5204/5204758.png" alt="Crayon">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218478.png" alt="Couleurs">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218493.png" alt="Loupe">
        </div> -->
        <div class="search">
            <h2>Mettez vos connaissances à l'épreuve en jouant ou en créant des quizz</h2>
            <div class="search-container2">
                <div id="search-icon">
                    <img src="https://img.icons8.com/fluency-systems-regular/256/search.png" alt="Rechercher">
                </div>
                <input id="search-box" class="searchBar" type="search" placeholder="Rechercher">
            </div>
        </div>
        <div class="categories">
        <?php 
        
        require ('bdconnexion.php');

        

        $sql = "SELECT * FROM quizz";
        $resultquizz = mysqli_query($conn, $sql);

        while($row=mysqli_fetch_assoc($resultquizz)) {
            $quizz_title = $row["Titre"];
            $id_quizz = $row["Id_quizz"];
            $quizz_category = $row["Categorie"];

            echo "<a href='quiz.php?role=$role&user=$id_user&id_quizz=$id_quizz' class='imgCategorie' data-category='$quizz_title' id='$id_quizz'>";
            echo "<h3 class='Name'>$quizz_title</h3>";
            switch ($quizz_category) {
                case "Sport":
                    echo "<img src='https://cdn-icons-png.flaticon.com/512/4218/4218113.png' alt='Sport'>";
                    break;
                case "Cinema":
                    echo "<img src='https://cdn-icons-png.flaticon.com/512/5198/5198228.png' alt='Cinéma'>";
                    break;
                case "Geographie":
                    echo "<img src='https://cdn-icons-png.flaticon.com/512/4218/4218484.png' alt='Géographie'>";
                    break;
                case "Histoire":
                    echo "<img src='https://cdn-icons-png.flaticon.com/512/4058/4058331.png' alt='Histoire'>";
                    break;
                case "Musique":
                    echo "<img src='https://cdn-icons-png.flaticon.com/512/5204/5204758.png' alt='Musique'>";
                    break;
                case "Sciences":
                    echo "<img src='https://icones8.fr/icon/0lUc5aQ86S3o/articles-de-laboratoire' alt='Sciences'>";
                    break;
                case "Art":
                    echo "<img src='https://cdn-icons-png.flaticon.com/512/4218/4218478.png' alt='Art'>";
                    break;
                case "Animal":
                    echo "<img src='https://cdn-icons-png.flaticon.com/512/8176/8176142.png' alt='Animal'>";
                    break;
                case "Anime":
                    echo "<img src='https://icones8.fr/icon/eWXAiv3hnUkS/adn-anime' alt='Anime'>";
                    break;
                default:
                    echo "<img src='https://icones8.fr/icon/ibngCF4waBaR/quiz' alt='Default'>";
                    break;
            }
            echo "</a>";
        }
        ?>
        </div>
        <script>
            // const elements = document.querySelectorAll('.imgCategorie');

            // elements.forEach(element => {
            //     const categorie = element.getAttribute('data-category');
            //     const id = element.getAttribute('id');
            //     console.log(id);
            //     console.log(categorie);
            // });
        </script>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="script.js"></script>
    <script>
        const searchBox = document.getElementById("search-box");

        searchBox.addEventListener("input", function () {
            const query = searchBox.value.toLowerCase();
            const allCategories = document.querySelectorAll(".imgCategorie");

            allCategories.forEach(function (category) {
                const title = category.getAttribute("data-category").toLowerCase();

                if (title.includes(query)) {
                    category.style.display = "flex";
                } else {
                    category.style.display = "none";
                }
            });
        });
    </script>
</body>

</html>