<?php

$mainMenu = [
    'index.php' => 'Acceuil',
    'services.php' => 'Services',
    'habitats.php' => 'Habitats',
    'contact.php' => 'Contact',
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arcadia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="/../assets/css/override-bootstrap-css.css" rel="stylesheet">
    <link href="assets/css/carousel.css" rel="stylesheet">

</head>
<body>
    <div class="header">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <div class="col-md-3 mb-2 mb-md-0">
            <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
            <img src="/../assets/images/Arcadia.png" alt="Logo Arcadia" width="150px">
            </a>
        </div>

        <div class="col-md-3 text-end">
            <a href="/login.php"><button type="button" class="btn btn-outline-primary me-2">Login/Deconnexion</button></a>
        </div>
        </header>
    </div>
    <main>