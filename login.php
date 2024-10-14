<?php
session_start();

require_once './includes/db.php';
require_once './includes/functions.php';

reconnect_auto();

if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password']) ) {
    $query = "SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL";
    $req = $pdo->prepare($query);
    $req->execute(['username' =>$_POST['username']]);
    $user = $req->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['auth'] = $user;
        $_SESSION['flash']['success'] ="Connexion effectuer avec sucess";

        if (isset($_POST['remember'])) {
            $remember_token = generateToken(100);
            $query = "UPDATE users SET remember_token = ? WHERE id = ?";
            $pdo->prepare($query)->execute([$remember_token,$user['id']]);
 
            setcookie("remember",$user['id'] . "::".$remember_token. $user['id'] .sha1("eva",time()+ 60*60*24*7)); 
         }

        header("Location: index.php");
        exit();
    }else{
        $_SESSION['flash']['error'] ="Identifier ou mot de passe incorrect";
    }

}
 ?>
<?php require_once './includes/header.php'; ?>
<div class=" content">
    <div class="container">
        <div class="header">
            <h2>Se Connecter</h2>
        </div>
        <form action="" class="form" id="form" method="post">
            <div class="form-control">
                <label for="username">Nom d'utilisateur ou l'émail</label>
                <input type="text" id="username" placeholder="rostodev" autocomplete="off" name="username">

            </div>

            <div class=" form-control">
                <label for="password">Mot de passe <a class="passforget" href="remember.php">(J'ai oublié mon mot de
                        passe)</a>
                </label>
                <input type="password" id="password" name="password">

            </div>
            <div class="form-controlg remember">
                <label for="remember"> <input type="checkbox" name="remember" value="1"> Se souvenir de moi</label>


            </div>

            <button type="submit"><i class="fa fa-user-plus"></i> Se connecter</button>
        </form>

    </div>
</div>
<?php
require_once './includes/footer.php';
?>