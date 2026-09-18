<?php
require '../conexao.php';
require 'includes/admin_layout.php';
admin_guard();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare('INSERT INTO eventos (titulo, data, hora, local, descricao, publico_alvo) VALUES (?,?,?,?,?,?)');
    $stmt->bind_param('ssssss', $_POST['titulo'], $_POST['data'], $_POST['hora'], $_POST['local'], $_POST['descricao'], $_POST['publico']);
    $stmt->execute();
}

if (isset($_GET['excluir'])) {
    $conn->query('DELETE FROM eventos WHERE id=' . intval($_GET['excluir']));
    header('Location: controle_calendario.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Calendário Escolar</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php render_admin_sidebar('controle_calendario.php'); ?>
    <div>
        <h2>Controle de Calendário Escolar</h2>
        <a href="homeadm.php">Voltar</a>
        <form method="POST">
            <h3>Novo Evento</h3>
            <input type="text" name="titulo" placeholder="Título" required>
            <input type="date" name="data" required>
            <input type="time" name="hora">
            <input type="text" name="local" placeholder="Local">
            <textarea name="descricao" placeholder="Descrição"></textarea>
            <select name="publico">
                <option value="geral">Geral</option>
                <option value="aluno">Alunos</option>
                <option value="professor">Professores</option>
            </select>
            <button type="submit">Cadastrar</button>
        </form>
        <table>
            <tr>
                <th>Data</th>
                <th>Título</th>
                <th>Local</th>
                <th>Público</th>
                <th>Ações</th>
            </tr>
            <?php
            $res = $conn->query('SELECT * FROM eventos ORDER BY data');
            while ($r = $res->fetch_assoc()) {
                echo "<tr>
                    <td>{$r['data']}</td>
                    <td>{$r['titulo']}</td>
                    <td>{$r['local']}</td>
                    <td>{$r['publico_alvo']}</td>
                    <td><a href='?excluir={$r['id']}'>Excluir</a></td>
                </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>