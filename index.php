<?php 
include "bootstrap/init.php";

if(isset($_GET['delete_folder']) && is_numeric($_GET['delete_folder'])){
    $deletedrows = deletefolder($_GET['delete_folder']);
}

if(isset($_GET['delete_task']) && is_numeric($_GET['delete_task'])){
    $deletedrows = deletetasks($_GET['delete_task']);
}

//delete and update actions must be used before gathering data
//because if we use it after that the changes wont be shown

$folders= getfolders();

$tasks= gettasks();

//dd1($tasks);

include "tpl/tpl-index.php";
?>