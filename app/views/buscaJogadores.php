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
                    <option value="Meio-campo" <?= ($_GET['posicao'] ?? '') === 'Meio-campo' ? 'selected' : '' ?>>Meio-campo</option>
                    <option value="Defensor" <?= ($_GET['posicao'] ?? '') === 'Defensor' ? 'selected' : '' ?>>Defensor</option>
                    <option value="Goleiro" <?= ($_GET['posicao'] ?? '') === 'Goleiro' ? 'selected' : '' ?>>Goleiro</option>
            </select>
            <button type="submit">Aplicar Filtros</button>

        </form>
    </div>
<?php
    $where = [];
    if (!empty($_GET['posicao'])) {
        $posicao = mysqli_real_escape_string($conn, $_GET['posicao']);
        $where[] = "j.posicao = '$posicao'";
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
            j.status
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

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Jogadores</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        ul { list-style-type: none; padding: 0; }
        li { padding: 10px; border-bottom: 1px solid #ccc; }
        .campo { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Lista de Jogadores</h1>
    <ul>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <li>
                <span class="campo">Apelido:</span> <?= htmlspecialchars($row['apelido']) ?><br>
                <span class="campo">Nome:</span> <?= htmlspecialchars($row['nome']) ?><br>
                <span class="campo">Idade:</span> <?= $row['idade'] ?> anos<br>
                <span class="campo">Altura:</span> <?= number_format($row['altura'], 2, ',', ' ') ?> m<br>
                <span class="campo">Peso:</span> <?= number_format($row['peso'], 2, ',', ' ') ?> kg
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html> 
<?php
mysqli_free_result($result);
mysqli_close($conn);
?>

<?php include("footer.php"); ?>
</body>

</html>