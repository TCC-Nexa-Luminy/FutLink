<?php
@session_start();

require_once("../../config/connect.php");

// Verificar se foi passado um ID específico na URL
$id = isset($_GET['id']) ? intval($_GET['id']) : $_SESSION['id'];

// Query para obter os dados do usuário
$query = "SELECT id_user, nome, email, foto_perfil, genero, telefone, bio, `status`, created_at, data_nasc FROM `tbl_usuarios` WHERE id_user = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Verificar se o usuário é um jogador
$queryIsPlayer = "SELECT COUNT(*) as is_player FROM tbl_jogador WHERE id_user = ?";
$stmtIsPlayer = $conn->prepare($queryIsPlayer);
$stmtIsPlayer->bind_param("i", $id);
$stmtIsPlayer->execute();
$resultIsPlayer = $stmtIsPlayer->get_result();
$isPlayerRow = $resultIsPlayer->fetch_assoc();
$isPlayer = ($isPlayerRow['is_player'] > 0);

// Calcular idade se data de nascimento existir
$idade = null;
if ($user['data_nasc']) {
    $dataNasc = new DateTime($user['data_nasc']);
    $hoje = new DateTime();
    $idade = $hoje->diff($dataNasc)->y;
}

// Junta os resultados em um único objeto
$response = array(
    'user' => $user,
    'is_player' => $isPlayer,
    'idade' => $idade
);

// Converte o objeto para JSON e envia a resposta
header('Content-Type: application/json');
echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
