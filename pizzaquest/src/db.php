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

            getLogger('db')->info('Connexion DB réussie');
        } catch (PDOException $e) {
            getLogger('db')->error('Erreur DB : ' . $e->getMessage());
            die("Erreur de connexion");
        }
    }

    return $pdo;
}

?>