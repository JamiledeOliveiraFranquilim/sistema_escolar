<?php
require 'conexao.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email']; $senha = $_POST['senha'];
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
    $stmt->bind_param("ss", $email, $senha); $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id']; $_SESSION['nome'] = $user['nome']; $_SESSION['tipo'] = $user['tipo'];
        if ($user['tipo'] == 'admin') header("Location: admin/homeadmin.php");
        elseif ($user['tipo'] == 'professor') header("Location: professor/homeprof.php");
        else header("Location: aluno/home.php");
        exit;
    } else { $erro = "Email ou senha incorretos!"; }
}
?>
<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><title>CEON - Login</title>
<link rel="stylesheet" href="css/style.css"></head>
<body class="login-page">
<div class="login-box">
    <h2>CEON</h2>
    <p class="subtitle">Plataforma Escolar - Escola CESI</p>
    <?php if(isset($erro)) echo "<div class='msg-erro'>$erro</div>"; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>
    <p class="hint">Admin: admin@cesi.com / admin123</p>
</div>
</body></html>