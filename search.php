<?php

session_start();
include 'connect.php';

if (isset($_GET['search'])) {
    $searchTerm = '%' . $_GET['search'] . '%';
    
    echo "Search Term: $searchTerm"; 
    
    $query = "SELECT * FROM series WHERE titulo LIKE :searchTerm";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    
    exit();
}

?>

