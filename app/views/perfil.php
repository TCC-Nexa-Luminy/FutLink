<?php
@session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

// Redirecionar para o script que verifica o tipo de usuário
require_once("../controllers/checkUserType.php");

// O script checkUserType.php retorna um JSON com a informação se o usuário é jogador ou não
// e para qual página redirecionar
$response = json_decode(ob_get_clean(), true);

if ($response['success']) {
    header("Location: " . $response['redirect']);
    exit;
} else {
    // Se houver algum erro, redirecionar para a página de login
    header("Location: login.php");
    exit;
}
?>
