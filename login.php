<?php
session_start();
require 'database.php';

if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $db->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit();
    } else {
        $error = 'Usuário ou senha inválidos!';
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <form action="login.php" method="post">
        <label for="username">Usuário:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <p>Não tem uma conta? <a href="register.php">Registre-se aqui</a></p>
</body>
</html>