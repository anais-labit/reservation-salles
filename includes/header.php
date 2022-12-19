<?php
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./includes/styles.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
</head>

<body>

    <div class="navContainer">
        <nav>
            <ul>
                <?php
                if (isset($_SESSION['id'])) { ?>
                    <li><a href="./index.php">Accueil</a></li>
                    <li><a href="./profil.php">Gérer mon profil</a></li>
                    <li><a href="./planning.php">Planning</a></li>
                    <li><a href="./reservation-form.php">Réserver une salle</a></li>
                <?php } else { ?>
                    <li><a href="./index.php">Accueil</a></li>
                    <li><a href="./inscription.php">Inscription</a></li>
                    <li><a href="./connexion.php">Connexion</a></li>
                    <li><a href="./planning.php">Planning des salles</a></li>
                <?php } ?>

            </ul>
        </nav>
    </div>

</body>

</html>