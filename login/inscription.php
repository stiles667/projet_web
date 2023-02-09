

    <?php 
$submit=isset($_POST['submit']);
$pseudo=($_POST['pseudo']);
$password=($_POST['password']);
$password2=($_POST['password2']);
$email=($_POST['email']);
$role=($_POST['role']);

$expression2 = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-z]{2,4}$/';

$bdd = new PDO('mysql:host=localhost;dbname=sqldbquizz;charset=utf8', 'root', '');


    switch (true) {
        case (empty($pseudo) || empty($password) || empty($password2) || empty($email) || empty($role)):
            echo "Veuillez remplir tous les champs.";
            break;
        case ($password != $password2):
            echo "Les mots de passe ne correspondent pas.";
            break;
        case (strlen($pseudo) < 3):
            echo "Votre pseudo est trop court.";
            break;
        case (!preg_match($expression2, $email)):
            echo "L'email n'est pas valide. ";
            break;
        default:
            echo "Vous êtes inscrit !";
            $req = $bdd->prepare('INSERT INTO utilisateur (pseudo, password, email, role) VALUES(:pseudo, :password, :email, :role)');
            $req->execute(array(
                'pseudo' => $pseudo,
                'password' => $password,
                'email' => $email,
                'role' => $role
            ));
            break;
    }





    
?>