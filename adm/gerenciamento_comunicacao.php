<?php
require '../conexao.php';
require 'includes/admin_layout.php';
admin_guard();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare('INSERT INTO comunicados (titulo, mensagem, publico_alvo, id_autor) VALUES (?,?,?,?)');
    $stmt->bind_param('sssi', $_POST['titulo'], $_POST['mensagem'], $_POST['publico'], $_SESSION['user_id']);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Comunicados</title>
</head>
<body>
    <?php render_admin_sidebar('gerenciamento_comunicacao.php'); ?>
    <div>
        <h2>Gerenciar Comunicados</h2>
        <a href="homeadm.php">Voltar</a>
        <form method="POST">
            <h3>Novo Comunicado</h3>
            <input type="text" name="titulo" placeholder="Título" required><br><br>
            <textarea name="mensagem" placeholder="Mensagem" required></textarea><br><br>
            <select name="publico">
                <option value="geral">Geral</option>
                <option value="aluno">Alunos</option>
                <option value="professor">Professores</option>
            </select>
            <button type="submit">Enviar</button>
        </form>
        <h3>Enviados</h3>
        <?php
        $res = $conn->query('SELECT * FROM comunicados ORDER BY data_publicacao DESC');
        while ($r = $res->fetch_assoc()) {
            echo "<div><b>{$r['titulo']}</b> ({$r['publico_alvo']})<br>{$r['mensagem']}</div>";
        }
        ?>
    </div>
</body>
</html>