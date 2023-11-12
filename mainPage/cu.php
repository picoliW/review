<?php
session_start();
include '../connect.php';
$titulo = $_POST['titulo'];
$rating = $_POST['rating'];
$episodes_watched = $_POST['episodes_watched'];
$usuario_id = $_SESSION['user_id'];

$query = "INSERT INTO series (titulo, rating, episodes_watched, userid) VALUES (:titulo, :rating, :episodes_watched, :userid)";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':titulo', $titulo);
$stmt->bindParam(':rating', $rating);
$stmt->bindParam(':episodes_watched', $episodes_watched);
$stmt->bindParam(':userid', $usuario_id);

if ($stmt->execute()) {
    echo "Dados inseridos com sucesso!";
} else {
    echo "Erro ao inserir dados: " . $stmt->errorInfo();
}

$sinopses = array(
    'Shrek' => 'Uma animação incrível sobre um ogro verde e suas aventuras inusitadas.',
    'Breaking Bad' => 'A história de um professor de química que se transforma em um poderoso traficante de drogas.',
    'Round 6' => 'Participantes de um jogo misterioso lutam pela sobrevivência em busca de um grande prêmio.'
);
?>

