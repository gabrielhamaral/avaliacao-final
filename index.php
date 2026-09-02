<?php
/**
 * index.php
 * Página de Login do sistema.
 * Responsável por exibir o formulário e validar as credenciais do usuário.
 */

// Inicia a sessão para podermos guardar os dados do usuário logado
session_start();

// Variável que vai guardar a mensagem de erro (caso exista)
$erro = "";

// Verifica se o formulário foi enviado via método POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recupera os dados enviados pelo formulário
    $email = trim($_POST["email"]);
    $senha = trim($_POST["senha"]);

    // Credenciais fixas (hardcoded), conforme solicitado na atividade
    $email_correto = "admin@sistema.com";
    $senha_correta = "123456";

    // Validação das credenciais
    if ($email === $email_correto && $senha === $senha_correta) {

        // Credenciais corretas: guarda o usuário na sessão
        $_SESSION["usuario"] = $email;

        // Redireciona para o dashboard
        header("Location: dashboard.php");
        exit(); // Sempre usar exit() após um header de redirecionamento

    } else {
        // Credenciais inválidas: define a mensagem de erro
        $erro = "E-mail ou senha inválidos. Tente novamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistema de Tarefas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-body">

    <main class="login-container">
        <h1 class="login-title">Bem-vindo</h1>
        <p class="login-subtitle">Faça login para acessar o sistema</p>

        <?php if (!empty($erro)): ?>
            <div class="mensagem-erro">
                <?php echo htmlspecialchars($erro); ?>
            </div>
        <?php endif; ?>

        <form class="login-form" method="POST" action="index.php">
            <div class="campo-form">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="admin@sistema.com" required>
            </div>

            <div class="campo-form">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
            </div>

            <button type="submit" class="btn-entrar">Entrar</button>
        </form>
    </main>

</body>
</html>
