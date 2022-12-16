<?php
// démarrer une session
session_start();
require_once './includes/header.php';
require_once './includes/connect.php';

// récupérer les valeurs de session
$login = $_SESSION['login'];
$pwd = $_SESSION['pwd'];

// modifier les informations
// requete pour récupérer les infos de la DB
$catchInfos = $conn->query("SELECT id, login, password FROM utilisateurs WHERE login = '$login'");
$displayInfos = $catchInfos->fetch_all();

// assigner la valeur de l'id dans une variable
$_SESSION["id"] = $displayInfos[0][0];
$idUser = $_SESSION["id"];
// var_dump($idUser);

// si le formulaire est envoyé
if (isset($_POST['submit'])) {
    // les post deviennent les nouvelles valeurs
    $confpwd = ($_POST['confpwd']);
    $newpwd2 = ($_POST['newpwd2']);
    $newpwd = ($_POST['newpwd']);
    $newlogin = ($_POST['login']);

    // si l'ancien pwd est le bon et que les nouveaux pwd correspondent
    if (($confpwd == $pwd) && ($newpwd == $newpwd2)) {
        // faire la requete de mise à jour de la db avec les nouvelles valeurs
        $upInfo = $conn->query("UPDATE utilisateurs SET login ='$newlogin', password = '$newpwd' WHERE id='$idUser'");
        echo "Les modifications ont bien été prises en compte";
        // et sauver les nouvelles valeurs
        $_SESSION['login'] = $newlogin;
        $_SESSION['pwd'] = $newpwd;

        header("Refresh:2");
    } else {
        echo "Mots de passe invalides";
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
    <title>Modification</title>
</head>

<body>

    <div class="page">
        <?php
        // salut personnalisé s'il y a un login
        if (isset($login)) {
            echo " <h1> Modifier votre profil " . ucwords($login) . "</h1>";
        } else {
            echo "<h1> Salut ! </h1>";
        }
        ?>

        <div class="formContainer">
            <form action="profil.php" method="post">
                <input type="text" name="login" placeholder="Login : <?= $login ?> ou nouveau ?" required>
                <input type="password" name="confpwd" placeholder="Ancien mot de passe" required>
                <input type="password" name="newpwd" placeholder="Nouveau Mot de passe" required>
                <input type="password" name="newpwd2" placeholder="Confirmation" required>
                <input type="submit" name="submit" value="Sauvegarder les changements">
                <button> <a href="./includes/suppression.php">⚠ Supprimer votre compte ⚠ </a> </button>
            </form>
        </div>
    </div>

    <?php
    require_once './includes/footer.php';
    ?>

</body>

</html>