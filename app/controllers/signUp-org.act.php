<?php
session_start();
require("../../config/connect.php");

// Função para upload de logo
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
    $new_filename = 'org_' . uniqid() . '.' . $file_extension;
    $upload_path = $upload_dir . $new_filename;
    
    if (move_uploaded_file($file['tmp_name'], $upload_path)) {
        return 'public/uploads/logos/' . $new_filename;
    }
    
    throw new Exception('Erro ao fazer upload da logo.');
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
    
    if (!empty($erros)) {
        $_SESSION['msg'] = implode('<br>', $erros);
        header('Location: ../views/signup-org.php');
        exit();
    }
    
    // Verificar se email já existe
    $check_email = $conn->prepare("SELECT id_org FROM tbl_organizacao WHERE email_org = ?");
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
    
    // Upload da logo se fornecida
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
    $password_hash = password_hash($_POST['org_pass'], PASSWORD_BCRYPT);
    $data_fundacao = $_POST['org_data_fund'];
    $cep = isset($_POST['org_cep']) ? $_POST['org_cep'] : '';
    
    // Verificar se a tabela existe
    $check_table = $conn->query("SHOW TABLES LIKE 'tbl_organizacao'");
    $table_exists = $check_table->num_rows > 0;
    
    // Se a tabela não existir, criá-la
    if (!$table_exists) {
        $create_table = "CREATE TABLE tbl_organizacao (
            id_org INT AUTO_INCREMENT PRIMARY KEY,
            nome_org VARCHAR(100) NOT NULL,
            email_org VARCHAR(200) NOT NULL UNIQUE,
            telefone_org VARCHAR(100) NOT NULL,
            password_org VARCHAR(255) NOT NULL,
            logo_org VARCHAR(255) NULL,
            descricao TEXT NULL,
            data_fundacao DATE NOT NULL,
            tipo ENUM('clube de futebol', 'escola de futebol', 'academia', 'federacao', 'empresa', 'outro') NOT NULL,
            cep VARCHAR(20) NULL,
            redes_sociais LONGTEXT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        
        if (!$conn->query($create_table)) {
            throw new Exception('Erro ao criar tabela de organizações: ' . $conn->error);
        }
    }
    
    // Criar descrição automática baseada no tipo
    $descricao = "Organização esportiva especializada em " . $tipo_db . ". ";
    $descricao .= "Fundada em " . date('Y', strtotime($data_fundacao)) . ".";
    
    // Inserir organização no banco
    $query = "INSERT INTO tbl_organizacao 
          (nome_org, email_org, telefone_org, password_org, logo_org, descricao, 
           data_fundacao, tipo, cep, created_at) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        throw new Exception('Erro ao preparar consulta: ' . $conn->error);
    }
    
    $stmt->bind_param("sssssssss", 
        $nome_org, $email_org, $telefone_org, $password_hash, 
        $logo_path, $descricao, $data_fundacao, $tipo_db, $cep
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
