<?php define('ROOT', dirname(__DIR__));
$title = '404'; 
require_once ROOT . '/includes/header.php';
?>

<div class="container-fluid mt-5 row align-items-center">
    <H1 class="p-3 d-flex justify-content-center"><strong>Page 404</strong></H1>
    <p class="p-3 d-flex justify-content-center">Ils semblent que vous aillez rencontrer un problème,</p>
    <p class="p-3 d-flex justify-content-center">Vous vous êtes trompés de lien ou de pages. </p>
    <p class="p-3 d-flex justify-content-center">Nous prions de revenir sur la page d'acceuil .</p>
</div>

<?php require_once ROOT . '/includes/footer.php';
?>