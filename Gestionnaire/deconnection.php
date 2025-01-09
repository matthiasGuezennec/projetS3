<?php 
require_once("config/connexion.php");
connexion::SESSION();

unset($_SESSION["Pizzeria"]);
header("Location: connexion.php");
exit();
?>