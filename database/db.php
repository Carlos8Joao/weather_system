<?php
$host = "127.0.0.1";   // servidor local (Laragon)
$user = "root";        // utilizador padrão
$password = "";        // sem senha por padrão
$database = "weather_system"; // nome da base criada

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

echo "Conexão bem-sucedida!";
?>
