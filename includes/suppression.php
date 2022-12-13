<?php
session_start();
require_once 'connect.php';

$id = $_SESSION['id'];
$eraseUser = $conn->query("DELETE FROM `utilisateurs` WHERE id='$id';");
echo "<p>" . "Votre compte a bien été supprimé" . "</p>";
// détruire la session
unset($_SESSION['id']);
session_destroy();

// rediriger vers le formulaire d'inscription
header("refresh:3;url=../inscription.php");
