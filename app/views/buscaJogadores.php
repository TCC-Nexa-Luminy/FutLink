<?php
include("../views/topo.php");
include("navbar-social.php");
require("../../config/connect.php");
?>

<link rel="stylesheet" href="../../public/css/buscaJogadores.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<title>Buscar Jogadores</title>

<div class="jogadores-page">
    <div class="container">

        <div class="barraPesquisa">
            <div class="pesquisaContainer">
                <form method="GET" action="../controllers/buscaJogadores.act.php">
                    <input type="text" name="apelido" placeholder="Buscar jogador por nome..." />
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>

        <div class="filtrosAvancados">
            <h3><i class="fas fa-filter"></i>Filtros de Busca</h3>
            <form method="GET" action="">
                <div class="filter-group">
                    <label class="filter-label">
                        <i class="fas fa-running"></i>
                        Posição
                    </label>
                    <select name="posicao">
                        <option value="">Todas as posições</option>
                        <option value="Atacante" <?= ($_GET['posicao'] ?? '') === 'Atacante' ? 'selected' : '' ?>>Atacante</option>
                        <option value="Meia" <?= ($_GET['posicao'] ?? '') === 'Meia' ? 'selected' : '' ?>>Meio-campo</option>
                        <option value="Volante" <?= ($_GET['posicao'] ?? '') === 'Volante' ? 'selected' : '' ?>>Volante</option>
                        <option value="Zagueiro" <?= ($_GET['posicao'] ?? '') === 'Zagueiro' ? 'selected' : '' ?>>Zagueiro</option>
                        <option value="Goleiro" <?= ($_GET['posicao'] ?? '') === 'Goleiro' ? 'selected' : '' ?>>Goleiro</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">
                        <i class="fas fa-heartbeat"></i>
                        Status
                    </label>
                    <select name="status">
                        <option value="">Todos os status</option>
                        <option value="ativo" <?= ($_GET['status'] ?? '') === 'ativo' ? 'selected' : '' ?>>Ativo</option>
                        <option value="lesionado" <?= ($_GET['status'] ?? '') === 'lesionado' ? 'selected' : '' ?>>Lesionado</option>
                        <option value="suspenso" <?= ($_GET['status'] ?? '') === 'suspenso' ? 'selected' : '' ?>>Suspenso</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">
                        <i class="fas fa-birthday-cake"></i>
                        Idade
                    </label>
                    <input type="number" name="idade_min" placeholder="Idade mínima" value="<?= htmlspecialchars($_GET['idade_min'] ?? '') ?>">
                    <input type="number" name="idade_max" placeholder="Idade máxima" value="<?= htmlspecialchars($_GET['idade_max'] ?? '') ?>">
                </div>

                <div class="filter-group">
                    <label class="filter-label">
                        <i class="fas fa-ruler-vertical"></i>
                        Altura (metros)
                    </label>
                    <input type="number" step="0.01" name="altura_min" placeholder="Altura mínima" value="<?= htmlspecialchars($_GET['altura_min'] ?? '') ?>">
                    <input type="number" step="0.01" name="altura_max" placeholder="Altura máxima" value="<?= htmlspecialchars($_GET['altura_max'] ?? '') ?>">
                </div>

                <div class="filter-buttons">
                    <button type="submit">
                        <i class="fas fa-search"></i>
                        Aplicar Filtros
                    </button>
                    <button type="button" onclick="window.location.href=window.location.pathname;">
                        <i class="fas fa-times"></i>
                        Limpar
                    </button>
                </div>
            </form>
        </div>

        <?php
        $where = [];
        if (!empty($_GET['posicao'])) {
            $posicao = mysqli_real_escape_string($conn, $_GET['posicao']);
            $where[] = "j.posicao = '$posicao'";
        }
        if (!empty($_GET['status'])) {
            $status = mysqli_real_escape_string($conn, $_GET['status']);
            $where[] = "j.status = '$status'";
        }
        if (!empty($_GET['idade_min'])) {
            $idade_min = (int)$_GET['idade_min'];
            $where[] = "TIMESTAMPDIFF(YEAR, u.data_nasc, CURDATE()) >= $idade_min";
        }
        if (!empty($_GET['idade_max'])) {
            $idade_max = (int)$_GET['idade_max'];
            $where[] = "TIMESTAMPDIFF(YEAR, u.data_nasc, CURDATE()) <= $idade_max";
        }
        if (!empty($_GET['altura_min'])) {
            $altura_min = (float)$_GET['altura_min'];
            $where[] = "j.altura >= $altura_min";
        }
        if (!empty($_GET['altura_max'])) {
            $altura_max = (float)$_GET['altura_max'];
            $where[] = "j.altura <= $altura_max";
        }
        
        $where_sql = '';
        if (!empty($where)) {
            $where_sql = 'WHERE ' . implode(' AND ', $where);
        }

        $sql = "
            SELECT 
                j.apelido,
                u.nome,
                TIMESTAMPDIFF(YEAR, u.data_nasc, CURDATE()) AS idade,
                j.altura,
                j.peso,
                j.posicao,
                j.status,
                u.foto_perfil
            FROM tbl_jogador AS j
            INNER JOIN tbl_usuarios AS u ON j.id_user = u.id_user
            $where_sql
            ORDER BY j.apelido
        ";  

        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die('Erro na consulta: ' . mysqli_error($conn));
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

        <ul class="jogadores-lista">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <li class="jogador-card" onclick="window.location.href='perfilJogador.php?apelido=<?= urlencode($row['apelido']) ?>'">
                    <div class="card-image-container">
                        <img 
                            src="<?= htmlspecialchars($row['foto_perfil'] ?: '../../public/images/profilePhotos/default-player.jpg') ?>" 
                            alt="Foto de <?= htmlspecialchars($row['nome']) ?>" 
                        >
                        <div class="status-badge <?= getStatusColor($row['status']) ?>">
                            <?= ucfirst($row['status']) ?>
                        </div>
                    </div>
                    
                    <div class="jogador-info">
                        <div class="jogador-header">
                            <div class="jogador-nome-principal">
                                <?php if (!empty($row['apelido'])): ?>
                                    <div class="jogador-apelido"><?= htmlspecialchars($row['apelido']) ?></div>
                                    <div class="jogador-nome-real"><?= htmlspecialchars($row['nome']) ?></div>
                                <?php else: ?>
                                    <div class="jogador-apelido"><?= htmlspecialchars($row['nome']) ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="posicao-badge">
                                <i class="<?= getPosicaoIcon($row['posicao']) ?>"></i>
                                <?= htmlspecialchars($row['posicao']) ?>
                            </div>
                        </div>
                        
                        <div class="jogador-stats">
                            <?php if ($row['idade']): ?>
                                <div class="stat-item">
                                    <i class="fas fa-birthday-cake"></i>
                                    <span><?= $row['idade'] ?> anos</span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($row['altura']): ?>
                                <div class="stat-item">
                                    <i class="fas fa-ruler-vertical"></i>
                                    <span><?= number_format($row['altura'], 2) ?>m</span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($row['peso']): ?>
                                <div class="stat-item">
                                    <i class="fas fa-weight"></i>
                                    <span><?= $row['peso'] ?>kg</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>

    </div>
</div>

<?php
mysqli_free_result($result);
mysqli_close($conn);
?>

<?php include("footer.php"); ?>