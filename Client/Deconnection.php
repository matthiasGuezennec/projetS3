<?php
require_once("config/connexion.php");
connexion::SESSION();

// Vérifiez si la variable de session existe et la supprimez si nécessaire
if (isset($_SESSION['Client'])) {
    unset($_SESSION['Client']);
}
session_commit();
// Redirigez l'utilisateur vers une autre page (par exemple, index.php)
header('Location: accueil.php');
exit();
?>