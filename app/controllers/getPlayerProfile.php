<?php
@session_start();

require_once("../../config/connect.php");

// Verificar se foi passado um ID específico na URL
$id = isset($_GET['id']) ? intval($_GET['id']) : $_SESSION['id'];

// Query para obter os dados do usuário
$query = "SELECT data_nasc, email, foto_perfil, genero, nome, `status`, `telefone` FROM `tbl_usuarios` WHERE id_user = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Query para obter os dados do jogador
$queryPlayer = "SELECT j.altura, j.apelido, j.descricao, j.estiloJogo, j.pe_dominante, j.peso, j.posicao, j.status, j.id_jogador 
                FROM `tbl_usuarios` as u
                JOIN `tbl_jogador` as j ON u.id_user = j.id_user
                WHERE u.id_user = ?";

$stmtPlayer = $conn->prepare($queryPlayer);
$stmtPlayer->bind_param("i", $id);
$stmtPlayer->execute();
$resultPlayer = $stmtPlayer->get_result();
$player = $resultPlayer->fetch_assoc();

// Inicializar arrays para dados adicionais
$caracteristicas = [];
$conquistas = [];
$historicoClubes = [];

if ($player) {
    $id_jogador = $player['id_jogador'];
    
    // Buscar características do jogador
    $queryCarac = "SELECT caracteristica, nivel FROM tbl_caracteristicas_jogador WHERE id_jogador = ? ORDER BY caracteristica";
    $stmtCarac = $conn->prepare($queryCarac);
    $stmtCarac->bind_param("i", $id_jogador);
    $stmtCarac->execute();
    $resultCarac = $stmtCarac->get_result();
    
    while ($row = $resultCarac->fetch_assoc()) {
        $caracteristicas[] = $row;
    }
    
    // Buscar conquistas do jogador
    $queryConq = "SELECT titulo, ano, clube, descricao, posicao, tipo FROM tbl_conquistas_jogador WHERE id_jogador = ? ORDER BY ano DESC";
    $stmtConq = $conn->prepare($queryConq);
    $stmtConq->bind_param("i", $id_jogador);
    $stmtConq->execute();
    $resultConq = $stmtConq->get_result();
    
    while ($row = $resultConq->fetch_assoc()) {
        $conquistas[] = $row;
    }
    
    // Buscar histórico de clubes
    $queryHist = "SELECT nome_clube, data_inicio, data_fim, posicao, descricao, ativo FROM tbl_historico_clubes WHERE id_jogador = ? ORDER BY data_inicio DESC";
    $stmtHist = $conn->prepare($queryHist);
    $stmtHist->bind_param("i", $id_jogador);
    $stmtHist->execute();
    $resultHist = $stmtHist->get_result();
    
    while ($row = $resultHist->fetch_assoc()) {
        $historicoClubes[] = $row;
    }
}

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
    'player' => $player,
    'caracteristicas' => $caracteristicas,
    'conquistas' => $conquistas,
    'historico_clubes' => $historicoClubes,
    'idade' => $idade
);

// Converte o objeto para JSON e envia a resposta
header('Content-Type: application/json');
echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
