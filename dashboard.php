<?php
session_start();
require 'database.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$users = $db->query('SELECT username FROM users')->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    <p><a href="logout.php">Sair</a></p>
    <h2>Lista de Inscritos</h2>
    <ul>
        <?php foreach ($users as $user): ?>
        <li><?php echo htmlspecialchars($user['username']); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>