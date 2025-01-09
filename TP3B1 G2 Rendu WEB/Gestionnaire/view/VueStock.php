<form class="connexionForm" method="post">
    <ul>
    <?php foreach ($Ingredients as $ingre): ?>
        <li>
            <?php 
            echo $ingre;
            ?>
        </li>
    <?php endforeach; ?>
    </ul>
</form>