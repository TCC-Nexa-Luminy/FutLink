<?php
session_start();
require("../../config/connect.php");

// Função para upload da foto principal
function uploadFotoPeneira($file) {
    $upload_dir = 'uploads/peneiras/';
    
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
        return $upload_path;
    }
    
    throw new Exception('Erro ao fazer upload da foto principal.');
}

// Função para upload de múltiplas fotos
function uploadFotos($files) {
    $upload_dir = 'uploads/peneiras/';
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
                $uploaded_files[] = $upload_path;
            }
        }
    }
    
    return $uploaded_files;
}

// Função para upload de documentos
function uploadDocumentos($files) {
    $upload_dir = 'uploads/documentos/';
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
                $uploaded_files[] = $upload_path;
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
    
    // NOVA VALIDAÇÃO: Taxa de inscrição
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
    
    // NOVA LÓGICA: Processar taxa de inscrição
    $taxa_inscricao = '';
    if ($_POST['tipo_taxa'] === 'gratuita') {
        $taxa_inscricao = 'Gratuita';
    } else {
        $valor = number_format((float)$_POST['valor_inscricao'], 2, ',', '.');
        $taxa_inscricao = 'R$ ' . $valor;
    }
    
    // Preparar dados para inserção
    $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
    $clube = mysqli_real_escape_string($conn, $_POST['clube']);
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
    $localizacao = mysqli_real_escape_string($conn, $_POST['localizacao']);
    $data = $_POST['data'];
    $horario = $_POST['horario'];
    $status_inscricao = $_POST['status_inscricao']; // Status das inscrições (Aberta/Fechada/Em Breve)
    $status = $_POST['status'];
    $faixa_etaria = mysqli_real_escape_string($conn, $_POST['faixa_etaria']);
    
    // Converter arrays para JSON
    $fotos_json = json_encode($fotos_extras);
    $documentos_json = json_encode($documentos);
    
    // Inserir no banco de dados - USANDO O CAMPO inscricao PARA A TAXA
    $query = "INSERT INTO peneiras 
              (titulo, clube, foto_peneira, descricao, localizacao, data, horario, 
               inscricao, status, faixa_etaria, fotos, documentos, status_inscricao) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        throw new Exception('Erro ao preparar consulta: ' . $conn->error);
    }
    
    $stmt->bind_param("sssssssssssss", 
        $titulo, $clube, $foto_peneira_path, $descricao, $localizacao, 
        $data, $horario, $taxa_inscricao, $status, $faixa_etaria, 
        $fotos_json, $documentos_json, $status_inscricao
    );
    
    if ($stmt->execute()) {
        $_SESSION['msg'] = 'Peneira criada com sucesso!';
        header('Location: ../views/peneiras.php?success=1');
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
