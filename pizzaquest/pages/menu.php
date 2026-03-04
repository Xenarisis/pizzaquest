<?php define('ROOT', dirname(__DIR__));
$title = 'menu'; 
require_once ROOT . '/includes/header.php';
?>

<div class="container-fluid align-items-center border-bottom border-dark p-4">
        <H2><strong><em>Commande pizza</em></strong></H2>
        <p>Choisissez vos pizza ici <strong>:</strong></p>
</div>

<div class="row p-5">
        <?php
        $pdo = getDB();
        $stmt = $pdo->query('SELECT * FROM pizzas');
        $all_pizzas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($all_pizzas as $value) {
            echo show_pizza($value);
        } ?>
    </div>

<?php require_once ROOT . '/includes/footer.php';
?>