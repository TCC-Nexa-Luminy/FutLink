<?php
@session_start();

$id_user = $_SESSION['id'];
include('../../config/connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conteudo = mysqli_real_escape_string($conn, $_POST['conteudo']);
    $video_url = isset($_POST['video_url']) ? mysqli_real_escape_string($conn, $_POST['video_url']) : NULL;

    $imagem = NULL;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $target_dir = "../../uploads/posts/";
        
        // Criar diretório se não existir
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Validar tipo de arquivo
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        $file_type = $_FILES['imagem']['type'];
        
        if (in_array($file_type, $allowed_types)) {
            // Gerar nome único para o arquivo
            $file_extension = pathinfo($_FILES["imagem"]["name"], PATHINFO_EXTENSION);
            $nomeArquivo = uniqid() . "_" . time() . "." . $file_extension;
            $target_file = $target_dir . $nomeArquivo;

            // Mover arquivo para o diretório
            if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
                $imagem = $target_file;
            } else {
                $_SESSION['error'] = "Erro ao fazer upload da imagem.";
                header("Location: ../views/home-page.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Tipo de arquivo não permitido. Use apenas JPG, PNG, GIF ou WebP.";
            header("Location: ../views/home-page.php");
            exit();
        }
    }

    // Validar URL de vídeo se fornecida
    if ($video_url && !empty($video_url)) {
        // Verificar se é uma URL válida do YouTube, Vimeo, etc.
        if (!filter_var($video_url, FILTER_VALIDATE_URL)) {
            $_SESSION['error'] = "URL de vídeo inválida.";
            header("Location: ../views/home-page.php");
            exit();
        }
    }

    // Inserir post no banco de dados
    $sql = "INSERT INTO posts (id_user, conteudo, imagem, video_url) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $id_user, $conteudo, $imagem, $video_url);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Post publicado com sucesso!";
        header("Location: ../views/home-page.php");
        exit();
    } else {
        $_SESSION['error'] = "Erro ao publicar post: " . $conn->error;
        header("Location: ../views/home-page.php");
        exit();
    }
}
?>
