<?php
require_once 'back/config.php';
require_once 'back/session.php';
require_once 'back/pdo.php';
require_once 'back/user.php';

require_once 'templates/header.php';

$errors = [];
$messages = [];

if (isset($_POST['loginUser'])) {
    $user = verifyUserLoginPassword($pdo, $_POST['email'], $_POST['password']);

    if ($user) {
        // session_regenerate_id(true);
        $_SESSION['user'] = $user;

        if ($user['role'] === 'admin') {
            header('location: admin/index.php');
        } elseif ($user['role'] === 'employe') {
            header('location: employe/index.php');
        } elseif ($user['role'] === 'veterinaire') {
            header('location: veterinaire/index.php');
        } else {
            header('location: index.php');
        }
    } else {
        $errors[] = 'Email ou mot de passe incorrect';
    }
}


?>
    <h1>Login</h1>

    <form method="POST">
        <div class="container mb-3">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <input type="submit" name="loginUser" class="btn btn-primary" value="Se connecter">

    </form>

    <?php
require_once 'templates/footer.php';
?>