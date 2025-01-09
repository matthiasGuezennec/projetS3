<h1>Mot de passe</h1>

<form action="MDP.php" method="post">
    <label for="motDePasse">Mot de passe</label>
    <input type="text" name="motDePasse" value="" required>

    <button type="submit">hashage</button>
</form>
<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {

        $motDePasse = $_POST["motDePasse"];

        $hash = password_hash($motDePasse, PASSWORD_DEFAULT);

        echo "<p>$hash</p>";
    }

?>