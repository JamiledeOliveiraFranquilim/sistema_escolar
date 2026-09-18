<?php
require '../conexao.php';
require 'includes/professor_layout.php';
professor_guard();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO comunicados (titulo, mensagem, publico_alvo, id_autor) VALUES (?,?, 'aluno', ?)");
    $stmt->bind_param('ssi', $_POST['titulo'], $_POST['mensagem'], $_SESSION['user_id']);
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
    <?php render_professor_sidebar('comunicacao_aluno.php'); ?>
    <div>
        <h2>Comunicados para Alunos</h2>
        <a href="homeprof.php">Voltar</a>
        <form method="POST">
            <input type="text" name="titulo" placeholder="Título" required><br><br>
            <textarea name="mensagem" placeholder="Mensagem" required></textarea><br><br>
            <button type="submit">Enviar Comunicado</button>
        </form>
        <h3>Meus Comunicados</h3>
        <?php
        $res = $conn->query("SELECT * FROM comunicados WHERE id_autor={$_SESSION['user_id']} ORDER BY id DESC");
        while ($r = $res->fetch_assoc()) {
            echo "<div><b>{$r['titulo']}</b><br>{$r['mensagem']}</div>";
        }
        ?>
    </div>
</body>
</html>