
<?php
    // session_start();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>manager  Accounts users</title>
</head>

<body>
    <header>
        <div class="logo">
            <h2><a href="index.php">Compte utilisateur</a></h2>
        </div>
        <nav>
            <ul>
             <?php if (isset($_SESSION['auth'])) : ?>
                 <li><a id="gcu" href="logout.php">Se deconnecter</a></li>
            <?php else : ?>
                <li><a href="register.php">S'inscrire</a></li>
                <li><a href="login.php">Se connecter</a></li>
            <?php endif; ?>
            </ul>
        </nav>

    </header>
    <span>
        <?php if (isset($_SESSION['flash'])) : ?>
            <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
                <div class="alert alert-<?= $type ?>">
                    <?= $message ?>
      
                </div>
            <?php endforeach; ?>
            <?php unset($_SESSION['flash']) ?>
        <?php endif; ?>
    </span>