<?php
include 'db.php';

$sql = "SELECT id, name, email, password FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Lista de Utilizadores</title>
  <style>
    table {
      border-collapse: collapse;
      width: 70%;
      margin: 20px auto;
      font-family: Arial, sans-serif;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: center;
    }
    th {
      background-color: #f2f2f2;
    }
    tr:nth-child(even) {
      background-color: #fafafa;
    }
    h2 {
      text-align: center;
      font-family: Arial, sans-serif;
    }
  </style>
</head>
<body>
  <h2>Utilizadores Cadastrados</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Email</th>
      <th>Senha</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["name"]."</td>
                    <td>".$row["email"]."</td>
                    <td>".$row["password"]."</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Nenhum utilizador encontrado</td></tr>";
    }
    $conn->close();
    ?>
  </table>
</body>
</html>
