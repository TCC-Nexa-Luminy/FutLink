<?php
session_start();
require("../../config/connect.php");

// Verificar se é uma organização logada usando o sistema de login atual
if (!isset($_SESSION['id']) || !isset($_SESSION['tipoLogin']) || $_SESSION['tipoLogin'] !== 'organizacao') {
    $_SESSION['msg'] = 'Você precisa estar logado como organização para criar peneiras.';
    header('Location: ../views/login.php');
    exit();
}

// Função para upload da foto principal
function uploadFotoPeneira($file) {
    $upload_dir = '../../uploads/peneiras/';
    
    // Criar diretório se não existir
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
    $max_size = 5 * 1024 * 1024; // 5MB
    
    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('Erro no upload da foto principal');
    }
    
    if (!in_array($file['type'], $allowed_types)) {
        throw new Exception('Tipo de arquivo não permitido para foto principal. Use apenas JPG, PNG ou WEBP.');
    }
    
    if ($file['size'] > $max_size) {
        throw new Exception('Foto principal muito grande. Tamanho máximo: 5MB.');
    }
    
    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $new_filename = 'peneira_' . uniqid() . '.' . $file_extension;
    $upload_path = $upload_dir . $new_filename;
    
    if (move_uploaded_file($file['tmp_name'], $upload_path)) {
        return 'uploads/peneiras/' . $new_filename; // Retornar caminho relativo
    }
    
    throw new Exception('Erro ao fazer upload da foto principal.');
}

// Função para upload de múltiplas fotos
function uploadFotos($files) {
    $upload_dir = '../../uploads/peneiras/';
    $uploaded_files = [];
    
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    foreach ($files['tmp_name'] as $key => $tmp_name) {
        if ($files['error'][$key] === UPLOAD_ERR_OK) {
            $file_extension = pathinfo($files['name'][$key], PATHINFO_EXTENSION);
            $new_filename = 'extra_' . uniqid() . '.' . $file_extension;
            $upload_path = $upload_dir . $new_filename;
            
            if (move_uploaded_file($tmp_name, $upload_path)) {
                $uploaded_files[] = 'uploads/peneiras/' . $new_filename;
            }
        }
    }
    
    return $uploaded_files;
}

// Função para upload de documentos
function uploadDocumentos($files) {
    $upload_dir = '../../uploads/documentos/';
    $uploaded_files = [];
    
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    foreach ($files['tmp_name'] as $key => $tmp_name) {
        if ($files['error'][$key] === UPLOAD_ERR_OK) {
            $file_extension = pathinfo($files['name'][$key], PATHINFO_EXTENSION);
            $new_filename = 'doc_' . uniqid() . '.' . $file_extension;
            $upload_path = $upload_dir . $new_filename;
            
            if (move_uploaded_file($tmp_name, $upload_path)) {
                $uploaded_files[] = 'uploads/documentos/' . $new_filename;
            }
        }
    }
    
    return $uploaded_files;
}

try {
    // Verificar se é POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método não permitido');
    }
    
    // Validações básicas
    $erros = [];
    
    if (empty($_POST['titulo'])) {
        $erros[] = 'Título é obrigatório';
    }
    
    if (empty($_POST['clube'])) {
        $erros[] = 'Clube é obrigatório';
    }
    
    if (empty($_POST['descricao'])) {
        $erros[] = 'Descrição é obrigatória';
    }
    
    if (empty($_POST['localizacao'])) {
        $erros[] = 'Localização é obrigatória';
    }
    
    if (empty($_POST['data'])) {
        $erros[] = 'Data é obrigatória';
    }
    
    if (empty($_POST['horario'])) {
        $erros[] = 'Horário é obrigatório';
    }
    
    if (empty($_POST['faixa_etaria'])) {
        $erros[] = 'Faixa etária é obrigatória';
    }
    
    // Verificar se foto principal foi enviada
    if (!isset($_FILES['foto_peneira']) || $_FILES['foto_peneira']['error'] === UPLOAD_ERR_NO_FILE) {
        $erros[] = 'Foto principal da peneira é obrigatória';
    }
    
    // Validação: Taxa de inscrição
    if (empty($_POST['tipo_taxa'])) {
        $erros[] = 'Tipo de taxa é obrigatório';
    }
    
    if ($_POST['tipo_taxa'] === 'paga' && (empty($_POST['valor_inscricao']) || $_POST['valor_inscricao'] <= 0)) {
        $erros[] = 'Valor da inscrição é obrigatório para peneiras pagas';
    }
    
    if (!empty($erros)) {
        $_SESSION['msg'] = implode('<br>', $erros);
        header('Location: ../views/addPeneira-org.php');
        exit();
    }
    
    // Upload da foto principal
    $foto_peneira_path = uploadFotoPeneira($_FILES['foto_peneira']);
    
    // Upload das fotos extras (opcional)
    $fotos_extras = [];
    if (isset($_FILES['fotos']) && !empty($_FILES['fotos']['tmp_name'][0])) {
        $fotos_extras = uploadFotos($_FILES['fotos']);
    }
    
    // Upload dos documentos (opcional)
    $documentos = [];
    if (isset($_FILES['documentos']) && !empty($_FILES['documentos']['tmp_name'][0])) {
        $documentos = uploadDocumentos($_FILES['documentos']);
    }
    
    // Processar taxa de inscrição
    $taxa_inscricao = '';
    if ($_POST['tipo_taxa'] === 'gratuita') {
        $taxa_inscricao = 'Gratuita';
    } else {
        $valor_inscricao = (float)$_POST['valor_inscricao'];
        $taxa_inscricao = 'R$ ' . number_format($valor_inscricao, 2, ',', '.');
    }
    
    // Preparar dados para inserção
    $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
    $clube = mysqli_real_escape_string($conn, $_POST['clube']);
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
    $localizacao = mysqli_real_escape_string($conn, $_POST['localizacao']);
    $data = $_POST['data'];
    $horario = $_POST['horario'];
    $faixa_etaria = mysqli_real_escape_string($conn, $_POST['faixa_etaria']);
    
    // Mapear status das inscrições para o formato do banco
    $status_inscricao_map = [
        'Aberta' => 'status-open',
        'Fechada' => 'status-closed', 
        'Em Breve' => 'status-soon'
    ];
    $status_inscricao_db = $status_inscricao_map[$_POST['status_inscricao']] ?? 'status-soon';
    
    // Mapear badge type baseado no status
    $badge_type_map = [
        'Nova' => 'new',
        'Destaque' => 'featured',
        'Ativa' => 'normal',
        'Inativa' => 'normal'
    ];
    $badge_type = $badge_type_map[$_POST['status']] ?? 'normal';
    
    // Converter arrays para JSON
    $fotos_json = json_encode($fotos_extras);
    $documentos_json = json_encode($documentos);
    
    // CORRIGIDO: Inserir na tabela 'peneiras' (não 'tbl_peneiras') com os campos corretos
    $query = "INSERT INTO peneiras 
              (titulo, clube, foto_peneira, descricao, localizacao, data, horario, 
               inscricao, status, faixa_etaria, caminho_foto, caminho_documento, 
               badge_type, status_inscricao, fotos, documentos) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        throw new Exception('Erro ao preparar consulta: ' . $conn->error);
    }
    
    // Usar o primeiro documento como caminho_documento (compatibilidade)
    $primeiro_documento = !empty($documentos) ? $documentos[0] : null;
    
    $stmt->bind_param("ssssssssssssssss", 
        $titulo, $clube, $foto_peneira_path, $descricao, $localizacao, 
        $data, $horario, $taxa_inscricao, $_POST['status'], $faixa_etaria,
        $foto_peneira_path, $primeiro_documento, $badge_type, $status_inscricao_db,
        $fotos_json, $documentos_json
    );
    
    if ($stmt->execute()) {
        $_SESSION['msg'] = 'Peneira criada com sucesso!';
        // Redirecionar para a página da organização
        header('Location: ../views/meu-perfil-org.php?success=1');
        exit();
    } else {
        throw new Exception('Erro ao criar peneira: ' . $stmt->error);
    }
    
} catch (Exception $e) {
    error_log("Erro ao criar peneira: " . $e->getMessage());
    $_SESSION['msg'] = $e->getMessage();
    header('Location: ../views/addPeneira-org.php');
    exit();
}
?>
