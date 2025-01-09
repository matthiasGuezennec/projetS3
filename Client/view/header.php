<header>
    <a class="home-button" href="accueil.php">Accueil</a>
    <h1 class="Nom-Entreprise"><a href="accueil.php">PizzAnanas</a></h1>
    <?php
    // si l'utilisateur s'est connecté à un compte client, on le récupère dans l'Array $_SESSION
    if (isset($_SESSION["Client"])) {
        // Vérifier que la session "Client" est définie
        $client = unserialize($_SESSION["Client"]);

        // Vérifier que l'objet client a été désérialisé avec succès
        if ($client && is_object($client)) {
            // Vérifier que la méthode get existe dans l'objet client
            if (method_exists($client, 'get')) {
                $nom = $client->get("NomClient");

                // Utiliser $nom pour afficher le lien
                echo "<a class=\"login-button\" href=\"vueCompte.php\">$nom</a>";
            } else {
                // Gérer le cas où la méthode get n'existe pas dans l'objet client
                echo "Erreur: La méthode get n'existe pas dans l'objet client.";
            }
        } else {
            // Gérer le cas où l'objet client n'a pas été désérialisé correctement
            echo "Erreur: Impossible de désérialiser l'objet client.";
        }
    } else {
        echo "<a class=\"login-button\" href=\"connexion.php\">connexion</a>";
    }
    ?>
</header>