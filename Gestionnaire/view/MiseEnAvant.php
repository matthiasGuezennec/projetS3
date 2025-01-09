<form method="post" class="connexionForm" action="miseEnAvant.php">

    <!-- Afficher tous les produit dans une balise select-->
    <select name="produitMEA">
        <?php foreach ($produits as $prod): ?>
            <option>
                <?php echo $prod[0] . " - " . $prod[2]; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <p>⚠️Laissez toujours minimum 8 Produits⚠️</p>
    <button type='submit' name='supprimmer'>supprimer</button>
</form>