<?php
session_start();
include 'db.php';

// Verifica se o utilizador está logado
if (!isset($_SESSION['user_id'])) {
    die("Precisas de fazer login primeiro!");
}

$user_id = $_SESSION['user_id']; // pega o ID do utilizador logado
$city = $_POST['search_term'];   // valor do formulário

// Usando prepared statement para evitar SQL Injection
$stmt = $conn->prepare("INSERT INTO search_history (user_id, city, search_date) VALUES (?, ?, NOW())");
$stmt->bind_param("is", $user_id, $city);

if ($stmt->execute()) {
    echo "✅ Pesquisa registrada com sucesso!";
} else {
    echo "❌ Erro: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

