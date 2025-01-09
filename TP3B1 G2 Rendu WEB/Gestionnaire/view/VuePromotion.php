<!-- Affiche toutes les promotions en cours -->
<ul>
    <?php foreach ($promotions as $promo): ?>

        <li>
            <?php echo $promo; ?>
        </li>

    <?php endforeach; ?>
    </ul>