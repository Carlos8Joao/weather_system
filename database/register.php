<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Registo de Utilizador</title>
  <link rel="stylesheet" href="style.css">

</head>
<body>
    <nav>
  <a href="unified_list.php">📋 Histórico</a> |
  <a href="reports_form.php">📝 Relatórios</a> |
  <a href="search_form.php">🔍 Pesquisas</a> |
  <a href="logout.php">🚪 Logout</a>
</nav>

  <h2>Registrar Novo Utilizador</h2>
  <form action="register_action.php" method="post">
    Nome: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Senha: <input type="password" name="password" required><br><br>
    <input type="submit" value="Registrar">
  </form>
</body>
</html>
