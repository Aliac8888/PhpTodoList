<?php 
include "bootstrap/init.php";

$home_url = site_url();

if($_SERVER['REQUEST_METHOD']=='POST'){
    $action = $_GET['action'];
    $params = $_POST;
    if($action == 'register'){
        $result = register($params);
        if(!$result){
            //if result is false it changes to true and goes inside the loop
            message("error in registeration");
        }else{
            message("registered successfully <br>
            <a href='{$home_url}auth.php'>login to use todo</a>", 'success');
        }
    } elseif($action == 'login'){
        $result = login($params['email'],$params['password']);
        if(!$result){
            //if result is false it changes to true and goes inside the loop
            message("error: email or password incorrect");
        }else{
            //message("logged in successfully <br><a href='{$home_url}'>start using todo</a>", 'success');
            redirect(site_url());
        }
    }
}



include "tpl/tpl-auth.php";

?>