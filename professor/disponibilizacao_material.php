<?php
require '../conexao.php';
require 'includes/professor_layout.php';
professor_guard();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['arquivo'])) {
    $pasta = '../uploads/';
    if (!is_dir($pasta)) {
        mkdir($pasta, 0777, true);
    }

    $arquivo = basename($_FILES['arquivo']['name']);
    $caminho = $pasta . time() . '_' . $arquivo;

    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho)) {
        $stmt = $conn->prepare('INSERT INTO materiais (titulo, arquivo, id_professor, id_turma) VALUES (?,?,?,?)');
        $stmt->bind_param('ssii', $_POST['titulo'], $caminho, $_SESSION['user_id'], $_POST['id_turma']);
        $stmt->execute();
        $msg = 'Material enviado!';
    } else {
        $erro = 'Erro no upload.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Materiais</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php render_professor_sidebar('disponibilizacao_material.php'); ?>
    <div>
        <h2>Disponibilizar Material</h2>
        <a href="homeprof.php">Voltar</a>
        <?php if (isset($msg)) echo '<p>' . $msg . '</p>'; if (isset($erro)) echo '<p>' . $erro . '</p>'; ?>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="titulo" placeholder="Título do Material" required><br><br>
            <select name="id_turma" required>
                <option value="">Selecione a Turma</option>
                <?php
                $t = $conn->query('SELECT * FROM turmas');
                while ($r = $t->fetch_assoc()) {
                    echo "<option value='{$r['id']}'>{$r['nome_turma']}</option>";
                }
                ?>
            </select><br><br>
            <input type="file" name="arquivo" required><br><br>
            <button type="submit">Enviar Material</button>
        </form>
        <h3>Materiais Enviados</h3>
        <?php
        $res = $conn->query("SELECT m.*, t.nome_turma FROM materiais m JOIN turmas t ON m.id_turma=t.id WHERE m.id_professor={$_SESSION['user_id']}");
        while ($r = $res->fetch_assoc()) {
            echo "<p><b>{$r['titulo']}</b> - Turma: {$r['nome_turma']} - <a href='{$r['arquivo']}' download>Baixar</a></p>";
        }
        ?>
    </div>
</body>
</html>