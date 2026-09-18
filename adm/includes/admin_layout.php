<?php
function admin_guard() {
    if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] !== 'admin') {
        header('Location: ../index.php');
        exit;
    }
}

function render_admin_sidebar($currentPage = null) {
    $currentPage = $currentPage ?: basename($_SERVER['PHP_SELF']);
    $links = [
        'homeadm.php' => 'Início',
        'gerenciar_usuario.php' => 'Gerenciar Usuários',
        'controle_calendario.php' => 'Calendário Escolar',
        'cardapio_semana.php' => 'Cardápio da Semana',
        'gerenciamento_comunicacao.php' => 'Comunicados',
        'gestao_turma_disciplinas.php' => 'Turmas e Disciplinas',
        'relatorio.php' => 'Relatórios',
    ];

    echo '<div class="sidebar">';
    echo '<h2>CEON Admin</h2>';
    echo '<p>Bem-vindo, ' . htmlspecialchars($_SESSION['nome'], ENT_QUOTES, 'UTF-8') . '</p>';

    foreach ($links as $file => $label) {
        $active = $currentPage === $file ? ' style="background:#495057;"' : '';
        echo '<a href="' . $file . '"' . $active . '>' . $label . '</a>';
    }

    echo '<a href="../logout.php">Sair</a>';
    echo '</div>';
}
?>
