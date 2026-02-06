<?php define('ROOT', dirname(__DIR__));
$title = 'menu'; 
require_once ROOT . '/includes/header.php'; ?>

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

<?php require_once ROOT . '/includes/footer.php';
?>