<?php
@session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}


require_once("../controllers/checkUserType.php");


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
