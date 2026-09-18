<?php
require 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nome'] = $user['nome'];
        $_SESSION['tipo'] = $user['tipo'];

        if ($user['tipo'] == 'admin') header("Location: adm/homeadm.php");
        elseif ($user['tipo'] == 'professor') header("Location: professor/homeprof.php");
        else header("Location: aluno/home.php");
        exit;
    } else {
        $erro = "Email ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CEON - Login</title>
</head>
<body>
    <div class="login-box">
        <h2 style="text-align:center;">CEON</h2>
        <?php if(isset($erro)) echo "<p style='color:red; text-align:center;'>$erro</p>"; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>
        <p style="font-size: 12px; text-align: center; color: #666;">Admin: admin@cesi.com / admin123</p>
        <p style="font-size: 12px; text-align: center; color: #666;">professor@cesi.com / prof123</p>
        <p style="font-size: 12px; text-align: center; color: #666;">aluno@cesi.com / aluno123</p>
    </div>
</body>
</html>