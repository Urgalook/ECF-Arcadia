<?php
require_once __DIR__ . "/../back/config.php";
require_once __DIR__ . "/../back/session.php";
employeOnly();

require_once __DIR__ . "/../back/pdo.php";
require_once __DIR__ . "/avis.php";
require_once __DIR__ . "/templates/header.php";


$pdo = getDatabaseConnection();

function validateAvis(PDO $pdo, int $id):bool
{
    $id = $_GET['id'];
    $query = $pdo->prepare("UPDATE avis SET Validation = TRUE WHERE id = :id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return true;
}

$avis = false;
$errors = [];
$messages = [];
if (isset($_GET["id"])) {
    $avis =  getAvisById($pdo, (int)$_GET["id"]);
}
if ($avis) {
    if (validateAvis($pdo, $_GET["id"])) {
        $messages[] = "L'article a bien été validé";
    } else {
        $errors[] = "Une erreur s'est produite lors de la validation";
    }
} else {
    $errors[] = "L'avis n'existe pas";
}



require_once('templates/footer.php');
?>
