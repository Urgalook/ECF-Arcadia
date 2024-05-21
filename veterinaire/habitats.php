<?php
require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/../back/config.php';
// require_once __DIR__ . '/../back/pdo.php';
require_once __DIR__ . '/../back/session.php';
veterinaireOnly();

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

if (isset($_POST['commentaireHabitat'])) {
    $habitat = $_POST['habitat'];
    $commentaire = $_POST['commentaire'];
    $date = $_POST['date'];

    $sql = "INSERT INTO `habitat_veterinaire`(`haitat`, `commenaire`, `date`) 
    VALUES (:habitat, :commentaire, :date)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':habitat', $habitat);
    $stmt->bindParam(':commenaire', $commenaire);
    $stmt->bindParam(':date', $date);
    $stmt->execute();
}

function getHabitatById(PDO $pdo, int $id): array | bool
{
    $query = $pdo->prepare("SELECT * FROM habitat_veterinaire WHERE id = :id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getHabitat(PDO $pdo): array | bool
{
    $sql = "SELECT * FROM habitat_veterinaire ORDER BY id DESC";

    $query = $pdo->prepare($sql);

    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getTotalHabitat(PDO $pdo): int | bool
{
    $sql = "SELECT COUNT(*) as total FROM habitat_veterinaire";
    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}


$habitatV = getHabitat($conn, 25, 1);
$totalHabitat = getTotalHabitat($conn);
$totalPages = ceil($totalHabitat / 25);

?>

<div class="empl">
    <div class="admin d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 350px;">
        <span class="fs-4">Menu</span>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="/veterinaire/index.php" class="nav-link" aria-current="page">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
            Accueil
            </a>
        </li>
        <li class="nav-item">
            <a href="/veterinaire/compte_rendus.php" class="nav-link" aria-current="page">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
            Compte-rendus
            </a>
        </li>
        <li>
            <a href="/veterinaire//habitats.php" class="nav-link text-white">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
            Habitats
            </a>
        </li>
        <li>
            <a href="/veterinaire/animaux.php" class="nav-link text-white">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
            Animaux
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

    <form
    action="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Location: {$_SERVER['/veterinaire/compte_rendus.php']}?success=true");
    exit();
}
?>"
    method="post" class="mb-3 form-empl">

    <div class="mb-3 form-empl">
        <label for="habitat" class="form-label">Habitat</label>
        <input type="number" class="form-control" id="habitat" name="habitat" required>
    </div>
    <div class="mb-3 form-empl">
        <label for="commentaire" class="form-label">Commentaire</label>
        <textarea class="form-control" id="commentaire" name="commentaire" rows="3"></textarea>
    </div>
    <div class="mb-3 form-empl">
        <label for="date" class="form-label">Date</label>
        <input type="datetime-local" class="form-control" id="date" name="date" rows="3">
    </div>
      <input type="submit" name="commentaireHabitat" class="btn btn-primary btn-form-empl" value="Ajouter un commentaire">
</div>

<h1 class="display-5 fw-bold text-body-emphasis repas">Commentaire habitat</h1>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">id</th>
        <th scope="col">Habitat</th>
        <th scope="col">Commentaire</th>
        <th scope="col">Date</th>
        </tr>
    </thead>
    <tbody>
<?php

?>

<?php foreach ($habitatV as $habitatV) {?>
        <tr>
            <th scope="row"><?=$habitatV["id"];?></th>
            <td><?=$habitatV["habitat"];?></td>
            <td><?=$habitatV["commentaire"];?></td>
            <td><?=$habitatV["date"];?></td>
        </tr>
        <?php }?>
    </tbody>
    </table>
    <nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php if ($totalPages > 1) {?>
      <?php for ($i = 1; $i <= $totalPages; $i++) {?>
        <li class="page-item">
          <a class="page-link <?php if ($i == $page) {echo " active";}?>" href="?page=<?php echo $i; ?>" >
            <?php echo $i; ?>
          </a>
        </li>
      <?php }?>
    <?php }?>
  </ul>
</nav>
</div>
</div>




<?php require_once __DIR__ . '/../templates/footer.php';?>