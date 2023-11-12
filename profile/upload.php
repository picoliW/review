<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetDirectory = "profile/profileImages";
    $targetFile = $targetDirectory . basename($_FILES["profileImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }

    $check = getimagesize($_FILES["profileImage"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    if (file_exists($targetFile)) {
        $uploadOk = 0;
    }

    if ($_FILES["profileImage"]["size"] > 1000000) {
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Desculpe, sua imagem não foi enviada.";
    } else {
        if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $targetFile)) {
            echo "A imagem " . basename($_FILES["profileImage"]["name"]) . " foi enviada com sucesso.";

            $usuario_id = $_SESSION['user_id'];

            $perfilImagem = "profile/profileImages/" . basename($_FILES["profileImage"]["name"]);
            $stmt = $pdo->prepare("UPDATE usuario SET perfil_imagem = ? WHERE id = ?");
            $stmt->execute([$perfilImagem, $usuario_id]);
            
            $_SESSION['perfil_imagem'] = $perfilImagem;    
        } else {
            echo "Desculpe, ocorreu um erro ao enviar sua imagem.";
        }
    }
}
?>
