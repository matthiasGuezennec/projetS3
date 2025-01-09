<form class="connexionForm" method="post">
    <h2>Les stocks de la pizzeria</h2>
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