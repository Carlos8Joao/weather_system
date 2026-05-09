<?php
include 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Novo utilizador inserido com sucesso!";
} else {
    if ($conn->errno == 1062) { // erro de duplicado
        echo "Este email já está cadastrado. Escolhe outro.";
    } else {
        echo "Erro: " . $conn->error;
    }
}

$conn->close();
?>


