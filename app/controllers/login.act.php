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



function infoLogin($email, $conn){
    

    // Prepare a consulta para verificar o email
    $loginUser = searchLogin($email, "tbl_usuarios", $conn);
    
    if($loginUser['found']){
        echo "email de usuario";
        print_r($loginUser);
    } else{
        $loginOrg = searchLogin($email, "tbl_organizacao", $conn);
        if($loginOrg['found']){
            echo "email de organização";
            print_r($loginOrg);
        }else{
            echo "email não encontrado!";
        }
    }
}


// if ($login['found']) {
//     // Verifica se a senha fornecida corresponde à senha armazenada (usando password_verify)
//     if (password_verify($senha, $usuario['senha'])) {
//         // Se a senha for correta, cria a sessão para o usuário
//         $_SESSION['usuario'] = $usuario['nome'];  // Salva o nome do usuário na sessão
//         $_SESSION['email'] = $usuario['email'];   // Salva o email na sessão
//         $_SESSION['id'] = $usuario['id_user'];
//         $msg = "Bem-vindo ao FutLink, <span>" . $usuario['nome'] . "</span>!";
//         $pagDestino = "../views/peneiras.php";  // Redireciona para o dashboard
//     } else {
//         // Se a senha estiver incorreta
//         $msg = "Senha incorreta.";
//     }
// } else {
//     // Se não encontrar o email no banco de dados
//     $msg = "O email não foi encontrado.";
// }

function searchLogin($email, $table, $conn){
    $query = "SELECT * FROM `$table` WHERE `email` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);  // Bind o parâmetro (s = string)
    $stmt->execute();  // Executa a consulta
    $resultado = $stmt->get_result();  // Pega o resultado da consulta
    
    $dados = array();
    $dados = $resultado->fetch_row();
    $emailFound = $resultado->num_rows ? true : false;

    return ["found"=>$emailFound, "dados" => $dados];
}

// Salva a mensagem de erro ou sucesso na sessão
// $_SESSION['msg'] = $msg;

// // Redireciona para a página de login ou dashboard
// header("Location: $pagDestino");
// exit();
?>
