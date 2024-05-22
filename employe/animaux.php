<?php
require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/../back/config.php';
require_once __DIR__ . '/../back/pdo.php';

$pdo = getDatabaseConnection();

if (isset($_POST['repas'])) {
    $id_animal = $_POST['id_animal'];
    $nourriture = $_POST['nourriture'];
    $quantite = $_POST['quantite'];
    $date = $_POST['date'];

    $sql = "INSERT INTO `nourriture`(`id_animal`, `nourriture`, `quantite`, `date`) VALUES (:id_animal, :nourriture, :quantite, :date)";
    $stmt = $pdo->prepare($sql);

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

$nourriture = getNourriture($pdo, 25, 1);
$totalNourriture = getTotalNourriture($pdo);
$totalPages = ceil($totalNourriture / 25);

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
  </div>

  <form 
    action="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Location: {$_SERVER['/employe/animaux.php']}?success=true");
    exit();
    }
    ?>" 
    method="post" class="mb-3 form-empl">

    <div class="mb-3 form-empl">
        <label for="id_animal" class="form-label">id_animal</label>
        <input type="number" class="form-control" id="id_animal" name="id_animal" required>
    </div>
    <div class="mb-3 form-empl">
        <label for="nourriture" class="form-label">Nourriture</label>
        <textarea class="form-control" id="nourriture" name="nourriture" rows="3"></textarea>
    </div>
    <div class="mb-3 form-empl">
        <label for="quantite" class="form-label">Quantité</label>
        <textarea class="form-control" id="quantite" name="quantite" rows="3"></textarea>
    </div>
    <div class="mb-3 form-empl">
        <label for="date" class="form-label">Date</label>
        <input type="datetime-local" class="form-control" id="date" name="date" rows="3">
    </div>
      <input type="submit" name="repas" class="btn btn-primary btn-form-empl" value="Ajouter un repas">
</div>

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
