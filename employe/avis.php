<?php
require_once __DIR__ . "/../back/config.php";
require_once __DIR__ . "/../back/session.php";
employeOnly();

require_once __DIR__ . "/../back/pdo.php";
require_once __DIR__ . "/templates/header.php";

$pdo = getDatabaseConnection();


if (isset($_GET['page'])) {
  $page = (int)$_GET['page'];
} else {
  $page = 1;
}

function getAvisById(PDO $pdo, int $id):array|bool
{
    $query = $pdo->prepare("SELECT * FROM avis WHERE id = :id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getAvis(PDO $pdo, int $limit = null, int $page = null):array|bool
{
    $sql = "SELECT * FROM avis ORDER BY id DESC";

    if ($limit && !$page) {
        $sql .= " LIMIT  :limit";
    }
    if ($limit && $page) {
        $sql .= " LIMIT :offest, :limit";
    }

    $query = $pdo->prepare($sql);

    if ($limit) {
        $query->bindValue(":limit", $limit, PDO::PARAM_INT);
    }
    if ($page) {
        $offset = ($page - 1) * $limit;
        $query->bindValue(":offest", $offset, PDO::PARAM_INT);
    }

    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getTotalAvis(PDO $pdo):int|bool
{
    $sql = "SELECT COUNT(*) as total FROM avis";
    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}


function deleteAvis(PDO $pdo, int $id):bool
{
    
    $query = $pdo->prepare("DELETE FROM avis WHERE id = :id");
    $query->bindValue(':id', $id, $pdo::PARAM_INT);

    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

$avis = getAvis($pdo, 25, 1);
$totalAvis = getTotalAvis($pdo);
$totalPages = ceil($totalAvis / 25);

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

    <h1 class="display-5 fw-bold text-body-emphasis">Avis</h1>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Avis</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php

?>

        <?php foreach ($avis as $avis) { ?>
        <tr>
            <th scope="row"><?= $avis["id"]; ?></th>
            <td><?= $avis["avis"]; ?></td>
            <td class="valider-btn"><a href="validate_avis.php?id=<?= $avis['id'] ?>">Valider</a>
            | <a href="avis_delete.php?id=<?= $avis['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</a></td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
    <nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php if ($totalPages > 1) { ?>
      <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
        <li class="page-item">
          <a class="page-link <?php if ($i == $page) { echo " active";} ?>" href="?page=<?php echo $i; ?>" >
            <?php echo $i; ?>
          </a>
        </li>
      <?php } ?>
    <?php } ?>
  </ul>
</nav>
</div>

<?php require_once __DIR__ . "/templates/footer.php"; ?>
