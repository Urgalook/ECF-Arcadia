<?php
require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/back/config.php';
require_once __DIR__ . '/back/pdo.php';
$pdo = getDatabaseConnection();
?>

<div class="main-services px-4 py-5">
    <h2 class="pb-2 border-bottom">Nos services</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
      <div class="col d-flex align-items-start">
        <div>
          <h3 class="fs-2 text-body-emphasis">Restauration</h3>
          <?php $sqlQuery = 'SELECT * FROM services WHERE id = 1';
$servicesStatement = $pdo->query($sqlQuery);
$servicesStatement->execute();
$services = $servicesStatement->fetchAll(PDO::FETCH_ASSOC);?>
          <p><?php foreach ($services as $services) { ?> <?=$services['description']?><?php } ?></p>
          </a>
        </div>
      </div>
      <div class="col d-flex align-items-start">
        <div>
          <h3 class="fs-2 text-body-emphasis">Visite des habitats avec un guide</h3>
          <?php $sqlQuery = 'SELECT * FROM services WHERE id = 3';
$servicesStatement = $pdo->query($sqlQuery);
$servicesStatement->execute();
$services = $servicesStatement->fetchAll(PDO::FETCH_ASSOC);?>
          <p><?php foreach ($services as $services) { ?> <?=$services['description']?><?php } ?></p>
          </a>
        </div>
      </div>
      <div class="col d-flex align-items-start">
        <div>
          <h3 class="fs-2 text-body-emphasis">Visite du zoo en petit train</h3>
          <?php $sqlQuery = 'SELECT * FROM services WHERE id = 2';
$servicesStatement = $pdo->query($sqlQuery);
$servicesStatement->execute();
$services = $servicesStatement->fetchAll(PDO::FETCH_ASSOC);?>
          <p><?php foreach ($services as $services) { ?> <?=$services['description']?><?php } ?></p>
          </a>
        </div>
      </div>
    </div>
  </div>

<?php require_once __DIR__ . '/templates/footer.php';?>