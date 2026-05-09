<?php
include 'db.php';


$sql = "SELECT id, user_id, city, search_date FROM search_history ORDER BY search_date DESC";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Histórico de Pesquisas</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav>
  <a href="unified_list.php">📋 Histórico</a> |
  <a href="reports_form.php">📝 Relatórios</a> |
  <a href="search_form.php">🔍 Pesquisas</a> |
  <a href="logout.php">🚪 Logout</a>
</nav>

  <h2>Histórico de Pesquisas</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>User ID</th>
      <th>Cidade</th>
      <th>Data da Pesquisa</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["user_id"]."</td>
                    <td>".$row["city"]."</td>
                    <td>".$row["search_date"]."</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Nenhuma pesquisa encontrada</td></tr>";
    }
    $conn->close();
    ?>
  </table>
</body>
</html>

