<?php
session_start();
include '../connect.php';

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit();
}

if (isset($_SESSION['user_id'])) {
    $usuario_id = $_SESSION['user_id'];
    $query = "SELECT * FROM series WHERE userid = :userid";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':userid', $usuario_id);
    $stmt->execute();
    $seriesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_SESSION['user_id'])) {
    $usuario_id = $_SESSION['user_id'];
    $query = "SELECT DISTINCT ON (titulo) * FROM series WHERE userid = :userid ORDER BY titulo, id DESC";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':userid', $usuario_id);
    $stmt->execute();
    $seriesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <span class="login-button" id="loginButton"><span onclick="openLoginPopup()">Entrar</span>/<span
                    onclick="openRegisterPopup()">Cadastro</span></span>

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
    <div id="overlay" class="overlay" onclick="closeLoginPopup()" onclick="closeRegisterPopup()"></div>
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
    <div id="registerPopup" class="popup">
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

    <div id="user-series" class="user-series">
        <?php if (isset($seriesData) && !empty($seriesData)) : ?>
            <h2>Títulos Avaliados:</h2>
            <ul>
                <?php foreach ($seriesData as $series) : ?>
                    <li>
                        <strong>Título:</strong> <?php echo $series['titulo']; ?><br>
                        <strong>Rating:</strong> <?php echo $series['rating']; ?><br>
                        <strong>Episódios Assistidos:</strong> <?php echo $series['episodes_watched']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>O usuário ainda não avaliou nenhuma série.</p>
        <?php endif; ?>
    </div>

    <script src="\script.js"></script>
    <script src="script.js"></script>
</body>

</html>
