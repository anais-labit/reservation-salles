<?php
// démarrer une session
session_start();
require_once './includes/connect.php';


if (isset($_POST['submit'])) {
    // on récupère l'id de l'utilisateur qui effectue la résa 
    $id = $_SESSION["id"];
    // on récupère les valeurs des post 
    $title = addslashes(htmlspecialchars($_POST["title"]));
    $desc = addslashes(htmlspecialchars($_POST["desc"]));
    $date = $_POST["date"];
    // concaténation date et heure de début et de fin pour être au format compatible à l'ajout à la db
    $start = $date . " " . $_POST["start"] . ":00";
    $end = $date . " " . $_POST["end"] . ":00";
    // echo $start;
    // echo $end;

    // requete pour récupérer le contenu de la DB où l'heure de début correspond éventuellement à une heure déjà rentrée ou alors où l'heure de fin correspond à une fin dejà rentrée
    $catchBookings = $conn->query("SELECT debut, fin FROM reservations WHERE debut BETWEEN '$start' AND '$end' OR fin BETWEEN '$start' AND '$end'");

    // fetch le contenu de la requête
    $bookings = $catchBookings->fetch_all();
    // var_dump($bookings);

    if (empty($bookings)) {
        // requete pour inserer les valeurs issues des post + id de l'utilisateur qui effectue la résa dans la db
        $newBooking = $conn->query("INSERT INTO reservations (`titre`, `description`, `debut`, `fin`, `id_utilisateur`) VALUES ('$title', '$desc', '$start', '$end', '$id')");
        echo "Félicitations, votre réservation a bien été effectuée";
    } else {
        echo "Ce créneau n'est pas disponible";
    }
}











?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation</title>
</head>

<body>
    <?php require_once './includes/header.php';
    if (isset($_SESSION['id'])) : ?>
        <div class="page">
            <h1>Réserver une salle</h1>
            <h3>Créneaux de 1h, en semaine entre 8h et 19h</h3>
            <div class="formContainer">
                <form action="reservation-form.php" method="post">
                    <input type="text" placeholder="Titre" name="title" size="20" required>
                    <input type="text" placeholder="Description" name="desc" required>
                    <input type="date" name="date" required>
                    <input type="time" placeholder="Début" name="start" step="3600" min="08:00" max="18:00" required>
                    <input type="time" placeholder="Fin" name="end" step="3600" min="09:00" max="19:00" required>
                    <input type="submit" id="log" name="submit" value="Soumettre ma demande">
                </form>
            </div>
        <?php else :
        header('Location:connexion.php');
    endif;
        ?>
        <?php require_once './includes/footer.php' ?>
</body>

</html>