<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Paiement : pizzAnanas</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/Paiement/style.css">
</head>

<body>
    <?php

    require_once("config/connexion.php");
    require_once("controller/controllerProduit.php");
    require_once("model/Produit.php");
    require_once("model/Client.php");
    require_once("model/Ingredient.php");
    require_once("model/Commande.php");
    require_once("controller/controllerCommande.php");


    connexion::SESSION();
    connexion::connect();
    // Si il n'est pas connecté, on le redirige sur la page de connexion
    if (!isset($_SESSION["Client"])) {

        header("location: connexion.php");
        exit();

    } else {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            Client::addCommande($_POST["card_number"], $_POST["expiry_date"], $_POST["cvv"]);

            // récuperation des informations pour insérer la commande dans la base de données
            $client = unserialize($_SESSION["Client"]);
            $pizzeria = $_POST["pizzeria"];
            $commande = $_SESSION["Commande"];

            // recuperation de la pizzéria
            $id = getID($_SESSION["Pizzeria"], $pizzeria);

            // méthode d'insertion
            controllerCommande::insertCommande($client->get("Login"), $id, $commande);

            // Affichage de la confirmation 
            ?>
            <h1>Commande confirmé ! </h1>
            <meta http-equiv="refresh" content="5;url=accueil.php">
            <?php
        } else {
            $pizzeria = controllerCommande::getPizzeria();
            $_SESSION["Pizzeria"] = $pizzeria;
            $commande = $_SESSION["Commande"];
            include("view/header.php");
            include("view/FormulairePaiement.html");
        }
    }
    function getID($array, $nom)
    {
        foreach ($array as $pizzeria) {

            if ($pizzeria[0] == $nom) {
                return $pizzeria[1];
            }
        }
    }
    ?>
</body>

</html>