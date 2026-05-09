<?php
include 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Usando prepared statement
$stmt = $conn->prepare("INSERT INTO users (name, email, password, created_at) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
    echo "<p class='success'>✅ Utilizador registrado com sucesso!</p>";
    echo "<p><a href='login.php'>🔑 Fazer Login</a></p>";
} else {
    echo "<p class='error'>❌ Erro: " . $stmt->error . "</p>";
}

$stmt->close();
$conn->close();
?>

