<?php
define('ROOT', dirname(__DIR__));
$title = 'Inscription'; 
require_once ROOT . '/includes/header.php';
require_once ROOT . '/includes/bootstrap.php';

$_SESSION['newuser'] = true;

$user = array(
    'id' => $_SESSION['user_id'] ?? uniqid(),
    'firstname' => $_SESSION['user_firstname'] ?? null,
    'lastname' => $_SESSION['user_lastname'] ?? null,
    'email' => $_SESSION['user_email'] ?? null,
    'adress' => $_SESSION['user_adress'] ?? null,
    'phone' => $_SESSION['user_phone'] ?? null
)

?>

<div>
    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
</div>

<div class="container my-5">
    <h2 class="m-b-auto">Veuillez vous inscrire :</h2>

    <form method="POST" action="/pages/traitement-login.php" class="needs-validation">
        <div class="card bg-warning bg-opacity-25 mb-4">
            <?= user_info($user, true);?>
        </div>
        <button type="submit" class="btn btn-secondary btn-lg">
            Validez vos informations
        </button>
    </form>
</div>

<?php require_once ROOT . '/includes/footer.php'; ?>