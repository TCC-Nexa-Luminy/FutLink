<?php
@session_start();

$id_user = $_SESSION['id'];
include('../../config/connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conteudo = mysqli_real_escape_string($conn, $_POST['conteudo']);

    $imagem = NULL;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $target_dir = "../../uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $nomeArquivo = uniqid() . "-" . basename($_FILES["imagem"]["name"]);
        $target_file = $target_dir . $nomeArquivo;

        move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file);
        $imagem = $target_file;
    }

    // Substitua 1 pelo ID do usuário logado (caso tenha login funcionando)
    $sql = "INSERT INTO posts (id_user, conteudo, imagem) VALUES ('$id_user', '$conteudo', '$imagem')";
    if ($conn->query($sql) === TRUE) {
        header("Location: ../views/home-page.php"); // Redireciona para a própria home
        exit();
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>
