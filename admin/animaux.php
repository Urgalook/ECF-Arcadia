<?php
require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/../back/config.php';
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

if (isset($_POST['majAnimaux'])) {
    $prenom = $_POST['prenom'];
    $espece = $_POST['espece'];
    $habitat = $_POST['habitat'];

    $sql = "INSERT INTO `animaux`(`prenom`, `espece`, `habitat`) VALUES (:prenom, :espece, :habitat)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':espece', $espece);
    $stmt->bindParam(':habitat', $habitat);
    $stmt->execute();
}

function getAnimauxById(PDO $pdo, int $id): array | bool
{
    $query = $pdo->prepare("SELECT * FROM animaux WHERE id = :id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getAnimaux(PDO $pdo): array | bool
{
    $sql = "SELECT * FROM animaux ORDER BY id DESC";

    $query = $pdo->prepare($sql);

    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getTotalAnimaux(PDO $pdo): int | bool
{
    $sql = "SELECT COUNT(*) as total FROM animaux";
    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function deleteAnimaux(PDO $pdo, int $id):bool
{
    
    $query = $pdo->prepare("DELETE FROM animaux WHERE id = :id");
    $query->bindValue(':id', $id, $pdo::PARAM_INT);

    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

$animaux = getAnimaux($conn, 5, 1);
$totalAnimaux = getTotalAnimaux($conn);
$totalPages = ceil($totalAnimaux / 50);

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
        <h1>Formulaire d'ajout d'animaux</h1>
        <form action="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Location: {$_SERVER['/admin/animaux.php']}?success=true");
    exit();
    }
    ?>" method="post" class="mb-3 form-empl">
            <div class="mb-3 form-empl">
                <label for="prenom" class="form-label">Prenom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="mb-3 form-empl">
                <label for="espece" class="form-label">Espèce</label>
                <input type="number" class="form-control" id="espece" name="espece" required>
            </div>
            <div class="mb-3 form-empl">
                <label for="habitat" class="form-label">Habitat</label>
                <input type="number" class="form-control" id="habitat" name="habitat" required>
            </div>
        <input type="submit" name="majAnimaux" class="btn btn-primary btn-form-empl" value="Ajouter un animal">
    </div>
    </div>

<h1>Liste des animaux</h1>
    <table class="table table-animaux">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Prénom</th>
        <th scope="col">Espèce</th>
        <th scope="col">Habitat</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php

?>

<?php foreach ($animaux as $animaux) {?>
        <tr>
            <th scope="row"><?=$animaux["id"];?></th>
            <td><?=$animaux["prenom"];?></td>
            <td><?=$animaux["espece"];?></td>
            <td><?=$animaux["habitat"];?></td>
            <td>
            <a href="/admin/delete_animal.php?id=<?=$animaux['id']?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?')">Supprimer</a></td>
            </td>
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