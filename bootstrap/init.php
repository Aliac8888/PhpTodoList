<?php
include "constants.php";
include BASE_PATH."bootstrap/config.php";//if we dont use base(root) path and dont include full path an error will occur
include BASE_PATH."vendor/autoload.php"; 
include BASE_PATH."libs/helpers.php";

try{
    $pdo = new PDO("mysql:dbname=$database_config->db;
    host=$database_config->host",
    $database_config->user,
    $database_config->pass);

} catch(PDOException $e){
    diepage("connection error : " . $e->getMessage());

}

include BASE_PATH."libs/lib-auth.php";
include BASE_PATH."libs/lib-tasks.php";

?>
