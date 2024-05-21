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

if (isset($_POST['saveHabitat'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $id = $_GET['id'];

    $sql = "UPDATE `habitats` SET `nom` = :nom, " . "`description` = :description" . " WHERE id = :id";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

function getHabitatsById(PDO $pdo, int $id): array | bool
{
    $query = $pdo->prepare("SELECT * FROM habitats WHERE id = :id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function saveHabitat(PDO $pdo, string $nom, string $description, int $id = null): bool
{
    if ($id === null) {
        $query = $pdo->prepare("INSERT INTO habitats (nom, description) "
            . "VALUES(:nom, :description)");
    } else {
        $query = $pdo->prepare("UPDATE `habitats` SET `nom` = :nom, "
            . "`description` = :description");

        $query->bindValue(':id', $id, $pdo::PARAM_INT);
    }

    $query->bindValue(':nom', $nom, $pdo::PARAM_STR);
    $query->bindValue(':description', $description, $pdo::PARAM_STR);
    return $query->execute();
}

$errors = [];
$messages = [];
$habitat = [
    'nom' => '',
    'description' => '',
    'id' => ''
];

if (isset($_GET['id'])) {

    $habitat = getHabitatsById($pdo, $_GET['id']);
    if ($habitat === false) {
        $errors[] = "L'habitat n\'existe pas";
    }
    $pageTitle = "Formulaire modification habitat";
} else {
    $pageTitle = "Formulaire ajout habitat";
}

if (isset($_POST['Habitat'])) {

    $habitat = [
        'nom' => $_POST['nom'],
        'description' => $_POST['description']
    ];

    if (!$errors) {
        if (isset($_GET["id"])) {
 
            $id = (int)$_GET["id"];
        } else {
            $id = null;
        }

        $res = saveHabitat($pdo, $_POST["nom"], $_POST["description"], $id);

        if ($res) {
            $messages[] = "L'habitat a bien été sauvegardé";

            if (!isset($_GET["id"])) {
                $habitat = [
                    'nom' => '',
                    'description' => ''
                ];
            }
        } else {
            $errors[] = "L'habitat n'a pas été sauvegardé";
        }
    }
}

?>

<div class="services-empl">
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
        <h1>Modification habitat</h1>

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
        <?php if ($habitat !== false) {?>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?=$habitat['nom'];?>">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="8"><?=$habitat['description'];?></textarea>
                </div>
                <?php }?>

                <input type="submit" name="saveHabitat" class="btn btn-primary" value="Enregistrer">

            </form>

        </div>
</div>

<?php
require_once __DIR__ . '/templates/footer.php';

?>