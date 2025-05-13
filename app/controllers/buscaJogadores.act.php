<?php
require("../../config/connect.php");

// if (isset($_GET['apelido'])) {
//     $apelido = $_GET['apelido'];

//     $sql = "SELECT * FROM tbl_jogador WHERE apelido LIKE ?";
//     $stmt = $conn->prepare($sql);
//     $likeapelido = "%$apelido%";
//     $stmt->bind_param("s", $likeapelido);
//     $stmt->execute();
    
//     $resultado = $stmt->get_result();
//     if ($resultado->num_rows > 0) {
//         echo "<h2>Resultados da busca:</h2>";
//         echo "<ul>";
//         while ($row = $resultado->fetch_assoc()) {
//             echo "<li>apelido: " . htmlspecialchars($row['apelido']) . " | Posição: " . htmlspecialchars($row['posicao']) . " | Clube: " . htmlspecialchars($row['clube']) . "</li>";
//         }
//         echo "</ul>";
//     } else {
//         echo "Nenhum jogador encontrado.";
//     }
// } 

$jogadores = [];
if (isset($_GET['apelido']) && !empty(trim($_GET['apelido']))) {
    $apelido = $_GET['apelido'];

    $sql = "SELECT * FROM tbl_jogador WHERE apelido LIKE ?";
    $stmt = $conn->prepare($sql);
    $likeApelido = "%$apelido%";
    $stmt->bind_param("s", $likeApelido);
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($row = $resultado->fetch_assoc()) {
        // Calcular idade (assumindo que há data_nascimento em tbl_usuarios)
        $nascimento = new DateTime($row['data_nascimento']);
        $hoje = new DateTime();
        $idade = $hoje->diff($nascimento)->y;

        $row['idade'] = $idade;
        $jogadores[] = $row;
    }

    $stmt->close();
}
