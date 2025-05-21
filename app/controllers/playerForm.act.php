<?php
@session_start();
require_once("../../config/connect.php");

$id_user = $_SESSION['id'];

$msg = "";
$destino = "";



if (verificaJogador($id_user, $conn)) {
    //jogador já registrado
    $msg = 'Você já está registrado como jogador!';
    $destino = "../views/playerForm.php";
} else {
    //pode criar sua conta
    $apelido = filter_input(INPUT_POST, "apelido", FILTER_SANITIZE_SPECIAL_CHARS);       //input:text
    $peso = str_replace(",", ".", $_POST['peso']);
    $altura = str_replace(",", ".", $_POST["altura"]);
    $estiloJogo = filter_input(INPUT_POST, "estilo", FILTER_SANITIZE_SPECIAL_CHARS);
    $peDominante = $_POST['pe_dominante'];
    $posicao = $_POST['posicao'];
    $descricao = filter_input(INPUT_POST, "sobre_mim", FILTER_SANITIZE_SPECIAL_CHARS);
    $fotoDestino = destinoFoto("foto_perfil");

    list($msg, $destino) = inserirDados($conn, $fotoDestino, $id_user, $apelido, $peso, $altura, $estiloJogo, $peDominante, $posicao, $descricao);
}


function inserirDados($connect, $id_user, $apelido, $peso, $altura, $estilo, $peDominante, $posicao, $descricao)
{
    $query = "INSERT INTO tbl_jogador
        (`id_user`, `apelido`, `peso`, `altura`, `posicao`, `estiloJogo`, `pe_dominante`, `descricao`) VALUES
        ('$id_user', '$apelido', '$peso', '$altura', '$posicao', '$estilo', '$peDominante', '$descricao');";

    $updateQuery = "";
    if (mysqli_query($connect, $query)) {
        return ["Parabéns! Agora você pode se candidatar para entrar nos times existentes da plataforma!", "../views/peneiras.php"];
    } else {
        return ["Erro ao criar sua conta!" . mysqli_error($connect), "../views/playerForm.php"];
    }
}

function verificaJogador($id, $connect)
{
    $query = "SELECT * FROM tbl_jogador WHERE id_user=?";

    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function destinoFoto($photo)
{
    if (isset($_FILES[$photo]) && $_FILES[$photo]['error'] == 0) {
        $photo = $_FILES[$photo];
        $info = pathinfo($photo['name']);
        $extensao = strtolower($info['extension']);

        $destino = "../../public/images/profilePhotos/" . md5(time() . $photo['name']) . "." . $extensao;
        move_uploaded_file($photo["tmp_name"], $destino);
        return $destino;
    } else {
        return "../../public/images/profilePhotos/defaultPhoto";
    }
}



$_SESSION['msg'] = $msg;
header("location: $destino");
