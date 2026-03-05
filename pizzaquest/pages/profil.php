<?php define('ROOT', dirname(__DIR__));
$title = 'profil';
require_once ROOT . '/includes/header.php';

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
// exit;

if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_connected']) || $_SESSION['is_connected'] !== true):
    header('Location: /pages/login.php');
    exit();
endif;

?>
<div class="container-fluid">
    <h1 class="mt-5">Bienvenue sur votre profil</h1>

    <div class="container-fluid align-items-center p-5">
        <h3>Voici vos informations</h3>
        <?php 
        $pdo = getDB();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([':id' => $_SESSION['user_id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        echo show_user_info($user);
        ?>
    </div>

    <h1 class="mt-2">Si vous souhaitez modifier vos informations c'est juste ici:</h1>

    

    <div class="d-flex justify-content-center">
        <a class="nav-link" href="/pages/logout.php">Logout</a>
    </div>
</div>

<?php require_once ROOT . '/includes/footer.php'; ?>