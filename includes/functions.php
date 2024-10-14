<?php
 function generateToken($length){
    $alphaNum = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

       return substr(str_shuffle(str_repeat($alphaNum, $length)), 0, $length);
 }
 function is_connect(){
   if (session_status() == PHP_SESSION_NONE ) {
      session_start();  
}
if (!isset($_SESSION['auth'])) {
   $_SESSION['flash']['error'] ="Vous ne pouvez pas acceder à cette page";
   header('Location: login.php');
   exit();
}

 }
 function reconnect_auto(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_COOKIE['remember']) && !isset($_SESSION['auth'])) {
        require_once 'db.php';
        if (!isset($pdo)) {
            global $pdo;
        }
        $remember_token = $_COOKIE['remember'];
        // echo '<pre>';
        //     var_dump($remember_token);
        //     echo '</pre>';
        //      die();
        $parts = explode("::", $remember_token);
        $userId = $parts[0];
        $req = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $req->execute([$userId]);
        $user = $req->fetch();
           

        if ($user) {
            $expected = $userId. "::".$user['remember_token']. sha1($user['id'] ."eva");
            // echo '<pre>';
            // var_dump($expected);
            // echo '</pre>';
            //  die();
            if ($expected == $_COOKIE['remember']) {
                $_SESSION["auth"] = $user;
                $_SESSION['flash']['success'] = "Connexion éffectuée avec sucess";

                setcookie("remember",$remember_token,time()+ 60* 60 * 24 * 7);
                header("Location: index.php");
                exit();
            }else{
                setcookie("remember", "",-1);
            }
        }else{
            setcookie("remember", "",-1);
        }
    }
}