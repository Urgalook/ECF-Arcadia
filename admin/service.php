<?php
require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/../back/config.php';
require_once __DIR__ . '/../back/pdo.php';
require_once __DIR__ . '/../back/session.php';
adminOnly();

$pdo = getDatabaseConnection();

if (isset($_POST['saveService'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $id = $_GET['id'];

    $sql = "UPDATE `services` SET `nom` = :nom, " . "`description` = :description" . " WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

function getServicesById(PDO $pdo, int $id): array | bool
{
    $query = $pdo->prepare("SELECT * FROM services WHERE id = :id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function saveService(PDO $pdo, string $nom, string $description, int $id = null): bool
{
    if ($id === null) {
        $query = $pdo->prepare("INSERT INTO services (nom, description) "
            . "VALUES(:nom, :description)");
    } else {
        $query = $pdo->prepare("UPDATE `services` SET `nom` = :nom, "
            . "`description` = :description");

        $query->bindValue(':id', $id, $pdo::PARAM_INT);
    }

    $query->bindValue(':nom', $nom, $pdo::PARAM_STR);
    $query->bindValue(':description', $description, $pdo::PARAM_STR);
    return $query->execute();
}

$errors = [];
$messages = [];
$service = [
    'nom' => '',
    'description' => '',
    'id' => ''
];

if (isset($_GET['id'])) {

    $service = getServicesById($pdo, $_GET['id']);
    if ($service === false) {
        $errors[] = "L'article n\'existe pas";
    }
    $pageTitle = "Formulaire modification article";
} else {
    $pageTitle = "Formulaire ajout article";
}

if (isset($_POST['Service'])) {

    $service = [
        'nom' => $_POST['nom'],
        'description' => $_POST['description']
    ];

    if (!$errors) {
        if (isset($_GET["id"])) {

            $id = (int)$_GET["id"];
        } else {
            $id = null;
        }

        $res = saveService($pdo, $_POST["nom"], $_POST["description"], $id);

        if ($res) {
            $messages[] = "L'article a bien été sauvegardé";

            if (!isset($_GET["id"])) {
                $service = [
                    'nom' => '',
                    'description' => ''
                ];
            }
        } else {
            $errors[] = "L'article n'a pas été sauvegardé";
        }
    }
}

?>

<div class="empl">
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
    <div class="form-empl">
        <h1>Modification service</h1>

        <?php foreach ($messages as $message) {?>
            <div class="alert alert-success" role="alert">
                <?=$message;?>
            </div>
        <?php }?>
        <?php foreach ($errors as $error) {?>
            <div class="alert alert-danger" role="alert">
                <?=$error;?>
            </div>
        <?php }?>
        <?php if ($service !== false) {?>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?=$service['nom'];?>">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="8"><?=$service['description'];?></textarea>
                </div>
                <?php }?>

                <input type="submit" name="saveService" class="btn btn-primary" value="Enregistrer">

            </form>

        </div>
</div>

