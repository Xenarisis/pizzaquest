<?php 
define('ROOT', dirname(__DIR__));
$title = 'acceuil'; 
require_once ROOT . '/includes/header.php';

if (isset($_SESSION['user_id'])) {
    $pdo = getDB();
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $stmt->execute([':id' => $_SESSION['user_id'] ?? null]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user['role'] !== 'admin') {
        header('Location: /pages/acceuil.php');
        exit();
    }
} else {
    header('Location: /pages/login.php');
    exit();
}
?>

<div class="container-fluid ">


    <div class="container-fluid align-items-center p-5">
        <H2><strong>Modifer la/les pizza(s) du jour</strong></H2>
        <form action="" method="POST">
            <?php 
            $pdo = getDB();
            $stmt = $pdo->query('SELECT * FROM pizzas');
            $all_pizzas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($all_pizzas as $pizza) {
                if($pizza['is_pizza_du_jour'] == 1) {
                    $checked = 'checked';
                } else {
                    $checked = '';
                }
                echo "<div class=\"col-md-6\">
                        <div class=\"form-check\">
                            <input 
                                class=\"form-check-input\" 
                                type=\"checkbox\" 
                                name=\"pizzas[]\"
                                value=\"$pizza[id]\"
                                id=\"pizza_$pizza[id]\"
                                $checked
                                >
                            <label class=\"form-check-label\" for=\"pizza_$pizza[id]\">
                                <strong>$pizza[name]</strong>
                                - $pizza[price] €
                            </label>
                        </div>
                    </div>";
            }
            ?>

            <input type="hidden" name="modif_pizza_du_jour" value="1">
            <button type="submit" class="btn btn-secondary">Modifier la/les pizza(s) du jour</button>

            <?php
                if(isset($_POST['modif_pizza_du_jour']) && isset($_POST['pizzas']) ) {

                    modify_pizza_du_jour($pdo, $_POST['pizzas']);

                    echo '<div class="alert alert-success mt-3" role="alert">Pizza(s) du jour modifiée(s) avec succès !</div>';
                }
            ?>
        </form>
    </div>

    <div class="container-fluid align-items-center p-5">
        <H2><strong>Ajouter une nouvelle pizza</strong></H2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nom de la pizza</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description de la pizza</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Prix de la pizza</label>
                <input type="number" class="form-control" id="price" name="price" required> 
            </div>
            <input type="hidden" name="newpizza" value="1">
            <button type="submit" class="btn btn-secondary">Ajouter la pizza </button>
        </form>

        <?php 
            if((isset($_POST['name']) || isset($_POST['description']) || isset($_POST['price'])) && isset($_POST['newpizza']) ) {
                $pizza = array (
                    'name' => $_POST['name'],
                    'description' => $_POST['description'],
                    'price' => $_POST['price']
                );

                $pdo = getDB();

                add_pizza($pdo, $pizza);

                echo '<div class="alert alert-success mt-3" role="alert">Pizza ajoutée avec succès !</div>';
            }
        ?>
    </div>
    <div class="container-fluid align-items-center p-5">
        <H2><strong>Modifier une pizza</strong></H2>

        <form action="" method="POST">
            <?php 
            $pdo = getDB();
            $stmt = $pdo->query('SELECT * FROM pizzas');
            $all_pizzas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($all_pizzas as $pizza) {
                echo "<div class=\"col-md-6\">
                        <div class=\"form-check\">
                            <input 
                                class=\"form-check-input\" 
                                type=\"checkbox\" 
                                name=\"pizzas[]\"
                                value=\"$pizza[id]\"
                                id=\"pizza_$pizza[id]\"
                            >
                            <label class=\"form-check-label\" for=\"pizza_$pizza[id]\">
                                <strong>$pizza[name]</strong>
                                - $pizza[price] €
                            </label>
                        </div>
                    </div>";
            }
            ?>

            <div class="mb-3">
                <label for="name" class="form-label">Modifier le nom de la pizza</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Modifier l'image de la pizza (lien)</label>
                <input type="text" class="form-control" id="image" name="image">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Modifier la description de la pizza</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Modifier le prix de la pizza</label>
                <input type="number" class="form-control" id="price" name="price"> 
            </div>

            <input type="hidden" name="modifpizza" value="1">
            <button type="submit" class="btn btn-secondary">Modifier la pizza</button>

            <?php
                if((isset($_POST['name']) || isset($_POST['description']) || isset($_POST['price']) || isset($_POST['image'])) && isset($_POST['modifpizza']) && isset($_POST['pizzas']) ) {
                    $pizza = array (null);

                    if(isset($_POST['name']) && !empty($_POST['name'])) { $pizza['name'] = $_POST['name']; }
                    if(isset($_POST['description']) && !empty($_POST['description'])) { $pizza['description'] = $_POST['description']; }
                    if(isset($_POST['price']) && !empty($_POST['price'])) { $pizza['price'] = $_POST['price']; }
                    if(isset($_POST['image']) && !empty($_POST['image'])) { $pizza['image'] = $_POST['image']; }

                    modify_pizza($pdo, $pizza, $_POST['pizzas']);

                    echo '<div class="alert alert-success mt-3" role="alert">Pizza modifier avec succès !</div>';
                }
            ?>

        </form>
    </div>
    <div class="container-fluid align-items-center p-5">
        <H2><strong>Supprimer une pizza</strong></H2>

        <form action="" method="POST">
            <?php 
            $pdo = getDB();
            $stmt = $pdo->query('SELECT * FROM pizzas');
            $all_pizzas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($all_pizzas as $pizza) {
                echo "<div class=\"col-md-6\">
                        <div class=\"form-check\">
                            <input 
                                class=\"form-check-input\" 
                                type=\"checkbox\" 
                                name=\"pizzas[]\"
                                value=\"$pizza[id]\"
                                id=\"pizza_$pizza[id]\"
                            >
                            <label class=\"form-check-label\" for=\"pizza_$pizza[id]\">
                                <strong>$pizza[name]</strong>
                                - $pizza[price] €
                            </label>
                        </div>
                    </div>";
            }
            ?>

            <input type="hidden" name="delpizza" value="1">
            <button type="submit" class="btn btn-secondary">Supprimer la pizza</button>

            <?php
                if(isset($_POST['delpizza']) && isset($_POST['pizzas']) ) {

                    foreach($_POST['pizzas'] as $value) {
                        delete_pizza($pdo, $value);
                    }

                    echo '<div class="alert alert-success mt-3" role="alert">Pizza supprimée avec succès !</div>';
                }
            ?>

        </form>
    </div>

</div>

<?php
require_once ROOT . '/includes/footer.php';
?>