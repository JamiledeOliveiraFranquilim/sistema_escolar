<?php
require '../conexao.php';
require 'includes/aluno_layout.php';
aluno_guard();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Aluno</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php render_aluno_sidebar('home.php'); ?>
    <div>
        <h1>Área do Aluno</h1>
    </div>
</body>
</html>