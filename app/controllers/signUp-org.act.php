<?php
session_start();
require("../../config/connect.php");

// Função para upload de logo/banner
function uploadLogo($file) {
    $upload_dir = '../../public/uploads/logos/';
    
    // Criar diretório se não existir
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
    $max_size = 5 * 1024 * 1024; // 5MB
    
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }
    
    if (!in_array($file['type'], $allowed_types)) {
        throw new Exception('Tipo de arquivo não permitido. Use apenas JPG, PNG ou WEBP.');
    }
    
    if ($file['size'] > $max_size) {
        throw new Exception('Arquivo muito grande. Tamanho máximo: 5MB.');
    }
    
    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $new_filename = 'org_logo_' . uniqid() . '.' . $file_extension;
    $upload_path = $upload_dir . $new_filename;
    
    if (move_uploaded_file($file['tmp_name'], $upload_path)) {
        return 'public/uploads/logos/' . $new_filename;
    }
    
    throw new Exception('Erro ao fazer upload da imagem.');
}

try {
    // Verificar se é POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método não permitido');
    }
    
    // Validações básicas
    $erros = [];
    
    if (empty($_POST['org_nome'])) {
        $erros[] = 'Nome da organização é obrigatório';
    }
    
    if (empty($_POST['org_email']) || !filter_var($_POST['org_email'], FILTER_VALIDATE_EMAIL)) {
        $erros[] = 'Email válido é obrigatório';
    }
    
    if (empty($_POST['org_pass']) || strlen($_POST['org_pass']) < 6) {
        $erros[] = 'Senha deve ter pelo menos 6 caracteres';
    }
    
    if ($_POST['org_pass'] !== $_POST['org_pass2']) {
        $erros[] = 'Senhas não coincidem';
    }
    
    if (empty($_POST['org_tel'])) {
        $erros[] = 'Telefone é obrigatório';
    }
    
    if (empty($_POST['org_tipo'])) {
        $erros[] = 'Tipo de organização é obrigatório';
    }
    
    if (empty($_POST['org_data_fund'])) {
        $erros[] = 'Data de fundação é obrigatória';
    }
    
    if (empty($_POST['org_bio'])) {
        $erros[] = 'Bio é obrigatória';
    }
    
    if (empty($_POST['org_descricao'])) {
        $erros[] = 'Descrição é obrigatória';
    }
    
    if (!empty($erros)) {
        $_SESSION['msg'] = implode('<br>', $erros);
        header('Location: ../views/signup-org.php');
        exit();
    }
    
    // Verificar se email já existe
    $check_email = $conn->prepare("SELECT id_org FROM tbl_organizacao WHERE email = ?");
    if ($check_email) {
        $check_email->bind_param("s", $_POST['org_email']);
        $check_email->execute();
        $result = $check_email->get_result();
        
        if ($result->num_rows > 0) {
            $_SESSION['msg'] = 'Este email já está cadastrado no sistema';
            header('Location: ../views/signup-org.php');
            exit();
        }
    }
    
    // Upload da logo/banner se fornecida
    $logo_path = null;
    if (isset($_FILES['org_photo']) && $_FILES['org_photo']['error'] !== UPLOAD_ERR_NO_FILE) {
        try {
            $logo_path = uploadLogo($_FILES['org_photo']);
        } catch (Exception $e) {
            $_SESSION['msg'] = $e->getMessage();
            header('Location: ../views/signup-org.php');
            exit();
        }
    }
    
    // Mapear tipos do formulário para o banco
    $tipos_map = [
        'clube' => 'clube de futebol',
        'escola' => 'escola de futebol',
        'academia' => 'academia',
        'federacao' => 'federacao',
        'empresa' => 'empresa',
        'outro' => 'outro'
    ];
    
    $tipo_db = $tipos_map[$_POST['org_tipo']] ?? 'outro';
    
    // Preparar dados para inserção
    $nome_org = mysqli_real_escape_string($conn, $_POST['org_nome']);
    $email_org = mysqli_real_escape_string($conn, $_POST['org_email']);
    $telefone_org = mysqli_real_escape_string($conn, $_POST['org_tel']);
    $bio_org = mysqli_real_escape_string($conn, $_POST['org_bio']);
    $descricao_org = mysqli_real_escape_string($conn, $_POST['org_descricao']);
    $password_hash = password_hash($_POST['org_pass'], PASSWORD_BCRYPT);
    $data_fundacao = $_POST['org_data_fund'];
    $cep = isset($_POST['org_cep']) ? $_POST['org_cep'] : '';
    
    // Inserir organização no banco usando a estrutura existente
    $query = "INSERT INTO tbl_organizacao 
          (nome_org, email, telefone_org, password_org, logo_org, bio, descricao, 
           data_fundacao, tipo, cep, created_at) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        throw new Exception('Erro ao preparar consulta: ' . $conn->error);
    }
    
    $stmt->bind_param("ssssssssss", 
        $nome_org, $email_org, $telefone_org, $password_hash, 
        $logo_path, $bio_org, $descricao_org, $data_fundacao, $tipo_db, $cep
    );
    
    if ($stmt->execute()) {
        $org_id = $conn->insert_id;
        
        // Criar sessão para a organização
        $_SESSION['org_id'] = $org_id;
        $_SESSION['org_nome'] = $nome_org;
        $_SESSION['org_email'] = $email_org;
        $_SESSION['msg'] = 'Cadastro realizado com sucesso! Bem-vindo ao FutLink.';
        
        // REDIRECIONAR PARA A PÁGINA DE ORGANIZAÇÕES
        header('Location: ../views/organizacoes.php?success=1');
        exit();
        
    } else {
        throw new Exception('Erro ao cadastrar organização: ' . $stmt->error);
    }
    
} catch (Exception $e) {
    error_log("Erro no cadastro de organização: " . $e->getMessage());
    $_SESSION['msg'] = $e->getMessage();
    header('Location: ../views/signup-org.php');
    exit();
}
?>
