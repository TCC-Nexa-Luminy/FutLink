<?php
@session_start();

require_once("../../config/connect.php");

// Verificar se foi passado um ID específico na URL
$id = isset($_GET['id']) ? intval($_GET['id']) : $_SESSION['id'];

// Query para obter os dados do usuário
$query = "SELECT data_nasc, email, foto_perfil, genero, nome, `status`, `telefone`, bio, created_at FROM `tbl_usuarios` WHERE id_user = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Calcular idade se data de nascimento existir
$idade = null;
if ($user['data_nasc']) {
    $dataNasc = new DateTime($user['data_nasc']);
    $hoje = new DateTime();
    $idade = $hoje->diff($dataNasc)->y;
}

// Buscar posts do usuário
$posts = [];
$queryPosts = "SELECT p.id_post, p.conteudo, p.imagem, p.video_url, p.criado_em,
                      (SELECT COUNT(*) FROM curtidas WHERE id_post = p.id_post) as total_curtidas,
                      (SELECT COUNT(*) FROM comentarios WHERE id_post = p.id_post) as total_comentarios
               FROM posts p 
               WHERE p.id_user = ? 
               ORDER BY p.criado_em DESC";

$stmtPosts = $conn->prepare($queryPosts);
$stmtPosts->bind_param("i", $id);
$stmtPosts->execute();
$resultPosts = $stmtPosts->get_result();

while ($row = $resultPosts->fetch_assoc()) {
    $posts[] = $row;
}

// Junta os resultados em um único objeto
$response = array(
    'user' => $user,
    'posts' => $posts,
    'idade' => $idade
);

// Converte o objeto para JSON e envia a resposta
header('Content-Type: application/json');
echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
