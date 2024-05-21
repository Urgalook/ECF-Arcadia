<?php
require_once __DIR__ . '/pdo.php';
$pdo = getDatabaseConnection();
$statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');

$statement->bindValue(':email', 'admin@arcadia.com');
if ($statement->execute()) {
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user === false) {

        echo 'Identifiants invalides';
    } else {

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

$statement->bindValue(':email', 'employe@arcadia.com');
if ($statement->execute()) {
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user === false) {

        echo 'Identifiants invalides';
    } else {

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

$statement->bindValue(':email', 'veterinaire@arcadia.com');
if ($statement->execute()) {
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user === false) {

        echo 'Identifiants invalides';
    } else {

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