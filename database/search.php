<?php
session_start(); // inicia sessão para usar o utilizador logado
include 'db.php';

// Verifica se o utilizador está logado
if (!isset($_SESSION['user_id'])) {
    die("Precisas de fazer login primeiro!");
}

$user_id = $_SESSION['user_id']; // pega o ID do utilizador logado
$city = $_POST['search_term'];   // valor do formulário

// Insere na tabela search_history
$sql = "INSERT INTO search_history (user_id, city, search_date)
        VALUES ('$user_id', '$city', NOW())";

if ($conn->query($sql) === TRUE) {
    echo "Pesquisa registrada com sucesso!";
} else {
    echo "Erro: " . $conn->error;
}

$conn->close();
?>
