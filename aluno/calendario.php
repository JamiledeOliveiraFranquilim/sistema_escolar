<?php
require '../conexao.php';
require 'includes/aluno_layout.php';
aluno_guard();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Calendário</title>
</head>
<body>
    <?php render_aluno_sidebar('calendario.php'); ?>
    <div>
        <h2>Meu Calendário</h2>
        <a href="home.php">Voltar</a>
        <table>
            <tr>
                <th>Data</th>
                <th>Título</th>
                <th>Local</th>
                <th>Descrição</th>
            </tr>
            <?php
            $res = $conn->query("SELECT * FROM eventos WHERE publico_alvo IN ('aluno','geral') ORDER BY data");
            while ($r = $res->fetch_assoc()) {
                echo "<tr><td>{$r['data']}</td><td>{$r['titulo']}</td><td>{$r['local']}</td><td>{$r['descricao']}</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>