<?php
session_start();

// Inclua a conexão com o banco de dados
require("../../config/connect.php");

// Pegue os dados do formulário
$email = $_POST['user_email'];
$senha = $_POST['user_pass'];

// Mensagem de erro ou sucesso
$msg = "";
$pagDestino = "../views/login.php";  // Página de destino em caso de erro

// Prepare a consulta para verificar o email
$stmt = $conn->prepare("SELECT * FROM `tbl_usuarios` WHERE `email` = ?");
$stmt->bind_param("s", $email);  // Bind o parâmetro (s = string)
$stmt->execute();  // Executa a consulta
$resultado = $stmt->get_result();  // Pega o resultado da consulta

if ($resultado->num_rows == 0) {
    // Se não encontrar o email no banco de dados
    $msg = "O email não foi encontrado.";
} else {
    // Se o email foi encontrado, pega os dados do usuário
    $usuario = $resultado->fetch_assoc();

    // Verifica se a senha fornecida corresponde à senha armazenada (usando password_verify)
    if (password_verify($senha, $usuario['senha'])) {
        // Se a senha for correta, cria a sessão para o usuário
        $_SESSION['usuario'] = $usuario['nome'];  // Salva o nome do usuário na sessão
        $_SESSION['email'] = $usuario['email'];   // Salva o email na sessão
        $_SESSION['id'] = $usuario['id_user'];
        $msg = "Bem-vindo ao FutLink, <span>" . $usuario['nome'] . "</span>!";
        $pagDestino = "../views/peneiras.php";  // Redireciona para o dashboard
    } else {
        // Se a senha estiver incorreta
        $msg = "Senha incorreta.";
    }
}

// Salva a mensagem de erro ou sucesso na sessão
$_SESSION['msg'] = $msg;

// Redireciona para a página de login ou dashboard
header("Location: $pagDestino");
exit();
?>
