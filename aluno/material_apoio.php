<?php
require '../conexao.php';
require 'includes/aluno_layout.php';
aluno_guard();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Materiais</title>
</head>
<body>
    <?php render_aluno_sidebar('material_apoio.php'); ?>
    <div>
        <h2>Materiais de Apoio</h2>
        <a href="home.php">Voltar</a>
        <?php
        $sql = "SELECT m.*, u.nome as prof FROM materiais m JOIN usuarios u ON m.id_professor=u.id WHERE m.id_turma = (SELECT id_turma FROM usuarios WHERE id={$_SESSION['user_id']})";
        $res = $conn->query($sql);
        if ($res->num_rows == 0) {
            echo '<p>Nenhum material disponível.</p>';
        }

        while ($r = $res->fetch_assoc()) {
            echo "<div><b>{$r['titulo']}</b> (Prof. {$r['prof']}) - <a href='{$r['arquivo']}' download>Baixar Arquivo</a></div>";
        }
        ?>
    </div>
</body>
</html>