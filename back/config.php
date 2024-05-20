<?php
$url = getenv('JAWSDB_URL');
$dbparts = parse_url($url);

$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['pass'];
$database = ltrim($dbparts['path'],'/');

define("_DOMAIN_", ".ecfarcadiatest.local");
define("_JUNGLE_IMAGES_FOLDER_", "/assets/images/Jungle/");
define("_SAVANE_IMAGES_FOLDER_", "/assets/images/Savane/");
define("_MARAIS_IMAGES_FOLDER_", "/assets/images/Marais/");
define("_DB_NAME_", "arcadia");
define("_DB_USER_", "root");
define("_DB_PASSWORD_", "M4x1meSTUDI2024*");
define("_APP_EMAIL_", "maxime.bloise72@gmail.com");

ini_set('display_errors', 1);