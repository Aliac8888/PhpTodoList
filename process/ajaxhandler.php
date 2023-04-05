<?php
include_once "../bootstrap/init.php";

if(!is_ajax_request()){
    diepage("invalid request");
}

if(!isset($_POST['action']) || empty($_POST['action'])){
    diepage("invalid action");
}

switch ($_POST['action']){
    case "addfolder":
        if(!isset($_POST["foldername"]) || strlen($_POST["foldername"]) < 3){
            echo "نام فولدر باید بزرگتر از دو حرف باشد";
            die();
        }
        echo addfolders($_POST["foldername"]);
    break;

    case "addfolder":

    break;


    default:
    diepage("invalid action");
}


?>