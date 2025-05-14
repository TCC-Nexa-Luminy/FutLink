<?php
include("topo.php");
?>
<link rel="stylesheet" href="../../public/css/home-page.css">

<body>
    <?php include("navbar-social.php"); ?>

    <div class="container">

        <div class="caixa-post">
            <form action="../controllers/publicar-post.act.php" method="POST" enctype="multipart/form-data">
                <textarea name="conteudo" placeholder="Compartilhe uma jogada, treino ou conquista..." required></textarea>
                <input type="file" name="imagem">
                <button type="submit">Publicar</button>
            </form>
        </div>

        <div class="posts">
            <?php
            include('../../config/connect.php');
            $sql = "SELECT p.id_post, p.conteudo, p.imagem, p.criado_em, u.nome 
                    FROM posts p
                    JOIN tbl_usuarios u ON p.id_user = u.id_user
                    ORDER BY p.criado_em DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($post = $result->fetch_assoc()) {
                    echo '<div class="card-post">';
                    echo '<div class="card-header">';
                    echo '<span class="user">@' . htmlspecialchars($post['nome']) . '</span>';
                    echo '<span class="time">' . date('d/m/Y H:i', strtotime($post['criado_em'])) . '</span>';
                    echo '</div>';
                    echo '<p>' . htmlspecialchars($post['conteudo']) . '</p>';
                    if ($post['imagem']) {
                        $caminhoImagem = str_replace('../../', '../', $post['imagem']);
                        echo '<img src="' . $caminhoImagem . '" alt="Imagem do post" class="post-image">';
                    }
                    echo '</div>';
                }
            } else {
                echo 'Nenhum post encontrado.';
            }
            ?>
        </div>

    </div>
</body>


