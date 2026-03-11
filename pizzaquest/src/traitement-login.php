<?php 
define('ROOT', dirname(__DIR__));
require_once ROOT . '/includes/bootstrap.php';

$NewUser = $_SESSION['newuser'] ?? false;
$pdo = getDB();

if($NewUser) {
    $user = array(
        'id' => null,
        'firstname' => $_POST['prenom'],
        'lastname' => $_POST['nom'],
        'email' => $_POST['email'],
        'password' => $_POST['MDP'],
        'adress' => $_POST['adress'],
        'phone' => $_POST['phone']
    );

    register($pdo, $user);

    redirect('/index.php?root=login');

} else {
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    $userGood = login($pdo, $email, $password);

    if($userGood) {
        $_SESSION['is_connected'] = true;
        redirect('/index.php?root=profil');
        exit;
    } else {
        $_SESSION['error'] = 'Email ou mot de passe incorrect';
        redirect('/index.php?root=login');
    }
}
?>