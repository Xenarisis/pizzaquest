<?php 
    define('ROOT', dirname(__DIR__));
    require_once ROOT . '/includes/bootstrap.php';

    $var = $_POST;

    $pdo = getDB();
    $stmt = $pdo->query('SELECT * FROM pizzas');
    $all_pizzas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($var['pizzas']);
    // var_dump($var['quantities']);
    // var_dump($_SESSION);
    // exit;

    if(!($var['pizzas'] || $var["livraison"] || $var['telephone'])) {
        $_SESSION['error'] = 'Veuillez remplir tous les champs obligatoires';
        redirect('/pages/command.php');
    }

    if($var["livraison"] == "domicile" && !$var['adress']) {
        $_SESSION['error'] = 'Veuillez remplir votre adresse pour une livraison à domicile';
        redirect('/pages/command.php');
    }

    foreach ($var['pizzas'] as $value) {
        $time = $var['quantities'][$value];
        if($time == null || $time == 0) {
            $time = 1;
        }
        for ($i=0; $i < $time; $i++) { 
            $commanded_pizza[] = find_pizza($value, $all_pizzas);
        }
    }

    $_SESSION['command'] = array(
        'pizzas' => $commanded_pizza,
        'livraison' => $var['livraison'],
        'adresse' => $var['adresse'],
        'phone' => $var['phone']
    );

    $_SESSION['success'] = true;
    redirect('/pages/confirmation.php');
?>