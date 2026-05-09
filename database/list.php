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
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
  <a href="unified_list.php">📋 Histórico</a> |
  <a href="reports_form.php">📝 Relatórios</a> |
  <a href="search_form.php">🔍 Pesquisas</a> |
  <a href="logout.php">🚪 Logout</a>
</nav>

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
