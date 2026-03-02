<?php 

function getDB(): PDO {
    static $pdo = null;
    
    if ($pdo === null) {
        $host = '127.0.0.1';
        $port = '8889';
        $user = 'root';
        $pass = 'root';
        $dbname = 'pizzaquest';

        try {
            $pdo = new PDO(
                "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8",
                $user,
                $pass,
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]
            );
    
            $pdo->exec("CREATE DATABASE IF NOT EXISTS pizzaquest");
            $pdo->exec("USE pizzaquest");

            getLogger()->info('Connexion DB réussie');
        } catch (PDOException $e) {
            getLogger()->error('Erreur DB : ' . $e->getMessage());
            die("Erreur de connexion");
        }
    }

    return $pdo;
}

// pizzas :
    // 0 => array( 'id' => "chèvre miel",
    //             'name' => "chèvre miel",
    //             'price' => "10 €"
    //             ),
    // 1 => array( 'id' => "chorizo",
    //             'name' => "chorizo",
    //             'price' => "10 €"
    //             ),
    // 2 => array( 'id' => "4 fromages",
    //             'name' => "4 fromages",
    //             'price' => "10 €"
    //             ),
    // 3 => array( 'id' => "truffes",
    //             'name' => "truffes",
    //             'price' => "10 €"
    //             ),
    // 4 => array( 'id' => "margarita",
    //             'name' => "margarita",
    //             'price' => "10 €"
    //             ),
    // 5 => array( 'id' => "l'ambroise",
    //             'name' => "l'ambroise",
    //             'price' => "10 €"
    //             ),
    // 6 => array( 'id' => "montagnarde",
    //             'name' => "montagnarde",
    //             'price' => "10 €"
    //             ),
    // 7 => array( 'id' => "la speciale",
    //             'name' => "la speciale",
    //             'price' => "10 €"
    //             ),
    // 8 => array( 'id' => "hawaienne",
    //             'name' => "hawaienne",
    //             'price' => "10 €"
    //             ),
    // 9 => array( 'id' => "peperoni",
    //             'name' => "peperoni",
    //             'price' => "10 €"
    //             ),
    // 10 => array(    'id' => "francontoise",
    //             'name' => "francontoise",
    //             'price' => "10 €"
    //             ),
    // 11 => array(    'id' =>  "hot piquante",
    //             'name' => "hot piquante",
    //             'price' => "10 €"
    //             ),
    // 12 => array(    'id' => "raquelette",
    //             'name' => "raquelette",
    //             'price' => "10 €"
    //             ),
    // 13 => array(    'id' => "reine",
    //             'name' => "reine",
    //             'price' => "10 €"
    //             ),
    // 14 => array(    'id' => "graouuh",
    //             'name' => "graouuh",
    //             'price' => "10,99 €"
    //             )
// );

?>