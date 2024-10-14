<?php
require_once './includes/db.php';
require_once './includes/functions.php';

if (!empty($_POST) && !empty($_POST['email'])) {
    $query = "SELECT * FROM users WHERE email =? AND confirmed_at IS NOT NULL";
    $req = $pdo->prepare($query);
    $req->execute([$_POST['email']]);
    $user = $req->fetch();
       
    if ($user) {
        session_start();
        $reset_token  = generateToken(10);
        
        $query = "UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id =?";
        $req = $pdo->prepare($query);
        $req->execute([$reset_token, $user['id']]);
        // echo '<pre>';
    //     var_dump($user);
    //     echo '</pre>';
    //      die();
        
        $mail = $_POST['email'];
        $subject = "Réinitialisation de votre mot de passe";
        $message = "Afin de réinitialiser votre mot de passe, merci de cliquer sur ce lien\n\n http://localhost/cours-2024/gestion-compt-user-2024/reset.php?id=" . $user['id'] . "&token=$reset_token";
        
        mail($mail, $subject, $message);

        $_SESSION['flash']['success'] = "Les intructions du rappel du mot de passe vous ont été envoyées par email";
        header("Location: login.php");
        exit();
     }
} else {
        $_SESSION['flash']['error'] = "Aucun compte ne correspond à cet email";
    }
?>
<?php require_once './includes/header.php'; ?>
<div class=" content">
    <div class="container">
        <div class="header">
            <h2>Rappel du mot de passe</h2>
        </div>

        <form action="" class="form" id="form" method="post">
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="rostodev" autocomplete="off" name="email">
            </div>

            <button type="submit"> Soumettre</button>
        </form>

    </div>
</div>
<?php
require_once './includes/footer.php';
?>