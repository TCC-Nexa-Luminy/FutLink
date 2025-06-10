<?php
session_start();
require("../../config/connect.php");

// Verificar se é uma organização logada
if (!isset($_SESSION['id']) || !isset($_SESSION['tipoLogin']) || $_SESSION['tipoLogin'] !== 'organizacao') {
    $_SESSION['msg'] = 'Você precisa estar logado como organização para editar peneiras.';
    header('Location: ../views/login.php');
    exit();
}

// Verificar se o ID da peneira foi fornecido
if (!isset($_POST['id_peneira']) || empty($_POST['id_peneira'])) {
    $_SESSION['msg'] = 'ID da peneira não fornecido.';
    header('Location: ../views/meu-perfil-org.php');
    exit();
}

$id_peneira = intval($_POST['id_peneira']);
$id_org = $_SESSION['id'];

// Verificar se a peneira existe e pertence à organização logada
$query = "SELECT * FROM peneiras WHERE id = ? LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_peneira);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['msg'] = 'Peneira não encontrada.';
    header('Location: ../views/meu-perfil-org.php');
    exit();
}

$peneira = $result->fetch_assoc();

// Verificar se a peneira pertence à organização logada
if ($peneira['id_org'] != $id_org) {
    $_SESSION['msg'] = 'Você não tem permissão para editar esta peneira.';
    header('Location: ../views/meu-perfil-org.php');
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

// Função para remover arquivo
function removerArquivo($caminho) {
    $caminho_completo = '../../' . $caminho;
    if (file_exists($caminho_completo) && is_file($caminho_completo)) {
        unlink($caminho_completo);
    }
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
    
    // Validação: Foto principal
    if (empty($_POST['foto_peneira_atual']) && (!isset($_FILES['foto_peneira']) || $_FILES['foto_peneira']['error'] === UPLOAD_ERR_NO_FILE)) {
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
        header('Location: ../views/editarPeneira.php?id=' . $id_peneira);
        exit();
    }
    
    // Processar foto principal
    $foto_peneira_path = $_POST['foto_peneira_atual'] ?? '';
    
    if (isset($_FILES['foto_peneira']) && $_FILES['foto_peneira']['error'] === UPLOAD_ERR_OK) {
        // Se enviou nova foto, faz upload e remove a antiga
        $nova_foto = uploadFotoPeneira($_FILES['foto_peneira']);
        
        // Remover foto antiga se existir e for diferente da nova
        if (!empty($foto_peneira_path) && $foto_peneira_path !== $nova_foto) {
            removerArquivo($foto_peneira_path);
        }
        
        $foto_peneira_path = $nova_foto;
    }
    
    // Processar fotos extras
    $fotos_extras = [];
    
    // Manter fotos existentes que não foram marcadas para remoção
    if (isset($_POST['fotos_existentes']) && isset($_POST['remover_fotos'])) {
        foreach ($_POST['fotos_existentes'] as $index => $foto) {
            if ($_POST['remover_fotos'][$index] == '0') {
                $fotos_extras[] = $foto;
            } else {
                // Remover foto marcada para exclusão
                removerArquivo($foto);
            }
        }
    }
    
    // Adicionar novas fotos
    if (isset($_FILES['fotos']) && !empty($_FILES['fotos']['tmp_name'][0])) {
        $novas_fotos = uploadFotos($_FILES['fotos']);
        $fotos_extras = array_merge($fotos_extras, $novas_fotos);
    }
    
    // Processar documentos
    $documentos = [];
    
    // Manter documentos existentes que não foram marcados para remoção
    if (isset($_POST['documentos_existentes']) && isset($_POST['remover_documentos'])) {
        foreach ($_POST['documentos_existentes'] as $index => $doc) {
            if ($_POST['remover_documentos'][$index] == '0') {
                $documentos[] = $doc;
            } else {
                // Remover documento marcado para exclusão
                removerArquivo($doc);
            }
        }
    }
    
    // Adicionar novos documentos
    if (isset($_FILES['documentos']) && !empty($_FILES['documentos']['tmp_name'][0])) {
        $novos_documentos = uploadDocumentos($_FILES['documentos']);
        $documentos = array_merge($documentos, $novos_documentos);
    }
    
    // Processar taxa de inscrição
    $taxa_inscricao = '';
    if ($_POST['tipo_taxa'] === 'gratuita') {
        $taxa_inscricao = 'Gratuita';
    } else {
        $valor_inscricao = (float)$_POST['valor_inscricao'];
        $taxa_inscricao = 'R$ ' . number_format($valor_inscricao, 2, ',', '.');
    }
    
    // Preparar dados para atualização
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
    
    // Usar o primeiro documento como caminho_documento (compatibilidade)
    $primeiro_documento = !empty($documentos) ? $documentos[0] : null;
    
    // Atualizar na tabela 'peneiras'
    $query = "UPDATE peneiras SET 
              titulo = ?, clube = ?, foto_peneira = ?, descricao = ?, localizacao = ?, 
              data = ?, horario = ?, inscricao = ?, status = ?, faixa_etaria = ?, 
              caminho_foto = ?, caminho_documento = ?, badge_type = ?, status_inscricao = ?, 
              fotos = ?, documentos = ?, data_atualizacao = NOW()
              WHERE id = ? AND id_org = ?";
    
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        throw new Exception('Erro ao preparar consulta: ' . $conn->error);
    }
    
    $stmt->bind_param("ssssssssssssssssii",
        $titulo, $clube, $foto_peneira_path, $descricao, $localizacao, 
        $data, $horario, $taxa_inscricao, $_POST['status'], $faixa_etaria,
        $foto_peneira_path, $primeiro_documento, $badge_type, $status_inscricao_db,
        $fotos_json, $documentos_json, $id_peneira, $id_org
    );
    
    if ($stmt->execute()) {
        $_SESSION['msg'] = 'Peneira atualizada com sucesso!';
        // Redirecionar para a página da organização
        header('Location: ../views/meu-perfil-org.php?success=1');
        exit();
    } else {
        throw new Exception('Erro ao atualizar peneira: ' . $stmt->error);
    }
    
} catch (Exception $e) {
    error_log("Erro ao atualizar peneira: " . $e->getMessage());
    $_SESSION['msg'] = $e->getMessage();
    header('Location: ../views/editarPeneira.php?id=' . $id_peneira);
    exit();
}
?>