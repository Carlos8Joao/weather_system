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
        header("Location: unified_list.php");
        exit;
    } else {
        $error = "❌ Senha incorreta!";
    }
} else {
    $error = "⚠️ Utilizador não encontrado!";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Erro de Login</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    .error { color: red; font-weight: bold; margin-top: 20px; }
    a { text-decoration: none; color: #4CAF50; }
  </style>
</head>
<body>
  <h2>Erro no Login</h2>
  <p class="error"><?php echo $error; ?></p>
  <p><a href="login.php">🔙 Voltar ao Login</a></p>
</body>
</html>
