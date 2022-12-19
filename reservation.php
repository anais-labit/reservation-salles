<?php
// démarrer une session
session_start();
require_once './includes/connect.php';
require_once './includes/functions.php';


if (isset($_GET['id'])) :
    $catchBookings = $conn->query("SELECT * FROM utilisateurs INNER JOIN reservations ON utilisateurs.id=reservations.id_utilisateur WHERE reservations.id= '" . $_GET['id'] . "'");
    $infoBooking = $catchBookings->fetch_all();
endif;

// mettre la date au format agréable pour user et traduire
$start = date_create($infoBooking[0][6]);
$newSDay = translateDay(date_format($start, 'l'));
$newSDate = date_format($start, 'j');
$newSMonth = translateMonth(date_format($start, 'F'));
$newSHour = date_format($start, '\ à\ H\h\ ');
$newStart = $newSDay . $newSDate . $newSMonth . $newSHour;
$end = date_create($infoBooking[0][7]);
$newEDay = translateDay(date_format($end, 'l'));
$newEDate = date_format($end, 'j');
$newEMonth = translateMonth(date_format($end, 'F'));
$newEHour = date_format($end, '\ à\ H\h\ ');
$newEnd = $newEDay . $newEDate . $newEMonth . $newEHour;
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations réservation</title>
</head>

<body>

    <?php require_once './includes/header.php';
    if (isset($_SESSION['id'])) :    ?>
        <div class="displayInfo">
            <h1>Informations sur la réservation</h1>
            <p>Réservé par : <?= $infoBooking[0][1] ?> </p>
            <p>Titre : <?= $infoBooking[0][4] ?> </p>
            <p>Description : <?= $infoBooking[0][5] ?> </p>
            <p>Début : <?= $newStart ?> </p>
            <p>Fin : <?= $newEnd ?> </p>
        </div>
    <?php else :
        header('Location:connexion.php');
    endif;
    ?>



    <?php require_once './includes/footer.php'
    ?>

</body>

</html>