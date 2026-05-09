<?php
session_start(); // inicia sessão
include 'db.php';

// Verifica se o utilizador está logado
if (!isset($_SESSION['user_id'])) {
    die("Precisas de fazer login primeiro!");
}

$user_id = $_SESSION['user_id']; // pega o ID do utilizador logado
$city = $_POST['city'];
$report_text = $_POST['report_text'];

// Insere na tabela reports
$sql = "INSERT INTO reports (user_id, city, report_text, report_date)
        VALUES ('$user_id', '$city', '$report_text', NOW())";

if ($conn->query($sql) === TRUE) {
    echo "Relatório registrado com sucesso!";
} else {
    echo "Erro: " . $conn->error;
}

$conn->close();
?>
