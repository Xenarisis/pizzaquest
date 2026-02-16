<?php 
    define('ROOT', dirname(__DIR__));
    require_once ROOT . '/src/helpers.php';
    require_once ROOT . '/src/db.php';

    $var = $_POST;
    print_r($var);

    if($var['pizzas'] == null) {
        redirect('/pages/command.php');
    }

    if($var['livraison'] == null) {
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

    redirect('/pages/confirmation.php');
?>