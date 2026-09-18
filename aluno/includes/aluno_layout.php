<?php
function aluno_guard()
{
    if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] !== 'aluno') {
        header('Location: ../index.php');
        exit;
    }
}

function render_aluno_sidebar($currentPage = null)
{
    $currentPage = $currentPage ?: basename($_SERVER['PHP_SELF']);
    $links = [
        'calendario.php' => 'Meu Calendário',
        'mural_avisos.php' => 'Mural de Avisos',
        'material_apoio.php' => 'Materiais',
    ];

    echo '<div>';
    echo '<h2>CEON Aluno</h2>';
    echo '<p>Olá, ' . htmlspecialchars($_SESSION['nome'], ENT_QUOTES, 'UTF-8') . '</p>';

    foreach ($links as $file => $label) {
        $activeText = $currentPage === $file ? ' (Ativo)' : '';
        echo '<a href="' . $file . '">' . $label . $activeText . '</a><br>';
    }

    echo '<a href="../logout.php">Sair</a>';
    echo '</div>';
}
?>
