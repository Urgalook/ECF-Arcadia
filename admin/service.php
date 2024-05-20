<?php
require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/../back/config.php';
require_once __DIR__ . '/../back/pdo.php';
require_once __DIR__ . '/../back/session.php';
adminOnly();

$servername = "127.0.0.1";
$bdd = "arcadia";
$username = "root";
$password = "M4x1meSTUDI2024*";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$bdd", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if (isset($_POST['saveService'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $id = $_GET['id'];

    $sql = "UPDATE `services` SET `nom` = :nom, " . "`description` = :description" . " WHERE id = :id";
    $stmt = $conn->prepare($sql);

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
    //requête pour récupérer les données de l'article en cas de modification
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
    // Si il n'y a pas d'erreur on peut faire la sauvegarde
    if (!$errors) {
        if (isset($_GET["id"])) {
            // Avec (int) on s'assure que la valeur stockée sera de type int
            $id = (int)$_GET["id"];
        } else {
            $id = null;
        }
        // On passe toutes les données à la fonction saveArticle
        $res = saveService($pdo, $_POST["nom"], $_POST["description"], $id);

        if ($res) {
            $messages[] = "L'article a bien été sauvegardé";
            //On vide le tableau article pour avoir les champs de formulaire vides
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

<div class="services-empl">
    <div class="admin-empl d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 350px; height: 40vh" >
      <span class="fs-4">Menu</span>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="/employe/index.php" class="nav-link" aria-current="page">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
            Accueil
            </a>
        </li>
        <li class="nav-item">
            <a href="/employe/avis.php" class="nav-link" aria-current="page">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
            Avis
            </a>
        </li>
        <li>
            <a href="/employe/animaux.php" class="nav-link text-white">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
            Alimentation
            </a>
        </li>
        <li>
            <a href="/employe/services.php" class="nav-link text-white">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
            Services
            </a>
        </li>
        </ul>
        <hr>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
        <strong>mdo</strong>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
        <li><a class="dropdown-item" href="#">New project...</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">Sign out</a></li>
      </ul>
    </div>
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

