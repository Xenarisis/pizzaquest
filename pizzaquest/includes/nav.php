<nav class="navbar sticky-top navbar-expand-lg navbar-light" style="background-color: #d0a01a;">
    <a class="navbar-brand" href="/pages/acceuil.php"><em><strong>Chez Marco.</strong></em></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="container-fluid d-flex justify-content-start">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="/pages/acceuil.php">Accueil</a></li>
            <li class="nav-item"><a class="nav-link" href="/pages/menu.php">Menu</a></li>
            <li class="nav-item"><a class="nav-link" href="/pages/nous.php">A propos de nous</a></li>
        </ul>
    </div>

    <div class="container-fluid d-flex justify-content-center">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="/pages/command.php">commande</a></li>
        </ul>
    </div>
    <div class="container-fluid d-flex justify-content-end me-5">
        <ul class="navbar-nav">
            <?php if (!isset($_SESSION['user_id'])): ?>
                <li class="nav-item"><a class="nav-link" href="/pages/login.php">Login</a></li>
            <?php else: ?>
                <?php 
                    $pdo = getDB();
                    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
                    $stmt->execute([':id' => $_SESSION['user_id'] ?? null]);
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                    if($user['role'] === 'admin'):
                    ?>
                    <li class="nav-item"><a class="nav-link" href="/pages/admin.php">Admin</a></li>
                    <?php endif; ?>
                <li class="nav-item"><a class="nav-link" href="/pages/profil.php">Mon profil</a></li>
            <?php endif; ?>
        </ul>
    </div>

</nav>