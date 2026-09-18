<?php require '../conexao.php'; if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] != 'aluno') { header("Location: ../index.php"); exit; } ?>
<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><title>Mural</title><style>body{font-family:Arial;padding:20px}</style></head>
<body><h2>Mural de Avisos</h2><a href="home.php">Voltar</a>
<?php $res=$conn->query("SELECT c.*, u.nome FROM comunicados c LEFT JOIN usuarios u ON c.id_autor=u.id WHERE c.publico_alvo IN ('aluno','geral') ORDER BY c.id DESC");
while($r=$res->fetch_assoc()) echo "<div style='border:1px solid #ccc;padding:15px;margin:10px 0;'><h3>{$r['titulo']}</h3><p>{$r['mensagem']}</p><small>Por: {$r['nome']} em {$r['data_publicacao']}</small></div>"; ?>
</body></html>