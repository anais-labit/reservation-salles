<?php
// démarrer une session
session_start();
require_once './includes/connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
    <title>Accueil</title>
</head>

<body>
    <?php require_once './includes/header.php'
    ?>
    <div class="page">
        <?php
        if (isset($_SESSION['id'])) {
            echo " <h1> Bienvenue " . ucwords($_SESSION['login']) . " !</h1>";
        } else {
            echo "<h1> Bienvenue ! </h1>";
        }
        ?>
        <div class="textContainer">
            <h3>Réservation de salles: présentation et objectifs du projet</h3>
            <p>Coder un site permettant aux utilisateurs de réserver une salle pour un événement </p>
            <ul>Il fallait créer : <br><br>
                <li><i class="fa-solid fa-check"></i> Une base de données et des tables - à l’aide de phpmyadmin</li>
                <li><i class="fa-solid fa-check"></i> Une page d’accueil - présentation du site </li>
                <li><i class="fa-solid fa-check"></i> Un formulaire d’inscription - les données sont insérées dans la base de données et l’utilisateur est redirigé vers la page de connexion</li>
                <li><i class="fa-solid fa-check"></i> Un formulaire de connexion - s’il existe un utilisateur en bdd correspondant à ces informations, alors l’utilisateur devient connecté</li>
                <li><i class="fa-solid fa-check"></i> Une page permettant de modifier son profil - possibilité de modifier login et mot de passe de l'utilisateur connecté</li>
                <li><i class="fa-solid fa-check"></i> Une structure html correcte et un design soigné à l’aide de css</li>
            </ul>
            <ul>New !! <br><br>
                <li><i class="fa-solid fa-check"></i> Une page permettant de voir l’ensemble des réservations effectuées - sous forme d’un tableau avec les jours de la semaine en cours</li>
                <li><i class="fa-solid fa-check"></i> Un formulaire de réservation - accessible uniquement aux utilisateurs connectés (titre, description, date de début, date de fin)</li>
                <li><i class="fa-solid fa-check"></i> Une page permettant de voir les réservations effectuées par l'utilisateur connecté - via l’id de l’événement en utilisant la méthode get</li>

            </ul>
            <ul>Bonus <br><br>
                <li><i class="fa-solid fa-check"></i> Affichage conditionnel de la barre de navigation</li>
                <li><i class="fa-solid fa-check"></i> Suppression de compte</li>
                <li><i class="fa-solid fa-check"></i> Gestion dynamique des dates du planning</li>

            </ul>
        </div>
    </div>
    <?php
    require_once './includes/footer.php';
    ?>
</body>

</html>