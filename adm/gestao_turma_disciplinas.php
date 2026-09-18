<?php
require '../conexao.php';
require 'includes/admin_layout.php';
admin_guard();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['criar_turma'])) {
        $conn->query("INSERT INTO turmas (nome_turma, ano_letivo) VALUES ('{$_POST['nome_turma']}', '{$_POST['ano_letivo']}')");
    }

    if (isset($_POST['criar_disc'])) {
        $conn->query("INSERT INTO disciplinas (nome_disciplina, id_professor, id_turma) VALUES ('{$_POST['nome_disc']}', '{$_POST['id_prof']}', '{$_POST['id_turma_disc']}')");
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Turmas e Disciplinas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php render_admin_sidebar('gestao_turma_disciplinas.php'); ?>
    <div>
        <h2>Gestão de Turmas e Disciplinas</h2>
        <a href="homeadm.php">Voltar</a>
        <div>
            <h3>Nova Turma</h3>
            <form method="POST">
                <input type="text" name="nome_turma" placeholder="Nome da Turma" required>
                <input type="number" name="ano_letivo" placeholder="Ano Letivo" required>
                <button type="submit" name="criar_turma">Criar</button>
            </form>
        </div>
        <div>
            <h3>Nova Disciplina</h3>
            <form method="POST">
                <input type="text" name="nome_disc" placeholder="Nome da Disciplina" required>
                <select name="id_prof" required>
                    <option value="">Professor</option>
                    <?php
                    $p = $conn->query("SELECT id,nome FROM usuarios WHERE tipo='professor'");
                    while ($r = $p->fetch_assoc()) {
                        echo "<option value='{$r['id']}'>{$r['nome']}</option>";
                    }
                    ?>
                </select>
                <select name="id_turma_disc" required>
                    <option value="">Turma</option>
                    <?php
                    $t = $conn->query("SELECT id,nome_turma FROM turmas");
                    while ($r = $t->fetch_assoc()) {
                        echo "<option value='{$r['id']}'>{$r['nome_turma']}</option>";
                    }
                    ?>
                </select>
                <button type="submit" name="criar_disc">Criar</button>
            </form>
        </div>
        <h3>Turmas</h3>
        <?php
        $res = $conn->query('SELECT * FROM turmas');
        while ($r = $res->fetch_assoc()) {
            echo "<li>{$r['nome_turma']} ({$r['ano_letivo']})</li>";
        }
        ?>
    </div>
</body>
</html>