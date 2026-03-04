<?php

    require_once __DIR__ . '/includes/bootstrap.php';

    $_SESSION['user_id'] = $_SESSION['user_id'] ?? null;

    require_once __DIR__ . '/pages/acceuil.php';
?>
