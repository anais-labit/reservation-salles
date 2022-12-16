<?php
// démarrer une session
session_start();
require_once './includes/connect.php';

// attribution d'une valeur par défaut aux POST pour éviter les erreurs
if (!isset($_POST["login"])) {
    $_POST["login"] = "";
    $_POST["pwd"] = "";
    $_POST["pwd2"] = "";
};

// création des variables issues des POST
$login = $_POST["login"];
$pwd = $_POST["pwd"];
$pwd2 = $_POST["pwd2"];

// récupérer les infos de ma base de données
$catchUsers = $conn->query("SELECT * FROM utilisateurs WHERE login='$login';");
$users = mysqli_num_rows($catchUsers);
// var_dump($users);


// si le bouton submit a été cliqué
if (isset($_POST['login'])) {
    // si le login n'existe pas, qu'il y a une valeur à login et pwd et que les pwd correspondent
    if (($users === 0) && ($login != NULL) && ($pwd != NULL) && ($pwd === $pwd2)) {
        $newUser = $conn->query("INSERT INTO utilisateurs (`login`, `password`) VALUES ('$login','$pwd')");
        echo "Félicitations, votre compte a été créé avec succès !";
        // refresh et redirection vers connexion
        header("refresh:2; url=connexion.php");
        // si le login existe
    } elseif ($users === 1) {
        echo "Erreur lors de la création du compte: Login déjà utilisé ";
    } elseif ($pwd !== $pwd2) {
        echo "Erreur lors de la création du compte: mots de passe différents";
    }
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>

<body>

    <?php require_once './includes/header.php'
    ?>

    <div class="page">
        <h1>S'inscrire</h1>

        <div class="formContainer">
            <form action="inscription.php" method="post">
                <input type="text" name="login" placeholder="Choisissez un login" required>
                <input type="password" name="pwd" placeholder="Saississez un mot de passe" required>
                <input type="password" name="pwd2" placeholder="Confirmez votre mot de passe" required>
                <input type="submit" id="log" name="submit" value="Créer le compte">
            </form>
        </div>
    </div>






    <?php require_once './includes/footer.php'
    ?>

</body>

</html>