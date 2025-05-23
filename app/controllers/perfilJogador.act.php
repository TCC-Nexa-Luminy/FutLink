<?php
@session_start();

require_once("../../config/connect.php");

$id = $_SESSION['id'];

// Primeira query para obter os dados do usuário
$query = "SELECT data_nasc, email, foto_perfil, genero, nome, `status`, `telefone` FROM `tbl_usuarios` WHERE id_user = $id";

// Segunda query para obter os dados do jogador
$queryPlayer = "SELECT j.altura, j.apelido, j.descricao, j.estiloJogo, j.pe_dominante, j.peso, j.posicao, j.status FROM `tbl_usuarios` as u
                JOIN `tbl_jogador` as j
                ON u.id_user = j.id_user
                WHERE u.id_user = $id";

// Executa a primeira query
$resul = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($resul);

// Variável para armazenar os dados do jogador
$player = null;

// Tenta executar a segunda query (a de jogador)
$resulPlayer = mysqli_query($conn, $queryPlayer);
if ($resulPlayer) {
    // Verifica se retornou algum resultado
    if (mysqli_num_rows($resulPlayer) > 0) {
        // Se houver dados, armazene no objeto player
        $player = mysqli_fetch_assoc($resulPlayer);
    }
}

// Junta os resultados em um único objeto
$response = array(
    'user' => $user,
    'player' => $player
);

// Converte o objeto para JSON e envia a resposta
echo json_encode($response);
?>