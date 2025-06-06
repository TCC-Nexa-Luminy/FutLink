<?php
@session_start();

require_once("../../config/connect.php");

// Verificar se o usuário está logado
if (!isset($_SESSION['id'])) {
    $response = array(
        'success' => false,
        'message' => 'Usuário não está logado',
        'redirect' => '../views/login.php'
    );
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

$id_user = $_SESSION['id'];

// Verificar se o usuário é um jogador
$query = "SELECT COUNT(*) as is_player FROM tbl_jogador WHERE id_user = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$isPlayer = ($row['is_player'] > 0);

$response = array(
    'success' => true,
    'is_player' => $isPlayer,
    'redirect' => $isPlayer ? '../views/perfilJogador.php' : '../views/perfilUsuario.php'
);

header('Content-Type: application/json');
echo json_encode($response);
?>
