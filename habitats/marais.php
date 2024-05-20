<?php
    require_once __DIR__ . '/../back/config.php';
    require_once __DIR__ . '/../back/pdo.php';
    require_once __DIR__ . '/../templates/header.php';

?>

<main>


  <section class="py-5 text-center">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Le marais d'Arcadia</h1>
        <p class="lead text-body-secondary">
        <?php $sqlQuery = 'SELECT * FROM habitats WHERE id = 3';
$habitatsStatement = $pdo->query($sqlQuery);
$habitatsStatement->execute();
$habitats = $habitatsStatement->fetchAll(PDO::FETCH_ASSOC);?>
        <?php foreach ($habitats as $habitats) { ?> <?=$habitats['description']?><?php } ?></p>
      </div>
    </div>
  </section>


  <div class="album py-5 bg-body-tertiary">
    <div>

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-3">
          <div class="col">
<?php 

$sqlQuery = 'SELECT * FROM animaux WHERE espece = 10';
  $animauxStatement = $pdo->query($sqlQuery);
  $animauxStatement->execute();
  $animaux = $animauxStatement->fetchAll(PDO::FETCH_ASSOC);
?>
            <div class="card shadow-sm">
            <img src="/assets/images/Marais/Caïman.jpg" class="card-img-top" alt="Les caïmans d'Arcadia">
              <div class="card-body">
                <div>
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary btn-detail" id="togg10">Découvrez nos caïmans en détail</button>
                  </div>
                  <div class="card-text" id="d10">
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

$sqlQuery = 'SELECT * FROM animaux WHERE espece = 11';
  $animauxStatement = $pdo->query($sqlQuery);
  $animauxStatement->execute();
  $animaux = $animauxStatement->fetchAll(PDO::FETCH_ASSOC);
?>

        <div class="col">
          <div class="card shadow-sm">
          <img src="/assets/images/Marais/Boa.jpeg" class="card-img-top" alt="Le boa d'Arcadia">
            <div class="card-body">
              <div>
              <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary btn-detail" id="togg11">Découvrez notre boa en détail</button>
                  </div>
                  <div class="card-text" id="d11">
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

$sqlQuery = 'SELECT * FROM animaux WHERE espece = 12';
  $animauxStatement = $pdo->query($sqlQuery);
  $animauxStatement->execute();
  $animaux = $animauxStatement->fetchAll(PDO::FETCH_ASSOC);
?>
          <div class="card shadow-sm">
          <img src="/assets/images/Marais/Tortue.jpg" class="card-img-top" alt="Les tortues d'Arcadia">
            <div class="card-body">
              <div>
              <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary btn-detail" id="togg12">Découvrez nos tortues en détail</button>
                  </div>
                  <div class="card-text" id="d12">
                  <p> Prénom :
                  <?php foreach ($animaux as $animaux) { ?>
                     <?=$animaux['prenom'].",";?><?php } ?></p>
                    <p>Avis du vétérinaire :</p>
                  </div>
              </div>
            </div>
          </div>
        </div>

</main>


<script src="../marais.js"></script>
<?php require_once __DIR__ . '/../templates/footer.php';?>