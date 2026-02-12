<?php 
    require ROOT.'/src/db.php';
    function nav_items (string $road, string $title): string {
        $class = 'nav-item';
        if ($_SERVER['SCRIPT_NAME'] === $title ) {
            $class .= ' active';
        }
        return <<<HTML
        <li class="$class">
            <a class="nav-link" href="$road">$title</a>
        </li>
HTML;
    }

    function show_pizza(array $pizza) {
        $data = urlencode(json_encode($pizza));

        return <<<HTML
        <div class="container-fluid align-items-center col-lg-4">
            <div class="card" style="width: 1p;">
                <img src="https://media.istockphoto.com/id/1493116898/fr/photo/pizza-italienne-napoletana-dans-la-cuisine-en-désordre-avec-des-ingrédients-de-cuisson.jpg?s=2048x2048&w=is&k=20&c=kKsrs7aJrRVo2LQzGqlHQcDTQGK6EsmV5wdcDs3RaqM=" class="card-img-top" alt="pizza">
                <div class="card-body justify-content-center">
                    <p class="card-text">$pizza[name]</p>
                    <p class="card-text">$pizza[price]</p>
                    <p>
                        <a class="btn btn-info" href="/pages/detailspizza.php?data=$data">View details &raquo</a>
                    </p>
                </div>
            </div>
        </div>
HTML;
    }

    function checkbox_pizza(array $pizza) {
        return <<<HTML
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">$pizza[name]</label>
        </div>
HTML;
    }

    function check_pizza(array $pizza, $key, $n) {
        $command_pizza[$key] = $all_pizzas[$key];
        $command_pizza[$key]['nbr'] .= $n;
    }

    function add_pizza(string $pizza, string $pizza_price) {
        $all_pizzas[] = array(
            'name' => $pizza,
            'price' => $pizza_price.' €'
            );
    };
?>