<?php
require_once __DIR__ . "/../back/config.php";
require_once __DIR__ . "/../back/session.php";
adminOnly();

require_once __DIR__ . "/../back/pdo.php";
require_once __DIR__ . "/templates/header.php";
$pdo = getDatabaseConnection();
function getAnimauxById(PDO $pdo, int $id): array | bool
{
    $query = $pdo->prepare("SELECT * FROM animaux WHERE id = :id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getAnimaux(PDO $pdo): array | bool
{
    $sql = "SELECT * FROM animaux ORDER BY id DESC";

    $query = $pdo->prepare($sql);

    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function deleteAnimaux(PDO $pdo, int $id):bool
{
    
    $query = $pdo->prepare("DELETE FROM animaux WHERE id = :id");
    $query->bindValue(':id', $id, $pdo::PARAM_INT);

    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

$animaux = false;
$errors = [];
$messages = [];
if (isset($_GET["id"])) {
    $animaux =  getAnimauxById($pdo, (int)$_GET["id"]);
}
if ($animaux) {
    if (deleteAnimaux($pdo, $_GET["id"])) {
        $messages[] = "L'animal a bien été supprimé";
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "L'animal n'existe pas";
}
?>

<div class="admin d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 350px;">
      <span class="fs-4">Menu</span>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
      <a href="/admin/index.php" class="nav-link" aria-current="page">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
          Accueil
        </a>
        <a href="/admin/services.php" class="nav-link" aria-current="page">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
          Services
        </a>
      </li>
      <li>
        <a href="/admin/horaires.php" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Horaires
        </a>
      </li>
      <li>
        <a href="/admin/habitats.php" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
          Habitats
        </a>
      </li>
      <li>
        <a href="/admin/animaux.php" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
          Animaux
        </a>
      </li>
      <li>
        <a href="/admin/veterinaire.php" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
          Compte-rendus vétérinaires
        </a>
      </li>
    </ul>
  </div>

<div class="row text-center my-5">
    <h1>Supression animal</h1>
    <?php foreach ($messages as $message) { ?>
        <div class="alert alert-success" role="alert">
            <?= $message; ?>
        </div>
    <?php } ?>
    <?php foreach ($errors as $error) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $error; ?>
        </div>
    <?php } ?>
</div>

<?php

require_once('templates/footer.php');
