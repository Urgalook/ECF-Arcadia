<?php

require_once __DIR__ . '/../back/config.php';
require_once __DIR__ . '/../back/session.php';
employeOnly();

require_once __DIR__ . '/templates/header.php';

?>
<div class="empl">

    <div class="admin d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 350px; height: 40vh" >
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
    
  <div>
        <h1 class="title">Espace employé</h1>
        <p class="lead mb-4 bvn">Bienvenue sur votre espace employé</p>
    </div>
</div>



<?php require_once __DIR__ . '/../templates/footer.php';?>
