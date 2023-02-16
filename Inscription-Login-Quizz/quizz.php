<?php 

require ('bdconnexion.php');

$submit=isset($_POST['submit']);

class Quizz1 {
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


    function Recup($conn, $reponses) {
        $questions = array();
        $reponses = array();    
        
        $quizz = "SELECT * FROM afficher WHERE Id_quizz" . $this->id;




        for ($i = 1; $i <= 10; $i++) {
            $sql = "SELECT * FROM question WHERE Id_question = " . $i;
            $sql2 = "SELECT * FROM choix WHERE Id_question = " . $i;
            $result = mysqli_query($conn, $sql);
            $result2 = mysqli_query($conn, $sql2);
        
            if (mysqli_num_rows($result) > 0) {

                $row = mysqli_fetch_assoc($result);

                $id = $row["Id_question"];
                $question = $row["intituleQuestion"];
                $questions = array('id' => $id, 'question' => $question);
                

                while ($row2 = mysqli_fetch_assoc($result2)) {
                $reponses = array(
                'reponse1' => $row2['reponse1'],
                'reponse2' => $row2['reponse2'],
                'reponse3' => $row2['reponse3'],
                'Bonne_reponse' => $row2['Bonne_reponse']);
                }


                echo "<br>" . "Question " . $id . ": " . $question . "<br>";
                
                foreach ($reponses as $index => $reponse) {
                    echo '<input type="radio" name="question' . $id . '" value="' . $index . '"> ' . $reponse . '<br>'. "\n" ;
                } 

                $questions = json_encode($questions);
                $reponses = json_encode($reponses);

                // return array('questions' => $questions, 'reponses' => $reponses);

                
            } else {
            echo "Question non trouvée pour l'id " . $i . "<br>";
            }
        }
    }

}

// Appel de la classe

$quizz1 = new Quizz1("Id_question", "Id_quizz", "intituleQuestion", "reponse");
$reponses = $quizz1->getReponses();
$quizz1->Recup($conn, $reponses);








// Affichage des données en JSON

// echo $questions;
// echo $reponses;
// echo $question;




// mysqli_close($conn);


