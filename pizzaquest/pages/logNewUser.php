<?php
define('ROOT', dirname(__DIR__));
$title = 'command success'; 
require_once ROOT . '/includes/header.php';
require_once ROOT . '/src/helpers.php';

$user = $_SESSION['user'] ?? array(
                'firstname' => 'prénom',
                'lastname' => 'nom',
                'email' => 'email',
                'adresse' => 'Votre adresse',
                'phone' => '** ** ** ** **'
            );
?>

<div class="container my-5">
    <h2 class="m-b-auto">Veuillez vous inscrire :</h2>

    <form method="POST" action="/pages/traitement_command.php" class="needs-validation">
        <div class="card bg-warning bg-opacity-25 mb-4">
            <?= user_info($user);?>
        </div>

        <button type="submit" class="btn btn-secondary btn-lg">
            Valider vos informations
        </button>

    </form>
</div>

<?php require_once ROOT . '/includes/footer.php'; ?>