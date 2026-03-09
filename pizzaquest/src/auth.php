<?php 
    function login(PDO $pdo, string $email, string $password): bool{
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
    
            getLogger('auth')->info('Login réussi', ['email' => $email]);  // log on -> /../logs/auth.log (little reminder for me)
            return true;
        }
    
        getLogger('auth')->warning('Login échoué', ['email' => $email]);   // log on -> /../logs/auth.log (little reminder for me)
        getLogger('errors')->error('Accès refusé', ['email' => $email]);   // log on -> /../logs/errors.log (little reminder for me)
        return false;
    }

    function register(PDO $pdo, array $user): bool {
        $stmt = $pdo->prepare("INSERT INTO users (id, firstname, lastname, email, password, adress, phone, role) VALUES (:id, :firstname, :lastname, :email, :password, :adress, :phone, :role)");
        $result = $stmt->execute([
            ':id' => $user['id'],
            ':firstname' => $user['firstname'],
            ':lastname' => $user['lastname'],
            ':email' => $user['email'],
            ':password' => password_hash($user['password'], PASSWORD_DEFAULT),
            ':adress' => $user['adress'],
            ':phone' => $user['phone'],
            ':role' => $user['role'] ?? 'user'
        ]);

        if ($result) {
            getLogger('auth')->info('Inscription réussie', ['email' => $user['email']]);  // log on -> /../logs/auth.log (little reminder for me)
        } else {
            getLogger('auth')->error('Inscription échouée', ['email' => $user['email']]);  // log on -> /../logs/auth.log (little reminder for me)
        }

        return $result;
    }

    function modify_user_info(PDO $pdo, array $user, $user_id): bool {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([':id' => $user_id]);
        $user_existing = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare('UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, password = :password, adress = :adress, phone = :phone WHERE id = :id');
        $user = [
            'firstname' => $user['firstname'] ?? $user_existing['firstname'],
            'lastname' => $user['lastname'] ?? $user_existing['lastname'],
            'email' => $user['email'] ?? $user_existing['email'],
            'password' => isset($user['password']) ? password_hash($user['password'], PASSWORD_DEFAULT) : $user_existing['password'],
            'adress' => $user['adress'] ?? $user_existing['adress'],
            'phone' => $user['phone'] ?? $user_existing['phone'],
            'id' => $user_id
        ];
        $result = $stmt->execute($user); 

        if ($result) {
            getLogger('auth')->info('Modification des informations réussie', ['email' => $user['email']]);  // log on -> /../logs/auth.log (little reminder for me)
        } else {
            getLogger('auth')->error('Modification des informations échouée', ['email' => $user['email']]);  // log on -> /../logs/auth.log (little reminder for me)
        }

        return $result;
    }
?>