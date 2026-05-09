<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Adicionar Relatório Meteorológico</title>
  <link rel="stylesheet" href="style.css">

</head>
<body>
  <nav>
  <a href="unified_list.php">📋 Histórico</a> |
  <a href="reports_form.php">📝 Relatórios</a> |
  <a href="search_form.php">🔍 Pesquisas</a> |
  <a href="logout.php">🚪 Logout</a>
</nav>

  <h2>Novo Relatório Meteorológico</h2>
  <form action="reports.php" method="post">
    Cidade: <input type="text" name="city" required><br><br>
    Relatório: <textarea name="report_text" rows="5" cols="40" required></textarea><br><br>
    <input type="submit" value="Salvar Relatório">
  </form>
</body>
<?php include 'nav.php'; ?>

</html>
 