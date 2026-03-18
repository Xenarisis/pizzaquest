<?php 
    define('ROOT', dirname(__DIR__));
    require_once ROOT . '/includes/init.php';

    $var = $_POST;

    $pdo = getDB();

    if(!($var['pizzas'] || $var["livraison"] || $var['telephone'])) {
        $_SESSION['error'] = 'Veuillez remplir tous les champs obligatoires';
        redirect('/index.php?root=command');
    }

    if($var["livraison"] == "domicile" && !$var['adress']) {
        $_SESSION['error'] = 'Veuillez remplir votre adresse pour une livraison à domicile';
        redirect('/index.php?root=command');
    }

    $_SESSION['command'] = array(
        'livraison' => $var['livraison'],
        'adress' => $var['adress'],
        'phone' => $var['phone']
    );

    $stmt = $pdo->prepare("INSERT INTO orders (user_id, pizza_id, quantity, comment, statut) VALUES (:user_id, :pizza_id, :quantity, :comment, :statut)");
        $result = $stmt->execute(
            [
                ':user_id' => $_SESSION['user_id'] ?? 0,
                ':pizza_id' => json_encode($var['pizzas']),
                ':quantity' => json_encode($var['quantities']),
                ':comment' => $var['comment'] ?? '',
                ':statut' => 'en cours'
            ]
        );

    $_SESSION['success'] = true;
    redirect('/index.php?root=confirmation');
?>