<?php
@session_start();
include("../views/topo.php");
require("../../config/connect.php");

if($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Criar diretórios se não existirem
if(!is_dir("uploads/fotos")) mkdir("uploads/fotos", 0777, true);
if(!is_dir("uploads/documentos")) mkdir("uploads/documentos", 0777, true);
if(!is_dir("uploads/clubes")) mkdir("uploads/clubes", 0777, true);

// Sanitiza dados recebidos
$titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
$clube = mysqli_real_escape_string($conn, $_POST['clube']);
$descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
$localizacao = mysqli_real_escape_string($conn, $_POST['localizacao']);
$data = $_POST['data'];
$horario = $_POST['horario'];
$inscricao = mysqli_real_escape_string($conn, $_POST['inscricao']);
$status = mysqli_real_escape_string($conn, $_POST['status']);
$faixa_etaria = mysqli_real_escape_string($conn, $_POST['faixa_etaria']);

// Arrays para armazenar caminhos das fotos e documentos
$fotos_caminhos = [];
$documentos_caminhos = [];
$foto_clube_caminho = NULL;

// Processa FOTO DO CLUBE (campo específico)
if(isset($_FILES['foto_clube']) && $_FILES['foto_clube']['error'] == 0) {
    $permitidos_foto = ['image/jpeg', 'image/png', 'image/gif'];
    
    if(in_array($_FILES['foto_clube']['type'], $permitidos_foto) && $_FILES['foto_clube']['size'] <= 2 * 1024 * 1024) {
        $foto_clube_nome = uniqid() . "_clube_" . basename($_FILES['foto_clube']['name']);
        $foto_clube_destino = "uploads/clubes/" . $foto_clube_nome;
        
        if(move_uploaded_file($_FILES['foto_clube']['tmp_name'], $foto_clube_destino)) {
            $foto_clube_caminho = $foto_clube_destino;
        }
    }
}

// Processa MÚLTIPLAS FOTOS DA PENEIRA
if(isset($_FILES['fotos']) && is_array($_FILES['fotos']['name'])) {
    $permitidos_foto = ['image/jpeg', 'image/png', 'image/gif'];
    
    for($i = 0; $i < count($_FILES['fotos']['name']); $i++) {
        if($_FILES['fotos']['error'][$i] == 0) {
            if(in_array($_FILES['fotos']['type'][$i], $permitidos_foto) && $_FILES['fotos']['size'][$i] <= 2 * 1024 * 1024) {
                $foto_nome = uniqid() . "_" . basename($_FILES['fotos']['name'][$i]);
                $foto_destino = "uploads/fotos/" . $foto_nome;
                
                if(move_uploaded_file($_FILES['fotos']['tmp_name'][$i], $foto_destino)) {
                    $fotos_caminhos[] = $foto_destino;
                }
            }
        }
    }
}

// Processa MÚLTIPLOS DOCUMENTOS
if(isset($_FILES['documentos']) && is_array($_FILES['documentos']['name'])) {
    $permitidos_doc = ['application/pdf', 'image/jpeg', 'image/png'];
    
    for($i = 0; $i < count($_FILES['documentos']['name']); $i++) {
        if($_FILES['documentos']['error'][$i] == 0) {
            if(in_array($_FILES['documentos']['type'][$i], $permitidos_doc)) {
                $doc_nome = uniqid() . "_" . basename($_FILES['documentos']['name'][$i]);
                $doc_destino = "uploads/documentos/" . $doc_nome;
                
                if(move_uploaded_file($_FILES['documentos']['tmp_name'][$i], $doc_destino)) {
                    $documentos_caminhos[] = $doc_destino;
                }
            }
        }
    }
}

// Converte arrays para JSON para armazenar no banco
$fotos_json = !empty($fotos_caminhos) ? json_encode($fotos_caminhos) : NULL;
$documentos_json = !empty($documentos_caminhos) ? json_encode($documentos_caminhos) : NULL;

// Determina o tipo de badge baseado na data
$data_peneira = new DateTime($data);
$hoje = new DateTime();
$diferenca = $hoje->diff($data_peneira)->days;

$badge_type = 'normal';
if($diferenca <= 7) {
    $badge_type = 'new';
} elseif($status == 'Ativa' && $inscricao == 'Aberta') {
    $badge_type = 'featured';
}

// Determina o status de inscrição
$status_inscricao = 'status-soon';
if($inscricao == 'Aberta' && $status == 'Ativa') {
    $status_inscricao = 'status-open';
} elseif($inscricao == 'Fechada') {
    $status_inscricao = 'status-closed';
}

// Insere na tabela peneiras (incluindo foto_clube)
$sql = "INSERT INTO peneiras (titulo, clube, foto_clube, descricao, localizacao, data, horario, inscricao, status, faixa_etaria, fotos, documentos, badge_type, status_inscricao) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssss", $titulo, $clube, $foto_clube_caminho, $descricao, $localizacao, $data, $horario, $inscricao, $status, $faixa_etaria, $fotos_json, $documentos_json, $badge_type, $status_inscricao);

if($stmt->execute()){
    // Redireciona para a página de peneiras com mensagem de sucesso
    header("Location: ../views/peneiras.php?success=1");
    exit();
} else {
    // Redireciona com mensagem de erro
    header("Location: ../views/peneiras.php?error=1");
    exit();
}

$stmt->close();
$conn->close();
?>
