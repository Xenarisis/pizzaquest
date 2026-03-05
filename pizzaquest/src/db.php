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

function add_pizza(PDO $pdo, array $pizza): bool {
    $stmt = $pdo->prepare('INSERT INTO pizzas (name, price, image, description, is_pizza_du_jour) VALUES (:name, :price, :image, :description, :is_pizza_du_jour)');
    $pizza = [
        'name' => $pizza['name'] ?? 'La pizza',
        'price' => $pizza['price'] ?? 8,
        'image' => $pizza['image'] ?? 'https://media.istockphoto.com/id/1493116898/fr/photo/pizza-italienne-napoletana-dans-la-cuisine-en-désordre-avec-des-ingrédients-de-cuisson.jpg?s=2048x2048&w=is&k=20&c=kKsrs7aJrRVo2LQzGqlHQcDTQGK6EsmV5wdcDs3RaqM=',
        'description' => $pizza['description'] ?? 'Une délicieuse pizza faite maison',
        'is_pizza_du_jour' => $pizza['is_pizza_du_jour'] ?? 0
    ];
    $result = $stmt->execute($pizza); 

    return $result;
}

function modify_pizza(PDO $pdo, array $pizza, $pizza_id): bool {
    $stmt = $pdo->prepare('SELECT * FROM pizzas WHERE id = :id');
    $stmt->execute([':id' => $pizza_id]);
    $pizza_existing = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare('UPDATE pizzas SET name = :name, price = :price, image = :image, description = :description, is_pizza_du_jour = :is_pizza_du_jour WHERE id = :id');
    $pizza = [
        'name' => $pizza['name'] ?? $pizza_existing['name'],
        'price' => $pizza['price'] ?? $pizza_existing['price'],
        'image' => $pizza['image'] ?? $pizza_existing['image'],
        'description' => $pizza['description'] ?? $pizza_existing['description'],
        'is_pizza_du_jour' => $pizza['is_pizza_du_jour'] ?? $pizza_existing['is_pizza_du_jour'],
        'id' => $pizza_id
    ];
    $result = $stmt->execute($pizza); 

    return $result;
}

function delete_pizza(PDO $pdo, $pizza_id): bool {
    $stmt = $pdo->prepare('DELETE FROM pizzas WHERE id = :id');
    $result = $stmt->execute([':id' => $pizza_id]); 

    return $result;
}

function modify_pizza_du_jour(PDO $pdo, array $pizza_ids): bool {
    $stmt = $pdo->prepare('UPDATE pizzas SET is_pizza_du_jour = 0');
    $stmt->execute();

    $stmt = $pdo->prepare('UPDATE pizzas SET is_pizza_du_jour = 1 WHERE id IN (' . implode(',', array_map('intval', $pizza_ids)) . ')');
    $result = $stmt->execute();

    return $result;
}
?>