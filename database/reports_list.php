<?php
include 'db.php';

$sql = "SELECT id, user_id, city, report_text, report_date 
        FROM reports 
        ORDER BY report_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Relatórios Meteorológicos</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    h2 { color: #333; }
    table { width: 90%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
    th { background-color: #4CAF50; color: white; }
    tr:nth-child(even) { background-color: #f9f9f9; }
  </style>
</head>
<body>
  <h2>📋 Relatórios Meteorológicos</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>User ID</th>
      <th>Cidade</th>
      <th>Relatório</th>
      <th>Data</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["user_id"]."</td>
                    <td>".$row["city"]."</td>
                    <td>".$row["report_text"]."</td>
                    <td>".$row["report_date"]."</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Nenhum relatório encontrado</td></tr>";
    }
    ?>
  </table>
</body>
</html>
