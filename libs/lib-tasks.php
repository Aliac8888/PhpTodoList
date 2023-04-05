<?php 

/*** folder functions ***/

function deletefolder($folder_id){
    global $pdo;
    $sql = "delete from folders where id = $folder_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $dlrows = $stmt->rowCount();
    return $dlrows;
}

function addfolders($folder_name){
    global $pdo;
    $current_user_id = get_current_user_id();
    $sql = "insert into folders (name,user_id) values (:folder_name,:current_user_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(":folder_name"=>$folder_name,":current_user_id"=>$current_user_id));
    $dlrows = $stmt->rowCount();
    return $dlrows ;
}

function getfolders(){
    global $pdo;
    $current_user_id = get_current_user_id();
    $sql = "select * from folders where user_id = $current_user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}

/*** task functions ***/

function removetasks(){

}

function addtasks(){

}

function gettasks(){

}

?>