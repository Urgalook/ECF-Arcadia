<?php
require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/../back/config.php';
require_once __DIR__ . '/../back/session.php';
require_once __DIR__ . '/../back/pdo.php';
employeOnly();

$pdo = getDatabaseConnection();

if (isset($_POST['majServices'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];

    $sql = "INSERT INTO `services`(`nom`, `description`) VALUES (:nom, :description)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':description', $description);
    $stmt->execute();
}

function getServicesById(PDO $pdo, int $id): array | bool
{
    $query = $pdo->prepare("SELECT * FROM services WHERE id = :id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getServices(PDO $pdo): array | bool
{
    $sql = "SELECT * FROM services ORDER BY id DESC";

    $query = $pdo->prepare($sql);

    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getTotalServices(PDO $pdo): int | bool
{
    $sql = "SELECT COUNT(*) as total FROM services";
    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

$services = getServices($pdo, 5, 1);
$totalServices = getTotalServices($pdo);
$totalPages = ceil($totalServices / 5);

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
        <h1>Formulaire d'ajout de service</h1>
        <form action="" method="post" class="mb-3 form-empl">
            <div class="mb-3 form-empl">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3 form-empl">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
    

        <input type="submit" name="majServices" class="btn btn-primary btn-form-empl" value="Ajouter un service">
    </div>
    </div>

<h1>Liste des services</h1>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nom</th>
        <th scope="col">Description</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php

?>

<?php foreach ($services as $service) {?>
        <tr>
            <th scope="row"><?=$service["id"];?></th>
            <td><?=$service["nom"];?></td>
            <td><?=$service["description"];?></td>
            <td class="valider-btn"><a href="/employe/service.php?id=<?=$service['id']?>">Modifier</a>
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