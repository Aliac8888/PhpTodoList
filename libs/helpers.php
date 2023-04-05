<?php 

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

?>