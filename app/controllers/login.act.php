<?php
session_start();

// Inclua a conexão com o banco de dados
require("../../config/connect.php");

// Pegue os dados do formulário
$email = $_POST['user_email'];
$senha_input = $_POST['user_pass'];

// Mensagem de erro ou sucesso
$msg = "";
$pagDestino = "../views/login.php";  // Página de destino em caso de erro

$loginStatus = infoLogin($email, $conn);

if($loginStatus['emailFound']){
    //caso encontre o email
    if(password_verify($senha_input, $loginStatus['password'])){
        $_SESSION['id'] = $loginStatus['id'];
        $_SESSION['tipoLogin'] = $loginStatus['type'];
        $msg = "Bem-vindo ao FutLink, <span>" . $loginStatus['user_name'] . "</span>!";
        $pagDestino = "../views/home-page.php";  // Redireciona para o dashboard
    }else{
        $msg = "<span>Email</span> ou <span>senha</span> incorretos!";
    }
}else{
    //caso seja um email inexistente
    $msg = "<span>Email</span> ou <span>senha</span> incorretos!";
}

function infoLogin($email, $conn){    

    // Prepare a consulta para verificar o email
    $loginUser = searchLogin($email, "tbl_usuarios", $conn);
    $loginOrg = searchLogin($email, "tbl_organizacao", $conn);

    $emailFound = false;
    $name = null;
    $type = null;
    $id = null;
    $password = null;

    //caso usuario
    if($loginUser['found']){
        $emailFound = true;
        $id = $loginUser['dados']['id_user'];
        $name = $loginUser['dados']['nome'];
        $password = $loginUser['dados']['senha'];
        $type = "usuario";
    } else{
        //caso organização
        if($loginOrg['found']){
            $emailFound = true;
            $id = $loginOrg['dados']['id_org'];
            $name = $loginOrg['dados']['nome_org'];
            $password = $loginOrg['dados']['password_org'];
            $type = "organizacao";
        }else{
            //caso o email nao seja encontrado
            $emailFound = false;
        }
    }
    return ["emailFound" => $emailFound, "id" => $id, "user_name" => $name, "password" =>$password, "type" => $type];
}

function searchLogin($email, $table, $conn){
    $query = "SELECT * FROM `$table` WHERE `email` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);  // Bind o parâmetro (s = string)
    $stmt->execute();  // Executa a consulta
    $resultado = $stmt->get_result();  // Pega o resultado da consulta
    
    $dados = array();
    $dados = $resultado->fetch_assoc();
    $found = $resultado->num_rows ? true : false;

    return ["found"=>$found, "dados" => $dados];
}

// Salva a mensagem de erro ou sucesso na sessão
$_SESSION['msg'] = $msg;

// Redireciona para a página de login ou dashboard
header("Location: $pagDestino");
exit();
?>
