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
    </div>
    <div id="overlay" class="overlay" onclick="closeLoginPopup()"></div>
    <div id="loginPopup" class="popup">
        <span class="close-button" onclick="closeLoginPopup()">&#10006;</span>
        <h2 class="login-text">Login</h2>
        <form id="login-form" method="post">
            <label class="username-text" for="username">Usuário:</label>
            <input class="username-text-box" type="text" id="username" name="username">
            <br>
            <label class="password-text" for="password">Senha:</label>
            <input class="password-text-box" type="password" id="password" name="password">
            <br>
            <div class="submit-text-section">
            <button class="submit-text" type="submit" method="post">Entrar</button>
            </div>
        </form>
        <div id="message"></div>
    </div>
    <div id="registerPopup" class="popup" style="display: none;">
    <span class="close-button" onclick="closeRegisterPopup()">&#10006;</span>
    <h2 class="register-text">Cadastro</h2>
    <form id="register-form" method="post">
        <label class="username-text" for="newUsername">Novo Usuário:</label>
        <input class="username-text-box" type="text" id="newUsername" name="newUsername">
        <br>
        <label class="password-text" for="newPassword">Nova Senha:</label>
        <input class="password-text-box" type="password" id="newPassword" name="newPassword">
        <br>
        <div class="submit-text-section">
            <button class="submit-text" type="submit" method="post">Cadastrar</button>
        </div>
    </form>
    <div id="registerMessage"></div>
</div>

<div class="container">  
<div class="image-container" id="shrekContainer">
    <img class="title" src="..\assets\shrek.png" alt="macaco" onclick="openRatingModal('Shrek')">
    <p class="image-text" onclick="openRatingModal('Shrek')">Shrek</p>
</div>
<div class="image-container" id="breakingBadContainer">
    <img class="title" src="..\assets\breaking-bad.png" alt="macaco" onclick="openRatingModal('Breaking Bad')">
    <p class="image-text" onclick="openRatingModal('Breaking Bad')">Breaking Bad</p>
</div>
<div class="image-container" id="round6Container">
    <img class="title" src="..\assets\round6.png" alt="macaco" onclick="openRatingModal('Round 6')">
    <p class="image-text" onclick="openRatingModal('Round 6')">Round 6</p>
</div>
</div>

<div id="ratingModal" class="popup" style="display: none;">
    <span class="close-button" onclick="closeRatingModal()">&#10006;</span>
    <h2 class="rating-text">Avaliação da Série</h2>
    <p id="selectedSeries"></p>
    <form id="rating-form" method="post" action="cu.php" onsubmit="submitRating(event)">
    <input type="hidden" id="titulo" name="titulo" value="Nome da Série Predefinido">
    <label for="rating">Avalie de 1 a 10:</label>
    <input type="number" id="rating" name="rating" min="1" max="10">
    <br>
    <label for="episodesWatched">Quantidade de episódios assistidos:</label>
    <input type="number" id="episodesWatched" name="episodes_watched" min="0">
    <br>
    <div class="submit-text-section">
    <button class="submit-text" type="submit" onclick="submitRating()">Submeter</button>

    </div>
</form>
    <div id="ratingMessage"></div>
</div>


</body>
<script src="\script.js"></script>
<script src="script-mainPage.js"></script>
</html>