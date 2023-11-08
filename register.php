<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newUsername = $_POST['newUsername'];
    $newPassword = $_POST['newPassword'];

    $hashedPassword = hash('sha256', $newPassword);

    $stmt = $pdo->prepare("INSERT INTO usuario (usuario, senha) VALUES (?, ?)");
    $stmt->execute([$newUsername, $hashedPassword]);

    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro no processamento do formulário de cadastro.";
}
?>
