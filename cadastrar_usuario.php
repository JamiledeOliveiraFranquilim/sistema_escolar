<?php
$pdo = new PDO(
    "mysql:host=localhost;dbname=sistema_escolar;charset=utf8",
    "root",
    ""
);

session_start();
if (isset($_POST["cadastrar"])) {
    $nome = $_POST["nome"];
    $senha = $_POST["senha"];
    $email = $_POST["email"];

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    $stmt->execute([$nome, $email, $senha_hash]);

    $usuario = $stmt->fetch();

    header("Location: index.php");
        exit;

    } else {
        $erro = "Já existe um usuário com este e-mail!";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Cadastro</h1>
    <form method="POST" action="processar_cadastro.php">
        <label>Nome:</label>
        <input type="text" name="nome" required>
        <br><br>
        <label>E-mail:</label>
        <input type="email" name="email" required>
        <br><br>
        <label>Senha:</label>
        <input type="password" name="senha" required>
        <br><br>
        <button type="button" onclick="window.location.href='login.php'">Cadastrar</button>
    </form>
</body>
</html>