<?php
require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/../back/config.php';
require_once __DIR__ . '/../back/pdo.php';
require_once __DIR__ . '/../back/session.php';
veterinaireOnly();

$pdo = getDatabaseConnection();

if (isset($_POST['compteRendu'])) {
    $id_animal = $_POST['id_animal'];
    $etat = $_POST['etat'];
    $nourriture = $_POST['nourriture'];
    $grammage = $_POST['grammage'];
    $date = $_POST['date'];
    $remarque = $_POST['remarque'];

    $sql = "INSERT INTO `veterinaire`(`id_animal`, `etat`, `nourriture`, `grammage`, `date`, `remarque`) 
    VALUES (:id_animal, :etat, :nourriture, :grammage, :date, :remarque)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':id_animal', $id_animal);
    $stmt->bindParam(':etat', $etat);
    $stmt->bindParam(':nourriture', $nourriture);
    $stmt->bindParam(':grammage', $grammage);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':remarque', $remarque);
    $stmt->execute();
}

function getCompteRenduById(PDO $pdo, int $id): array | bool
{
    $query = $pdo->prepare("SELECT * FROM veterinaire WHERE id = :id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getCompteRendu(PDO $pdo): array | bool
{
    $sql = "SELECT * FROM veterinaire ORDER BY id DESC";

    $query = $pdo->prepare($sql);

    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getTotalCompteRendu(PDO $pdo): int | bool
{
    $sql = "SELECT COUNT(*) as total FROM veterinaire";
    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}


$compteRendus = getCompteRendu($pdo, 25, 1);
$totalCompteRendu = getTotalCompteRendu($pdo);
$totalPages = ceil($totalCompteRendu / 25);

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
    </div>

    <form
    action="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Location: {$_SERVER['/veterinaire/compte_rendus.php']}?success=true");
    exit();
}
?>"
    method="post" class="mb-3 form-empl">

    <div class="mb-3 form-empl">
        <label for="id_animal" class="form-label">id_animal</label>
        <input type="number" class="form-control" id="id_animal" name="id_animal" required>
    </div>
    <div class="mb-3 form-empl">
        <label for="etat" class="form-label">Etat animal</label>
        <textarea class="form-control" id="etat" name="etat" rows="3"></textarea>
    </div>
    <div class="mb-3 form-empl">
        <label for="nourriture" class="form-label">Nourriture</label>
        <textarea class="form-control" id="nourriture" name="nourriture" rows="3"></textarea>
    </div>
    <div class="mb-3 form-empl">
        <label for="grammage" class="form-label">Grammage nourriture</label>
        <textarea class="form-control" id="grammage" name="grammage" rows="3"></textarea>
    </div>
    <div class="mb-3 form-empl">
        <label for="date" class="form-label">Date passage</label>
        <input type="datetime-local" class="form-control" id="date" name="date" rows="3">
    </div>
    <div class="mb-3 form-empl">
        <label for="remarque" class="form-label">Remarque</label>
        <textarea class="form-control" id="remarque" name="remarque" rows="3"></textarea>
    </div>
      <input type="submit" name="compteRendu" class="btn btn-primary btn-form-empl" value="Ajouter un compte-rendu">
</div>

<h1 class="display-5 fw-bold text-body-emphasis repas">Compte-rendus</h1>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">id</th>
        <th scope="col">id_animal</th>
        <th scope="col">Etat animal</th>
        <th scope="col">Nourriture</th>
        <th scope="col">Grammage nourriture</th>
        <th scope="col">Date</th>
        <th scope="col">Remarque</th>
        </tr>
    </thead>
    <tbody>
<?php

?>

<?php foreach ($compteRendus as $compteRendus) {?>
        <tr>
            <th scope="row"><?=$compteRendus["id"];?></th>
            <td><?=$compteRendus["id_animal"];?></td>
            <td><?=$compteRendus["etat"];?></td>
            <td><?=$compteRendus["nourriture"];?></td>
            <td><?=$compteRendus["grammage"];?></td>
            <td><?=$compteRendus["date"];?></td>
            <td><?=$compteRendus["remarque"];?></td>
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
