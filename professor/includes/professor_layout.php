<?php
function professor_guard()
{
    if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] !== 'professor') {
        header('Location: ../index.php');
        exit;
    }
}

function render_professor_sidebar($currentPage = null)
{
    $currentPage = $currentPage ?: basename($_SERVER['PHP_SELF']);
    $links = [
        'homeprof.php' => 'Início',
        'calendario.php' => 'Calendário da Turma',
        'comunicacao_aluno.php' => 'Comunicados',
        'disponibilizacao_material.php' => 'Materiais',
    ];

    echo '<div>';
    echo '<h2>CEON Prof</h2>';
    echo '<p>Olá, ' . htmlspecialchars($_SESSION['nome'], ENT_QUOTES, 'UTF-8') . '</p>';

    foreach ($links as $file => $label) {
        $activeText = $currentPage === $file ? ' (Ativo)' : '';
        echo '<a href="' . $file . '">' . $label . $activeText . '</a><br>';
    }

    echo '<a href="../logout.php">Sair</a>';
    echo '</div>';
}
?>
