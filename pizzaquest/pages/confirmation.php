<?php
define('ROOT', dirname(__DIR__));
$title = 'command success'; 
require_once ROOT . '/includes/header.php';

if(!isset($_SESSION['success']) || $_SESSION['success'] != true) {
    header('Location: /index.php?root=command');
    exit();
}

unset($_SESSION['success']);
?>

<div class="container my-5">
    <div class="alert alert-success " role="alert">
        <h3 class="alert-heading">Commande validée !</h3>
        
        <h3>Votre commande</h3>

        <?php 
            $command = $_SESSION['command'];

            $user = $_SESSION['uesr_id'] ?? 0;


            $pdo = getDB();
            $stmt = $pdo->query("SELECT * FROM orders WHERE user_id = $user");
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // var_dump($order[0]);

            echo '<h3>Vos pizzas</h3>';

            foreach($orders as $order) {
                $pizza = json_decode($order['pizza_id']);
                foreach($pizza as $value) {
                    $stmtp = $pdo->query("SELECT * FROM pizzas WHERE id = $value");
                    $p = $stmtp->fetchAll(PDO::FETCH_ASSOC);

                    $name = $p[0]['name'];

                    echo "<p> - $name </p>";
                }
            }

            echo '<H3>Prix total</H3>';

            $price = 0;

            foreach($orders as $order) {
                $pizza = json_decode($order['pizza_id']);
                foreach($pizza as $value) {
                    $stmtp = $pdo->query("SELECT * FROM pizzas WHERE id = $value");
                    $p = $stmtp->fetchAll(PDO::FETCH_ASSOC);

                    $price += $p[0]['price'];
                    
                }
            }

            echo "<p> $price € </p>";

        ?>

        <p>Nous vous remercions d'avoir pris une pizza chez nous.</p>
        <p class="mb-3">
            <a href="/index.php?root=menu" class="btn btn-primary">Retour au menu</a>
        </p>
    </div>
</div>

<?php require_once ROOT . '/includes/footer.php'; ?>