<?php
include("../views/topo.php");
include("navbar-social.php");
require("../../config/connect.php");
?>

<link rel="stylesheet" href="../../public/css/buscaJogadores.css">
<title>Buscar Jogadores</title>


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
        <form method="GET" action="">
            <select name="posicao">
                    <option value="">-- Posição --</option>
                    <option value="Atacante" <?= ($_GET['posicao'] ?? '') === 'Atacante' ? 'selected' : '' ?>>Atacante</option>
                    <option value="Meia" <?= ($_GET['posicao'] ?? '') === 'Meia' ? 'selected' : '' ?>>Meio-campo</option>
                    <option value="Volante" <?= ($_GET['posicao'] ?? '') === 'Voalnte' ? 'selected' : '' ?>>Volante</option>
                    <option value="Zagueiro" <?= ($_GET['posicao'] ?? '') === 'Zagueiro' ? 'selected' : '' ?>>Zagueiro</option>
                    <option value="Goleiro" <?= ($_GET['posicao'] ?? '') === 'Goleiro' ? 'selected' : '' ?>>Goleiro</option>
            </select>
            <select name="status">
                <option value="">-- Status --</option>
                <option value="ativo" <?= ($_GET['status'] ?? '') === 'ativo' ? 'selected' : '' ?>>Ativo</option>
                <option value="lesionado" <?= ($_GET['status'] ?? '') === 'lesionado' ? 'selected' : '' ?>>Lesionado</option>
                <option value="suspenso" <?= ($_GET['status'] ?? '') === 'suspenso' ? 'selected' : '' ?>>Suspenso</option>
                <option value="sem time" <?= ($_GET['status'] ?? '') === 'sem time' ? 'selected' : '' ?>>Sem Time</option>
            </select>

            <input type="number" name="idade_min" placeholder="Idade mínima" value="<?= htmlspecialchars($_GET['idade_min'] ?? '') ?>">
            <input type="number" name="idade_max" placeholder="Idade máxima" value="<?= htmlspecialchars($_GET['idade_max'] ?? '') ?>">

            <input type="number" step="0.01" name="altura_min" placeholder="Altura mínima (m)" value="<?= htmlspecialchars($_GET['altura_min'] ?? '') ?>">
            <input type="number" step="0.01" name="altura_max" placeholder="Altura máxima (m)" value="<?= htmlspecialchars($_GET['altura_max'] ?? '') ?>">

            <button type="submit">Aplicar Filtros</button>
            <button type="button" onclick="window.location.href=window.location.pathname;">Limpar filtros</button>
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
?>
    <ul>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
               
        
            <li>
                <img 
                src="<?= htmlspecialchars($row['foto_perfil'] ?: '../../public/images/profilePhotos/') ?>" 
                alt="Foto de <?= htmlspecialchars($row['nome']) ?>" 
                >
                <span class="campo">Apelido:</span> <?= htmlspecialchars($row['apelido']) ?><br>
                <span class="campo">Nome:</span> <?= htmlspecialchars($row['nome']) ?><br>
                <span class="campo">Idade:</span> <?= $row['idade'] ?> anos<br>
                <span class="campo">Altura:</span> <?= number_format($row['altura'], 2, ',', ' ') ?> m<br>
                <span class="campo">Peso:</span> <?= number_format($row['peso'], 2, ',', ' ') ?> kg<br>
                <span class="campo">Posição:</span> <?= htmlspecialchars($row['posicao']) ?><br>
                <span class="campo">Status:</span> <?= htmlspecialchars($row['status']) ?>
            </li>
        <?php endwhile; ?>
    </ul>

<?php
$sql = "
    SELECT 
        j.apelido,
        u.nome,
        TIMESTAMPDIFF(YEAR, u.data_nasc, CURDATE()) AS idade,
        j.altura,
        j.peso
    FROM tbl_jogador AS j
    INNER JOIN tbl_usuarios AS u
        ON j.id_user = u.id_user
    ORDER BY j.apelido
";

$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Erro na consulta: ' . mysqli_error($conn));
}
?>

<?php
mysqli_free_result($result);
mysqli_close($conn);
?>

<?php include("footer.php"); ?>
