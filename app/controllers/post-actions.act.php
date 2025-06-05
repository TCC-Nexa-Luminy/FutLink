<?php
@session_start();
include('../../config/connect.php');

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não logado']);
    exit();
}

$id_user = $_SESSION['id'];
$action = $_POST['action'] ?? '';
$id_post = $_POST['id_post'] ?? '';

header('Content-Type: application/json');

switch ($action) {
    case 'curtir':
        // Verificar se já curtiu
        $check = "SELECT id_curtida FROM curtidas WHERE id_post = '$id_post' AND id_user = '$id_user'";
        $result = $conn->query($check);
        
        if ($result->num_rows > 0) {
            // Descurtir
            $sql = "DELETE FROM curtidas WHERE id_post = '$id_post' AND id_user = '$id_user'";
            $curtido = false;
        } else {
            // Curtir
            $sql = "INSERT INTO curtidas (id_post, id_user) VALUES ('$id_post', '$id_user')";
            $curtido = true;
        }
        
        if ($conn->query($sql)) {
            // Contar total de curtidas
            $count_sql = "SELECT COUNT(*) as total FROM curtidas WHERE id_post = '$id_post'";
            $count_result = $conn->query($count_sql);
            $total_curtidas = $count_result->fetch_assoc()['total'];
            
            // 🆕 CRIAR NOTIFICAÇÃO PARA CURTIDAS
            if ($curtido) {
                // Buscar o dono do post
                $owner_sql = "SELECT id_user FROM posts WHERE id_post = '$id_post'";
                $owner_result = $conn->query($owner_sql);
                
                if ($owner_result && $owner_result->num_rows > 0) {
                    $post_owner = $owner_result->fetch_assoc()['id_user'];
                    
                    // Não notificar se a pessoa curtiu o próprio post
                    if ($post_owner != $id_user) {
                        // Buscar conteúdo do post (primeiros 100 caracteres)
                        $post_sql = "SELECT SUBSTRING(conteudo, 1, 100) as preview FROM posts WHERE id_post = '$id_post'";
                        $post_result = $conn->query($post_sql);
                        $post_preview = $post_result->fetch_assoc()['preview'];
                        
                        // Criar notificação
                        $notif_sql = "INSERT INTO notificacoes (id_user_destino, id_user_origem, tipo, id_referencia, conteudo) 
                              VALUES ('$post_owner', '$id_user', 'curtida', '$id_post', '$post_preview')";
                        $conn->query($notif_sql);
                    }
                }
            }
            
            echo json_encode([
                'success' => true, 
                'curtido' => $curtido, 
                'total_curtidas' => $total_curtidas
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao processar curtida']);
        }
        break;
        
    case 'comentar':
        $conteudo = mysqli_real_escape_string($conn, $_POST['conteudo']);
        
        if (empty($conteudo)) {
            echo json_encode(['success' => false, 'message' => 'Comentário não pode estar vazio']);
            break;
        }
        
        $sql = "INSERT INTO comentarios (id_post, id_user, conteudo) VALUES ('$id_post', '$id_user', '$conteudo')";
        
        if ($conn->query($sql)) {
            // Buscar dados do usuário para retornar
            $user_sql = "SELECT nome FROM tbl_usuarios WHERE id_user = '$id_user'";
            $user_result = $conn->query($user_sql);
            $user_data = $user_result->fetch_assoc();
            
            // 🆕 CRIAR NOTIFICAÇÃO PARA COMENTÁRIOS
            // Buscar o dono do post
            $owner_sql = "SELECT id_user FROM posts WHERE id_post = '$id_post'";
            $owner_result = $conn->query($owner_sql);
            
            if ($owner_result && $owner_result->num_rows > 0) {
                $post_owner = $owner_result->fetch_assoc()['id_user'];
                
                // Não notificar se a pessoa comentou no próprio post
                if ($post_owner != $id_user) {
                    // Criar notificação
                    $notif_sql = "INSERT INTO notificacoes (id_user_destino, id_user_origem, tipo, id_referencia, conteudo) 
                          VALUES ('$post_owner', '$id_user', 'comentario', '$id_post', '$conteudo')";
                    $conn->query($notif_sql);
                }
            }
            
            echo json_encode([
                'success' => true,
                'comentario' => [
                    'id_comentario' => $conn->insert_id,
                    'conteudo' => $conteudo,
                    'nome_usuario' => $user_data['nome'],
                    'criado_em' => date('d/m/Y H:i')
                ]
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao adicionar comentário']);
        }
        break;
        
    case 'repostar':
        // Verificar se já repostou
        $check = "SELECT id_repost FROM reposts WHERE id_post_original = '$id_post' AND id_user = '$id_user'";
        $result = $conn->query($check);
        
        if ($result->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'Você já repostou este post']);
        } else {
            $sql = "INSERT INTO reposts (id_post_original, id_user) VALUES ('$id_post', '$id_user')";
            
            if ($conn->query($sql)) {
                // 🆕 CRIAR NOTIFICAÇÃO PARA REPOSTS
                // Buscar o dono do post
                $owner_sql = "SELECT id_user FROM posts WHERE id_post = '$id_post'";
                $owner_result = $conn->query($owner_sql);
                
                if ($owner_result && $owner_result->num_rows > 0) {
                    $post_owner = $owner_result->fetch_assoc()['id_user'];
                    
                    // Não notificar se a pessoa repostou o próprio post
                    if ($post_owner != $id_user) {
                        // Buscar conteúdo do post (primeiros 100 caracteres)
                        $post_sql = "SELECT SUBSTRING(conteudo, 1, 100) as preview FROM posts WHERE id_post = '$id_post'";
                        $post_result = $conn->query($post_sql);
                        $post_preview = $post_result->fetch_assoc()['preview'];
                        
                        // Criar notificação
                        $notif_sql = "INSERT INTO notificacoes (id_user_destino, id_user_origem, tipo, id_referencia, conteudo) 
                                      VALUES ('$post_owner', '$id_user', 'repost', '$id_post', '$post_preview')";
                        $conn->query($notif_sql);
                    }
                }
                
                echo json_encode(['success' => true, 'message' => 'Post repostado com sucesso!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erro ao repostar']);
            }
        }
        break;
        
    case 'buscar_comentarios':
        $sql = "SELECT c.conteudo, c.criado_em, u.nome 
                FROM comentarios c 
                JOIN tbl_usuarios u ON c.id_user = u.id_user 
                WHERE c.id_post = '$id_post' 
                ORDER BY c.criado_em ASC";
        
        $result = $conn->query($sql);
        $comentarios = [];
        
        while ($row = $result->fetch_assoc()) {
            $comentarios[] = [
                'conteudo' => $row['conteudo'],
                'nome_usuario' => $row['nome'],
                'criado_em' => date('d/m/Y H:i', strtotime($row['criado_em']))
            ];
        }
        
        echo json_encode(['success' => true, 'comentarios' => $comentarios]);
        break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Ação inválida']);
}
?>