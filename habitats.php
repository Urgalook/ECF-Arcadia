<?php
require_once __DIR__ . '/templates/header.php';
?>

<div class="main-services px-4 py-5">
    <h1 class="pb-2 border-bottom">Les habitats du zoo</h1>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
      <div class="col d-flex align-items-start">
        <div>
          <h3 class="fs-2 text-body-emphasis">La Jungle</h3>
          <a href="habitats/jungle.php">
            <img src="assets/images/jungle.jpg" alt="Jungle" class="img-habitat">
        </a>
        </div>
      </div>
      <div class="col d-flex align-items-start">
        <div>
          <h3 class="fs-2 text-body-emphasis">La Savane</h3>
          <a href="habitats/savane.php">
            <img src="assets/images/savane.webp" alt="Savane" class="img-habitat">
          </a>
        </div>
      </div>
      <div class="col d-flex align-items-start">
        <div>
          <h3 class="fs-2 text-body-emphasis">Le Marais</h3>
          <a href="habitats/marais.php">
            <img src="assets/images/marais.jpg" alt="Marais" class="img-habitat">
          </a>
        </div>
      </div>
    </div>
  </div>


<?php require_once __DIR__ . '/templates/footer.php';?>