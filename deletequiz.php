<?php 

require('bdconnexion.php');

if (isset($_GET['user']) && isset($_GET['role']) && isset($_GET['deletequizz'])) {      //If user is connected

    $id_user = $_GET['user'];       //Get user id
    $role_user = $_GET['role'];     //Get user role
    $delete_quizz = $_GET['deletequizz'];       //Get quizz id that we want to delete
    
    $sqlcreate = "SELECT * FROM creer WHERE Id_quizz = '$delete_quizz'";        //Check if user created the quizz
    $resultcreate = mysqli_query($conn, $sqlcreate);        //Execute query

    if (mysqli_num_rows($resultcreate) > 0) {    //If user created the quizz
        while($row2 = mysqli_fetch_assoc($resultcreate)) {      //Get quizz id
            $id_quizz = $row2['Id_quizz'];    //Get quizz id

            echo $id_quizz;
            echo "<br>";
        }
    } else {
        echo "0 results";
    }

    $sqlquizz = "SELECT * FROM quizz WHERE Id_quizz = '$id_quizz'";     //Check if quizz exists
    $resultquizz = mysqli_query($conn, $sqlquizz);      //Execute query

    $sqlquestion = "SELECT * FROM question WHERE Id_quizz = '$id_quizz'";       //Check if question exists
    $resultquestion = mysqli_query($conn, $sqlquestion);            //Execute query

    if (mysqli_num_rows($resultquestion) > 0) {      //If question exists
        while($row3 = mysqli_fetch_assoc($resultquestion)) {
            $id_question = $row3['Id_question'];    //Get question id

            echo $id_question;
            echo "<br>";

            $sqlreponse = "SELECT * FROM choix WHERE Id_question = '$id_question'";    //Check if reponse exists
            $resultreponse = mysqli_query($conn, $sqlreponse);

            if (mysqli_num_rows($resultreponse) > 0) {    //If reponse exists
                while($row4 = mysqli_fetch_assoc($resultreponse)) {
                    $id_reponse = $row4['Id_rep'];      //Get reponse id
                    
                    $sqldeletereponse = "DELETE FROM choix WHERE `Id_question` = '$id_question'";   //Delete reponse from database with question id
                    $resultdeletereponse = mysqli_query($conn, $sqldeletereponse);

                    if ($resultdeletereponse) {     //If reponse is deleted
                        
                        
                    } else {
                        echo "Error deleting record: " . mysqli_error($conn);
                    }

                    echo "rep :".$id_reponse;   
                    echo "<br>";

                }
            } else {
                echo "0 results";
            }
        }
    } else {
        echo "0 results";
    }

    $sqldeletequestion = "DELETE FROM question WHERE `Id_quizz` = '$id_quizz'";     //Delete question from database with quizz id
    $resultdeletequestion = mysqli_query($conn, $sqldeletequestion);

    if ($resultdeletequestion) {
        
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    $sqldeletequizz = "DELETE FROM quizz WHERE `Id_quizz` = '$delete_quizz'";       //Delete quizz from database with quizz id
    $resultdeletequizz = mysqli_query($conn, $sqldeletequizz);

    if ($resultdeletequizz) {
        
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    $sqldeletecreate = "DELETE FROM creer WHERE `Id_quizz` = '$delete_quizz'";      //Delete creation quizz from database with quizz id
    $resultdeletecreate = mysqli_query($conn, $sqldeletecreate);

    if ($resultdeletecreate) {          // If quizz is deleted
        header('Location:dashboard.php?role='.$role_user.'&user='.$id_user.'');         //Redirect to dashboard
        
    } else {
        echo "Error deleting record: " . mysqli_error($conn);       //If quizz is not deleted show error
    }

}


?>