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

if (isset($_POST['saveHoraire'])) {
    $jour = $_POST['jour'];
    $ouverture = $_POST['ouverture'];
    $fermeture = $_POST['fermeture'];
    $id = $_GET['id'];

    $sql = "UPDATE `horaires`SET `jour` = :jour, " . "`ouverture` = :ouverture, " . "`fermeture` = :fermeture" . " WHERE id = :id";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':jour', $jour);
    $stmt->bindParam(':ouverture', $ouverture);
    $stmt->bindParam(':fermeture', $fermeture);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

function getHorairesById(PDO $pdo, int $id): array | bool
{
    $query = $pdo->prepare("SELECT * FROM horaires WHERE id = :id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function saveHoraire(PDO $pdo, string $jour, string $ouverture, string $fermeture, int $id = null): bool
{
    if ($id === null) {
        $query = $pdo->prepare("INSERT INTO horaires (nom, ouverture, fermeture) "
            . "VALUES(:nom, :ouverture, :fermeture)");
    } else {
        $query = $pdo->prepare("UPDATE `horaires` SET `jour` = :jour, "
            . "`ouverture` = :ouverture". "`fermeture` = :fermeture");

        $query->bindValue(':id', $id, $pdo::PARAM_INT);
    }

    $query->bindValue(':jour', $jour, $pdo::PARAM_STR);
    $query->bindValue(':ouverture', $ouverture, $pdo::PARAM_STR);
    $query->bindValue(':fermeture', $fermeture, $pdo::PARAM_STR);
    return $query->execute();
}

$errors = [];
$messages = [];
$horaires = [
    'jour' => '',
    'ouverture' => '',
    'fermeture' => '',
    'id' => ''
];

if (isset($_GET['id'])) {
    //requête pour récupérer les données de l'article en cas de modification
    $horaires = getHorairesById($pdo, $_GET['id']);
    if ($horaires === false) {
        $errors[] = "L'horaire n\'existe pas";
    }
    $pageTitle = "Formulaire de modification d'horaire";
} else {
    $pageTitle = "Formulaire d'ajout d'horaires";
}

if (isset($_POST['Horaires'])) {

    $horaires = [
        'nom' => $_POST['nom'],
        'ouverture' => $_POST['ouverture'],
        'fermeture' => $_POST['fermeture']
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
        $res = saveHoraire($pdo, $_POST["jour"], $_POST["ouverture"], $_POST["fermeture"], $id);

        if ($res) {
            $messages[] = "L'horaire a bien été sauvegardé";
            //On vide le tableau article pour avoir les champs de formulaire vides
            if (!isset($_GET["id"])) {
                $horaires = [
                    'nom' => '',
                    'ouverture' => '',
                    'fermeture' => ''
                ];
            }
        } else {
            $errors[] = "L'horaire n'a pas été sauvegardé";
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
        <h1>Modification horaire</h1>

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
        <?php if ($horaires !== false) {?>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="jour" class="form-label">Jour</label>
                    <input type="text" class="form-control" id="jour" name="jour" value="<?=$horaires['jour'];?>">
                </div>
                <div class="mb-3">
                    <label for="ouverture" class="form-label">Ouverture</label>
                    <input type="time" class="form-control" id="ouverture" name="ouverture" value="<?=$horaires['ouverture'];?>">
                </div>
                <div class="mb-3">
                    <label for="fermeture" class="form-label">Fermeture</label>
                    <input type="time" class="form-control" id="fermeture" name="fermeture" value="<?=$horaires['fermeture'];?>">
                </div>
                <?php }?>

                <input type="submit" name="saveHoraire" class="btn btn-primary" value="Enregistrer">

            </form>

        </div>
</div>

<?php
require_once __DIR__ . '/templates/footer.php';

?>