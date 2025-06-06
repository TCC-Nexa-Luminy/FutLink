<?php
@session_start();
require_once("../../config/connect.php");

$id_user = $_SESSION['id'];
$msg = "";
$destino = "../views/editarPerfilJogador.php";

// Verificar se o jogador existe
$queryVerifica = "SELECT id_jogador FROM tbl_jogador WHERE id_user = ?";
$stmtVerifica = $conn->prepare($queryVerifica);
$stmtVerifica->bind_param("i", $id_user);
$stmtVerifica->execute();
$resultVerifica = $stmtVerifica->get_result();

if ($resultVerifica->num_rows === 0) {
    $_SESSION['msg'] = "Erro: Perfil de jogador não encontrado!";
    header("Location: $destino");
    exit();
}

$jogador = $resultVerifica->fetch_assoc();
$id_jogador = $jogador['id_jogador'];

// Iniciar transação
$conn->begin_transaction();

try {
    // 1. Atualizar dados básicos do jogador
    $apelido = filter_input(INPUT_POST, "apelido", FILTER_SANITIZE_SPECIAL_CHARS);
    $peso = floatval(str_replace(",", ".", $_POST['peso']));
    $altura = floatval(str_replace(",", ".", $_POST['altura']));
    $estiloJogo = filter_input(INPUT_POST, "estilo", FILTER_SANITIZE_SPECIAL_CHARS);
    $peDominante = $_POST['pe_dominante'];
    $posicao = $_POST['posicao'];
    $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_SPECIAL_CHARS);

    // Validações básicas
    if ($peso <= 0 || $peso > 300) {
        throw new Exception("Peso deve estar entre 1 e 300 kg");
    }
    if ($altura <= 0 || $altura > 3) {
        throw new Exception("Altura deve estar entre 0.1 e 3 metros");
    }
    if (!is_numeric($_POST['peso']) || !is_numeric($_POST['altura'])) {
        throw new Exception("Peso e altura devem ser valores numéricos");
    }

    $queryUpdateJogador = "UPDATE tbl_jogador SET 
                          apelido = ?, peso = ?, altura = ?, posicao = ?, 
                          estiloJogo = ?, pe_dominante = ?, descricao = ? 
                          WHERE id_jogador = ?";
    
    $stmtUpdateJogador = $conn->prepare($queryUpdateJogador);
    $stmtUpdateJogador->bind_param("sddssssi", $apelido, $peso, $altura, $posicao, $estiloJogo, $peDominante, $descricao, $id_jogador);
    
    if (!$stmtUpdateJogador->execute()) {
        throw new Exception("Erro ao atualizar dados básicos do jogador");
    }

    // 2. Processar foto de perfil (se enviada)
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == 0) {
        $fotoDestino = processarFoto($_FILES['foto_perfil']);
        if ($fotoDestino) {
            $queryUpdateFoto = "UPDATE tbl_usuarios SET foto_perfil = ? WHERE id_user = ?";
            $stmtUpdateFoto = $conn->prepare($queryUpdateFoto);
            $stmtUpdateFoto->bind_param("si", $fotoDestino, $id_user);
            $stmtUpdateFoto->execute();
        }
    }

    // 3. Gerenciar características (delete all e insert new)
    $queryDeleteCarac = "DELETE FROM tbl_caracteristicas_jogador WHERE id_jogador = ?";
    $stmtDeleteCarac = $conn->prepare($queryDeleteCarac);
    $stmtDeleteCarac->bind_param("i", $id_jogador);
    $stmtDeleteCarac->execute();

    // Inserir novas características
    if (isset($_POST['caracteristicas']) && !empty($_POST['caracteristicas'])) {
        $queryInsertCarac = "INSERT INTO tbl_caracteristicas_jogador (id_jogador, caracteristica, nivel) VALUES (?, ?, 'intermediario')";
        $stmtInsertCarac = $conn->prepare($queryInsertCarac);
        
        foreach ($_POST['caracteristicas'] as $caracteristica) {
            $caracteristica = filter_var($caracteristica, FILTER_SANITIZE_SPECIAL_CHARS);
            $stmtInsertCarac->bind_param("is", $id_jogador, $caracteristica);
            $stmtInsertCarac->execute();
        }
    }

    // 4. Gerenciar conquistas existentes
    if (isset($_POST['conquistas_existentes'])) {
        foreach ($_POST['conquistas_existentes'] as $id_conquista => $dados) {
            $titulo = filter_var($dados['titulo'], FILTER_SANITIZE_SPECIAL_CHARS);
            $ano = intval($dados['ano']);
            $clube = filter_var($dados['clube'], FILTER_SANITIZE_SPECIAL_CHARS);
            $posicao = $dados['posicao'];
            $descricaoConq = filter_var($dados['descricao'], FILTER_SANITIZE_SPECIAL_CHARS);

            // Validar ano
            if ($ano < 1990 || $ano > 2030) {
                throw new Exception("Ano da conquista deve estar entre 1990 e 2030");
            }

            $queryUpdateConq = "UPDATE tbl_conquistas_jogador SET 
                               titulo = ?, ano = ?, clube = ?, posicao = ?, descricao = ? 
                               WHERE id_conquista = ? AND id_jogador = ?";
            
            $stmtUpdateConq = $conn->prepare($queryUpdateConq);
            $stmtUpdateConq->bind_param("sisssii", $titulo, $ano, $clube, $posicao, $descricaoConq, $id_conquista, $id_jogador);
            $stmtUpdateConq->execute();
        }
    }

    // Excluir conquistas marcadas para exclusão
    if (isset($_POST['excluir_conquistas'])) {
        $queryDeleteConq = "DELETE FROM tbl_conquistas_jogador WHERE id_conquista = ? AND id_jogador = ?";
        $stmtDeleteConq = $conn->prepare($queryDeleteConq);
        
        foreach ($_POST['excluir_conquistas'] as $id_conquista) {
            $stmtDeleteConq->bind_param("ii", $id_conquista, $id_jogador);
            $stmtDeleteConq->execute();
        }
    }

    // Inserir novas conquistas
    if (isset($_POST['novas_conquistas'])) {
        $queryInsertConq = "INSERT INTO tbl_conquistas_jogador (id_jogador, titulo, ano, clube, posicao, descricao) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtInsertConq = $conn->prepare($queryInsertConq);
        
        foreach ($_POST['novas_conquistas'] as $dados) {
            if (!empty($dados['titulo'])) {
                $titulo = filter_var($dados['titulo'], FILTER_SANITIZE_SPECIAL_CHARS);
                $ano = intval($dados['ano']);
                $clube = filter_var($dados['clube'], FILTER_SANITIZE_SPECIAL_CHARS);
                $posicao = $dados['posicao'];
                $descricaoConq = filter_var($dados['descricao'], FILTER_SANITIZE_SPECIAL_CHARS);

                if ($ano < 1990 || $ano > 2030) {
                    throw new Exception("Ano da conquista deve estar entre 1990 e 2030");
                }

                $stmtInsertConq->bind_param("isisss", $id_jogador, $titulo, $ano, $clube, $posicao, $descricaoConq);
                $stmtInsertConq->execute();
            }
        }
    }

    // 5. Gerenciar clubes existentes
    if (isset($_POST['clubes_existentes'])) {
        foreach ($_POST['clubes_existentes'] as $id_historico => $dados) {
            $nomeClube = filter_var($dados['nome'], FILTER_SANITIZE_SPECIAL_CHARS);
            $dataInicio = $dados['data_inicio'];
            $dataFim = !empty($dados['data_fim']) ? $dados['data_fim'] : null;
            $posicaoClube = filter_var($dados['posicao'], FILTER_SANITIZE_SPECIAL_CHARS);
            $descricaoClube = filter_var($dados['descricao'], FILTER_SANITIZE_SPECIAL_CHARS);
            $ativo = empty($dataFim) ? 1 : 0;

            $queryUpdateClube = "UPDATE tbl_historico_clubes SET 
                                nome_clube = ?, data_inicio = ?, data_fim = ?, posicao = ?, descricao = ?, ativo = ? 
                                WHERE id_historico = ? AND id_jogador = ?";
            
            $stmtUpdateClube = $conn->prepare($queryUpdateClube);
            $stmtUpdateClube->bind_param("sssssiii", $nomeClube, $dataInicio, $dataFim, $posicaoClube, $descricaoClube, $ativo, $id_historico, $id_jogador);
            $stmtUpdateClube->execute();
        }
    }

    // Excluir clubes marcados para exclusão
    if (isset($_POST['excluir_clubes'])) {
        $queryDeleteClube = "DELETE FROM tbl_historico_clubes WHERE id_historico = ? AND id_jogador = ?";
        $stmtDeleteClube = $conn->prepare($queryDeleteClube);
        
        foreach ($_POST['excluir_clubes'] as $id_historico) {   
            $stmtDeleteClube->bind_param("ii", $id_historico, $id_jogador);
            $stmtDeleteClube->execute();
        }
    }

    // Inserir novos clubes
    if (isset($_POST['novos_clubes'])) {
        $queryInsertClube = "INSERT INTO tbl_historico_clubes (id_jogador, nome_clube, data_inicio, data_fim, posicao, descricao, ativo) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmtInsertClube = $conn->prepare($queryInsertClube);
        
        foreach ($_POST['novos_clubes'] as $dados) {
            if (!empty($dados['nome'])) {
                $nomeClube = filter_var($dados['nome'], FILTER_SANITIZE_SPECIAL_CHARS);
                $dataInicio = $dados['data_inicio'];
                $dataFim = !empty($dados['data_fim']) ? $dados['data_fim'] : null;
                $posicaoClube = filter_var($dados['posicao'], FILTER_SANITIZE_SPECIAL_CHARS);
                $descricaoClube = filter_var($dados['descricao'], FILTER_SANITIZE_SPECIAL_CHARS);
                $ativo = empty($dataFim) ? 1 : 0;

                $stmtInsertClube->bind_param("isssssi", $id_jogador, $nomeClube, $dataInicio, $dataFim, $posicaoClube, $descricaoClube, $ativo);
                $stmtInsertClube->execute();
            }
        }
    }

    // Confirmar transação
    $conn->commit();
    
    $msg = "Perfil atualizado com sucesso!";
    $destino = "../views/perfilJogador.php";

} catch (Exception $e) {
    // Reverter transação em caso de erro
    $conn->rollback();
    $msg = "Erro ao atualizar perfil: " . $e->getMessage();
}

function processarFoto($arquivo) {
    if ($arquivo['error'] !== 0) {
        return false;
    }

    $info = pathinfo($arquivo['name']);
    $extensao = strtolower($info['extension']);
    
    // Validar extensão
    $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    if (!in_array($extensao, $extensoesPermitidas)) {
        return false;
    }

    // Validar tamanho (máximo 5MB)
    if ($arquivo['size'] > 5 * 1024 * 1024) {
        return false;
    }

    $nomeArquivo = md5(time() . $arquivo['name']) . "." . $extensao;
    $destino = "../../public/images/profilePhotos/" . $nomeArquivo;
    
    if (move_uploaded_file($arquivo["tmp_name"], $destino)) {
        return $destino;
    }
    
    return false;
}

$_SESSION['msg'] = $msg;
header("Location: $destino");
exit();
?>
