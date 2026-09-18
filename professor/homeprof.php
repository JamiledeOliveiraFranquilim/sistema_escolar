<?php
require '../conexao.php';
require 'includes/professor_layout.php';
professor_guard();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Professor</title>
</head>
<body>
    <?php render_professor_sidebar('homeprof.php'); ?>
    <div>
        <h1>Área do Professor</h1>
    </div>
</body>
</html>