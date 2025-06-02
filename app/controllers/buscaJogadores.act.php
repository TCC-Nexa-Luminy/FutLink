<link rel="stylesheet" href="../../public/css/buscaJogadores.act.css">

<?php
require("../../config/connect.php");
include("../views/topo.php");
include("../views/navbar-social.php");

$jogadores = [];
$termo_pesquisa = '';

if (isset($_GET['apelido']) && !empty(trim($_GET['apelido']))) {
    $termo = trim($_GET['apelido']);
    $termo_pesquisa = $termo;

    $sql = "
        SELECT 
            j.*, 
            u.nome,
            u.foto_perfil,
            u.data_nasc,
            TIMESTAMPDIFF(YEAR, u.data_nasc, CURDATE()) AS idade
        FROM tbl_jogador AS j
        INNER JOIN tbl_usuarios AS u ON j.id_user = u.id_user
        WHERE j.apelido LIKE ? OR u.nome LIKE ?
        ORDER BY j.apelido
    ";

    $stmt = $conn->prepare($sql);
    $likeTermo = "%$termo%";
    $stmt->bind_param("ss", $likeTermo, $likeTermo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($row = $resultado->fetch_assoc()) {
        $jogadores[] = $row;
    }

    $stmt->close();
}

// Função para obter ícone da posição
function getPosicaoIcon($posicao) {
    switch($posicao) {
        case 'Atacante': return 'fas fa-bullseye';
        case 'Meia': return 'fas fa-exchange-alt';
        case 'Volante': return 'fas fa-shield-alt';
        case 'Zagueiro': return 'fas fa-user-shield';
        case 'Goleiro': return 'fas fa-hand-paper';
        default: return 'fas fa-user';
    }
}

// Função para obter cor do status
function getStatusColor($status) {
    switch($status) {
        case 'ativo': return 'status-ativo';
        case 'lesionado': return 'status-lesionado';
        case 'suspenso': return 'status-suspenso';
        default: return 'status-default';
    }
}
?>

<link rel="stylesheet" href="../../public/css/resultadoBusca.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<title>Resultado da Busca - <?= htmlspecialchars($termo_pesquisa) ?></title>

<div class="resultado-busca-page">
    <div class="container">
        
        <!-- Header da página -->
        <div class="page-header">
            <div class="header-content">
                <button onclick="history.back()" class="btn-voltar">
                    <i class="fas fa-arrow-left"></i>
                    Voltar
                </button>
                
                <div class="header-info">
                    <h1>Resultados da Busca</h1>
                    <?php if (!empty($termo_pesquisa)): ?>
                        <p class="termo-pesquisa">
                            Buscando por: <span>"<?= htmlspecialchars($termo_pesquisa) ?>"</span>
                        </p>
                    <?php endif; ?>
                    
                    <div class="resultado-count">
                        <?php if (count($jogadores) > 0): ?>
                            <i class="fas fa-users"></i>
                            <?= count($jogadores) ?> jogador<?= count($jogadores) > 1 ? 'es' : '' ?> encontrado<?= count($jogadores) > 1 ? 's' : '' ?>
                        <?php else: ?>
                            <i class="fas fa-search"></i>
                            Nenhum jogador encontrado
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resultados -->
        <?php if (count($jogadores) > 0): ?>
            <div class="jogadores-grid">
                <?php foreach ($jogadores as $jogador): ?>
                    <div class="jogador-card" onclick="window.location.href='perfilJogador.php?apelido=<?= urlencode($jogador['apelido']) ?>'">
                        <div class="card-image-container">
                            <img 
                                src="<?= htmlspecialchars($jogador['foto_perfil'] ?: '../../public/images/profilePhotos/default-player.jpg') ?>" 
                                alt="Foto de <?= htmlspecialchars($jogador['nome']) ?>" 
                            >
                            <div class="status-badge <?= getStatusColor($jogador['status']) ?>">
                                <?= ucfirst($jogador['status']) ?>
                            </div>
                        </div>
                        
                        <div class="jogador-info">
                            <div class="jogador-header">
                                <div class="jogador-nome-principal">
                                    <?php if (!empty($jogador['apelido'])): ?>
                                        <div class="jogador-apelido"><?= htmlspecialchars($jogador['apelido']) ?></div>
                                        <div class="jogador-nome-real"><?= htmlspecialchars($jogador['nome']) ?></div>
                                    <?php else: ?>
                                        <div class="jogador-apelido"><?= htmlspecialchars($jogador['nome']) ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="posicao-badge">
                                    <i class="<?= getPosicaoIcon($jogador['posicao']) ?>"></i>
                                    <?= htmlspecialchars($jogador['posicao']) ?>
                                </div>
                            </div>
                            
                            <div class="jogador-stats">
                                <?php if ($jogador['idade']): ?>
                                    <div class="stat-item">
                                        <i class="fas fa-birthday-cake"></i>
                                        <span><?= $jogador['idade'] ?> anos</span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($jogador['altura']): ?>
                                    <div class="stat-item">
                                        <i class="fas fa-ruler-vertical"></i>
                                        <span><?= number_format($jogador['altura'], 2) ?>m</span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($jogador['peso']): ?>
                                    <div class="stat-item">
                                        <i class="fas fa-weight"></i>
                                        <span><?= $jogador['peso'] ?>kg</span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if (!empty($jogador['estiloJogo'])): ?>
                                <div class="estilo-jogo">
                                    <i class="fas fa-futbol"></i>
                                    <span><?= htmlspecialchars($jogador['estiloJogo']) ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-results">
                <div class="no-results-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h2>Nenhum jogador encontrado</h2>
                <p>Não encontramos jogadores com o termo "<?= htmlspecialchars($termo_pesquisa) ?>"</p>
                <div class="suggestions">
                    <h3>Sugestões:</h3>
                    <ul>
                        <li>Verifique se o nome ou apelido está correto</li>
                        <li>Tente usar apenas parte do nome</li>
                        <li>Use termos mais gerais na busca</li>
                    </ul>
                </div>
                <button onclick="history.back()" class="btn-nova-busca">
                    <i class="fas fa-search"></i>
                    Fazer nova busca
                </button>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php include("../views/footer.php"); ?>