<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/vueCompte/style.css">

    <title>Mon Compte</title>
</head>

<body>
    <div class="leCompte">
        <h1>Mon Compte</h1>

        <p><strong>Login:</strong>
            <?php echo $client->get("Login"); ?>
        </p>
        <p><strong>Nom:</strong>
            <?php echo $client->get("NomClient"); ?>
        </p>
        <p><strong>Prénom:</strong>
            <?php echo $client->get("PrenomClient"); ?>
        </p>
        <p><strong>Adresse:</strong>
            <?php echo $client->get("Adresse"); ?>
        </p>
        <p><strong>Email:</strong>
            <?php echo $client->get("Email"); ?>
        </p>
        <p><strong>Téléphone:</strong>
            <?php echo $client->get("Telephone"); ?>
        </p>
        <a href="modifierInfos.php" class="change-info-link">Changer les informations</a>
        <a href='Deconnection.php' class="change-info-link">Déconnexion</a>


    </div>

</body>

</html>