<?php
@session_start();

// Verificar se é uma organização logada
if (!isset($_SESSION['id']) || !isset($_SESSION['tipoLogin']) || $_SESSION['tipoLogin'] !== 'organizacao') {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Acesso não autorizado']);
    exit();
}

// Verificar se o ID da peneira foi fornecido
if (!isset($_POST['id']) || empty($_POST['id'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'ID da peneira não fornecido']);
    exit();
}

require_once("../../config/connect.php");

$peneira_id = intval($_POST['id']);
$org_id = $_SESSION['id'];

// Verificar se a peneira pertence à organização logada
$check_query = "SELECT id FROM peneiras WHERE id = ? AND id_org = ?";
$check_stmt = $conn->prepare($check_query);
$check_stmt->bind_param("ii", $peneira_id, $org_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows === 0) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Você não tem permissão para excluir esta peneira']);
    exit();
}


$delete_query = "DELETE FROM peneiras WHERE id = ? AND id_org = ?";
$delete_stmt = $conn->prepare($delete_query);
$delete_stmt->bind_param("ii", $peneira_id, $org_id);

if ($delete_stmt->execute()) {
    

    $files_query = "SELECT foto_peneira, fotos, documentos FROM peneiras WHERE id = ?";
    $files_stmt = $conn->prepare($files_query);
    $files_stmt->bind_param("i", $peneira_id);
    $files_stmt->execute();
    $files_result = $files_stmt->get_result();
    
    if ($files_result->num_rows > 0) {
        $peneira_files = $files_result->fetch_assoc();
        
        // Excluir a foto principal
        if (!empty($peneira_files['foto_peneira']) && file_exists('../../' . $peneira_files['foto_peneira'])) {
            unlink('../../' . $peneira_files['foto_peneira']);
        }
        
        // Excluir fotos extras
        if (!empty($peneira_files['fotos'])) {
            $fotos = json_decode($peneira_files['fotos'], true);
            foreach ($fotos as $foto) {
                if (file_exists('../../' . $foto)) {
                    unlink('../../' . $foto);
                }
            }
        }
        
        // Excluir documentos
        if (!empty($peneira_files['documentos'])) {
            $documentos = json_decode($peneira_files['documentos'], true);
            foreach ($documentos as $documento) {
                if (file_exists('../../' . $documento)) {
                    unlink('../../' . $documento);
                }
            }
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Erro ao excluir peneira: ' . $conn->error]);
}

$conn->close();
?>