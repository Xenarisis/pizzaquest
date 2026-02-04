<?php require_once 'src/helpers.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php if(isset($title)) { echo $title; } else { echo 'Mypizza'; } ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  </head>

  <body>

    <nav class="navbar bg-black">
        <div class="container-fluid">
           <a class="navbar-brand" href="#">Hello</a>

           <div class="collapse navbar-collapse">
                <ul class="navbar-nav m-auto">
                    <?php nav_items('pages/accueil.php', 'Acceuil');?>
                    <?php nav_items('pages/menu.php', 'Menus');?>
                    <?php nav_items('pages/nous.php', 'A propos de nous');?>
                    <?php nav_items('pages/panier.php', 'Panier');?>
                </ul>
            </div>
        </div>
    </nav>

    <main role="main" class="container">
