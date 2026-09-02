<?php
/**
 * logout.php
 * Encerra a sessão do usuário e redireciona para a tela de login.
 */

session_start();     // Precisa iniciar a sessão antes de poder destruí-la
session_unset();     // Remove todas as variáveis da sessão
session_destroy();   // Destrói a sessão por completo

// Redireciona de volta para o login
header("Location: index.php");
exit();
?>
