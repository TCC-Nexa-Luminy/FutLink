<?php
require_once("../../config/connect.php");
function inserirDados($connect, $peso, $altura, $posicao, $id_user)
{
    $query = "INSERT INTO tbl_jogador
        (`id_user`, `peso`, `altura`, `posicao`) VALUES
        ('$id_user', '$peso', '$altura', '$posicao');";

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

$id_user = filter_input(INPUT_POST, "id_user", FILTER_VALIDATE_INT);

$msg = "";
$destino = "";

if (verificaJogador($id_user, $conn)) {
    //jogador já registrado
    $msg = 'Você já está registrado como jogador!';
    $destino = "../views/playerForm.php";
} else {
    //pode criar sua conta
    $peso = str_replace(",", ".", $_POST["peso"]);
    $altura = str_replace(",", ".", $_POST["altura"]);
    $posicao = $_POST['posicao'];

    list($msg, $destino) = inserirDados($conn, $peso, $altura, $posicao, $id_user);
}

$_SESSION['msg'] = $msg;
header("location: $destino");