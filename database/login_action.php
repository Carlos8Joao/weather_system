<?php
session_start();
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Usando prepared statement
$stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['name'] = $row['name'];

        echo "<p class='success'>✅ Login realizado com sucesso! Bem-vindo, ".$_SESSION['name'].".</p>";
        echo "<script>setTimeout(function(){ window.location.href = 'unified_list.php'; }, 2000);</script>";
    } else {
        echo "<p class='error'>❌ Senha incorreta!</p>";
        echo "<p><a href='login.php'>🔙 Voltar ao Login</a></p>";
    }
} else {
    echo "<p class='error'>⚠️ Utilizador não encontrado!</p>";
    echo "<p><a href='login.php'>🔙 Voltar ao Login</a></p>";
}

$stmt->close();
$conn->close();
?>
