<?php
require("../../config/connect.php");

$jogadores = [];

if (isset($_GET['apelido']) && !empty(trim($_GET['apelido']))) {
    $apelido = trim($_GET['apelido']);

    $sql = "SELECT * FROM tbl_jogador WHERE apelido LIKE ?";
    $stmt = $conn->prepare($sql);
    $likeApelido = "%$apelido%";
    $stmt->bind_param("s", $likeApelido);
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($row = $resultado->fetch_assoc()) {
        $jogadores[] = $row;
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado da Busca</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;   
        }
        table, th, td {
            border: 1px solid #999;
        }
        th, td {
            padding: 10px;
        }
    </style>
</head>
<body>

    <h1>Resultado da Busca</h1>

    <?php if (count($jogadores) > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Apelido</th>
                <th>Posição</th>
                <th>Altura</th>
                <th>Peso</th>
                <th>Estilo de Jogo</th>
                <th>Status</th>
            </tr>
            <?php foreach ($jogadores as $jogador): ?>
                <tr>
                    <td><?= $jogador['id_jogador'] ?></td>
                    <td><?= htmlspecialchars($jogador['apelido']) ?></td>
                    <td><?= $jogador['posicao'] ?></td>
                    <td><?= $jogador['altura'] ?> m</td>
                    <td><?= $jogador['peso'] ?> kg</td>
                    <td><?= htmlspecialchars($jogador['estiloJogo']) ?></td>
                    <td><?= $jogador['status'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Nenhum jogador encontrado com o apelido informado.</p>
    <?php endif; ?>

</body>
</html>

