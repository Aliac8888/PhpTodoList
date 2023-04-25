<?php defined('BASE_PATH') or die("permission denied");

/*** authentication functions ***/

function get_current_user_id(){
    return getloggedinuser()->id ?? 0;
}


function getuserbyemail($email){
    global $pdo;
    $sql = "select * from users where email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":email"=>$email]);
    $records = $stmt->fetchAll(pdo::FETCH_OBJ);
    return $records[0] ?? null;//fetchall returns an array so we want the first record
}


function login($email,$pass){
    $user = getuserbyemail($email);
    if(is_null($user)){
        return false;
    }
    if(password_verify($pass,$user -> password)){
        //login successful
        $user->image ="https://www.gravatar.com/avatar/". md5(strtolower(trim($user->email)));
        $_SESSION['login'] = $user;
        return true;
    }
    return false;
}

function logout(){
    unset($_SESSION['login']);
}


function isloggedin(){
    return isset($_SESSION['login']) ? true : false;
}

function getloggedinuser(){
    return $_SESSION['login'] ?? null;
}


function register($userdata){
    global $pdo;
    $email = $userdata["email"];  
    $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^"; 
    //password validation check later.
    if(!preg_match("/^[a-zA-z]*$/", $userdata['username']) or empty($userdata['username'])){
        diepage("username must just contain alphabets". PHP_EOL . "<a href='http://localhost:8012/todo/auth.php'>click to try sign up again</a>");

    }
    elseif(!preg_match($pattern, $email) or empty($email)){
        diepage("not a valid email". PHP_EOL . "<a href='http://localhost:8012/todo/auth.php'>click to try sign up again</a>");
    }
    else{    
        $pass_hash = password_hash($userdata['password'],PASSWORD_BCRYPT);
        $sql = "insert into users (name,email,password) values (:name,:email,:pass)"; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":name"=>$userdata['username'],":email"=>$userdata['email'],":pass"=>$pass_hash));
        $dlrows = $stmt->rowCount() ? true : false;//if rowcount is 0 false and if it has value its true
        return $dlrows;
    }


}

?>