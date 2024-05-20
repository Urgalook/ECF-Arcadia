<?php
// require_once 'back/pdo.php';

// $statement = $pdo->prepare('INSERT INTO users(email, password, role) VALUES (:email, :password, :role)');
// $statement->bindValue(':email', 'admin@arcadia.com');
// $statement->bindValue(':role', 'admin');

// // Hash du mot de passe en utilisant BCRYPT
// $statement->bindValue(':password', password_hash('adminZ24*', PASSWORD_BCRYPT));
// if ($statement->execute()) {
//     echo 'L\'utilisateur a bien été créé';
// } else {
//     echo 'Impossible de créer l\'utilisateur';
// }

// $statement = $pdo->prepare('INSERT INTO users(email, password, role) VALUES (:email, :password, :role)');
// $statement->bindValue(':email', 'employe@arcadia.com');
// $statement->bindValue(':role', 'employe');

// // Hash du mot de passe en utilisant BCRYPT
// $statement->bindValue(':password', password_hash('employeZ24*', PASSWORD_BCRYPT));
// if ($statement->execute()) {
//     echo 'L\'utilisateur a bien été créé';
// } else {
//     echo 'Impossible de créer l\'utilisateur';
// }

// $statement = $pdo->prepare('INSERT INTO users(email, password, role) VALUES (:email, :password, :role)');
// $statement->bindValue(':email', 'veterinaire@arcadia.com');
// $statement->bindValue(':role', 'veterinaire');

// // Hash du mot de passe en utilisant BCRYPT
// $statement->bindValue(':password', password_hash('veterinaireZ24*', PASSWORD_BCRYPT));
// if ($statement->execute()) {
//     echo 'L\'utilisateur a bien été créé';
// } else {
//     echo 'Impossible de créer l\'utilisateur';
// }

$statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
// On récupère un utilisateur ayant le même login (ici, e-mail)
$statement->bindValue(':email', 'admin@arcadia.com');
if ($statement->execute()) {
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user === false) {
        // Si aucun utilisateur ne correspond au login entré, on affiche une erreur
        echo 'Identifiants invalides';
    } else {
        // On vérifie le hash du password
        if (password_verify('adminZ24*', $user['password'])) {
            echo ' ';
        } else {
            echo 'Identifiants invalides';
        }
    }
} else {
    echo 'Impossible de récupérer l\'utilisateur';
}

$statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
// On récupère un utilisateur ayant le même login (ici, e-mail)
$statement->bindValue(':email', 'employe@arcadia.com');
if ($statement->execute()) {
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user === false) {
        // Si aucun utilisateur ne correspond au login entré, on affiche une erreur
        echo 'Identifiants invalides';
    } else {
        // On vérifie le hash du password
        if (password_verify('employeZ24*', $user['password'])) {
            echo ' ';
        } else {
            echo 'Identifiants invalides';
        }
    }
} else {
    echo 'Impossible de récupérer l\'utilisateur';
}


$statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
// On récupère un utilisateur ayant le même login (ici, e-mail)
$statement->bindValue(':email', 'veterinaire@arcadia.com');
if ($statement->execute()) {
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user === false) {
        // Si aucun utilisateur ne correspond au login entré, on affiche une erreur
        echo 'Identifiants invalides';
    } else {
        // On vérifie le hash du password
        if (password_verify('veterinaireZ24*', $user['password'])) {
            echo '';
        } else {
            echo 'Identifiants invalides';
        }
    }
} else {
    echo 'Impossible de récupérer l\'utilisateur';
}

function verifyUserLoginPassword(PDO $pdo, string $email, string $password) {
    $query = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    } else {
        return false;
    }
}


?>