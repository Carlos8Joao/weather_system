<?php
include 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (name, email, password, created_at)
        VALUES ('$name', '$email', '$password', NOW())";

if ($conn->query($sql) === TRUE) {
    echo "Utilizador registrado com sucesso!";
} else {
    echo "Erro: " . $conn->error;
}

$conn->close();
?>
