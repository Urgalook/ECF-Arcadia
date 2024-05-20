<?php
require_once __DIR__ . "/../back/config.php";
require_once __DIR__ . "/../back/session.php";
employeOnly();

require_once __DIR__ . "/../back/pdo.php";
require_once __DIR__ . "/avis.php";
require_once __DIR__ . "/templates/header.php";


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
