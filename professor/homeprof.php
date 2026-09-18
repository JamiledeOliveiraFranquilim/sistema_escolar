<?php 
require '../conexao.php'; 
if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] != 'professor') { header("Location: ../index.php"); exit; }

$id = $_SESSION['user_id'];
$total_materiais = $conn->query("SELECT COUNT(*) as t FROM materiais WHERE id_professor=$id")->fetch_assoc()['t'];
$total_comunicados = $conn->query("SELECT COUNT(*) as t FROM comunicados WHERE id_autor=$id")->fetch_assoc()['t'];
$total_turmas = $conn->query("SELECT COUNT(DISTINCT id_turma) as t FROM disciplinas WHERE id_professor=$id")->fetch_assoc()['t'];
$total_eventos = $conn->query("SELECT COUNT(*) as t FROM eventos WHERE publico_alvo='aluno'")->fetch_assoc()['t'];

// Minhas turmas/disciplinas
$minhas_turmas = $conn->query("SELECT d.nome_disciplina, t.nome_turma FROM disciplinas d 
    JOIN turmas t ON d.id_turma=t.id WHERE d.id_professor=$id");
// Últimos materiais
$ult_materiais = $conn->query("SELECT m.*, t.nome_turma FROM materiais m 
    JOIN turmas t ON m.id_turma=t.id WHERE m.id_professor=$id ORDER BY m.id DESC LIMIT 3");
?>
<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><title>Professor - CEON</title>
<link rel="stylesheet" href="../css/style.css"></head>
<body>
<div class="sidebar prof">
    <h2>CEON Prof</h2>
    <div class="user-info">Olá,<b><?php echo $_SESSION['nome']; ?></b>Professor</div>
    <a href="homeprof.php" class="active">🏠 Início</a>
    <a href="calendario.php">📅 Calendário da Turma</a>
    <a href="comunicacao_aluno.php">📢 Comunicados</a>
    <a href="disponibilizacao_material.php">📁 Materiais de Apoio</a>
    <a href="../logout.php">🚪 Sair</a>
</div>
<div class="content">
    <h1>Área do Professor</h1>
    
    <div class="stats-grid">
        <div class="stat-card blue"><h3>Minhas Turmas</h3><div class="number"><?php echo $total_turmas; ?></div></div>
        <div class="stat-card green"><h3>Materiais Enviados</h3><div class="number"><?php echo $total_materiais; ?></div></div>
        <div class="stat-card orange"><h3>Comunicados</h3><div class="number"><?php echo $total_comunicados; ?></div></div>
        <div class="stat-card red"><h3>Eventos na Agenda</h3><div class="number"><?php echo $total_eventos; ?></div></div>
    </div>

    <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 25px;">
        <div class="panel">
            <h2>📚 Minhas Disciplinas</h2>
            <?php if ($minhas_turmas->num_rows == 0): ?>
                <p style="color:#888;">Nenhuma disciplina atribuída.</p>
            <?php else: while($d = $minhas_turmas->fetch_assoc()): ?>
                <div class="aviso-item tipo-prof">
                    <h3><?php echo $d['nome_disciplina']; ?></h3>
                    <small>Turma: <?php echo $d['nome_turma']; ?></small>
                </div>
            <?php endwhile; endif; ?>
        </div>
        <div class="panel">
            <h2>📁 Últimos Materiais Enviados</h2>
            <?php if ($ult_materiais->num_rows == 0): ?>
                <p style="color:#888;">Nenhum material enviado.</p>
            <?php else: while($m = $ult_materiais->fetch_assoc()): ?>
                <div class="aviso-item">
                    <h3><?php echo $m['titulo']; ?></h3>
                    <small>Turma: <?php echo $m['nome_turma']; ?> • <?php echo date('d/m/Y', strtotime($m['data_upload'])); ?></small>
                </div>
            <?php endwhile; endif; ?>
        </div>
    </div>
</div>
</body>
</html>