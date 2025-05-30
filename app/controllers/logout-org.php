<?php
session_start();

// Destruir todas as variáveis de sessão relacionadas à organização
unset($_SESSION['org_id']);
unset($_SESSION['org_nome']);
unset($_SESSION['org_email']);

// Se não há mais nada na sessão, destruir completamente
if (empty($_SESSION)) {
    session_destroy();
}

// Redirecionar para a página de login
header('Location: ../views/login.php');
exit();
?>
