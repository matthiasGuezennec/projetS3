<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier les informations</title>
    <link rel="stylesheet" href="css/style.css">
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
require_once("config/connexion.php");
require_once("controller/controllerClient.php");
// Inclure la classe Client si elle n'est pas déjà incluse
if(!class_exists('Client')) {
    include 'model/Client.php';
}
connexion::SESSION();
connexion::connect();

if(isset($_SESSION["Client"])) {
    $client = unserialize($_SESSION["Client"]);
} else {
    // Rediriger vers la page de connexion si l'objet Client n'est pas en session
    header("Location: connexion.php");
    exit();
}

// Traitement du formulaire de modification des informations
if($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les nouvelles informations depuis le formulaire
    $nouveauNom = $_POST["nouveauNom"];
    $nouveauPrenom = $_POST["nouveauPrenom"];
    $nouvelleAdresse = $_POST["nouvelleAdresse"];
    $nouvelEmail = $_POST["nouvelEmail"];
    $nouveauTelephone = $_POST["nouveauTelephone"];

    // Mettre à jour les informations du client
    $client->set("NomClient", $nouveauNom);
    $client->set("PrenomClient", $nouveauPrenom);
    $client->set("Adresse", $nouvelleAdresse);
    $client->set("Email", $nouvelEmail);
    $client->set("Telephone", $nouveauTelephone);

    // Mettre à jour l'objet Client dans la session
    $_SESSION["Client"] = serialize($client);

    controllerClient::Update($client->get("Login"), $client);

    // Rediriger vers la page du compte après la modification
    header("Location: vueCompte.php");
    exit();
}
include("view/header.php");
include("view/Debut.html");

include("view/modifInfos.php");
echo "</div>";

include("view/footer.html");
?>