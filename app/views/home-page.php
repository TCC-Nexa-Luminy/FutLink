<?php
include("topo.php");
?>
<link rel="stylesheet" href="../../public/css/home-page.css">
<!-- Adicione Font Awesome para ícones -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<body>
    <?php include("navbar-social.php"); ?>

    <div class="container">
        <div class="caixa-post">
            <form action="../controllers/publicar-post.act.php" method="POST" enctype="multipart/form-data">
                <textarea name="conteudo" placeholder="Compartilhe uma jogada, treino ou conquista..." required></textarea>
                <div class="form-actions">
                    <div class="file-input-wrapper">
                        <div class="file-input-button">
                            <i class="fas fa-image"></i>
                            <span>Adicionar imagem</span>
                        </div>
                        <input type="file" name="imagem">
                    </div>
                    <button type="submit">
                        <i class="fas fa-paper-plane"></i>
                        Publicar
                    </button>
                </div>
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
                    $primeiraLetra = strtoupper(substr($post['nome'], 0, 1));
                    
                    echo '<div class="card-post">';
                    echo '<div class="card-header">';
                    echo '<div class="user-info">';
                    echo '<div class="user-avatar">' . $primeiraLetra . '</div>';
                    echo '<div class="user-details">';
                    echo '<span class="user">@' . htmlspecialchars($post['nome']) . '</span>';
                    echo '<span class="time">' . date('d/m/Y H:i', strtotime($post['criado_em'])) . '</span>';
                    echo '</div>'; // user-details
                    echo '</div>'; // user-info
                    echo '</div>'; // card-header
                    
                    echo '<div class="card-content">';
                    echo '<p>' . htmlspecialchars($post['conteudo']) . '</p>';
                    echo '</div>';
                    
                    if ($post['imagem']) {
                        $caminhoImagem = str_replace('../../', '../', $post['imagem']);
                        echo '<div class="post-image-container">';
                        echo '<img src="' . $caminhoImagem . '" alt="Imagem do post" class="post-image">';
                        echo '</div>';
                    }
                    
                    echo '<div class="card-actions">';
                    echo '<button class="action-button"><i class="far fa-heart"></i> <span>Curtir</span></button>';
                    echo '<button class="action-button"><i class="far fa-comment"></i> <span>Comentar</span></button>';
                    echo '<button class="action-button"><i class="far fa-share-square"></i> <span>Compartilhar</span></button>';
                    echo '</div>';
                    
                    echo '</div>'; // card-post
                }
            } else {
                echo '<div class="empty-state">';
                echo '<i class="far fa-newspaper"></i>';
                echo '<p>Nenhum post encontrado. Seja o primeiro a compartilhar!</p>';
                echo '</div>';
            }
            ?>

        </div>
    </div>
    <script>
        // Script para mostrar o nome do arquivo selecionado
        document.querySelector('input[type="file"]').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            if (fileName) {
                const fileButton = document.querySelector('.file-input-button span');
                fileButton.textContent = fileName.length > 20 ? fileName.substring(0, 20) + '...' : fileName;
            }
        });
    </script>
</body>
