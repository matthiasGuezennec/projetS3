<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="css/style.css">

    <title>Pizzeria en ligne</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: none;
        }

        form {
            max-width: 400px;
            margin: auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<?php
require_once("controller/controllerClient.php");
require_once("config/connexion.php");
require_once("model/Client.php");

connexion::SESSION();

connexion::connect();
echo "<body>";
include("view/header.php");
include("view/AccueilDebut.html");
if(isset($_SESSION["Client"])) {
    header('Location: vueCompte.php');
    exit();
}
if(isset($_POST['login-bouton'])) {

    // Passer les champs en obligatoire seulement si le bouton pressé est le bouton pour ce connecté
    $loginRequired = "required";
    $passwordRequired = "required";

    // Récup des valeur du formulaire
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Si l'identification est correcte, on stocke le client dans l'Array $_SESSION
    if(Client::testClient($login, $password)) {

        $_SESSION["Client"] = serialize(controllerClient::getOne($login));
        // redirection vers la page de commande
        header('Location: commande.php');
        exit();
    } else {
        echo "Identifiants incorrects. Veuillez réessayer.";
    }
}
if(isset($_POST['create-bouton'])) {
    header("Location: CreerCompte.php");
    exit();
}

include("view/formulaireConnexion.html");
echo '</body>';
?>