<?php 
define('ROOT', dirname(__DIR__));
$title = 'acceuil'; 
require_once ROOT . '/includes/header.php';
require_once ROOT . '/src/helpers.php';
?>
<div class="container-fluid ">
    <div class="container-fluid align-items-center p-5">
        <H2><strong>Présentation de pizzaquest</strong></H2>
        <p>PizzaQuest est un projet de développement web réalisé dans un cadre pédagogique.
        Il s’agit de concevoir une application web complète pour une pizzeria de quartier, depuis l’affichage du menu jusqu’à la gestion des commandes et de l’administration, en utilisant PHP natif, sans framework.
        Le projet répond à un besoin concret qui est d'aider Marco, le gérant de la pizzeria qui nous a engagé, à digitaliser son activité, jusque-là gérée entièrement sur papier.
        L’application permet :
        aux clients de consulter le menu ,passer commande en ligne et par exemple se créer un compte aussi,
        au gérant (admin) de gérer les pizzas et de suivre les commandes via une interface sécurisée.
        PizzaQuest est développé progressivement sur plusieurs semaines, chaque nouvelle fonctionnalité s’appuyant sur les notions apprises précédemment. Le projet couvre l’ensemble du cycle de vie d’une application web : conception, développement, sécurité, base de données, versioning et monitoring.</p>
    </div>
    <div class="row p-5">
        <h2><strong>Les pizzas du moment</strong></h2>
        <?php $index = 0;

        foreach($all_pizzas as $value) {
            if($index >= 3) {
                break;
            } else {
                echo show_pizza($value);
                $index++;
            }
        } ?>
    </div>
    <div class="container-fluid align-items-center p-5">
        <h2><strong>À propos de nous</strong></h2>
        <p>Marco a toujours aimé la cuisine et surtout la pizza. Après plusieurs années d’expérience, il a décidé d’ouvrir sa propre pizzeria avec une idée simple : faire de bonnes pizzas, avec des produits de qualité et sans chichi.
        Ici, on mise sur la simplicité, le goût et la générosité. Chaque pizza est préparée avec soin et dans une ambiance conviviale. La pizzeria de Marco, c’est un endroit où l’on vient manger une bonne pizza et passer un bon moment, tout simplement.</p>
    </div>
</div>

<?php
require_once ROOT . '/includes/footer.php';
?>