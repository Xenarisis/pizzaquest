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

    <div class="container-fluid align-items-center p-5">
        <h3 class="mt-2">Si vous souhaitez modifier vos informations c'est juste ici:</h3>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="firstname" class="form-label">Modifier votre prénom</label>
                <input type="text" class="form-control" id="firstname" name="firstname">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Modifier votre nom</label>
                <input type="text" class="form-control" id="lastname" name="lastname">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Modifier votre email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Modifier votre mot de passe</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="adress" class="form-label">Modifier votre adresse</label>
                <input type="text" class="form-control" id="adress" name="adress">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Modifier votre numéro de téléphone</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>
            <input type="hidden" name="modify_user_info" value="1">
            <button type="submit" class="btn btn-secondary">Modifier mes informations</button>
        </form>
        <?php 
        if((isset($_POST['firstname']) || isset($_POST['lastname']) || isset($_POST['email']) || isset($_POST['password']) || isset($_POST['adress']) || isset($_POST['phone'])) && isset($_POST['modify_user_info']) ) {
            $user = array (
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'adress' => $_POST['adress'],
                'phone' => $_POST['phone']
            );

            $pdo = getDB();

            modify_user_info($pdo, $user, $_SESSION['user_id']);

            echo '<div class="alert alert-success mt-3" role="alert">Informations modifiées avec succès !</div>';
        }

        ?>
    </div>

    <div class="d-flex justify-content-center">
        <a class="nav-link" href="/pages/logout.php">Logout</a>
    </div>
</div>

<?php require_once ROOT . '/includes/footer.php'; ?>