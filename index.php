<?php 
include "bootstrap/init.php";

if(isset($_GET['delete_folder']) && is_numeric($_GET['delete_folder'])){
    $deletedrows = deletefolder($_GET['delete_folder']);
}

//delete and update actions must be used before gathering data
//because if we use it after that the changes wont be shown

$folders= getfolders();
$tasks= gettasks();

include "tpl/tpl-index.php";
?>