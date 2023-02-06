<h1>Bienvenue sur notre Quizzeo !</h1>

<form method="post" action="script.php">
   <label for="pseudo">Pseudo :</label><br>
   <input type="text" name="pseudo" id="pseudo"><br>

   <label for="role"> Choix rôle : </label><br>
        <select name="role" id="card">
            <option value=""> -- Veuillez choisir votre rôle -- </option>
            <option value="utilisateur"> Utilisateur </option>
            <option value="quizzeur"> Quizzeur </option>
            <option value="admin"> Administrateur </option>
        </select><br>
     
   <input type="submit" value="Envoyer">
   

</form>