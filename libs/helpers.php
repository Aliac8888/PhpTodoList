<?php defined('BASE_PATH') or diepage("permission denied");

//if(!defined('BASE_PATH')){
//    echo 'permission denied';
//    die();
//} this is another kind of preventing a hacker to see errors of the program

//how it works? well actually the app is running by index.php and all constants are included by constants.php
//as we see in libs files we didnt include any constants so there we go...
function diepage($msg){
    echo "<div style='margin:50px auto;
    width:70%;
    padding:50px;
    color:white;
    background-color:grey;
    border:2px solid black;
    border-radius:20px'>$msg</div>";
    die();
};

function is_ajax_request(){
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) =='xmlhttprequest'){
        return true;
    } 
    return false;
}

//the function above checks if http request equals to ajax
?>