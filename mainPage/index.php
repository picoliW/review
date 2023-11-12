<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
include '../connect.php';


if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit();
}
$sinopses = array(
    'Shrek' => 'Uma animação incrível sobre um ogro verde e suas aventuras<br> inusitadas.',
    'Breaking Bad' => 'A história de um professor de química que se transforma em<br> um poderoso traficante de drogas.',
    'Round 6' => 'Participantes de um jogo misterioso lutam pela sobrevivência<br> em busca de um grande prêmio.'
);

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];

    try {
    $query = "SELECT * FROM series WHERE titulo LIKE :searchTerm";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

}
 catch (PDOException $e) {
    echo 'Erro ao executar a consulta: ' . $e->getMessage();
}
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
    <form method="get" action="">
    <label for="search">Pesquisar série:</label>
    <input type="text" id="search" name="search">
    <button type="submit">Pesquisar</button>
</form>


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

<div class="container">
<?php if (isset($searchResults)) : ?>
    <div class="bucetaPRETA">
    <h2>Resultados da Pesquisa para "<?php echo $searchTerm; ?>"</h2>
    </div>
    <?php
    foreach ($searchResults as $result) {
        echo '<div class="search-result">';
        echo '<img src="' . $result['imagem_path'] . '" alt="' . $result['titulo'] . '">';
        echo '<p>' . $result['titulo'] . '</p>';
        echo '<a href="#" onclick="openRatingModal(\'' . $result['titulo'] . '\', \'' . $result['sinopse'] . '\')">Ver Detalhes</a>';
        echo '</div>';
    }
    ?>
<?php else : ?>
<div class="image-container" id="shrekContainer">
    <img class="title" src="..\assets\shrek.png" alt="macaco" onclick="openRatingModal('Shrek', '<?php echo $sinopses['Shrek']; ?>')">
    <p class="image-text" onclick="openRatingModal('Shrek', '<?php echo $sinopses['Shrek']; ?>')">Shrek</p>

</div>
<div class="image-container" id="breakingBadContainer">
    <img class="title" src="..\assets\breaking-bad.png" alt="macaco" onclick="openRatingModal('Breaking Bad', '<?php echo $sinopses['Breaking Bad']; ?>')">
    <p class="image-text" onclick="openRatingModal('Breaking Bad', '<?php echo $sinopses['Breaking Bad']; ?>')">Breaking Bad</p>
</div>
<div class="image-container" id="round6Container">
    <img class="title" src="..\assets\round6.png" alt="macaco" onclick="openRatingModal('Round 6', '<?php echo $sinopses['Round 6']; ?>')">
    <p class="image-text" onclick="openRatingModal('Round 6', '<?php echo $sinopses['Round 6']; ?>')">Round 6</p>
</div>
<?php endif; ?>

<div id="ratingModal" class="popup" style="display: none;">
    <span class="close-button" onclick="closeRatingModal()">&#10006;</span>
    <h3 class="rating-text">Informações da Série</h3>
    <p id="selectedSeries"></p>
    <p id="sinopse"></p>
    <form id="rating-form" method="post" action="cu.php" onsubmit="submitRating(event)">
    <input type="hidden" id="titulo" name="titulo" value="Nome da Série Predefinido">
    <h3 class="rating-text">Avaliação da Série:</h3>
    <label for="rating">Avalie de 1 a 10:</label>
    <input type="number" id="rating" name="rating" min="1" max="10">
    <br>
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