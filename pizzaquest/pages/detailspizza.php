<?php define('ROOT', dirname(__DIR__));
$title = 'Details pizza'; 
require_once ROOT . '/includes/header.php';
$arr = json_decode($_GET['data'], true);
?>

<div class="container justify-content-center">
    <div class="container-fluid">
        <img src="<?php echo $arr['image'] ?>" class="img-fluid rounded" alt="Responsive image">
    </div>
    <div class="container-fluid justify-content-center align-items-center my-5">
        <h2>Détails pizza</h2>
        <?php 
        echo "<p>- " . $arr['name'] . "</p>";
        echo "<p>- " . $arr['price'] . "€ </p>";
        echo "<p>- " . $arr['description'] . "</p>";
        ?>
    </div>
</div>

<?php require_once ROOT . '/includes/footer.php';
?>