<div class="connexionForm">
    <ul>
    <?php foreach ($produits as $produit): ?>
        <li><?php echo $produit[1] . "(" . $produit[2] ." €) : commandé.es " . $produit[3] . " fois";      ?></li>
    <?php endforeach; ?>
    </ul>
    <h2> Total : <?php echo number_format($total[0][0], 2); ?> €</h2>
</div>