<?php 
    require_once ROOT .'/src/db.php';

    function e($value) {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
    
    function redirect($url) {
        header("Location: $url");
        exit;
    }

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
        <div class="row mb-3 align-items-center">
            <div class="col-md-6">
                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="checkbox" 
                        name="pizzas[]" 
                        value="$pizza[name]"
                        id="pizza_$pizza[id]"
                    >
                    <label class="form-check-label" for="pizza_$pizza[id]">
                        <strong>$pizza[name]</strong> 
                        - $pizza[price]
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <label for="qte_$pizza[id]" class="form-label">Quantité</label>
                <input 
                    type="number" 
                    class="form-control" 
                    name="quantites[$pizza[id]]"
                    id="qte_$pizza[id] "
                    min="0" 
                    value=" $$pizza[id] ?? 0 "
                >
            </div>
        </div>
HTML;
    }

    function user_info(array $user) {
        return <<<HTML
        <div class="card mb-4">
            <div class="card-header">
                <h3>Vos informations</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nom" class="form-label">Nom *</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="nom" 
                            name="nom" 
                            value=""
                            required
                        >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="prenom" class="form-label">Prénom *</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="prenom" 
                            name="prenom"
                            value=""
                            required
                        >
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input 
                        type="email" 
                        class="form-control" 
                        id="email" 
                        name="email"
                        value=""
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone *</label>
                    <input 
                        type="tel" 
                        class="form-control" 
                        id="telephone" 
                        name="telephone"
                        value="$user[phone]"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse de livraison *</label>
                    <textarea 
                        class="form-control" 
                        id="adresse" 
                        name="adresse" 
                        rows="3"
                        required
                    >$user[adresse]</textarea>
                </div>
            </div>
        </div>
HTML;
    }

    function add_pizza(string $pizza, string $pizza_price) {
        $all_pizzas[] = array(
            'id' => $pizza,
            'name' => $pizza,
            'price' => $pizza_price.' €'
            );
    };

    function find_pizza($pizza, $all_pizzas) {
        foreach ($all_pizzas as $value) {
            if($value['name'] == $pizza) {
                return $value;
            }
        }
    }
?>