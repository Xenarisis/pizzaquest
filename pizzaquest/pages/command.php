<?php define('ROOT', dirname(__DIR__));
$title = 'Passer commande'; 
require_once ROOT . '/includes/header.php';

$user = array(
    'id' => $_SESSION['user_id'] ?? null,
    'firstname' => $_SESSION['user_firstname'] ?? '',
    'lastname' => $_SESSION['user_lastname'] ?? '',
    'email' => $_SESSION['user_email'] ?? '',
    'adress' => $_SESSION['user_adress'] ?? '',
    'phone' => $_SESSION['user_phone'] ?? ''
)

?>

<div class="container my-5">
    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
</div>

<div class="container my-5">
    <h1>Passer une commande</h1>

    <form method="POST" action="/pages/traitement_command.php" class="needs-validation">
        <div class="card bg-warning bg-opacity-25 mb-4">
            <div class="card-header">
                <h3>Choisissez vos pizzas</h3>
            </div>
            <div class="card-body">
                <?php 
                $pdo = getDB();
                $stmt = $pdo->query('SELECT * FROM pizzas');
                $all_pizzas = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                foreach ($all_pizzas as $pizza) {
                    echo checkbox_pizza($pizza);
                }
                ?>
            </div>
        </div>

        <div class="card bg-warning bg-opacity-25 mb-4">
            <?= user_info($user);?>
        </div>

        <div class="card bg-warning bg-opacity-25 mb-4">
            <div class="card-header">
                <h3>Mode de commande </h3>
            </div>
            <div class="card-body">
                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="radio" 
                        name="livraison" 
                        value="Sur_place" 
                        id="Sur_place"
                    >
                    <label class="form-check-label" for="Sur_place">
                        Sur place
                    </label>
                </div>
                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="radio" 
                        name="livraison" 
                        value="domicile" 
                        id="livraison_domicile"
                    >
                    <label class="form-check-label" for="livraison_domicile">
                        Livraison à domicile (+5€)
                    </label>
                </div>
                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="radio" 
                        name="livraison" 
                        value="emporter"
                        id="livraison_emporter"
                    >
                    <label class="form-check-label" for="livraison_emporter">
                        À emporter
                    </label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg">
            Valider ma commande
        </button>
    </form>
</div>

<?php require_once ROOT . '/includes/footer.php';
?>