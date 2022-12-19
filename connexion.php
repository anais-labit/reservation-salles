<?php
// démarrer une session
session_start();
require_once './includes/header.php';
require_once './includes/connect.php';

// attribution d'une valeur par défaut aux POST pour éviter les erreurs
if (!isset($_POST["login"])) {
    $_POST["login"] = "";
    $_POST["pwd"] = "";
};

// création des variables issues des POST
$login = $_POST["login"];
$pwd = $_POST["pwd"];

// requete pour récupérer le contenu de la DB pour l'utilisateur concerné
$catchUsers = $conn->query("SELECT * FROM utilisateurs WHERE login='$login';");
// verifier si le login existe déjà en comptant les éventuels doublons
$users = mysqli_num_rows($catchUsers);
// fetch le contenu de la requête
$userInfo = $catchUsers->fetch_all();
// var_dump($userInfo[0][2]);


// condition pour rentrer dans les erreurs que lorsque des données sont rentrées
if (isset($_POST['submit'])) {
    // une requete pour valider la connexion si le login existe déjà et que le mot de passe correspond à celui en DB
    if (($users === 1) && ($_POST["pwd"] === $userInfo[0][2])) {
        // si le login existe, qu'il y a une valeur à login et pwd 
        if (($users === 1) && ($login != NULL) && ($pwd != NULL)) {
            // définir les valeurs de session
            $_SESSION["login"] = $login;
            $_SESSION["pwd"] = $pwd;
            $_SESSION["id"] = $userInfo[0][0];
            // echo $_SESSION["id"];
            // puis valider la connexion en redirigeant vers profil.php
            echo "Connexion réussie";
            header("refresh:2; url=planning.php");
        }
    } elseif ($users != 1) {
        echo "Ce login n'existe pas";
    } elseif ($_POST["pwd"] !== $userInfo[0][2]) {
        echo "Mot de pas incorrect";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
    <title>Connexion</title>
</head>

<body>
    <div class="page">
        <h1>Se connecter</h1>

        <div class="formContainer">
            <form action="connexion.php" method="post">
                <input type="text" name="login" placeholder="Login" required>
                <input type="password" name="pwd" placeholder="Mot de passe" required>
                <input type="submit" id="log" name="submit" value="Connexion">
            </form>
        </div>
    </div>

    <?php
    require_once './includes/footer.php';
    ?>

</body>

</html>