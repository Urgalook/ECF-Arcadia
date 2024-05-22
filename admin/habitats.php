<?php
require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/../back/config.php';
require_once __DIR__ . '/../back/session.php';
require_once __DIR__ . '/../back/pdo.php';

adminOnly();

$pdo = getDatabaseConnection();

if (isset($_POST['majHabitats'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];

    $sql = "INSERT INTO `habitats`(`nom`, `description`) VALUES (:nom, :description)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':description', $description);
    $stmt->execute();
}

function getHabitatsById(PDO $pdo, int $id): array | bool
{
    $query = $pdo->prepare("SELECT * FROM habitats WHERE id = :id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getHabitats(PDO $pdo): array | bool
{
    $sql = "SELECT * FROM habitats ORDER BY id DESC";

    $query = $pdo->prepare($sql);

    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getTotalHabitats(PDO $pdo): int | bool
{
    $sql = "SELECT COUNT(*) as total FROM habitats";
    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function deleteHabitat(PDO $pdo, int $id):bool
{
    
    $query = $pdo->prepare("DELETE FROM habitat WHERE id = :id");
    $query->bindValue(':id', $id, $pdo::PARAM_INT);

    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

$habitats = getHabitats($pdo, 5, 1);
$totalHabitats = getTotalHabitats($pdo);
$totalPages = ceil($totalHabitats / 5);

?>
<div class="services-empl">
    <div class="admin-empl d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 350px; height: 40vh" >
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
        <h1>Formulaire d'ajout d'habitat</h1>
        <form action="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Location: {$_SERVER['/admin/habitats.php']}?success=true");
    exit();
    }
    ?>" method="post" class="mb-3 form-empl">
            <div class="mb-3 form-empl">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3 form-empl">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>


        <input type="submit" name="majHabitats" class="btn btn-primary btn-form-empl" value="Ajouter un habitat">
    </div>
    </div>

<h1>Liste des habitats</h1>
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

<?php foreach ($habitats as $habitats) {?>
        <tr>
            <th scope="row"><?=$habitats["id"];?></th>
            <td><?=$habitats["nom"];?></td>
            <td><?=$habitats["description"];?></td>
            <td class="valider-btn"><a href="/admin/habitat.php?id=<?=$habitats['id']?>">Modifier</a>
            <a href="/admin/delete_habitat.php?id=<?=$habitats['id']?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</a></td>
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
