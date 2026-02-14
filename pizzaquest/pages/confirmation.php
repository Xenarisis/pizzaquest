<?php
$success = $_SESSION['success'] ?? null;
unset($_SESSION['success']);

if (!$success) {
    redirect('/pages/acceuil.php');
}
?>

<div class="container my-5">
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Commande validée !</h4>
        <p><?= e($success) ?></p>
        <hr>
        <p class="mb-0">
            <a href="/pages/menu.php" class="btn btn-primary">Retour au menu</a>
        </p>
    </div>
</div>