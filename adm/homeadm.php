<?php
require '../conexao.php';
require 'includes/admin_layout.php';
admin_guard();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Admin - CEON</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php render_admin_sidebar('homeadm.php'); ?>
    <div>
        <h1>Painel de Administração</h1>
        <p>Gerencie a plataforma CEON.</p>
    </div>
</body>
</html>