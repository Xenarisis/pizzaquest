<?php 

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
            <div class="card bg-warning bg-opacity-25" style="width: 1p;">
                <img src="$pizza[image]" class="card-img-top" alt="pizza">
                <div class="card-body justify-content-center">
                    <p class="card-text m-auto">- $pizza[name]</p>
                    <p class="card-text m-auto">- $pizza[price]</p>
                    <p>
                        <a class="btn btn-secondary" href="/pages/detailspizza.php?data=$data">View details &raquo</a>
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
                        value="$pizza[id]"
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
                    name="quantities[$pizza[id]]"
                    id="qte_$pizza[id] "
                    min="0" 
                    value=" $$pizza[id] ?? 0 "
                >
            </div>
        </div>
HTML;
    }


    function user_info(array $user, $is_new_user = false) {
        $password_part = $is_new_user ? '
                <div class="mb-3">
                    <label for="MDP" class="form-label">Mot de passe *</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="MDP" 
                        name="MDP" 
                        value=""
                        placeholder="Veuillez entrer votre mot de passe"
                        required
                    >
                </div>' : '';

        return <<<HTML
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
                            value="$user[lastname]"
                            placeholder="Veuillez entrer votre nom"
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
                            value="$user[firstname]"
                            placeholder="Veuillez entrer votre prénom"
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
                        value="$user[email]"
                        placeholder="Veuillez entrer votre adresse email"
                        required
                    >
                </div>

                $password_part

                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone *</label>
                    <input 
                        type="tel" 
                        class="form-control" 
                        id="telephone" 
                        name="telephone"
                        value="$user[phone]"
                        placeholder="Veuillez entrer votre numéro de téléphone"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="adress" class="form-label">Adresse de livraison *</label>
                    <textarea 
                        class="form-control" 
                        id="adress" 
                        name="adress" 
                        rows="3"
                        placeholder="Veuillez entrer votre addresse"
                        required
                    >$user[adress]</textarea>
                </div>
            </div>
HTML;
    }

    // will add admin part later to add pizzas and etc

    // function add_pizza(string $pizza, string $pizza_price) {
    //     $all_pizzas[] = array(
    //         'id' => $pizza,
    //         'name' => $pizza,
    //         'price' => $pizza_price.' €'
    //         );
    // };

    function find_pizza($pizza_id, $all_pizzas) {
        foreach ($all_pizzas as $value) {
            if($value["id"] == $pizza_id) {
                return $value;
            }
        }
    }
?>