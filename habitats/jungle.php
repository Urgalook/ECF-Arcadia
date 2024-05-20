<?php
    require_once __DIR__ . '/../back/config.php';
    require_once __DIR__ . '/../back/pdo.php';
    require_once __DIR__ . '/../templates/header.php';
?>

<main>


  <section class="py-5 text-center">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">La jungle d'Arcadia</h1>
        <p class="lead text-body-secondary">
Bienvenue dans la Savane de notre zoo, un écosystème fascinant qui abrite une diversité impressionnante d'animaux emblématiques. Dans ce biome vaste et ouvert, les visiteurs auront l'occasion de découvrir de près la majesté et la beauté de la faune africaine. Les éléphants, girafes, guépards, lions et zèbres règnent en maîtres de cette terre, offrant aux visiteurs une expérience immersive dans leur habitat naturel. Les éléphants se déplacent gracieusement en troupeaux, les girafes se nourrissent des feuilles des acacias avec leur langue bleue distinctive, tandis que les guépards impressionnent par leur agilité et leur vitesse. Les lions, rois de la savane, commandent le respect avec leur présence puissante et leurs rugissements retentissants. Les zèbres, avec leurs rayures distinctives, ajoutent une touche de caractère unique à cet environnement. Promenez-vous le long des sentiers sinueux pour une immersion totale dans cet écosystème dynamique, avec des points d'observation stratégiquement placés offrant des vues spectaculaires et des opportunités de photographie inoubliables.</p>
        <p>
          <a href="#" class="btn btn-primary my-2">Main call to action</a>
          <a href="#" class="btn btn-secondary my-2">Secondary action</a>
        </p>
      </div>
    </div>
  </section>


  <div class="album py-5 bg-body-tertiary">
    <div>

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-3">
          <div class="col">
<?php 

$sqlQuery = 'SELECT * FROM animaux WHERE espece = 1';
  $animauxStatement = $pdo->query($sqlQuery);
  $animauxStatement->execute();
  $animaux = $animauxStatement->fetchAll(PDO::FETCH_ASSOC);
?>
            <div class="card shadow-sm">
            <img src="/assets/images/Jungle/Crocodiles.jpeg" class="card-img-top" alt="Les crocodiles d'Arcadia">
              <div class="card-body">
                <div>
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary btn-detail" id="togg1">Découvrez nos crocodiles en détail</button>
                  </div>
                  <div class="card-text" id="d1">
                  <p> Prénoms :
                  <?php foreach ($animaux as $animaux) { ?>
                     <?=$animaux['prenom'].",";?><?php } ?></p>
                    <p>Avis du vétérinaire :</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

<?php 

$sqlQuery = 'SELECT * FROM animaux WHERE espece = 2';
  $animauxStatement = $pdo->query($sqlQuery);
  $animauxStatement->execute();
  $animaux = $animauxStatement->fetchAll(PDO::FETCH_ASSOC);
?>

        <div class="col">
          <div class="card shadow-sm">
          <img src="/assets/images/Jungle/Gorille.jpg" class="card-img-top" alt="Les gorilles d'Arcadia">
            <div class="card-body">
              <div>
              <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary btn-detail" id="togg2">Découvrez nos gorilles en détail</button>
                  </div>
                  <div class="card-text" id="d2">
                  <p> Prénoms :
                  <?php foreach ($animaux as $animaux) { ?>
                     <?=$animaux['prenom'].",";?><?php } ?></p>
                    <p>Avis du vétérinaire :</p>
                  </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col">
<?php 

$sqlQuery = 'SELECT * FROM animaux WHERE espece = 3';
  $animauxStatement = $pdo->query($sqlQuery);
  $animauxStatement->execute();
  $animaux = $animauxStatement->fetchAll(PDO::FETCH_ASSOC);
?>
          <div class="card shadow-sm">
          <img src="/assets/images/Jungle/Pantère-noire.jpg" class="card-img-top" alt="La panthère noire d'Arcadia">
            <div class="card-body">
              <div>
              <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary btn-detail" id="togg3">Découvrez notre panthère noire en détail</button>
                  </div>
                  <div class="card-text" id="d3">
                  <p> Prénom :
                  <?php foreach ($animaux as $animaux) { ?>
                     <?=$animaux['prenom'].",";?><?php } ?></p>
                    <p>Avis du vétérinaire :</p>
                  </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col">
<?php 

$sqlQuery = 'SELECT * FROM animaux WHERE espece = 4';
  $animauxStatement = $pdo->query($sqlQuery);
  $animauxStatement->execute();
  $animaux = $animauxStatement->fetchAll(PDO::FETCH_ASSOC);
?>
          <div class="card shadow-sm tigre">
          <img src="/assets/images/Jungle/Tigres.jpg" class="card-img-top" alt="Les tigres d'Arcadia">
            <div class="card-body">
              <div>
              <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary btn-detail" id="togg4">Découvrez nos tigres en détail</button>
                  </div>
                  <div class="card-text" id="d4">
                  <p> Prénoms :
                  <?php foreach ($animaux as $animaux) { ?>
                     <?=$animaux['prenom'].",";?><?php } ?></p>
                    <p>Avis du vétérinaire :</p>
                  </div>
            </div>
          </div>
        </div>


</main>


<script src="../jungle.js"></script>
<?php require_once __DIR__ . '/../templates/footer.php';?>