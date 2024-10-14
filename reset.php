<?php
require_once './includes/db.php';
session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
if (isset($_GET['id']) && isset($_GET['token'])) {

    $userId = $_GET['id'];
    $token = $_GET['token'];
    
    $query = "SELECT * FROM users WHERE id = ? AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE) AND confirmed_at IS NOT NULL";
    $req = $pdo->prepare($query);
    $req->execute([$userId, $token]);
    // $user = $req->fetch();
    $user = $req->fetch();
    
    if ($user) {
        if (!empty($_POST)) {
            if (!empty($_POST['password']) && $_POST['password'] === $_POST['confirm_password']) {
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $query = "UPDATE users SET password = ?,reset_token = NULL,reset_at = NULL WHERE id = ?";
                $pdo->prepare($query)->execute([$password, $userId]);

                $_SESSION['flash']['success'] = "Votre mot de passe a bien été mise à jours";
                $_SESSION['auth'] = $user;
                header('Location: index.php');
                exit();
            } else {
                $_SESSION['flash']['error'] = "Les deux mots de passes ne correspondent pas !";
            }
        }
    } else {
        $_SESSION['flash']['error'] = "Ce token n'est plus valide";
        header('Location: login.php');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}
?>

<?php require_once './includes/header.php'; ?>
<div class=" content">
    <div class="container">
        <div class="header">
            <h2>Réinitialiser votre mot de passe</h2>
        </div>
<form action="" class="form" id="form" method="post" enctype="multipart/form-data">
            

            <div class="form-control">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password">

            </div>

            <div class="form-control">
                <label for="confirm_password">Confirmation du mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password">

            </div>
            
            <button type="submit"> Réinitialiser votre mot de passe</button>
        </form>
        </div>
</div>
<?php
require_once './includes/footer.php';
?>