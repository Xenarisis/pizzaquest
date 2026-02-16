<?php
define('ROOT', dirname(__DIR__));
$title = 'command success'; 
require_once ROOT . '/includes/header.php';
require_once ROOT . '/src/helpers.php';

?>

<div class="container my-5">
    <div class="alert alert-success" role="alert">
        <h3 class="alert-heading">Commande validée !</h3>
        <p>Nous vous remercions d'avoir pris une pizza chez nous.</p>
        <p class="mb-0">
            <a href="/pages/menu.php" class="btn btn-primary">Retour au menu</a>
        </p>
    </div>
</div>

<?php require_once ROOT . '/includes/footer.php'; ?>