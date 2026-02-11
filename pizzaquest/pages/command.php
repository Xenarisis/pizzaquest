<?php define('ROOT', dirname(__DIR__));
$title = 'Passer commande'; 
require_once ROOT . '/includes/header.php';
require_once ROOT . '/src/helpers.php';
?>

<div class="container">
    <div class="container-fluid border border-secondary rounded ">
        <h2><strong>Vous pouvez passer commande ici</strong></h2>
        <form>
            <?php foreach($all_pizzas as $key => $value) {
                    checkbox_pizza($key);
                } ?>
        </form>
    </div>
    <div class="container-fluid"></div>
</div>

<?php require_once ROOT . '/includes/footer.php';
?>