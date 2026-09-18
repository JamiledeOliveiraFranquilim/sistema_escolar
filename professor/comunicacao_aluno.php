<?php
require '../conexao.php';
if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] != 'professor') { header("Location: ../index.php"); exit; }
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO comunicados (titulo, mensagem, publico_alvo, id_autor) VALUES (?,?, 'aluno', ?)");
    $stmt->bind_param("ssi", $_POST['titulo'], $_POST['mensagem'], $_SESSION['user_id']); $stmt->execute();
}
?>
<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><title>Comunicados</title><style>body{font-family:Arial;padding:20px}</style></head>
<body><h2>Comunicados para Alunos</h2><a href="homeprof.php">Voltar</a>
<form method="POST" style="margin:20px 0;border:1px solid #ccc;padding:15px;">
<input type="text" name="titulo" placeholder="Título" required><br><br>
<textarea name="mensagem" placeholder="Mensagem" required style="width:100%;height:100px;"></textarea><br><br>
<button type="submit">Enviar Comunicado</button></form>
<h3>Meus Comunicados</h3>
<?php $res=$conn->query("SELECT * FROM comunicados WHERE id_autor={$_SESSION['user_id']} ORDER BY id DESC"); while($r=$res->fetch_assoc()) echo "<div style='border:1px solid #ddd;padding:10px;margin:5px 0;'><b>{$r['titulo']}</b><br>{$r['mensagem']}</div>"; ?>
</body></html>