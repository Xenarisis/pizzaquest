<?php define('ROOT', dirname(__DIR__));
$title = 'profil';
require_once ROOT . '/includes/header.php';

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
// exit;

if (!isset($_SESSION['user_id'])):
    header('Location: /pages/login.php');
    exit();
endif;

?>

<h1>Bienvenue sur votre profil</h1>

<a class="nav-link" href="/pages/logout.php">Logout</a>

<?php require_once ROOT . '/includes/footer.php'; ?>