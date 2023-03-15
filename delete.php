<?php 

require('bdconnexion.php');

if (isset($_GET['user']) && isset($_GET['role']) && isset($_GET['deleteId'])) {     //we check if the user is connected

    $id_user = $_GET['user'];
    $role_user = $_GET['role'];
    $delete_user = $_GET['deleteId'];       //we get the id of the user we want to delete

    $sqluser = "SELECT * FROM utilisateur WHERE Id_utilisateur = '$delete_user'";       //we check if the user exists
    $resultuser = mysqli_query($conn, $sqluser);

    if (mysqli_num_rows($resultuser) > 0) {        //if the user exists
        while($row = mysqli_fetch_assoc($resultuser)) {
            $id_utilisateur = $row['Id_utilisateur'];   //we get the id of the user

            echo $id_utilisateur;
            echo "<br>";
        }
    } else {
        echo "0 results";
    }
    
    
    $sqlcreate = "SELECT * FROM creer WHERE Id_utilisateur = '$delete_user'";       //we check if the user created a quizz
    $resultcreate = mysqli_query($conn, $sqlcreate);

    if (mysqli_num_rows($resultcreate) > 0) {       //if the user created a quizz
        while($row2 = mysqli_fetch_assoc($resultcreate)) {
            $id_quizz = $row2['Id_quizz'];      //we get the id of the quizz

            echo $id_quizz;
            echo "<br>";
        }
    } else {
        echo "0 results";
    }


    $sqlquizz = "SELECT * FROM quizz WHERE Id_quizz = '$id_quizz'";     //we check if the quizz exists
    $resultquizz = mysqli_query($conn, $sqlquizz);

    $sqlquestion = "SELECT * FROM question WHERE Id_quizz = '$id_quizz'";       //we check if the quizz has questions
    $resultquestion = mysqli_query($conn, $sqlquestion);

    if (mysqli_num_rows($resultquestion) > 0) {
        // output data of each row
        while($row3 = mysqli_fetch_assoc($resultquestion)) {    //if the quizz has questions
            $id_question = $row3['Id_question'];    //we get the id of the question

            echo $id_question;
            echo "<br>";

            $sqlreponse = "SELECT * FROM choix WHERE Id_question = '$id_question'";    //we check if the question has answers
            $resultreponse = mysqli_query($conn, $sqlreponse);

            if (mysqli_num_rows($resultreponse) > 0) {   //if the question has answers
                // output data of each row
                while($row4 = mysqli_fetch_assoc($resultreponse)) { 
                    $id_reponse = $row4['Id_rep'];  //we get the id of the answer
                    
                    $sqldeletereponse = "DELETE FROM choix WHERE `Id_question` = '$id_question'";       //we delete the answer
                    $resultdeletereponse = mysqli_query($conn, $sqldeletereponse);

                    if ($resultdeletereponse) {
                        
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

    $sqldeletequestion = "DELETE FROM question WHERE `Id_quizz` = '$id_quizz'";     //we delete the question
    $resultdeletequestion = mysqli_query($conn, $sqldeletequestion);

    if ($resultdeletequestion) {
        
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    $sqldeletequizz = "DELETE FROM quizz WHERE `Id_quizz` = '$id_quizz'";       //we delete the quizz
    $resultdeletequizz = mysqli_query($conn, $sqldeletequizz);

    if ($resultdeletequizz) {
        
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    $sqldeletecreate = "DELETE FROM creer WHERE `Id_utilisateur` = '$id_utilisateur'";      //we delete the link between the user and the quizz
    $resultdeletecreate = mysqli_query($conn, $sqldeletecreate);

    if ($resultdeletecreate) {
        
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    $sqldeleteuser = "DELETE FROM utilisateur WHERE `Id_utilisateur` = '$id_utilisateur'";      //we delete the user
    $resultdeleteuser = mysqli_query($conn, $sqldeleteuser);

    if ($resultdeleteuser) {
        header('Location:dashboard.php?role='.$role_user.'&user='.$id_user.'');
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

}


?>