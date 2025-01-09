<div class="connexionForm">
    <h2> Les Alertes de stock de la pizzeria </h2>
    <ul>
        <?php
        // vue sous forme de liste des Alertes ~2-3 minutes
        foreach ($Alertes as $alrt): ?>
            <li>
                <?php echo $alrt; ?>
            </li>
        <?php endforeach; ?>
        <ul>
</div>