<?php
@session_start();
include("topo.php");
?>
<link rel="stylesheet" href="../../public/css/home-page.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<body>
    <?php include("navbar-social.php");
    include("message.php");
    ?>

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
            $id_user_logado = $_SESSION['id'] ?? 0;

            $sql = "SELECT p.id_post, p.conteudo, p.imagem, p.criado_em, u.nome,
                           (SELECT COUNT(*) FROM curtidas WHERE id_post = p.id_post) as total_curtidas,
                           (SELECT COUNT(*) FROM curtidas WHERE id_post = p.id_post AND id_user = '$id_user_logado') as usuario_curtiu,
                           (SELECT COUNT(*) FROM comentarios WHERE id_post = p.id_post) as total_comentarios
                    FROM posts p
                    JOIN tbl_usuarios u ON p.id_user = u.id_user
                    ORDER BY p.criado_em DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($post = $result->fetch_assoc()) {
                    $primeiraLetra = strtoupper(substr($post['nome'], 0, 1));
                    $curtido = $post['usuario_curtiu'] > 0;

                    echo '<div class="card-post" data-post-id="' . $post['id_post'] . '">';
                    echo '<div class="card-header">';
                    echo '<div class="user-info">';
                    echo '<div class="user-avatar">' . $primeiraLetra . '</div>';
                    echo '<div class="user-details">';
                    echo '<span class="user">@' . htmlspecialchars($post['nome']) . '</span>';
                    echo '<span class="time">' . date('d/m/Y H:i', strtotime($post['criado_em'])) . '</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

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
                    echo '<button class="action-button btn-curtir ' . ($curtido ? 'curtido' : '') . '" data-post-id="' . $post['id_post'] . '">';
                    echo '<i class="' . ($curtido ? 'fas' : 'far') . ' fa-heart"></i> ';
                    echo '<span>Curtir (' . $post['total_curtidas'] . ')</span>';
                    echo '</button>';

                    echo '<button class="action-button btn-comentar" data-post-id="' . $post['id_post'] . '">';
                    echo '<i class="far fa-comment"></i> <span>Comentar (' . $post['total_comentarios'] . ')</span>';
                    echo '</button>';

                    echo '<button class="action-button btn-repostar" data-post-id="' . $post['id_post'] . '">';
                    echo '<i class="far fa-share-square"></i> <span>Compartilhar</span>';
                    echo '</button>';
                    echo '</div>';

                    // Seção de comentários (inicialmente oculta)
                    echo '<div class="comentarios-section hidden" id="comentarios-' . $post['id_post'] . '">';
                    echo '<div class="comentario-form">';
                    echo '<input type="text" class="comentario-input" placeholder="Escreva um comentário..." data-post-id="' . $post['id_post'] . '">';
                    echo '<button class="comentario-btn" data-post-id="' . $post['id_post'] . '">Enviar</button>';
                    echo '</div>';
                    echo '<div class="comentarios-lista" id="comentarios-lista-' . $post['id_post'] . '">';
                    echo '</div>';
                    echo '</div>';

                    echo '</div>';
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

        // Função para curtir/descurtir
        document.querySelectorAll('.btn-curtir').forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.dataset.postId;

                fetch('../controllers/post-actions.act.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `action=curtir&id_post=${postId}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const icon = this.querySelector('i');
                            const span = this.querySelector('span');

                            if (data.curtido) {
                                this.classList.add('curtido');
                                icon.classList.remove('far');
                                icon.classList.add('fas');
                            } else {
                                this.classList.remove('curtido');
                                icon.classList.remove('fas');
                                icon.classList.add('far');
                            }

                            span.textContent = `Curtir (${data.total_curtidas})`;
                        }
                    })
                    .catch(error => console.error('Erro:', error));
            });
        });

        // Função para mostrar/ocultar comentários
        document.querySelectorAll('.btn-comentar').forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.dataset.postId;
                const comentariosSection = document.getElementById(`comentarios-${postId}`);

                if (comentariosSection.classList.contains('hidden')) {
                    comentariosSection.classList.remove('hidden');
                    carregarComentarios(postId);
                } else {
                    comentariosSection.classList.add('hidden');
                }
            });
        });

        // Função para carregar comentários
        function carregarComentarios(postId) {
            fetch('../controllers/post-actions.act.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `action=buscar_comentarios&id_post=${postId}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const lista = document.getElementById(`comentarios-lista-${postId}`);
                        lista.innerHTML = '';

                        data.comentarios.forEach(comentario => {
                            const div = document.createElement('div');
                            div.className = 'comentario-item';
                            div.innerHTML = `
                            <span class="comentario-usuario">@${comentario.nome_usuario}</span>
                            <span class="comentario-tempo">${comentario.criado_em}</span>
                            <div class="comentario-conteudo">${comentario.conteudo}</div>
                        `;
                            lista.appendChild(div);
                        });
                    }
                });
        }

        // Função para adicionar comentário
        document.querySelectorAll('.comentario-btn').forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.dataset.postId;
                const input = document.querySelector(`.comentario-input[data-post-id="${postId}"]`);
                const conteudo = input.value.trim();

                if (conteudo === '') {
                    alert('Digite um comentário!');
                    return;
                }

                fetch('../controllers/post-actions.act.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `action=comentar&id_post=${postId}&conteudo=${encodeURIComponent(conteudo)}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            input.value = '';
                            carregarComentarios(postId);

                            // Atualizar contador de comentários
                            const btnComentar = document.querySelector(`.btn-comentar[data-post-id="${postId}"] span`);
                            const currentCount = parseInt(btnComentar.textContent.match(/\d+/)[0]) + 1;
                            btnComentar.textContent = `Comentar (${currentCount})`;
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error('Erro:', error));
            });
        });

        // Função para repostar
        document.querySelectorAll('.btn-repostar').forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.dataset.postId;

                if (confirm('Deseja repostar este post?')) {
                    fetch('../controllers/post-actions.act.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `action=repostar&id_post=${postId}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            alert(data.message);
                            if (data.success) {
                                location.reload();
                            }
                        })
                        .catch(error => console.error('Erro:', error));
                }
            });
        });

        // Permitir enviar comentário com Enter
        document.querySelectorAll('.comentario-input').forEach(input => {
            input.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    const postId = this.dataset.postId;
                    document.querySelector(`.comentario-btn[data-post-id="${postId}"]`).click();
                }
            });
        });
    </script>
</body>