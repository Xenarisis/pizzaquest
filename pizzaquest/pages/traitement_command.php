<?php 
    define('ROOT', dirname(__DIR__));
    require_once ROOT . '/includes/bootstrap.php';

    $var = $_POST;

    $pdo = getDB();

    if(!($var['pizzas'] || $var["livraison"] || $var['telephone'])) {
        $_SESSION['error'] = 'Veuillez remplir tous les champs obligatoires';
        redirect('/pages/command.php');
    }

    if($var["livraison"] == "domicile" && !$var['adress']) {
        $_SESSION['error'] = 'Veuillez remplir votre adresse pour une livraison à domicile';
        redirect('/pages/command.php');
    }

    if(!isset($_SESSION['is_connected'])) {

        $_SESSION['command'] = array(
            'livraison' => $var['livraison'],
            'adresse' => $var['adresse'],
            'phone' => $var['phone']
        );

        $stmt = $pdo->prepare("INSERT INTO orders (user_id, pizza_id, quantity, comment, statut) VALUES (:user_id, :pizza_id, :quantity, :comment, :statut)");
        $result = $stmt->execute(
            [
                ':user_id' => $_SESSION['user_id'] ?? null,
                ':pizza_id' => json_encode($var['pizzas']),
                ':quantity' => json_encode($var['quantities']),
                ':comment' => $var['comment'] ?? null,
                ':statut' => 'en cours'
            ]
        );
    }

    $_SESSION['success'] = true;
    redirect('/pages/confirmation.php');
?>