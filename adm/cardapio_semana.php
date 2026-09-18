<?php
require '../conexao.php';
require 'includes/admin_layout.php';
admin_guard();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn->query('DELETE FROM cardapio');
    foreach ($_POST['refeicao'] as $dia => $texto) {
        if (!empty($texto)) {
            $conn->query("INSERT INTO cardapio (dia_semana, refeicao) VALUES ('$dia', '$texto')");
        }
    }
}

$cardapio = [];
$res = $conn->query('SELECT * FROM cardapio');
while ($r = $res->fetch_assoc()) {
    $cardapio[$r['dia_semana']] = $r['refeicao'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cardápio</title>
</head>
<body>
    <?php render_admin_sidebar('cardapio_semana.php'); ?>
    <div>
        <h2>Cardápio da Semana</h2>
        <a href="homeadm.php">Voltar</a>
        <form method="POST">
            <?php foreach (['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta'] as $dia): ?>
                <label><b><?php echo $dia; ?>:</b></label><br>
                <textarea name="refeicao[<?php echo $dia; ?>]" style="width:100%;height:60px;"><?php echo $cardapio[$dia] ?? ''; ?></textarea><br><br>
            <?php endforeach; ?>
            <button type="submit">Salvar Cardápio</button>
        </form>
    </div>
</body>
</html>