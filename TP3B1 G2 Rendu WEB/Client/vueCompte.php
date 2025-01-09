<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">

    <title>Mon Compte</title>
</head>

<body>
    <?php

    require_once("controller/controllerClient.php");
    require_once("config/connexion.php");
    require_once("model/Client.php");
    // Inclure la classe Client si elle n'est pas déjà incluse
    if (!class_exists('Client')) {
        include 'Chemin/Vers/Votre/Classe/Client.php';
    }

    // Désérialiser l'objet Client depuis la session
    session_start();
    if (isset($_SESSION["Client"])) {
        $client = unserialize($_SESSION["Client"]);
    } else {
        // Rediriger vers la page de connexion si l'objet Client n'est pas en session
        header("Location: connexion.php");
        exit();
    }
    include("view/header.php");
    include("view/Debut.html");
    include("view/vueCompte.php");
    echo"</div></div>";
    include("view/footer.html");
    ?>
</body>