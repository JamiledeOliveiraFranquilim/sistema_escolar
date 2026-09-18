<?php
require '../conexao.php';
require 'includes/aluno_layout.php';
aluno_guard();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mural</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php render_aluno_sidebar('mural_avisos.php'); ?>
    <div>
        <h2>Mural de Avisos</h2>
        <a href="home.php">Voltar</a>
        <?php
        $res = $conn->query("SELECT c.*, u.nome FROM comunicados c LEFT JOIN usuarios u ON c.id_autor=u.id WHERE c.publico_alvo IN ('aluno','geral') ORDER BY c.id DESC");
        while ($r = $res->fetch_assoc()) {
            echo "<div><h3>{$r['titulo']}</h3><p>{$r['mensagem']}</p><small>Por: {$r['nome']} em {$r['data_publicacao']}</small></div>";
        }
        ?>
    </div>
</body>
</html>