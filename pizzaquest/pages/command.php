<?php define('ROOT', dirname(__DIR__));
$title = 'Passer commande'; 
require_once ROOT . '/includes/header.php';
require_once ROOT . '/src/helpers.php';

$user = $_SESSION['user'] ?? array(
            'firstname' => 'prénom',
            'lastname' => 'nom',
            'email' => 'email',
            'adresse' => 'Votre adresse',
            'phone' => '** ** ** ** **'
        );
?>

<div class="container my-5">
    <h1>Passer une commande</h1>

    <form method="POST" action="/pages/traitement_command.php" class="needs-validation">
        <div class="card bg-warning bg-opacity-25 mb-4">
            <div class="card-header">
                <h3>Choisissez vos pizzas</h3>
            </div>
            <div class="card-body">
                <?php foreach ($all_pizzas as $pizza) {
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