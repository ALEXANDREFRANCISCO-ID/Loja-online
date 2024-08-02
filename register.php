<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $stmt = $db->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        $stmt->execute([$username, $password]);
        header('Location: login.php');
        exit();
    } catch (PDOException $e) {
        $error = 'Usuário já existe!';
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Registrar</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Registrar</h1>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <form action="register.php" method="post">
        <label for="username">Usuário:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Registrar">
    </form>
    <p>Já tem uma conta? <a href="login.php">Faça login aqui</a></p>
</body>
</html>