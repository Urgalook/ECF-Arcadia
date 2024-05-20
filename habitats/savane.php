<?php
    require_once __DIR__ . '/../back/config.php';
    require_once __DIR__ . '/../back/pdo.php';
    require_once __DIR__ . '/../templates/header.php';

?>

<main>


  <section class="py-5 text-center">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">La savane d'Arcadia</h1>
        <p class="lead text-body-secondary">
        <?php $sqlQuery = 'SELECT * FROM habitats WHERE id = 2';
$habitatsStatement = $pdo->query($sqlQuery);
$habitatsStatement->execute();
$habitats = $habitatsStatement->fetchAll(PDO::FETCH_ASSOC);?>
        <?php foreach ($habitats as $habitats) { ?> <?=$habitats['description']?><?php } ?></p>
      </div>
    </div>
  </section>



  <div class="album py-5 bg-body-tertiary">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-3">
          <div class="col">
<?php 

$sqlQuery = 'SELECT * FROM animaux WHERE espece = 5';
  $animauxStatement = $pdo->query($sqlQuery);
  $animauxStatement->execute();
  $animaux = $animauxStatement->fetchAll(PDO::FETCH_ASSOC);
?>
            <div class="card shadow-sm">
            <img src="/assets/images/Savane/Elephant.jpg" class="card-img-top" alt="Les éléphants d'Arcadia">
              <div class="card-body">
                <div>
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary btn-detail" id="togg5">Découvrez nos élépahnts en détail</button>
                  </div>
                  <div class="card-text" id="d5">
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

$sqlQuery = 'SELECT * FROM animaux WHERE espece = 6';
  $animauxStatement = $pdo->query($sqlQuery);
  $animauxStatement->execute();
  $animaux = $animauxStatement->fetchAll(PDO::FETCH_ASSOC);
?>
          <div class="card shadow-sm">
          <img src="/assets/images/Savane/Girafe.jpg" class="card-img-top" alt="Les girafes d'Arcadia">
            <div class="card-body">
              <div>
              <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary btn-detail" id="togg6">Découvrez nos girafes en détail</button>
                  </div>
                  <div class="card-text" id="d6">
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

$sqlQuery = 'SELECT * FROM animaux WHERE espece = 7';
  $animauxStatement = $pdo->query($sqlQuery);
  $animauxStatement->execute();
  $animaux = $animauxStatement->fetchAll(PDO::FETCH_ASSOC);
?>
          <div class="card shadow-sm">
          <img src="/assets/images/Savane/Guepard.jpg" class="card-img-top" alt="Les guépards d'Arcadia">
            <div class="card-body">
              <div>
              <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary btn-detail" id="togg7">Découvrez notre panthère noire en détail</button>
                  </div>
                  <div class="card-text" id="d7">
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

$sqlQuery = 'SELECT * FROM animaux WHERE espece = 8';
  $animauxStatement = $pdo->query($sqlQuery);
  $animauxStatement->execute();
  $animaux = $animauxStatement->fetchAll(PDO::FETCH_ASSOC);
?>
          <div class="card shadow-sm">
          <img src="/assets/images/Savane/Lion.jpg" class="card-img-top" alt="Les lion d'Arcadia">
            <div class="card-body">
              <div>
              <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary btn-detail" id="togg8">Découvrez nos lions en détail</button>
                  </div>
                  <div class="card-text" id="d8">
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

$sqlQuery = 'SELECT * FROM animaux WHERE espece = 9';
  $animauxStatement = $pdo->query($sqlQuery);
  $animauxStatement->execute();
  $animaux = $animauxStatement->fetchAll(PDO::FETCH_ASSOC);
?>
          <div class="card shadow-sm">
          <img src="/assets/images/Savane/Zèbres.jpg" class="card-img-top" alt="Les zèbres d'Arcadia">
            <div class="card-body">
              <div>
              <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary btn-detail" id="togg9">Découvrez nos zèbres en détail</button>
                  </div>
                  <div class="card-text" id="d9">
                  <p> Prénoms :
                  <?php foreach ($animaux as $animaux) { ?>
                     <?=$animaux['prenom'].",";?><?php } ?></p>
                    <p>Avis du vétérinaire :</p>
                  </div>
            </div>
          </div>
        </div>
    </div>
</div>
</div>


</main>


<script src="../savane.js"></script>

<?php require_once __DIR__ . '/../templates/footer.php';?>