<?php require '../conexao.php'; if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] != 'aluno') { header("Location: ../index.php"); exit; } ?>
<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><title>Materiais</title><style>body{font-family:Arial;padding:20px}</style></head>
<body><h2>Materiais de Apoio</h2><a href="home.php">Voltar</a>
<?php
$sql = "SELECT m.*, u.nome as prof FROM materiais m JOIN usuarios u ON m.id_professor=u.id WHERE m.id_turma = (SELECT id_turma FROM usuarios WHERE id={$_SESSION['user_id']})";
$res=$conn->query($sql);
if ($res->num_rows == 0) echo "<p>Nenhum material disponível.</p>";
while($r=$res->fetch_assoc()) echo "<div style='border-bottom:1px solid #eee;padding:10px 0;'><b>{$r['titulo']}</b> (Prof. {$r['prof']}) - <a href='{$r['arquivo']}' download>Baixar Arquivo</a></div>"; ?>
</body></html>