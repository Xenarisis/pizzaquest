<?php 
define('ROOT', dirname(__DIR__));
require_once ROOT . '/src/helpers.php';

$NewUser = $_SESSION['newuser'] ?? false;

if($NewUser) {
    $_SESSION['user'] = array(
        'id' => uniqid(),
        'firstname' => $_POST['prenom'] ?? null,
        'lastname' => $_POST['nom'] ?? null,
        'email' => $_POST['email'] ?? null,
        'password' => $_POST['password'] ?? null,
        'adresse' => $_POST['adresse'] ?? null,
        'phone' => $_POST['phone'] ?? null
    );

    redirect('/pages/profil.php');

} else {
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    $user = connect_user($email, $password);

    if($user['password'] === $password) {
        $_SESSION['user'] = $user;
        redirect('/pages/profil.php');
    } else {
        $_SESSION['error'] = 'Email ou mot de passe incorrect';
        header('Location: /pages/login.php');
        exit();
    }
}
?>