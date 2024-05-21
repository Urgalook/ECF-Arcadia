<?php

require_once __DIR__ . '/templates/header.php';
include("/back/pdo.php");
$pdo = getDatabaseConnection();
?>

    <div class="main row flex-lg-row-reverse align-items-center g-5 py-5">

        <div class="col-lg-6">
            <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Un zoo au coeur de la mythique forêt de Brocéliande</h1>
            <p class="lead">Bienvenue à Arcadia, un havre de biodiversité niché au cœur de la mystique forêt de Brocéliande. Ce zoo enchanteur offre une expérience immersive où les visiteurs peuvent explorer trois habitats distincts, chacun abritant une multitude d'espèces fascinantes.

La première étape de votre voyage vous transporte dans la luxuriante jungle, où les crocodiles glissent silencieusement dans les eaux sombres, les gorilles jouent avec agilité dans les arbres, les panthères noires se fondent dans l'ombre et les majestueux tigres règnent en maîtres de leur royaume verdoyant.

Ensuite, embarquez pour un safari à travers la savane, où les éléphants majestueux barbotent paisiblement dans les points d'eau, les lions somnolent à l'ombre des acacias, les zèbres rayés gambadent dans les plaines herbeuses, les girafes s'élancent gracieusement vers les cimes des arbres et les guépards filent à toute vitesse dans la savane dorée.

Puis, plongez dans les mystérieux marais, où des boas sinueux s'enroulent autour des branches, des caïmans se cachent dans les eaux troubles et des tortues séculaires se prélassent au soleil, créant un tableau tranquille et serein.

Entre vos explorations, arrêtez-vous au restaurant du zoo pour déguster des mets délicieux inspirés de la cuisine locale, préparés avec des ingrédients frais et savoureux.

Pour une visite plus instructive, optez pour une excursion guidée avec l'un de nos experts passionnés, qui partagera des faits fascinants sur les animaux et leur habitat naturel, ainsi que des histoires captivantes sur la conservation et la protection de la faune sauvage.

Si vous préférez une aventure plus détendue, montez à bord du petit train du zoo et laissez-vous conduire à travers les différents habitats, en profitant de vues panoramiques et d'une atmosphère paisible.

Arcadia vous invite à découvrir la beauté et la diversité du règne animal, tout en encourageant le respect et la préservation de la nature pour les générations futures.</p>
        </div>
        <div class="carousel col-10 col-sm-8 col-lg-6">
            <button class="btn" id="prev">&#10096</button>
            <button class="btn" id="next">&#10097</button>
            <ul>
                <li class="slide"><img src="assets/images/Présentation_zoo1.jpg" alt="image carousel"></li>
                <li class="slide active"><img src="assets/images/Présentation_zoo2.jpg" alt="image carousel"></li>
                <li class="slide"><img src="assets/images/Présentation_zoo3.jpg" alt="image carousel"></li>
            </ul>
        </div>

    </div>

    <div class="avisbdd">

<?php

require_once __DIR__ . '/back/config.php';
require_once __DIR__ . '/back/pdo.php';


    $sqlQuery = 'SELECT * FROM avis ORDER BY id DESC';
    $avisStatement = $pdo->query($sqlQuery);
    $avisStatement->execute();
    $avis = $avisStatement->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="container px-4 py-5" id="hanging-icons">
    <h2 class="pb-2 border-bottom">Les avis de nos visiteurs</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
      <div class="col d-flex align-items-start">

        <div class="avis-client">
        <?php
        foreach ($avis as $avis) { if ($avis['Validation'] !== NULL){ 
        ?>
          <h3 class="fs-2 text-body-emphasis"><?php echo $avis['pseudo']; ?></h3>
          <p><?php echo $avis['avis']; ?></p>
        <?php
        }}
        ?>
        </div>
      </div>
    </div>
</div>

<div class="avis d-flex gap-2 py-5">
        <a href="/avis.php">
            <button class="btn btn-primary btn-avis d-inline-flex align-items-center" type="button">
                Laissez-nous un avis !
            </button>
        </a>
    </div>

    <div class="container px-4 py-5" id="hanging-icons">
        <?php
            $sqlQuery = 'SELECT * FROM horaires ORDER BY id ASC';
            $horairesStatement = $pdo->query($sqlQuery);
            $horairesStatement->execute();
            $horaires = $horairesStatement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <h1>Horaires d'ouverture</h1>
    <table class="table table-animaux">
    <thead>
        <tr>
        <th scope="col">Jour</th>
        <th scope="col">Ouverture</th>
        <th scope="col">Fermeture</th>
        </tr>
    </thead>
    <tbody>
    <?php

?>

<?php foreach ($horaires as $horaires) {?>
        <tr>
            <td><?=$horaires['jour'];?></td>
            <td><?=$horaires['ouverture'];?></td>
            <td><?=$horaires['fermeture'];?></td>
        </tr>
        <?php }?>
    </tbody>
    </table>
    </div>
</div>


<?php require_once __DIR__ . '/templates/footer.php';?>