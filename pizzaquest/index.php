<?php
    require_once __DIR__ . '/includes/init.php';

    $allowed = ['nous', 'acceuil', 'command', 'profil', 'login', 'logout', 'logNewUser', 'menu', 'detailspizza', 'confirmation'];
    if(isset($_SESSION['user_id'])) {
        $pdo = getDB();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
        $stmt->execute([':user_id' => $_SESSION['user_id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user['role'] == 'admin') {
            array_push($allowed, 'admin');
        }
    }
    $page = $_GET['root'] ?? 'acceuil';


    // var_dump($_GET['root']);
    // exit;

    if(in_array($page, $allowed)) {
        include("/pages/$page.php");
        redirect("/pages/$page.php");
    } else {
        include("/pages/404.php");
        redirect('/pages/404.php');
    } 

?>
