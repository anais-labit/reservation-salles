<?php
// démarrer une session
session_start();
// connexion à la DB
require_once './includes/connect.php';
require_once './includes/functions.php';

// requête pour fetch les résas de la semaine en cours (via id utilisateur des deux tables)
$bookings = $conn->query("SELECT * FROM utilisateurs INNER JOIN reservations ON utilisateurs.id=reservations.id_utilisateur WHERE WEEK(reservations.debut)=WEEK(CURDATE())");
$planning = $bookings->fetch_all();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning</title>
</head>

<body>
    <?php require_once './includes/header.php'
    ?>
    <div class="page">
        <h1>Planning</h1>
        <div class="planningContainer">
            <table border=1px>
                <thead>
                    <tr>
                        <td></td>
                        <td><?php echo $mon = translateDay(date("l", strtotime("monday this week"))) . date("d", strtotime("monday this week")) . translateMonth(date("F", strtotime("monday this week"))); ?></td>
                        <td><?php echo $tue = translateDay(date("l", strtotime("tuesday this week"))) . date("d", strtotime("tuesday this week")) . translateMonth(date("F", strtotime("tuesday this week"))); ?></td>
                        <td><?php echo $wed = translateDay(date("l", strtotime("wednesday this week"))) . date("d", strtotime("wednesday this week")) . translateMonth(date("F", strtotime("wednesday this week"))); ?></td>
                        <td><?php echo $thu = translateDay(date("l", strtotime("thursday this week"))) . date("d", strtotime("thursday this week")) . translateMonth(date("F", strtotime("thursday this week"))); ?></td>
                        <td><?php echo $fri = translateDay(date("l", strtotime("friday this week"))) . date("d", strtotime("friday this week")) . translateMonth(date("F", strtotime("friday this week"))); ?></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // boucle du nombre de créneaux horaires possibles qui affiche les valeurs des heures 
                    for ($h = 8; $h < 20; $h++) :
                        echo "<td>" . $h . "h" . "</td>";
                        // boucle du nombre de jours possibles qui affiche les cases des jours et leur valeur dans le même format que celui de la DB pour future comparaison
                        for ($j = 1; $j <= 5; $j++) :
                            $dateComp = date("Y-m-d H:i:s", strtotime("sunday last week $h hours $j days"));
                            echo "<td>";
                            // var_dump($planning[$j][3]);
                            // condition de réservation false par défaut (la case est libre)
                            $reserved = false;
                            // à chaque fois que je rencontre un event (=résa), si la date existe déjà sur un event en DB, la réservation passe à true
                            foreach ($planning as $event) :
                                // var_dump($event[6]);
                                if (($dateComp >= $event[6]) and ($dateComp <= $event[7])) :
                                    // var_dump($dateComp);
                                    $reserved = true;
                                    echo "Réservé pour : " . $event[4] . "<br><a href='reservation.php?id=$event[3]'>Voir les infos</a>";
                                endif;
                            endforeach;
                            // si c'est réservé = indisponible
                            if ($reserved) :
                                echo "</td>";
                            // sinon, lien de réservation
                            else :
                                echo "<a href='reservation-form.php'>Réserver</a>";
                                echo "</td>";
                            endif;
                        endfor;
                        echo "</tr>";
                    endfor;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php require_once './includes/footer.php' ?>
</body>

</html>