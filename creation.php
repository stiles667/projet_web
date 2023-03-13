<?php 
require('bdconnexion.php');

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
    <link rel="stylesheet" href="creation.css">
    <title>Quizzeo</title>
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
                $email = $row['email'];
                $id_utilisateur = $row['Id_utilisateur'];

                echo "<h2>$pseudo</h2>";
                echo "<a id='profil' href='dashboard.php?role=$role&user=$id_user'>";
                echo "<img src='https://cdn-icons-png.flaticon.com/512/149/149071.png' alt='Photo de profil'>";
                echo "</a>";

            ?>
        </div>
    </header>
    <div class="container">
        <div class="info-container">
            <h1>Création de quiz</h1>
            <img src="https://img.icons8.com/color/256/add-folder.png">
        </div>
        <div id="pageCreate">
            <form action="" method="post">
                <div class="info-container">
                    <input class="input-quiz" type="text" placeholder="Titre" maxlength="15" required>
                    <!-- <input class="input-quiz" type="text" placeholder="Titre" maxlength="20" required
                        oninvalid="this.style.border='2px solid #ff5f45';"> -->
                    <h2>Difficulté</h2>
                    <select name="role" class="input-quiz difficulty" placeholder="aze" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div class="container-question">
                    <div class="question">
                        <div class="bar"></div>
                        <div class="question2">
                            <div class="number">
                                <h3>1</h3>
                            </div>
                            <h3>Question</h3>
                            <input type="text" id="textarea" placeholder="Quel est la couleur du cheval blanc de Henri IV ?">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="answer1" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="answer2" required>
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="answer3" required>
                            </div>
                            <div>
                                <label for="answer4" class="letter">D</label>
                                <input type="text" name="answer4" required>
                            </div>
                            <div class="check">
                                <img src="https://img.icons8.com/fluency/256/checkmark.png">
                                <label for="correctAnswer">Sélectionner la bonne réponse</label>
                                <select name="correctAnswer" id="correctAnswer">
                                    <option value="answer1">A</option>
                                    <option value="answer2">B</option>
                                    <option value="answer3">C</option>
                                    <option value="answer4">D</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-question">
                <div class="question">
                        <div class="bar"></div>
                        <div class="question2">
                            <div class="number">
                                <h3>2</h3>
                            </div>
                            <h3>Question</h3>
                            <input type="text" id="textarea" placeholder="Quel est la couleur du cheval blanc de Henri IV ?">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="answer1" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="answer2" required>
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="answer3" required>
                            </div>
                            <div>
                                <label for="answer4" class="letter">D</label>
                                <input type="text" name="answer4" required>
                            </div>
                            <div class="check">
                                <img src="https://img.icons8.com/fluency/256/checkmark.png">
                                <label for="correctAnswer">Sélectionner la bonne réponse</label>
                                <select name="correctAnswer" id="correctAnswer">
                                    <option value="answer1">A</option>
                                    <option value="answer2">B</option>
                                    <option value="answer3">C</option>
                                    <option value="answer4">D</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-question">
                <div class="question">
                        <div class="bar"></div>
                        <div class="question2">
                            <div class="number">
                                <h3>3</h3>
                            </div>
                            <h3>Question</h3>
                            <input type="text" id="textarea" placeholder="Quel est la couleur du cheval blanc de Henri IV ?">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="answer1" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="answer2" required>
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="answer3" required>
                            </div>
                            <div>
                                <label for="answer4" class="letter">D</label>
                                <input type="text" name="answer4" required>
                            </div>
                            <div class="check">
                                <img src="https://img.icons8.com/fluency/256/checkmark.png">
                                <label for="correctAnswer">Sélectionner la bonne réponse</label>
                                <select name="correctAnswer" id="correctAnswer">
                                    <option value="answer1">A</option>
                                    <option value="answer2">B</option>
                                    <option value="answer3">C</option>
                                    <option value="answer4">D</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-question">
                <div class="question">
                        <div class="bar"></div>
                        <div class="question2">
                            <div class="number">
                                <h3>4</h3>
                            </div>
                            <h3>Question</h3>
                            <input type="text" id="textarea" placeholder="Quel est la couleur du cheval blanc de Henri IV ?">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="answer1" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="answer2" required>
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="answer3" required>
                            </div>
                            <div>
                                <label for="answer4" class="letter">D</label>
                                <input type="text" name="answer4" required>
                            </div>
                            <div class="check">
                                <img src="https://img.icons8.com/fluency/256/checkmark.png">
                                <label for="correctAnswer">Sélectionner la bonne réponse</label>
                                <select name="correctAnswer" id="correctAnswer">
                                    <option value="answer1">A</option>
                                    <option value="answer2">B</option>
                                    <option value="answer3">C</option>
                                    <option value="answer4">D</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-question">
                <div class="question">
                        <div class="bar"></div>
                        <div class="question2">
                            <div class="number">
                                <h3>5</h3>
                            </div>
                            <h3>Question</h3>
                            <input type="text" id="textarea" placeholder="Quel est la couleur du cheval blanc de Henri IV ?">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="answer1" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="answer2" required>
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="answer3" required>
                            </div>
                            <div>
                                <label for="answer4" class="letter">D</label>
                                <input type="text" name="answer4" required>
                            </div>
                            <div class="check">
                                <img src="https://img.icons8.com/fluency/256/checkmark.png">
                                <label for="correctAnswer">Sélectionner la bonne réponse</label>
                                <select name="correctAnswer" id="correctAnswer">
                                    <option value="answer1">A</option>
                                    <option value="answer2">B</option>
                                    <option value="answer3">C</option>
                                    <option value="answer4">D</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-question">
                <div class="question">
                        <div class="bar"></div>
                        <div class="question2">
                            <div class="number">
                                <h3>6</h3>
                            </div>
                            <h3>Question</h3>
                            <input type="text" id="textarea" placeholder="Quel est la couleur du cheval blanc de Henri IV ?">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="answer1" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="answer2" required>
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="answer3" required>
                            </div>
                            <div>
                                <label for="answer4" class="letter">D</label>
                                <input type="text" name="answer4" required>
                            </div>
                            <div class="check">
                                <img src="https://img.icons8.com/fluency/256/checkmark.png">
                                <label for="correctAnswer">Sélectionner la bonne réponse</label>
                                <select name="correctAnswer" id="correctAnswer">
                                    <option value="answer1">A</option>
                                    <option value="answer2">B</option>
                                    <option value="answer3">C</option>
                                    <option value="answer4">D</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-question">
                <div class="question">
                        <div class="bar"></div>
                        <div class="question2">
                            <div class="number">
                                <h3>7</h3>
                            </div>
                            <h3>Question</h3>
                            <input type="text" id="textarea" placeholder="Quel est la couleur du cheval blanc de Henri IV ?">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="answer1" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="answer2" required>
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="answer3" required>
                            </div>
                            <div>
                                <label for="answer4" class="letter">D</label>
                                <input type="text" name="answer4" required>
                            </div>
                            <div class="check">
                                <img src="https://img.icons8.com/fluency/256/checkmark.png">
                                <label for="correctAnswer">Sélectionner la bonne réponse</label>
                                <select name="correctAnswer" id="correctAnswer">
                                    <option value="answer1">A</option>
                                    <option value="answer2">B</option>
                                    <option value="answer3">C</option>
                                    <option value="answer4">D</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-question">
                <div class="question">
                        <div class="bar"></div>
                        <div class="question2">
                            <div class="number">
                                <h3>8</h3>
                            </div>
                            <h3>Question</h3>
                            <input type="text" id="textarea" placeholder="Quel est la couleur du cheval blanc de Henri IV ?">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="answer1" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="answer2" required>
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="answer3" required>
                            </div>
                            <div>
                                <label for="answer4" class="letter">D</label>
                                <input type="text" name="answer4" required>
                            </div>
                            <div class="check">
                                <img src="https://img.icons8.com/fluency/256/checkmark.png">
                                <label for="correctAnswer">Sélectionner la bonne réponse</label>
                                <select name="correctAnswer" id="correctAnswer">
                                    <option value="answer1">A</option>
                                    <option value="answer2">B</option>
                                    <option value="answer3">C</option>
                                    <option value="answer4">D</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-question">
                <div class="question">
                        <div class="bar"></div>
                        <div class="question2">
                            <div class="number">
                                <h3>9</h3>
                            </div>
                            <h3>Question</h3>
                            <input type="text" id="textarea" placeholder="Quel est la couleur du cheval blanc de Henri IV ?">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="answer1" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="answer2" required>
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="answer3" required>
                            </div>
                            <div>
                                <label for="answer4" class="letter">D</label>
                                <input type="text" name="answer4" required>
                            </div>
                            <div class="check">
                                <img src="https://img.icons8.com/fluency/256/checkmark.png">
                                <label for="correctAnswer">Sélectionner la bonne réponse</label>
                                <select name="correctAnswer" id="correctAnswer">
                                    <option value="answer1">A</option>
                                    <option value="answer2">B</option>
                                    <option value="answer3">C</option>
                                    <option value="answer4">D</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-question">
                <div class="question">
                        <div class="bar"></div>
                        <div class="question2">
                            <div class="number">
                                <h3>10</h3>
                            </div>
                            <h3>Question</h3>
                            <input type="text" id="textarea" placeholder="Quel est la couleur du cheval blanc de Henri IV ?">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="answer1" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="answer2" required>
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="answer3" required>
                            </div>
                            <div>
                                <label for="answer4" class="letter">D</label>
                                <input type="text" name="answer4" required>
                            </div>
                            <div class="check">
                                <img src="https://img.icons8.com/fluency/256/checkmark.png">
                                <label for="correctAnswer">Sélectionner la bonne réponse</label>
                                <select name="correctAnswer" id="correctAnswer">
                                    <option value="answer1">A</option>
                                    <option value="answer2">B</option>
                                    <option value="answer3">C</option>
                                    <option value="answer4">D</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <input id="button-submit" type="submit" value="Créer">
            </form>
        </div>
    </div>
    <script src="script.js"></script>
    <script>
        $(".arrow").click(function () {

        var $containerAnswer = $(this).closest(".container-question").find(".container-answer");
        var $containerBar = $(this).closest(".container-question").find(".bar");
        
        if ($containerAnswer.height() > 0) {
            $containerAnswer.height(0);
            $containerBar.height(60);
        } else {
            $containerAnswer.height(
                $containerAnswer.prop("scrollHeight") + "px"
            );
            $containerBar.height(
                $containerBar.prop("scrollHeight") + "px"
            );
        }
        });

        $(".arrow").click(function () {
            $(this).toggleClass("rotate");
        });
    </script>
</body>

</html>