<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">

</head>
<body>
  <nav>
  <a href="unified_list.php">📋 Histórico</a> |
  <a href="reports_form.php">📝 Relatórios</a> |
  <a href="search_form.php">🔍 Pesquisas</a> |
  <a href="logout.php">🚪 Logout</a>
</nav>

  <div class="container">
    <h2>Login</h2>
    <form action="login_action.php" method="post">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Senha" required>
      <input type="submit" value="Entrar">
    </form>
  </div>
</body>
