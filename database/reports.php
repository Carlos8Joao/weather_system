<?php
session_start();
include 'db.php';

// Verifica se o utilizador está logado
if (!isset($_SESSION['user_id'])) {
    die("Precisas de fazer login primeiro!");
}

$user_id = $_SESSION['user_id']; // pega o ID do utilizador logado
$city = $_POST['city'];
$report_text = $_POST['report_text'];

// Usando prepared statement para evitar SQL Injection
$stmt = $conn->prepare("INSERT INTO reports (user_id, city, report_text, report_date) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("iss", $user_id, $city, $report_text);

if ($stmt->execute()) {
    echo "✅ Relatório registrado com sucesso!";
} else {
    echo "❌ Erro: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

