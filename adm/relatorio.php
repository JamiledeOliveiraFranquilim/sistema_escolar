<?php
require '../conexao.php';
require 'includes/admin_layout.php';
admin_guard();

$alunos = $conn->query("SELECT COUNT(*) as t FROM usuarios WHERE tipo='aluno'")->fetch_assoc()['t'];
$profs = $conn->query("SELECT COUNT(*) as t FROM usuarios WHERE tipo='professor'")->fetch_assoc()['t'];
$eventos = $conn->query("SELECT COUNT(*) as t FROM eventos")->fetch_assoc()['t'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatórios</title>
</head>
<body>
    <?php render_admin_sidebar('relatorio.php'); ?>
    <div>
        <h2>Dashboard de Relatórios</h2>
        <a href="homeadm.php">Voltar</a>
        <div>
            <div>
                <h3>Alunos</h3>
                <h1><?php echo $alunos; ?></h1>
            </div>
            <div>
                <h3>Professores</h3>
                <h1><?php echo $profs; ?></h1>
            </div>
            <div>
                <h3>Eventos</h3>
                <h1><?php echo $eventos; ?></h1>
            </div>
        </div>
    </div>
</body>
</html>