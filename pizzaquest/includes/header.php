<?php require 'src/helpers.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php if(isset($title)) { echo $title; } else { echo 'Mypizza'; } ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  </head>

  <body>

    <div class="container-fluid">
            <header>
                 <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>   
                    </button>

                        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                            <ul class="navbar-nav m-auto px-2">
                                <li class="nav-item"><a class="nav-link" href="#">Sur place</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">A emporter</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Par livraison</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Telephone</a></li>
                            </ul>
                        </div>
                </nav>

                <?php require 'nav.php'; ?>
            </header>
    </div>

    <main role="main" class="container">
