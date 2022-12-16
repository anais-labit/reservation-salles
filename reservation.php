<?php
// démarrer une session
session_start();
require_once './includes/connect.php';

if (isset($_GET['id'])) :
    $catchBookings = $conn->query("SELECT * FROM utilisateurs INNER JOIN reservations ON utilisateurs.id=reservations.id_utilisateur WHERE reservations.id= '" . $_GET['id'] . "'");
    $infoBooking = $catchBookings->fetch_all();
endif;
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre réservation</title>
</head>

<body>

    <?php require_once './includes/header.php';
    if (isset($_POST['submit'])) :
    ?>
        <div class="displayInfo">
            <h1>Informations sur la réservation</h1>
            <p>Réservé par : <?= $infoBooking[0][1] ?> </p>
            <p>Titre : <?= $infoBooking[0][4] ?> </p>
            <p>Description : <?= $infoBooking[0][5] ?> </p>
            <p>Début : <?= $infoBooking[0][6] ?> </p>
            <p>Fin : <?= $infoBooking[0][7] ?> </p>
        </div>
    <?php endif; ?>



    <?php require_once './includes/footer.php'
    ?>

</body>

</html>