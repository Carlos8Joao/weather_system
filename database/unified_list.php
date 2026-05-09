<?php
session_start();
include 'db.php';

// Verifica se o utilizador está logado
if (!isset($_SESSION['user_id'])) {
    die("Precisas de fazer login primeiro!");
}

$user_id = $_SESSION['user_id'];

// Busca histórico de pesquisas do utilizador logado
$sql_search = "SELECT id, city, search_date 
               FROM search_history 
               WHERE user_id = '$user_id'
               ORDER BY search_date DESC";
$result_search = $conn->query($sql_search);

// Busca relatórios do utilizador logado
$sql_reports = "SELECT id, city, report_text, report_date 
                FROM reports 
                WHERE user_id = '$user_id'
                ORDER BY report_date DESC";
$result_reports = $conn->query($sql_reports);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Histórico e Relatórios do Utilizador</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    h2 { color: #333; margin-top: 40px; }
    table { width: 90%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
    th { background-color: #4CAF50; color: white; }
    tr:nth-child(even) { background-color: #f9f9f9; }
  </style>
</head>
<body>
  <h1>🌦️ Sistema Meteorológico</h1>
  <h3>Bem-vindo, <?php echo $_SESSION['name']; ?>!</h3>

  <!-- Histórico de Pesquisas -->
  <h2>📌 Histórico de Pesquisas</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Cidade</th>
      <th>Data da Pesquisa</th>
    </tr>
    <?php
    if ($result_search->num_rows > 0) {
        while($row = $result_search->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["city"]."</td>
                    <td>".$row["search_date"]."</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Nenhuma pesquisa encontrada</td></tr>";
    }
    ?>
  </table>

  <!-- Relatórios Meteorológicos -->
  <h2>📋 Relatórios Meteorológicos</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Cidade</th>
      <th>Relatório</th>
      <th>Data</th>
    </tr>
    <?php
    if ($result_reports->num_rows > 0) {
        while($row = $result_reports->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["city"]."</td>
                    <td>".$row["report_text"]."</td>
                    <td>".$row["report_date"]."</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Nenhum relatório encontrado</td></tr>";
    }
    ?>
  </table>
</body>
</html>
