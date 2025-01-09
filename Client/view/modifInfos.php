<body>

    <h1>Modifier les informations</h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nouveauNom">Nouveau Nom:</label>
        <input type="text" name="nouveauNom" value="<?php echo htmlspecialchars($client->get("NomClient")); ?>" required>

        <label for="nouveauPrenom">Nouveau Prénom:</label>
        <input type="text" name="nouveauPrenom" value="<?php echo htmlspecialchars($client->get("PrenomClient")); ?>" required>

        <label for="nouvelleAdresse">Nouvelle Adresse:</label>
        <input type="text" name="nouvelleAdresse" value="<?php echo htmlspecialchars($client->get("Adresse")); ?>" required>

        <label for="nouvelEmail">Nouvel Email:</label>
        <input type="email" name="nouvelEmail" value="<?php echo htmlspecialchars($client->get("Email")); ?>" required>

        <label for="nouveauTelephone">Nouveau Téléphone:</label>
        <input type="tel" name="nouveauTelephone" value="<?php echo htmlspecialchars($client->get("Telephone")); ?>" required>

        <button type="submit">Enregistrer les modifications</button>
    </form>
</div>
</body>
</html>