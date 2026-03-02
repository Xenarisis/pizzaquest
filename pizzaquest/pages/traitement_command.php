<?php 
    define('ROOT', dirname(__DIR__));
    require_once ROOT . '/includes/bootstrap.php';

    $var = $_POST;

    if($var['pizzas'] == null || $var['livraison'] == null || $var['phone'] == null) {
        $_SESSION['error'] = 'Veuillez remplir tous les champs obligatoires';
        redirect('/pages/command.php');
    }

    if($var['livraison'] == 'domicile' && $var['adresse'] == null) {
        $_SESSION['error'] = 'Veuillez remplir votre adresse pour une livraison à domicile';
        redirect('/pages/command.php');
    }

    $commanded_pizza = array(null);

    foreach ($var['pizzas'] as $value) {
        $time = $var['quantites'][$value];
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