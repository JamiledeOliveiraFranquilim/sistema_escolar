<?php
require '../conexao.php';
require 'includes/admin_layout.php';
admin_guard();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'];

    $sql = 'INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $nome, $email, $senha, $tipo);

    if ($stmt->execute()) {
        $msg = 'Usuário cadastrado com sucesso!';
    } else {
        $erro = 'Erro ao cadastrar: ' . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Usuários</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php render_admin_sidebar('gerenciar_usuario.php'); ?>
    <div>
        <h2>Gerenciar Usuários</h2>
        <a href="homeadm.php">Voltar ao Painel</a>

        <?php if (isset($msg)) echo '<p>' . $msg . '</p>'; ?>
        <?php if (isset($erro)) echo '<p>' . $erro . '</p>'; ?>

        <form method="POST">
            <h3>Novo Usuário</h3>
            <input type="text" name="nome" placeholder="Nome Completo" required><br><br>
            <input type="email" name="email" placeholder="Email" required><br><br>
            <input type="password" name="senha" placeholder="Senha" required><br><br>
            <select name="tipo" required>
                <option value="aluno">Aluno</option>
                <option value="professor">Professor</option>
                <option value="admin">Administrador</option>
            </select><br><br>
            <button type="submit" name="cadastrar">Cadastrar</button>
        </form>

        <h3>Usuários Cadastrados</h3>
        <table>
            <tr><th>ID</th><th>Nome</th><th>Email</th><th>Tipo</th></tr>
            <?php
            $sql = 'SELECT id, nome, email, tipo FROM usuarios';
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['id']}</td><td>{$row['nome']}</td><td>{$row['email']}</td><td>{$row['tipo']}</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>