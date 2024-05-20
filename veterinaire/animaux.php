<?php
require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/../back/config.php';
require_once __DIR__ . '/../back/pdo.php';

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

if (isset($_POST['repas'])) {
    $id_animal = $_POST['id_animal'];
    $nourriture = $_POST['nourriture'];
    $quantite = $_POST['quantite'];
    $date = $_POST['date'];

    $sql = "INSERT INTO `nourriture`(`id_animal`, `nourriture`, `quantite`, `date`) VALUES (:id_animal, :nourriture, :quantite, :date)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id_animal', $id_animal);
    $stmt->bindParam(':nourriture', $nourriture);
    $stmt->bindParam(':quantite', $quantite);
    $stmt->bindParam(':date', $date);
    $stmt->execute();
}

function getNourritureById(PDO $pdo, int $id): array | bool
{
    $query = $pdo->prepare("SELECT * FROM nourriture WHERE id = :id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getNourriture(PDO $pdo): array | bool
{
    $sql = "SELECT * FROM nourriture ORDER BY id DESC";

    $query = $pdo->prepare($sql);

    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getTotalNourriture(PDO $pdo): int | bool
{
    $sql = "SELECT COUNT(*) as total FROM nourriture";
    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

$nourriture = getNourriture($conn, 25, 1);
$totalNourriture = getTotalNourriture($conn);
$totalPages = ceil($totalNourriture / 25);

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


    <div>
        <h1 class="display-5 fw-bold text-body-emphasis repas">Repas</h1>
            <table class="table">
            <thead>
                <tr>
                <th scope="col">id</th>
                <th scope="col">id_animal</th>
                <th scope="col">Nourriture</th>
                <th scope="col">Quantité</th>
                <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
    </div>
</div>

    <?php

?>

<?php foreach ($nourriture as $nourriture) {?>
        <tr>
            <th scope="row"><?=$nourriture["id"];?></th>
            <td><?=$nourriture["id_animal"];?></td>
            <td><?=$nourriture["nourriture"];?></td>
            <td><?=$nourriture["quantite"];?></td>
            <td><?=$nourriture["date"];?></td>
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


<?php
require_once __DIR__ . '/templates/footer.php';

?>