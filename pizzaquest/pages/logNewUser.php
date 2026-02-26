<?php
define('ROOT', dirname(__DIR__));
$title = 'Inscription'; 
require_once ROOT . '/includes/header.php';
require_once ROOT . '/src/helpers.php';

$_SESSION['newuser'] = true;

$user = $_SESSION['user'] ?? array(
                'id' => uniqid(),
                'firstname' => null,
                'lastname' => null,
                'email' => null,
                'password' => null,
                'adresse' => null,
                'phone' => null
            );
?>

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