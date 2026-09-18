<?php
require '../conexao.php';
require 'includes/professor_layout.php';
professor_guard();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO eventos (titulo, data, hora, local, descricao, publico_alvo) VALUES (?,?,?,?,?, 'aluno')");
    $stmt->bind_param('sssss', $_POST['titulo'], $_POST['data'], $_POST['hora'], $_POST['local'], $_POST['descricao']);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Calendário</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php render_professor_sidebar('calendario.php'); ?>
    <div>
        <h2>Calendário da Turma</h2>
        <a href="homeprof.php">Voltar</a>
        <form method="POST">
            <h3>Novo Evento/Atividade</h3>
            <input type="text" name="titulo" placeholder="Título" required>
            <input type="date" name="data" required>
            <input type="time" name="hora">
            <input type="text" name="local" placeholder="Local">
            <textarea name="descricao" placeholder="Descrição"></textarea>
            <button type="submit">Adicionar</button>
        </form>
        <h3>Eventos Agendados</h3>
        <?php
        $res = $conn->query("SELECT * FROM eventos WHERE publico_alvo='aluno' ORDER BY data");
        while ($r = $res->fetch_assoc()) {
            echo "<p><b>{$r['data']} - {$r['titulo']}</b><br>{$r['descricao']}</p>";
        }
        ?>
    </div>
</body>
</html>