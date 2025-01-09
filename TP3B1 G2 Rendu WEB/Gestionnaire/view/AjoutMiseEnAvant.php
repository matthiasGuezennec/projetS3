<form method="post" class="connexionForm" action="miseEnAvant.php">

    <!-- Afficher tous les produit dans une balise select-->
    <select name="produit_Add_MEA">
        <?php foreach ($leProduit as $prod): 
            if (isDyna($prod->get("NomProduit"))): ?>
            <option>
                <?php echo $prod->get("IDProduit") . " - " . $prod->get("NomProduit"); ?>
            </option>
        <?php endif; endforeach; ?>
    </select>
    <button type='submit' name='ajouter_produit'>Mettre le produit en avant</button>
</form>

<?php 
// vérifie si le produit selectionné est un produit dynamique (issus d'une modification d'un produit par un client dans une commande)
function isDyna (string $str):bool {

    // $numStr : garde seulement la/les valeur.s numériques de str  
    $numStr = preg_replace("/[^0-9]/", "", $str);

    if ($str == "produit_dynamique_" . $numStr) {
        return false;
    }
    return true;
}
?>