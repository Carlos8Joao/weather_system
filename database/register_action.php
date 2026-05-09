<?php
include 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (name, email, password, created_at)
        VALUES ('$name', '$email', '$password', NOW())";

if ($conn->query($sql) === TRUE) {
    echo "<!DOCTYPE html>
    <html lang='pt'>
    <head>
      <meta charset='UTF-8'>
      <title>Registo bem-sucedido</title>
      <style>
        .success { color: green; font-weight: bold; margin-top: 20px; }
      </style>
    </head>
    <body>
      <p class='success'>✅ Utilizador registrado com sucesso!</p>
      <p><a href='login.php'>🔑 Fazer Login</a></p>
    </body>
    </html>";
} else {
    echo "Erro: " . $conn->error;
}

$conn->close();
?>
