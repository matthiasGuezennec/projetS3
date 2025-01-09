<form method="post" class="connexionForm" action="connexion.php">
    <label class="champ-text" for="NomPizzeria">Nom de la pizzeria</label>
    <br>
    <br>
    <select id="NomPizzeria" name="NomPizzeria">

        <?php foreach ($Pizzeria as $pizz): ?>
        <option>
            <?php echo $pizz["NomPizzeria"]; ?>
        </option>
        <?php endforeach; ?>

    </select>
    <br>
    <br>

    <button type="submit">Connexion</button>
</form>