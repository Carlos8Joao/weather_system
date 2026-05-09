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
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
    }
    h2 {
      text-align: center;
      margin-top: 20px;
    }
    table {
      border-collapse: collapse;
      width: 80%;
      margin: 20px auto;
      background-color: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    th, td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: center;
    }
    th {
      background-color: #4CAF50;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
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

