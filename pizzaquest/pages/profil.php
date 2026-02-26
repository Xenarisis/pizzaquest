<?php define('ROOT', dirname(__DIR__));
require_once ROOT . '/src/helpers.php';
$title = 'profil'; 

if (!isset($_SESSION['user'])):
    header('Location: /pages/login.php');
    exit();
endif;

require_once ROOT . '/includes/header.php';
?>

<h1>Bienvenue sur votre profil</h1>

<a class="nav-link" href="/pages/logout.php">Logout</a>

<?php require_once ROOT . '/includes/footer.php'; ?>