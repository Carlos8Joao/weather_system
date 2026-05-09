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
        echo "Login realizado com sucesso!";
        header("Location: unified_list.php");
    } else {
        echo "Senha incorreta!";
    }
} else {
    echo "Utilizador não encontrado!";
}

$conn->close();
?>
