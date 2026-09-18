<?php
require '../conexao.php';
if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] != 'professor') { header("Location: ../index.php"); exit; }
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO eventos (titulo, data, hora, local, descricao, publico_alvo) VALUES (?,?,?,?,?, 'aluno')");
    $stmt->bind_param("sssss", $_POST['titulo'], $_POST['data'], $_POST['hora'], $_POST['local'], $_POST['descricao']); $stmt->execute();
}
?>
<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><title>Calendário</title><style>body{font-family:Arial;padding:20px}</style></head>
<body><h2>Calendário da Turma</h2><a href="homeprof.php">Voltar</a>
<form method="POST" style="margin:20px 0;border:1px solid #ccc;padding:15px;"><h3>Novo Evento/Atividade</h3>
<input type="text" name="titulo" placeholder="Título" required><input type="date" name="data" required><input type="time" name="hora"><input type="text" name="local" placeholder="Local">
<textarea name="descricao" placeholder="Descrição"></textarea><button type="submit">Adicionar</button></form>
<h3>Eventos Agendados</h3>
<?php $res=$conn->query("SELECT * FROM eventos WHERE publico_alvo='aluno' ORDER BY data"); while($r=$res->fetch_assoc()) echo "<p><b>{$r['data']} - {$r['titulo']}</b><br>{$r['descricao']}</p>"; ?>
</body></html>