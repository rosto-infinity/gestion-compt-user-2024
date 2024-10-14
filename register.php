<?php
session_start();
require_once('./includes/db.php');
require_once('./includes/functions.php');

if (isset($_POST)) {
    $errors = [];
    
   
    // Pseudo--------------------------------
    if (empty($_POST['username']) || !preg_match("#^[a-zA-Z0-9_]+$#", $_POST['username'])) {
        
        $errors['username'] = "Pseudo non valide";
        // var_dump($errors['username']);
    } else {
        // SELECT * FROM users WHERE username = post
        $query = "SELECT * FROM users WHERE username = ?";
        $req = $pdo->prepare($query);
        $req->execute([$_POST['username']]);
        if ($req->fetch()) {
            $errors['username'] = "Ce pseudo n'est plus disponible";
        }
    }
    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";
    // var_dump($_FILES["photo"]["name"]);
    
    // // Photo---------------------------------
    // if (empty($_FILES["photo"]["name"])) {

    //     // var_dump($_FILES["photo"]["name"]);
    //     $errors['photo'] = "Vous devez inserer une photo de profile ";
    // }else {

    // }

    // Email---------------------------------------
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email non valide";
    } else {
        // SELECT * FROM users WHERE email = post
        $query = "SELECT * FROM users WHERE email = ?";
        $req = $pdo->prepare($query);
        $req->execute([$_POST['email']]);
        if ($req->fetch()) {
            $errors['email'] = "Cet email est déjà pris";
        }
    }

    // Password-----------------------------------------
    if (empty($_POST['password'])) {
        $errors['password'] = "Vous devez entrer un mot de passe ";
    }else if( $_POST['password'] !== $_POST['confirm_password']){
        $errors['password'] = "Votre mot de passe ne correspond pas !";

    }
    
    // INSERT INTO------------------------------------------
    if (empty($errors)) {
        $query = "INSERT INTO users(username,email,password,confirmation_token) VALUES(?,?,?,?)";
        $req = $pdo->prepare($query);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
       
        $token =generateToken(10);
        // var_dump($token);
        $req->execute([$_POST['username'], $_POST['email'], $password, $token]);
        $userId = $pdo->lastInsertId();
        $mail = $_POST['email'];
        $subject = "Confirmation du compte";
        $message = "Afin de confirmer votre compte, merci de cliquer sur ce lien ou de copier et coller dans l'URL de votre navigateur\n
        http://localhost/cours-2024/gestion-compt-user-2024/confirm?id=$userId&token=$token";
      



        mail($mail,$subject,$message);

        $_SESSION['flash']['success'] = "Compte créé avec sucèss. Veillez vérifier votre boite mail afin de confirmer votre compte";

        header("Location: login");
        exit();
    }
    
}
?>

<?php require_once './includes/header.php'; ?>


<div class="content">
    <div class="container">
        <div class="header">
            <h2>S'inscrire</h2>
        </div>
        <?php
if (!empty($errors)) {
    echo '<div style="color:white; text-align: center; background-color:#ff6c6c;padding:2px 7px; margin-bottom:10px; font-size:23px;">' . reset($errors) . '</div>';
}
?>
        <form action="" class="form" id="form" method="post" enctype="multipart/form-data">
            <div class="form-control">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" placeholder="rostodev" name="username" autocomplete="off"
                    value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>">

            </div>

            <!-- <div class="form-control">
                <label for="photo">Photo</label>
                <input type="file" id="photo" name="photo">
            </div> -->

            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="rostodev@gmail.com" name="email" 
                value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
            </div>

            <div class="form-control">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password">

            </div>

            <div class="form-control">
                <label for="confirm_password">Confirmation du mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password">

            </div>
            

            <button type="submit"> S'inscrire</button>

        </form>

    </div>
</div>
<?php
require_once './includes/footer.php';
?>