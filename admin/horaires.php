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

function getHorairesById(PDO $pdo, int $id): array | bool
{
    $query = $pdo->prepare("SELECT * FROM horaires WHERE id = :id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getHoraires(PDO $pdo): array | bool
{
    $sql = "SELECT * FROM horaires ORDER BY id DESC";

    $query = $pdo->prepare($sql);

    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getTotalHoraires(PDO $pdo): int | bool
{
    $sql = "SELECT COUNT(*) as total FROM horaires";
    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

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

    <div class="table">
    <h1>Liste des horaires</h1>
        <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Jour</th>
            <th scope="col">Ouverture</th>
            <th scope="col">Fermeture</th>
            </tr>
        </thead>
        <tbody>
        <?php

$horaires = getHoraires($conn, 10, 1);
$totalHoraires = getTotalHoraires($conn);
$totalPages = ceil($totalHoraires / 10);

?>

    <?php foreach ($horaires as $horaires) {?>
            <tr>
                <th scope="row"><?=$horaires["id"];?></th>
                <td><?=$horaires["jour"];?></td>
                <td><?=$horaires["ouverture"];?></td>
                <td><?=$horaires["fermeture"];?></td>
                <td class="valider-btn"><a href="/admin/horaire.php?id=<?=$horaires['id']?>">Modifier</a>
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
    </div>


    <?php
require_once __DIR__ . '/templates/footer.php';

?>