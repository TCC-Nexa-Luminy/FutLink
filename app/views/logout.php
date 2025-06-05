<?php
session_start();

// Capturar tipo de usuário antes de destruir sessão (para log/debug se necessário)
$tipo_usuario = '';
if (isset($_SESSION['tipoLogin'])) {
    $tipo_usuario = $_SESSION['tipoLogin'];
}

// Destruir todas as variáveis de sessão
$_SESSION = array();

// Se desejar destruir a sessão completamente, apague também o cookie de sessão
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir a sessão
session_destroy();

// Adicionar mensagem de sucesso (opcional)
session_start();
$_SESSION['logout_success'] = 'Você foi desconectado com sucesso!';

// Redirecionar para a página inicial
header('Location: ../../public/index.php');
exit();
?>
