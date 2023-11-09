<?php
session_start();
include '../connect.php';

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../header&login.css">
    <title>GL Reviewer</title>
</head>
<body>
    <header>
        <i class="fas fa-bars fa-2x" id="menu-icon"></i>
        <div class="page-title">
        <h1>GL Reviewer</h1>
        </div>
        <?php if (isset($_SESSION['user_id'])) : ?>
            <div id="user-info" class="user-info">
                <span id="usernameDisplay" class="username-display">Bem vindo, <?php echo $_SESSION['usuario']; ?></span>
            <form method="post" action="">
                <button type="submit" name="logout" method="post">Sair</button>
            </form>
            </div>
        <?php else : ?>
            <span class="login-button" id="loginButton" ><span onclick="openLoginPopup()">Entrar</span>/<span onclick="openRegisterPopup()">Cadastro</span></span>
            
        <?php endif; ?>
    </header>
    <div id="sidebar" class="sidebar">
    <ul>
        <li><a class="sidebar-link" href="\mainPage\index.php">Página Inicial</a></li>
        <?php if (isset($_SESSION['user_id'])) : ?>
            <li><a class="sidebar-link" href="\profile\index.php">Perfil</a></li>
        <?php else : ?>
            <li><a class="sidebar-link">Faça login para ver o perfil</a></li>
        <?php endif; ?>
    </ul>

    </body>
<script src="\script.js"></script>
<script src="script.js"></script>
</html>