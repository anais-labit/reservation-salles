<!-- détruire la session à la deconnexion -->
<?php
session_start();
unset($_SESSION['id']);
session_destroy();
header('Location:../connexion.php');
