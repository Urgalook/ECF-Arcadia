<?php
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

define("_DOMAIN_", ".ecfarcadiatest.local");
define("_JUNGLE_IMAGES_FOLDER_", "/assets/images/Jungle/");
define("_SAVANE_IMAGES_FOLDER_", "/assets/images/Savane/");
define("_MARAIS_IMAGES_FOLDER_", "/assets/images/Marais/");
define("_DB_NAME_", "arcadia");
define("_DB_USER_", "root");
define("_DB_PASSWORD_", "M4x1meSTUDI2024*");
define("_APP_EMAIL_", "maxime.bloise72@gmail.com");

ini_set('display_errors', 1);