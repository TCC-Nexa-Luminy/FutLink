<?php
@session_start();
require_once("../../config/connect.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../views/editarPerfilUsuario.php");
    exit();
}

$id_user = $_SESSION['id'];

try {
    // Validar dados obrigatórios
    if (empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['telefone']) || empty($_POST['data_nasc'])) {
        throw new Exception("Todos os campos obrigatórios devem ser preenchidos.");
    }

    // Validar email
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Email inválido.");
    }

    // Verificar se email já existe (exceto o próprio usuário)
    $checkEmail = "SELECT id_user FROM tbl_usuarios WHERE email = ? AND id_user != ?";
    $stmtCheck = $conn->prepare($checkEmail);
    $stmtCheck->bind_param("si", $_POST['email'], $id_user);
    $stmtCheck->execute();
    if ($stmtCheck->get_result()->num_rows > 0) {
        throw new Exception("Este email já está sendo usado por outro usuário.");
    }

    // Processar upload de foto
    $foto_perfil = null;
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../public/images/profilePhotos/';
        
        // Verificar se a pasta existe, se não, criar
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
        $maxSize = 5 * 1024 * 1024; // 5MB

        if (!in_array($_FILES['foto_perfil']['type'], $allowedTypes)) {
            throw new Exception("Tipo de arquivo não permitido. Use PNG, JPG, JPEG ou WEBP.");
        }

        if ($_FILES['foto_perfil']['size'] > $maxSize) {
            throw new Exception("Arquivo muito grande. Máximo 5MB.");
        }

        $extension = pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION);
        $filename = 'user_' . $id_user . '_' . time() . '.' . $extension;
        $uploadPath = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $uploadPath)) {
            $foto_perfil = '../../public/images/profilePhotos/' . $filename;
        } else {
            throw new Exception("Erro ao fazer upload da foto.");
        }
    }

    // Preparar dados para atualização
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $data_nasc = $_POST['data_nasc'];
    $bio = trim($_POST['bio'] ?? '');

    // Limitar bio a 500 caracteres
    if (strlen($bio) > 500) {
        $bio = substr($bio, 0, 500);
    }

    // Atualizar dados básicos
    if ($foto_perfil) {
        $query = "UPDATE tbl_usuarios SET nome = ?, email = ?, telefone = ?, data_nasc = ?, bio = ?, foto_perfil = ? WHERE id_user = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssi", $nome, $email, $telefone, $data_nasc, $bio, $foto_perfil, $id_user);
    } else {
        $query = "UPDATE tbl_usuarios SET nome = ?, email = ?, telefone = ?, data_nasc = ?, bio = ? WHERE id_user = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssi", $nome, $email, $telefone, $data_nasc, $bio, $id_user);
    }

    if (!$stmt->execute()) {
        throw new Exception("Erro ao atualizar dados básicos: " . $stmt->error);
    }

    // Processar alteração de senha se fornecida
    if (!empty($_POST['nova_senha'])) {
        if (empty($_POST['senha_atual'])) {
            throw new Exception("Para alterar a senha, você deve informar sua senha atual.");
        }

        // Verificar senha atual
        $queryPass = "SELECT senha FROM tbl_usuarios WHERE id_user = ?";
        $stmtPass = $conn->prepare($queryPass);
        $stmtPass->bind_param("i", $id_user);
        $stmtPass->execute();
        $resultPass = $stmtPass->get_result();
        $userData = $resultPass->fetch_assoc();

        if (!$userData) {
            throw new Exception("Usuário não encontrado.");
        }

        if (!password_verify($_POST['senha_atual'], $userData['senha'])) {
            throw new Exception("Senha atual incorreta.");
        }

        if (strlen($_POST['nova_senha']) < 6) {
            throw new Exception("A nova senha deve ter pelo menos 6 caracteres.");
        }

        if ($_POST['nova_senha'] !== $_POST['confirmar_senha']) {
            throw new Exception("A confirmação da nova senha não confere.");
        }

        // Atualizar senha
        $novaSenhaHash = password_hash($_POST['nova_senha'], PASSWORD_DEFAULT);
        $queryUpdatePass = "UPDATE tbl_usuarios SET senha = ? WHERE id_user = ?";
        $stmtUpdatePass = $conn->prepare($queryUpdatePass);
        $stmtUpdatePass->bind_param("si", $novaSenhaHash, $id_user);
        
        if (!$stmtUpdatePass->execute()) {
            throw new Exception("Erro ao atualizar senha: " . $stmtUpdatePass->error);
        }
    }

    $_SESSION['msg'] = "Perfil atualizado com sucesso!";
    header("Location: ../views/perfilUsuario.php");
    exit();

} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    header("Location: ../views/editarPerfilUsuario.php");
    exit();
} catch (Error $e) {
    $_SESSION['error'] = "Erro interno: " . $e->getMessage();
    header("Location: ../views/editarPerfilUsuario.php");
    exit();
}
?>