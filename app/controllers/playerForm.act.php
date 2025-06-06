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
    $apelido = filter_input(INPUT_POST, "apelido", FILTER_SANITIZE_SPECIAL_CHARS);
    $peso = str_replace(",", ".", $_POST['peso']);
    $altura = str_replace(",", ".", $_POST["altura"]);
    $estiloJogo = filter_input(INPUT_POST, "estilo", FILTER_SANITIZE_SPECIAL_CHARS);
    $peDominante = $_POST['pe_dominante'];
    $posicao = $_POST['posicao'];
    $descricao = filter_input(INPUT_POST, "sobre_mim", FILTER_SANITIZE_SPECIAL_CHARS);
    $fotoDestino = destinoFoto("foto_perfil");

    // Novos dados
    $caracteristicas = json_decode($_POST['caracteristicas'] ?? '[]', true);
    $conquistas = $_POST['conquistas'] ?? [];
    $clubes = $_POST['clubes'] ?? [];

    list($msg, $destino) = inserirDados($conn, $id_user, $apelido, $peso, $altura, $estiloJogo, $peDominante, $posicao, $descricao, $caracteristicas, $conquistas, $clubes);
    inserirPhoto($fotoDestino, $id_user, $conn);
};

function inserirPhoto($nomePhoto, $id, $conexao)
{
    $query = "UPDATE `tbl_usuarios`
    SET `foto_perfil` = ?
    WHERE `id_user` = ?";

    $stmt = $conexao->prepare($query);
    $stmt->bind_param("si", $nomePhoto, $id);
    $stmt->execute();
}

function inserirDados($connect, $id_user, $apelido, $peso, $altura, $estilo, $peDominante, $posicao, $descricao, $caracteristicas, $conquistas, $clubes)
{
    // Iniciar transação
    $connect->begin_transaction();
    
    try {
        // Inserir dados básicos do jogador
        $query = "INSERT INTO tbl_jogador
            (`id_user`, `apelido`, `peso`, `altura`, `posicao`, `estiloJogo`, `pe_dominante`, `descricao`) VALUES
            (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $connect->prepare($query);
        $stmt->bind_param("isddssss", $id_user, $apelido, $peso, $altura, $posicao, $estilo, $peDominante, $descricao);
        
        if (!$stmt->execute()) {
            throw new Exception("Erro ao inserir dados básicos do jogador");
        }
        
        $id_jogador = $connect->insert_id;

        // Inserir características
        if (!empty($caracteristicas)) {
            $queryCarac = "INSERT INTO tbl_caracteristicas_jogador (id_jogador, caracteristica, nivel) VALUES (?, ?, ?)";
            $stmtCarac = $connect->prepare($queryCarac);
            
            foreach ($caracteristicas as $carac) {
                if (!empty($carac['nome'])) {
                    $stmtCarac->bind_param("iss", $id_jogador, $carac['nome'], $carac['nivel']);
                    $stmtCarac->execute();
                }
            }
        }

        // Inserir conquistas
        if (!empty($conquistas)) {
            $queryConq = "INSERT INTO tbl_conquistas_jogador (id_jogador, titulo, ano, clube, descricao, posicao) VALUES (?, ?, ?, ?, ?, ?)";
            $stmtConq = $connect->prepare($queryConq);
            
            foreach ($conquistas as $conquista) {
                if (!empty($conquista['titulo'])) {
                    $ano = !empty($conquista['ano']) ? $conquista['ano'] : null;
                    $stmtConq->bind_param("isisss", $id_jogador, $conquista['titulo'], $ano, $conquista['clube'], $conquista['descricao'], $conquista['posicao']);
                    $stmtConq->execute();
                }
            }
        }

        // Inserir histórico de clubes
        if (!empty($clubes)) {
            $queryClube = "INSERT INTO tbl_historico_clubes (id_jogador, nome_clube, data_inicio, data_fim, posicao, descricao, ativo) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmtClube = $connect->prepare($queryClube);
            
            foreach ($clubes as $clube) {
                if (!empty($clube['nome'])) {
                    $dataFim = !empty($clube['data_fim']) ? $clube['data_fim'] : null;
                    $ativo = empty($clube['data_fim']) ? 1 : 0;
                    $stmtClube->bind_param("isssssi", $id_jogador, $clube['nome'], $clube['data_inicio'], $dataFim, $clube['posicao'], $clube['descricao'], $ativo);
                    $stmtClube->execute();
                }
            }
        }

        // Confirmar transação
        $connect->commit();
        
        return ["Parabéns! Seu perfil foi criado com sucesso! Agora você pode se candidatar para entrar nos times existentes da plataforma!", "../views/peneiras.php"];
        
    } catch (Exception $e) {
        // Reverter transação em caso de erro
        $connect->rollback();
        return ["Erro ao criar sua conta: " . $e->getMessage(), "../views/playerForm.php"];
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

        // Validar extensão
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($extensao, $extensoesPermitidas)) {
            return "../../public/images/profilePhotos/defaultPhoto.png";
        }

        $destino = "../../public/images/profilePhotos/" . md5(time() . $photo['name']) . "." . $extensao;
        
        if (move_uploaded_file($photo["tmp_name"], $destino)) {
            return $destino;
        }
    }
    
    return "../../public/images/profilePhotos/defaultPhoto.png";
}

$_SESSION['msg'] = $msg;
header("location: $destino");
?>
