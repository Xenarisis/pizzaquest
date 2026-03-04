<?php
define('ROOT', dirname(__DIR__));
$title = 'Login'; 
require_once ROOT . '/includes/header.php';

$_SESSION['newuser'] = false;
?>

<div>
    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
</div>

<div class="container-fluid my-5">
    <form action="/pages/traitement-login.php" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Veuillez rentrer votre adresse email" required>

            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Veuillez rentrer votre mot de passe" required>

            <input type="submit" class="btn btn-warning mt-3" value="Login">
        </div>
    </form>
    <p><a class="nav-link" href="/pages/logNewUser.php">if you don't have any account: click here !</a></p>
</div>

<?php require_once ROOT . '/includes/footer.php'; ?>