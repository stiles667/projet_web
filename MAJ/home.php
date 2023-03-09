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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
        integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <link href='https://css.gg/search.css' rel='stylesheet'>
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
            <!-- <a href="" class="imgCategorie" data-category="Sport" >
                <h3 class="Name">Sport</h3>
                <img src="https://cdn-icons-png.flaticon.com/512/4218/4218113.png" alt="Sport">
            </a>
            <a href="quiz.html" class="imgCategorie" data-category="Cinéma" id="2">
                <h3 class="Name">Cinéma</h3>
                
                <img src="https://cdn-icons-png.flaticon.com/512/5198/5198228.png" alt="Cinéma">
            </a>
            <a href="quiz.html" class="imgCategorie" data-category="Géographie">
                <h3 class="Name">Géographie</h3>
                <img src="https://cdn-icons-png.flaticon.com/512/4218/4218484.png" alt="Géographie">
            </a>
            <a href="quiz.html" class="imgCategorie" data-category="Animal">
                <h3 class="Name">Animal</h3>
                <img src="https://cdn-icons-png.flaticon.com/512/8176/8176142.png" alt="Animal">
            </a>
            <a href="quiz.html" class="imgCategorie" data-category="Maths">
                <h3 class="Name">Maths</h3>
                <img src="https://cdn-icons-png.flaticon.com/512/5197/5197954.png" alt="Maths">
            </a>
            <a href="quiz.html" class="imgCategorie" data-category="Vocabulaire">
                <h3 class="Name">Vocabulaire</h3>
                <img src="https://cdn-icons-png.flaticon.com/512/4218/4218472.png" alt="Vocabulaire">
            </a>
            <a href="quiz.html" class="imgCategorie" data-category="Gastronomie">
                <h3 class="Name">Gastronomie</h3>
                <img src="https://cdn-icons-png.flaticon.com/512/4058/4058331.png" alt="Gastronomie">
            </a>
            <a href="quiz.html" class="imgCategorie" data-category="Célébrité">
                <h3 class="Name">Célébrité</h3>
                <img src="https://cdn-icons-png.flaticon.com/512/5197/5197853.png" alt="Célébrité">
            </a>
            <a href="quiz.html" class="imgCategorie" data-category="Arts">
                <h3 class="Name">Arts</h3>
                <img src="https://cdn-icons-png.flaticon.com/512/4218/4218478.png" alt="Arts">
            </a>
            <a href="quiz.html" class="imgCategorie" data-category="Musique">
                <h3 class="Name">Musique</h3>
                <img src="https://cdn-icons-png.flaticon.com/512/5198/5198104.png" alt="Musique">
            </a>
            <a href="quiz.html" class="imgCategorie" data-category="Culture">
                <h3 class="Name">Culture</h3>
                <img src="https://cdn-icons-png.flaticon.com/512/3962/3962505.png" alt="Culture">
            </a>
            <a href="quiz.html" class="imgCategorie" data-category="Espace">
                <h3 class="Name">Espace</h3>
                <img src="https://cdn-icons-png.flaticon.com/512/4663/4663555.png" alt="Espace">
            </a> -->
        </div>
        <script>
            // Récupération de tous les éléments avec la classe "imgCategorie"
            const elements = document.querySelectorAll('.imgCategorie');
            
            // Parcours de chaque élément
            elements.forEach(element => {
                // Récupération de la valeur de l'attribut "data-category"
                const categorie = element.getAttribute('data-category');
                const id = element.getAttribute('id');
                console.log(id);
                console.log(categorie);
            });




        </script>
    </div>
    <!-- <footer>
        <ul>
            <li><a href="#">À propos</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Conditions d'utilisation</a></li>
        </ul>
        <p>&copy; Quizzeo 2023</p>
    </footer> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="script.js"></script>
</body>

</html>