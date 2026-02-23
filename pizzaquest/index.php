<?php
    session_start();

    $_SESSION['user'] = array(
        'firstname' => 'prénom',
        'lastname' => 'nom',
        'email' => 'email',
        'adresse' => 'Votre adresse',
        'phone' => '** ** ** ** **'
    );

    require_once __DIR__ . '/pages/acceuil.php';
?>