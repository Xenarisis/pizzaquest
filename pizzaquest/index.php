<?php

    session_start();
    
    $_SESSION['user'] = array(
        'id' => uniqid(),
        'firstname' => null,
        'lastname' => null,
        'email' => null,
        'password' => null,
        'adresse' => null,
        'phone' => null
    );
    
    require_once __DIR__ . '/pages/acceuil.php';
?>