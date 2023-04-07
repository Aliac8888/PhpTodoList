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
        echo addfolder($_POST["foldername"]);
    break;

    case "addtask":
        $folderid= $_POST['folderid'];
        $tasktitle = $_POST['tasktitle'];
        if(!isset($folderid) || empty($folderid)){
            echo ".ابتدا یک فولدر را انتخاب کنید";
            die();
        }

        if(!isset($tasktitle) || strlen($tasktitle) < 3){
            echo "نام یک تسک با حداقل ۳ حرف را وارد کنید";
            die();
        }

        echo addtask($tasktitle,$folderid);

    break;


    default:
    diepage("invalid action");
}


?>