<?php
session_start();
require("../../config/connect.php");

// Função para upload de imagem
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
    $new_filename = uniqid('logo_') . '.' . $file_extension;
    $upload_path = $upload_dir . $new_filename;
    
    if (move_uploaded_file($file['tmp_name'], $upload_path)) {
        return 'public/uploads/logos/' . $new_filename;
    }
    
    throw new Exception('Erro ao fazer upload da imagem.');
}

// Função para validar CNPJ
function validarCNPJ($cnpj) {
    $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
    
    if (strlen($cnpj) != 14) {
        return false;
    }
    
    // Eliminar CNPJs inválidos conhecidos
    if (preg_match('/(\d)\1{13}/', $cnpj)) {
        return false;
    }
    
    // Validar DVs
    for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
        $soma += $cnpj[$i] * $j;
        $j = ($j == 2) ? 9 : $j - 1;
    }
    
    $resto = $soma % 11;
    
    if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto)) {
        return false;
    }
    
    for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
        $soma += $cnpj[$i] * $j;
        $j = ($j == 2) ? 9 : $j - 1;
    }
    
    $resto = $soma % 11;
    
    return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
}

// Função para verificar se email já existe
function verificarEmailOrg($email, $connect) {
    $stmt = $connect->prepare("SELECT * FROM `organizacoes` WHERE `email` = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    return $resultado->num_rows == 0; // true se email não existe (válido para cadastro)
}

// Função para verificar se CNPJ já existe
function verificarCNPJ($cnpj, $connect) {
    if (empty($cnpj)) {
        return true; // CNPJ vazio é válido
    }
    
    $stmt = $connect->prepare("SELECT * FROM `organizacoes` WHERE `cnpj` = ?");
    $stmt->bind_param("s", $cnpj);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    return $resultado->num_rows == 0; // true se CNPJ não existe (válido para cadastro)
}

// Função para inserir organização
function inserirOrganizacao($connect, $dados, $logo_path) {
    $query = "INSERT INTO `organizacoes` 
              (`nome`, `email`, `senha`, `telefone`, `cnpj`, `tipo_organizacao`, 
               `data_fundacao`, `estado`, `cidade`, `logo`) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $connect->prepare($query);
    
    if (!$stmt) {
        return ["Erro ao preparar consulta: " . $connect->error, "../views/signup-org.php"];
    }
    
    $senha_hash = password_hash($dados['org_pass'], PASSWORD_BCRYPT);
    
    $stmt->bind_param("ssssssssss", 
        $dados['org_nome'],
        $dados['org_email'], 
        $senha_hash,
        $dados['org_tel'],
        $dados['org_cnpj'],
        $dados['org_tipo'],
        $dados['org_data_fund'],
        $dados['org_estado'],
        $dados['org_cidade'],
        $logo_path
    );
    
    if ($stmt->execute()) {
        $org_id = $connect->insert_id;
        
        // Criar sessão para a organização
        $_SESSION['org_id'] = $org_id;
        $_SESSION['org_nome'] = $dados['org_nome'];
        $_SESSION['org_email'] = $dados['org_email'];
        
        // Log da atividade
        logActivity($connect, $org_id, 'cadastro', 'Organização cadastrada com sucesso');
        
        return ["Cadastro realizado com sucesso! Bem-vindo ao FutLink.", "../views/dashboard-org.php"];
    } else {
        return ["Erro ao cadastrar organização: " . $stmt->error, "../views/signup-org.php"];
    }
}

// Função para log de atividades
function logActivity($connect, $org_id, $acao, $detalhes) {
    $query = "INSERT INTO `logs_organizacoes` 
              (`organizacao_id`, `acao`, `detalhes`, `ip_address`, `user_agent`) 
              VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $connect->prepare($query);
    
    if ($stmt) {
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        
        $stmt->bind_param("issss", $org_id, $acao, $detalhes, $ip, $user_agent);
        $stmt->execute();
    }
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
    
    if (empty($_POST['org_estado'])) {
        $erros[] = 'Estado é obrigatório';
    }
    
    if (empty($_POST['org_cidade'])) {
        $erros[] = 'Cidade é obrigatória';
    }
    
    if (!empty($erros)) {
        $_SESSION['msg'] = implode('<br>', $erros);
        header('Location: ../views/signup-org.php');
        exit();
    }
    
    // Verificar se email já existe
    if (!verificarEmailOrg($_POST['org_email'], $conn)) {
        $_SESSION['msg'] = 'Este email já está cadastrado no sistema';
        header('Location: ../views/signup-org.php');
        exit();
    }
    
    // Verificar CNPJ se fornecido
    if (!empty($_POST['org_cnpj'])) {
        if (!validarCNPJ($_POST['org_cnpj'])) {
            $_SESSION['msg'] = 'CNPJ inválido';
            header('Location: ../views/signup-org.php');
            exit();
        }
        
        if (!verificarCNPJ($_POST['org_cnpj'], $conn)) {
            $_SESSION['msg'] = 'Este CNPJ já está cadastrado no sistema';
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
    
    // Inserir organização
    list($msg, $pagDestino) = inserirOrganizacao($conn, $_POST, $logo_path);
    
    $_SESSION['msg'] = $msg;
    header("Location: $pagDestino");
    exit();
    
} catch (Exception $e) {
    error_log("Erro no cadastro de organização: " . $e->getMessage());
    $_SESSION['msg'] = 'Erro interno do sistema. Tente novamente mais tarde.';
    header('Location: ../views/signup-org.php');
    exit();
}
?>
