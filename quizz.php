<?php 

require ('bdconnexion.php');

$submit=isset($_POST['submit']);



class Quizz1 {
    public $id;
    public $question;
    public $reponses = array();

    public function __construct($id, $question, $reponses) {
        $this->id = $id;
        $this->question = $question;
        $this->reponses = $reponses;
    }

    public function __toString() {
        return "Question " . $this->id . ": " . $this->question . "<br>";
    }

    public function getReponses() {
        return $this->reponses;
    }

    public function getReponse($index) {
        return $this->reponses[$index];
    }


    function Recup($conn) {
        for ($i = 1; $i <= 10; $i++) {
            $sql = "SELECT * FROM question WHERE Id_question = " . $i;
            $sql2 = "SELECT * FROM choix WHERE Id_question = " . $i;
            $result = mysqli_query($conn, $sql);
            $result2 = mysqli_query($conn, $sql2);
        
            if (mysqli_num_rows($result) > 0) {
                // Récupération des données de la question
                $row = mysqli_fetch_assoc($result);
                // $row2 = mysqli_fetch_assoc($result2);
                $id = $row["Id_question"];
                $question = $row["intituleQuestion"];
                
                
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    
                    $reponse = $row2["reponse"];
                    $reponses[] = $reponse;
                }
        
                // Traitement de la question
                // Par exemple, affichage de la question
                echo "Question " . $id . ": " . $question . "<br>";
                echo "Réponses:" . $reponse . "<br>";
                
                // foreach ($reponses as $index => $reponse) {
                    
                //     echo '<input type="radio" name="reponse_' . $id . '" value="' . $valeur . '"> ' . $reponse . '<br>';
                // }
        
                
            } else {
            echo "Question non trouvée pour l'id " . $i . "<br>";
            }
        }
    }
}

// Appel de la classe

$quizz1 = new Quizz1("Id_question", "intituleQuestion", array("reponse"));
$quizz1->Recup($conn);



//Transformation des données en JSON

$questions = array();
$reponses = array();



$questions = json_encode($questions);
$reponses = json_encode($reponses);






// Affichage des données en JSON

echo $questions;
echo $reponses;





