<?php
define('ROOT', dirname(__DIR__));
$title = 'command success'; 
require_once ROOT . '/includes/header.php';
require_once ROOT . '/src/helpers.php';
?>

<div class="container-fluid my-5">
    <form action="/pages/traitement-login.php" method="post">
        <form action="" method="get">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <input type="submit" class="btn btn-warning mt-3" value="Login">
            </div>
        </form>
    </form>
    <p><a class="nav-link" href="/pages/logNewUser.php">if you don't have any account: click here !</a></p>
</div>

<?php require_once ROOT . '/includes/footer.php'; ?>