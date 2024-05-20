<?php
    require_once __DIR__ . '/templates/header.php';
    require_once __DIR__ . '/back/config.php';
    require_once __DIR__ . '/back/pdo.php';

    $servername = "127.0.0.1";
    $bdd = "arcadia";
    $username = "root";
    $password = "M4x1meSTUDI2024*";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$bdd", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }


    if(isset($_POST['sendAvis']))
    {
        $pseudo = $_POST['pseudo'];
        $message = $_POST['message'];

        $sql = "INSERT INTO `avis`(`pseudo`, `avis`) VALUES (:pseudo, :message)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':pseudo', $pseudo);  
        $stmt->bindParam(':message', $message);
            $stmt->execute();
    }

?>

<form action="" method="post" class="mb-3 form">
    <div class="mb-3 form">
        <label for="pseudo" class="form-label">Pseudo</label>
        <input type="text" class="form-control" id="pseudo" name="pseudo" required>
    </div>
    <div class="mb-3 form">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" id="message" name="message" rows="3"></textarea>
    </div>

    <input type="submit" name="sendAvis" class="btn btn-primary form" value="Envoyer">

<?php
    require_once __DIR__ . '/templates/footer.php';

?>