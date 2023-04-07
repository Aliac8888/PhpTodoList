<?php defined('BASE_PATH') or die("permission denied");

/*** folder functions ***/

function deletefolder($folder_id){
    global $pdo;
    $sql = "delete from folders where id = $folder_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $dlrows = $stmt->rowCount();
    return $dlrows;
}

function addfolder($folder_name){
    global $pdo;
    $current_user_id = get_current_user_id();
    $sql = "insert into folders (name,user_id) values (:folder_name,:current_user_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(":folder_name"=>$folder_name,":current_user_id"=>$current_user_id));
    $dlrows = $stmt->rowCount();
    return $dlrows;
}

function getfolders(){
    global $pdo;
    $current_user_id = get_current_user_id();
    $sql = "select * from folders where user_id = $current_user_id ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}

/*** task functions ***/

function deletetasks($task_id){
    global $pdo;
    $sql = "delete from tasks where id = $task_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $dlrows = $stmt->rowCount();
    return $dlrows;
}

function addtask($tasktitle,$folderid){
    global $pdo;
    $current_user_id = get_current_user_id();
    $sql = "insert into tasks (title,user_id,folder_id) values (:title,:user_id,:folder_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(":title"=>$tasktitle,":user_id"=>$current_user_id,":folder_id"=>$folderid));
    $dlrows = $stmt->rowCount();
    return $dlrows;
}

function gettasks(){
    global $pdo;
    $folder = $_GET['folder_id'] ?? null; //sets $folder to null if there are no folder_id's
    $folder_condition = '';
    if(isset($folder) and is_numeric($folder)){
        $folder_condition = "and folder_id = $folder";
    }

    $current_user_id = get_current_user_id();
    $sql = "select * from tasks where user_id = $current_user_id $folder_condition";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}

?>