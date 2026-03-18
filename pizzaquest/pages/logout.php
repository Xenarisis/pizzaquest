<?php
define('ROOT', dirname(__DIR__));
$title = 'Logout'; 
require_once ROOT . '/includes/header.php';

unset($_SESSION['user_id']);

// some code after to disconnect the user of it's account
?>

<div class="container my-5">
    <div class="alert alert-success" role="alert">
        <h3 class="alert-heading">Compte bien déconnecté</h3>
        <p>Vous vous êtes déconnecté de votre compte si toutefois vous voulez vous reconnecter n'hésitez pas a passer pas la page login</p>
        <p class="mb-0">
            <a href="/index.php?root=acceuil" class="btn btn-primary">Retour a l'acceuil</a>
        </p>
    </div>
</div>

<?php require_once ROOT . '/includes/footer.php'; ?>