<?php
@session_start();
include('../../config/connect.php');

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não logado']);
    exit();
}

$id_user = $_SESSION['id'];
$action = $_POST['action'] ?? '';

header('Content-Type: application/json');

switch ($action) {
    case 'listar':
        // Buscar notificações do usuário
        $sql = "SELECT n.*, u.nome, u.foto_perfil 
                FROM notificacoes n 
                JOIN tbl_usuarios u ON n.id_user_origem = u.id_user 
                WHERE n.id_user_destino = '$id_user' 
                ORDER BY n.criado_em DESC 
                LIMIT 20";
        
        $result = $conn->query($sql);
        $notificacoes = [];
        
        while ($row = $result->fetch_assoc()) {
            // Formatar a mensagem com base no tipo
            $titulo = '';
            $mensagem = '';
            switch ($row['tipo']) {
                case 'curtida':
                    $titulo = $row['nome'] . " curtiu seu post";
                    $mensagem = "Curtiu sua publicação: \"" . substr($row['conteudo'], 0, 50) . "...\"";
                    break;
                case 'comentario':
                    $titulo = $row['nome'] . " comentou em seu post";
                    $mensagem = "\"" . substr($row['conteudo'], 0, 50) . "...\"";
                    break;
                case 'repost':
                    $titulo = $row['nome'] . " repostou seu post";
                    $mensagem = "Repostou sua publicação: \"" . substr($row['conteudo'], 0, 50) . "...\"";
                    break;
            }
            
            // Calcular tempo relativo
            $tempo_relativo = calcularTempoRelativo($row['criado_em']);
            
            // Adicionar à lista
            $notificacoes[] = [
                'id' => $row['id'],
                'nome' => $row['nome'],
                'foto_perfil' => $row['foto_perfil'] ?? '',
                'titulo' => $titulo,
                'mensagem' => $mensagem,
                'lida' => $row['lida'] == 1,
                'tempo' => $tempo_relativo,
                'id_referencia' => $row['id_referencia'],
                'tipo' => $row['tipo']
            ];
        }
        
        echo json_encode(['success' => true, 'notificacoes' => $notificacoes]);
        break;
        
    case 'marcar_lida':
        $id_notificacao = $_POST['id_notificacao'] ?? 0;
        
        if ($id_notificacao > 0) {
            $sql = "UPDATE notificacoes SET lida = 1 
                    WHERE id = '$id_notificacao' AND id_user_destino = '$id_user'";
            
            if ($conn->query($sql)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erro ao marcar notificação como lida']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'ID de notificação inválido']);
        }
        break;
        
    case 'marcar_todas_lidas':
        $sql = "UPDATE notificacoes SET lida = 1 
                WHERE id_user_destino = '$id_user' AND lida = 0";
        
        if ($conn->query($sql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao marcar notificações como lidas']);
        }
        break;
        
    case 'contar_nao_lidas':
        $sql = "SELECT COUNT(*) as total FROM notificacoes 
                WHERE id_user_destino = '$id_user' AND lida = 0";
        
        $result = $conn->query($sql);
        $total = $result->fetch_assoc()['total'];
        
        echo json_encode(['success' => true, 'total' => $total]);
        break;

        case 'excluir':
            $id_notificacao = $_POST['id_notificacao'] ?? 0;
            
            if ($id_notificacao > 0) {
                $sql = "DELETE FROM notificacoes 
                        WHERE id = '$id_notificacao' AND id_user_destino = '$id_user'";
                
                if ($conn->query($sql)) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Erro ao excluir notificação']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'ID de notificação inválido']);
            }
            break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Ação inválida']);
}

// Função para calcular tempo relativo
function calcularTempoRelativo($data) {
    $agora = new DateTime();
    $data_notif = new DateTime($data);
    $diff = $agora->diff($data_notif);
    
    if ($diff->days > 0) {
        return $diff->days . 'd';
    } elseif ($diff->h > 0) {
        return $diff->h . 'h';
    } elseif ($diff->i > 0) {
        return $diff->i . ' min';
    } else {
        return 'Agora';
    }
}
?>