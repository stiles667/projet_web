<?php 

require ('bdconnexion.php');

$submit=isset($_POST['submit']);


class Quizz {
    public $id;
    public $idquizz;
    public $question;
    public $reponses = array();

    public function __construct($id, $idquizz, $question, $reponses) {
        $this->id = $id;
        $this->idquizz = $idquizz;
        $this->question = $question;
        $this->reponses = $reponses;
    }


    public function getReponses() {
        return $this->reponses;
    }

    public function getReponse($index) {
        return $this->reponses[$index];
    }

    // function Recup($conn, $reponses) {
    //     $quizzlist = "SELECT * FROM quizz";
    //     $resultquizz = mysqli_query($conn, $quizzlist);
    //     while($row=mysqli_fetch_assoc($resultquizz)) {
    //         $quizz_title = $row["Titre"];
    //         $id_quizz = $row["Id_quizz"];
    //         $difficulte = $row["difficulte"];

    //         $quizz_data = array();
    //         $quizz_data[] = [
    //             'Id_quizz' => $id_quizz,
    //             'Titre_quizz' => $quizz_title,
    //             'Difficulte' => $difficulte
    //         ];


            
    //         foreach ($quizz_data as $quizz) {
    //             $id_quizz = $quizz['Id_quizz'];
    //             $quizz_title = $quizz['Titre_quizz'];
    //             $difficulte = $quizz['Difficulte'];


    //             echo '<div><h3>' . $quizz_title ." - ". 'Difficulté : ' . $difficulte . '</h3>';
    //             echo '<button onclick="toggle_quizz(' . $id_quizz . ')">Afficher</button><br><br>';
    //             echo '<div id="quizz' . $id_quizz . '" style="display:none;">';
    //         }
            

            
            
    
    //         $sql_questions = "SELECT * FROM `question` WHERE Id_quizz = " . $id_quizz;
    //         $result_questions = mysqli_query($conn, $sql_questions);
    
    //         if (mysqli_num_rows($result_questions) > 0) {
    //             while ($row_question = mysqli_fetch_assoc($result_questions)) {
    //                 $id_question = $row_question["Id_question"];
    //                 $question = $row_question["question"];
    //                 echo "Question " . $id_question . ": " . $question . "<br>";
    
    //                 $sql_reponses = "SELECT * FROM choix WHERE Id_question = " . $id_question;
    //                 $result_reponses = mysqli_query($conn, $sql_reponses);
    
    //                 if (mysqli_num_rows($result_reponses) > 0) {
    //                     while ($row_reponse = mysqli_fetch_assoc($result_reponses)) {
    //                         $reponses = array(
    //                             'reponse1' => $row_reponse['rep1'],
    //                             'reponse2' => $row_reponse['rep2'],
    //                             'reponse3' => $row_reponse['rep3'],
    //                             'Bonne_reponse' => $row_reponse['Bonne_reponse']
    //                         );
    //                         foreach ($reponses as $index => $reponse) {
    //                             echo '<input type="radio" name="question' . $id_question . '" value="' . $index . '"> ' . $reponse . '<br>' . "\n";
    //                         }
    //                     }
    //                 } else {
    //                     echo "Réponses non trouvées pour l'id_question " . $id_question . "<br>";
    //                 }
    //             }
            
    //         } else {
    //             echo "Question non trouvée pour l'id_quizz " . $id_quizz . "<br>";
    //         }
    //     }
    // }
    public function Recup($conn) {
        $quizzlist = "SELECT * FROM quizz";             // Récupération des titres de quizz dans la base de données
        $resultquizz = mysqli_query($conn, $quizzlist);        // Exécution de la requête
    
        // Boucle pour afficher chaque titre de quizz avec un bouton
        while($row=mysqli_fetch_assoc($resultquizz)) {
            $quizz_title = $row["Titre"];
            $id_quizz = $row["Id_quizz"];
    
            echo '<div><h3>' . $quizz_title . '</h3>';
            echo '<button onclick="affichage_quizz(' . $id_quizz . ')">Afficher</button><br><br>';
            echo '<div id="quizz' . $id_quizz . '" style="display:none;">';
    
            $sql_questions = "SELECT * FROM `question` WHERE Id_quizz = " . $id_quizz;          // Récupération des questions à partir des id_quizz
            $result_questions = mysqli_query($conn, $sql_questions);                // Exécution de la requête
            
            // Boucle pour afficher chaque question
            if (mysqli_num_rows($result_questions) > 0) {

                $num_question = 1;      
                while ($row_question = mysqli_fetch_assoc($result_questions)) {         
                    $id_question = $row_question["Id_question"];        // Récupération de l'id de la question
                    $question = $row_question["question"];        // Récupération de la question
                    
                    echo "Question " . $num_question . ": " . $question . "<br>";       // Affichage de la question
                    $num_question++;        // Incrémentation du numéro de la question

                    if ($num_question > 10) {       // Si le numéro de la question est supérieur à 10, on remet à 1
                        $num_question = 1;
                    }
    
                    $sql_reponses = "SELECT * FROM choix WHERE Id_question = " . $id_question;          // Récupération des réponses à partir des id_question
                    $result_reponses = mysqli_query($conn, $sql_reponses);          // Exécution de la requête
    
                    if (mysqli_num_rows($result_reponses) > 0) {

                        while ($row_reponse = mysqli_fetch_assoc($result_reponses)) {       // Boucle pour afficher chaque réponse
                            $reponses = array(
                                'reponse1' => $row_reponse['rep1'],
                                'reponse2' => $row_reponse['rep2'],
                                'reponse3' => $row_reponse['rep3'],
                                'Bonne_reponse' => $row_reponse['Bonne_reponse']
                            );
                            foreach ($reponses as $index => $reponse) {         // Affichage des réponses avec un bouton radio pour chaque réponse
                                echo '<input type="radio" name="question' . $id_question . '" value="' . $index . '"> ' . $reponse . '<br>' . "\n";
                            }
                        }
                    } else {    // Si aucune réponse n'est trouvée, on affiche un message d'erreur
                        echo "Réponses non trouvées pour l'id_question " . $id_question . "<br>";
                    }
                }
    
            } else {        // Si aucune question n'est trouvée, on affiche un message d'erreur
                echo "Question non trouvée pour l'id_quizz " . $id_quizz . "<br>";
            }
    
            echo '</div></div>';
        }
    }
}


// Appel de la classe
$quizz = new Quizz("Id_question", "Id_quizz", "intituleQuestion", "reponse");
$reponses = $quizz->getReponses();
$quizz->Recup($conn);


?>

<html>  
<script>
function affichage_quizz(quizz_id) {       // Fonction pour afficher ou cacher les questions
    var quizz = document.getElementById('quizz' + quizz_id);        // Récupération de l'id du quizz
    if (quizz.style.display === 'none') {           // Si le quizz est caché, on l'affiche
        quizz.style.display = 'block';              
    } else {                            // Sinon, on le cache
        quizz.style.display = 'none';
    }
}
</script>
</html>