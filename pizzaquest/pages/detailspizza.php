<?php define('ROOT', dirname(__DIR__));
$arr = json_decode($_GET['data'], true);
$title = 'Details pizza'; 
require_once ROOT . '/includes/header.php';
require_once ROOT . '/src/helpers.php';
?>

<div class="container justify-content-center">
    <div class="container-fluid">
        <img src="https://media.istockphoto.com/id/1493116898/fr/photo/pizza-italienne-napoletana-dans-la-cuisine-en-désordre-avec-des-ingrédients-de-cuisson.jpg?s=2048x2048&w=is&k=20&c=kKsrs7aJrRVo2LQzGqlHQcDTQGK6EsmV5wdcDs3RaqM=" class="img-fluid rounded" alt="Responsive image">
    </div>
    <div class="container-fluid justify-content-center">
        <h2>Détails pizza</h2>
        <?php foreach($arr as $key => $value) {
            echo "$value\r\n";
        } ?>
    </div>
</div>

<?php require_once ROOT . '/includes/footer.php';
?>