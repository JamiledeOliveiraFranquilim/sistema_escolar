<?php require '../conexao.php'; if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] != 'aluno') { header("Location: ../index.php"); exit; } ?>
<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><title>Calendário</title><style>body{font-family:Arial;padding:20px}table{width:100%;border-collapse:collapse}th,td{border:1px solid #ddd;padding:8px}</style></head>
<body><h2>Meu Calendário</h2><a href="home.php">Voltar</a>
<table><tr><th>Data</th><th>Título</th><th>Local</th><th>Descrição</th></tr>
<?php $res=$conn->query("SELECT * FROM eventos WHERE publico_alvo IN ('aluno','geral') ORDER BY data"); while($r=$res->fetch_assoc()) echo "<tr><td>{$r['data']}</td><td>{$r['titulo']}</td><td>{$r['local']}</td><td>{$r['descricao']}</td></tr>"; ?>
</table></body></html>