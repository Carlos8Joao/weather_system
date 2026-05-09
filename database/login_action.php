<?php
session_start();
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        
        
        echo "<!DOCTYPE html>
        <html lang='pt'>
        <head>
          <meta charset='UTF-8'>
          <title>Login bem-sucedido</title>
          <style>
            .success { color: green; font-weight: bold; margin-top: 20px; }
          </style>
        </head>
        <body>
          <p class='success'>✅ Login realizado com sucesso! Bem-vindo, ".$_SESSION['name'].".</p>
          <p>Serás redirecionado em 2 segundos...</p>
          <script>
            setTimeout(function(){ window.location.href = 'unified_list.php'; }, 2000);
          </script>
        </body>
        </html>";
        exit;
    } else {
        $error = "❌ Senha incorreta!";
    }
} else {
    $error = "⚠️ Utilizador não encontrado!";
}

$conn->close();
?>
