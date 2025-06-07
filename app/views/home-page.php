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
        <!-- Caixa de Post Melhorada -->
        <div class="caixa-post">
            <div class="post-creator">
                <div class="creator-header">
                    <div class="creator-avatar">
                        <?php if (!empty($_SESSION['foto_perfil'])): ?>
                            <img src="<?= $_SESSION['foto_perfil'] ?>" alt="Seu avatar">
                        <?php else: ?>
                            <i class="fas fa-user"></i>
                        <?php endif; ?>
                    </div>
                    <div class="creator-info">
                        <h3>Olá, <?= $_SESSION['nome'] ?? 'Jogador' ?>!</h3>
                        <p>Compartilhe suas últimas jogadas e conquistas</p>
                    </div>
                </div>
                
                <form action="../controllers/publicar-post.act.php" method="POST" enctype="multipart/form-data">
                    <div class="input-group">
                        <textarea name="conteudo" placeholder="🏆 Compartilhe uma jogada, treino ou conquista incrível..." required></textarea>
                    </div>
                    
                    <!-- Campo para URL de vídeo -->
                    <div class="input-group video-input" style="display: none;">
                        <input type="url" name="video_url" placeholder="Cole aqui o link do vídeo (YouTube, Vimeo, etc.)" class="video-url-input">
                        <button type="button" class="remove-video-btn">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    
                    <div class="form-actions">
                        <div class="media-options">
                            <div class="file-input-wrapper">
                                <div class="file-input-button">
                                    <i class="fas fa-image"></i>
                                    <span>Adicionar foto</span>
                                </div>
                                <input type="file" name="imagem" accept="image/*">
                            </div>
                            <button type="button" class="media-btn" id="video-btn">
                                <i class="fas fa-video"></i>
                                <span>Vídeo</span>
                            </button>
                        </div>
                        
                        <button type="submit" class="publish-btn">
                            <i class="fas fa-paper-plane"></i>
                            <span>Publicar</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Feed de Posts -->
        <div class="posts-feed">
            <div class="feed-header">
                <h2><i class="fas fa-stream"></i> Feed de Atividades</h2>
            </div>

            <div class="posts">
                <?php
                include('../../config/connect.php');
                $id_user_logado = $_SESSION['id'] ?? 0;

                $sql = "SELECT p.id_post, p.conteudo, p.imagem, p.video_url, p.criado_em, p.id_user, u.nome, u.foto_perfil,
                               (SELECT COUNT(*) FROM curtidas WHERE id_post = p.id_post) as total_curtidas,
                               (SELECT COUNT(*) FROM curtidas WHERE id_post = p.id_post AND id_user = '$id_user_logado') as usuario_curtiu,
                               (SELECT COUNT(*) FROM comentarios WHERE id_post = p.id_post) as total_comentarios
                        FROM posts p
                        JOIN tbl_usuarios u ON p.id_user = u.id_user
                        ORDER BY p.criado_em DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($post = $result->fetch_assoc()) {
                        $curtido = $post['usuario_curtiu'] > 0;
                        $isOwner = $post['id_user'] == $id_user_logado;
                        $timeAgo = calcularTempoDecorrido($post['criado_em']);

                        echo '<article class="post-card" data-post-id="' . $post['id_post'] . '">';
                        
                        // Header do post
                        echo '<header class="post-header">';
                        echo '<div class="author-info">';
                        
                        if (!empty($post['foto_perfil']) && file_exists('../../public/images/perfil/' . $post['foto_perfil'])) {
                            echo '<div class="author-avatar">';
                            echo '<img src="../../public/images/perfil/' . $post['foto_perfil'] . '" alt="' . htmlspecialchars($post['nome']) . '">';
                            echo '</div>';
                        } else {
                            $primeiraLetra = strtoupper(substr($post['nome'], 0, 1));
                            echo '<div class="author-avatar avatar-letter">' . $primeiraLetra . '</div>';
                        }
                        
                        echo '<div class="author-details">';
                        echo '<h4 class="author-name">' . htmlspecialchars($post['nome']) . '</h4>';
                        echo '<time class="post-time">' . $timeAgo . '</time>';
                        echo '</div>';
                        echo '</div>';
                        
                        if ($isOwner) {
                            echo '<div class="post-menu">';
                            echo '<button class="menu-toggle"><i class="fas fa-ellipsis-h"></i></button>';
                            echo '<div class="menu-dropdown">';
                            echo '<button class="menu-item btn-editar-post" data-post-id="' . $post['id_post'] . '">';
                            echo '<i class="fas fa-edit"></i> Editar';
                            echo '</button>';
                            echo '<button class="menu-item btn-excluir-post" data-post-id="' . $post['id_post'] . '">';
                            echo '<i class="fas fa-trash"></i> Excluir';
                            echo '</button>';
                            echo '</div>';
                            echo '</div>';
                        }
                        
                        echo '</header>';

                        // Conteúdo do post
                        echo '<div class="post-content">';
                        echo '<p class="post-text" data-post-id="' . $post['id_post'] . '">' . htmlspecialchars($post['conteudo']) . '</p>';
                        echo '</div>';

                        // Imagem do post
                        if ($post['imagem']) {
                            echo '<div class="post-media">';
                            echo '<img src="' . htmlspecialchars($post['imagem']) . '" alt="Imagem do post" class="post-image" loading="lazy">';
                            echo '</div>';
                        }

                        // Vídeo do post
                        if ($post['video_url']) {
                            echo '<div class="post-media">';
                            echo '<div class="video-container">';
                            
                            // Detectar tipo de vídeo e criar embed apropriado
                            $video_embed = createVideoEmbed($post['video_url']);
                            if ($video_embed) {
                                echo $video_embed;
                            } else {
                                echo '<a href="' . htmlspecialchars($post['video_url']) . '" target="_blank" class="video-link">';
                                echo '<i class="fas fa-play-circle"></i> Ver vídeo';
                                echo '</a>';
                            }
                            
                            echo '</div>';
                            echo '</div>';
                        }

                        // Ações do post
                        echo '<footer class="post-actions">';
                        echo '<div class="action-buttons">';
                        
                        echo '<button class="action-btn btn-curtir ' . ($curtido ? 'active' : '') . '" data-post-id="' . $post['id_post'] . '">';
                        echo '<i class="' . ($curtido ? 'fas' : 'far') . ' fa-heart"></i>';
                        echo '<span>' . $post['total_curtidas'] . '</span>';
                        echo '</button>';

                        echo '<button class="action-btn btn-comentar" data-post-id="' . $post['id_post'] . '">';
                        echo '<i class="far fa-comment"></i>';
                        echo '<span>' . $post['total_comentarios'] . '</span>';
                        echo '</button>';

                        echo '<button class="action-btn btn-compartilhar" data-post-id="' . $post['id_post'] . '">';
                        echo '<i class="far fa-share-square"></i>';
                        echo '<span>Compartilhar</span>';
                        echo '</button>';
                        
                        echo '</div>';
                        echo '</footer>';

                        // Seção de comentários
                        echo '<div class="comments-section hidden" id="comentarios-' . $post['id_post'] . '">';
                        echo '<div class="comment-form">';
                        echo '<input type="text" class="comment-input" placeholder="Escreva um comentário..." data-post-id="' . $post['id_post'] . '">';
                        echo '<button class="comment-submit" data-post-id="' . $post['id_post'] . '">';
                        echo '<i class="fas fa-paper-plane"></i>';
                        echo '</button>';
                        echo '</div>';
                        echo '<div class="comments-list" id="comentarios-lista-' . $post['id_post'] . '">';
                        echo '</div>';
                        echo '</div>';

                        echo '</article>';
                    }
                } else {
                    echo '<div class="empty-feed">';
                    echo '<div class="empty-icon"><i class="fas fa-futbol"></i></div>';
                    echo '<h3>Nenhum post ainda</h3>';
                    echo '<p>Seja o primeiro a compartilhar algo incrível!</p>';
                    echo '<button class="cta-btn" onclick="document.querySelector(\'textarea\').focus()">';
                    echo '<i class="fas fa-plus"></i> Criar primeiro post';
                    echo '</button>';
                    echo '</div>';
                }

                function calcularTempoDecorrido($dataPost) {
                    $agora = new DateTime();
                    $post = new DateTime($dataPost);
                    $diff = $agora->diff($post);
                    
                    if ($diff->d > 0) return $diff->d . 'd';
                    if ($diff->h > 0) return $diff->h . 'h';
                    if ($diff->i > 0) return $diff->i . 'm';
                    return 'agora';
                }

                function createVideoEmbed($url) {
                    // YouTube
                    if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $matches)) {
                        $video_id = $matches[1];
                        return '<iframe width="100%" height="315" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allowfullscreen></iframe>';
                    }
                    
                    // Vimeo
                    if (preg_match('/vimeo\.com\/(\d+)/', $url, $matches)) {
                        $video_id = $matches[1];
                        return '<iframe width="100%" height="315" src="https://player.vimeo.com/video/' . $video_id . '" frameborder="0" allowfullscreen></iframe>';
                    }
                    
                    return false;
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        // Script para mostrar o nome do arquivo selecionado
        document.querySelector('input[type="file"]').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            if (fileName) {
                const fileButton = document.querySelector('.file-input-button span');
                fileButton.textContent = fileName.length > 20 ? fileName.substring(0, 20) + '...' : fileName;
                fileButton.parentElement.style.background = "#e6fffa";
                fileButton.parentElement.style.borderColor = "#38b2ac";
            }
        });

        // Script para mostrar/ocultar campo de vídeo
        document.getElementById('video-btn').addEventListener('click', function() {
            const videoInput = document.querySelector('.video-input');
            const isVisible = videoInput.style.display !== 'none';
            
            if (isVisible) {
                videoInput.style.display = 'none';
                this.classList.remove('active');
            } else {
                videoInput.style.display = 'flex';
                this.classList.add('active');
                document.querySelector('.video-url-input').focus();
            }
        });

        // Script para remover campo de vídeo
        document.querySelector('.remove-video-btn').addEventListener('click', function() {
            const videoInput = document.querySelector('.video-input');
            const videoBtn = document.getElementById('video-btn');
            
            videoInput.style.display = 'none';
            videoBtn.classList.remove('active');
            document.querySelector('.video-url-input').value = '';
        });

        // Função para editar post
        document.querySelectorAll('.btn-editar-post').forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.dataset.postId;
                const conteudoElement = document.querySelector(`.post-text[data-post-id="${postId}"]`);
                const conteudoAtual = conteudoElement.textContent;
                
                const novoConteudo = prompt('Editar post:', conteudoAtual);
                
                if (novoConteudo !== null && novoConteudo.trim() !== '') {
                    fetch('../controllers/post-actions.act.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `action=editar&id_post=${postId}&conteudo=${encodeURIComponent(novoConteudo)}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            conteudoElement.textContent = novoConteudo;
                            showNotification('Post editado com sucesso!', 'success');
                        } else {
                            showNotification(data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        showNotification('Erro ao editar post', 'error');
                    });
                }
            });
        });

        // Função para excluir post
        document.querySelectorAll('.btn-excluir-post').forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.dataset.postId;
                
                if (confirm('Tem certeza que deseja excluir este post? Esta ação não pode ser desfeita.')) {
                    fetch('../controllers/post-actions.act.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `action=excluir_post&id_post=${postId}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const postElement = document.querySelector(`.post-card[data-post-id="${postId}"]`);
                            postElement.style.animation = 'slideOutUp 0.3s ease';
                            setTimeout(() => {
                                postElement.remove();
                            }, 300);
                            showNotification('Post excluído com sucesso!', 'success');
                        } else {
                            showNotification(data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        showNotification('Erro ao excluir post', 'error');
                    });
                }
            });
        });

        // Função para curtir/descurtir
        document.querySelectorAll('.btn-curtir').forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.dataset.postId;

                // Animação imediata
                this.style.transform = "scale(1.2)";
                setTimeout(() => {
                    this.style.transform = "scale(1)";
                }, 150);

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
                                this.classList.add('active');
                                icon.classList.remove('far');
                                icon.classList.add('fas');
                            } else {
                                this.classList.remove('active');
                                icon.classList.remove('fas');
                                icon.classList.add('far');
                            }

                            span.textContent = data.total_curtidas;
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
                    comentariosSection.style.animation = 'slideInUp 0.3s ease';
                    carregarComentarios(postId);
                } else {
                    comentariosSection.style.animation = 'slideOutUp 0.3s ease';
                    setTimeout(() => {
                        comentariosSection.classList.add('hidden');
                    }, 300);
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
                            div.className = 'comment-item';
                            div.innerHTML = `
                            <div class="comment-header">
                                <span class="comment-author">@${comentario.nome_usuario}</span>
                                <span class="comment-time">${comentario.criado_em}</span>
                            </div>
                            <div class="comment-content">${comentario.conteudo}</div>
                        `;
                            lista.appendChild(div);
                        });
                    }
                });
        }

        // Função para adicionar comentário
        document.querySelectorAll('.comment-submit').forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.dataset.postId;
                const input = document.querySelector(`.comment-input[data-post-id="${postId}"]`);
                const conteudo = input.value.trim();

                if (conteudo === '') {
                    showNotification('Digite um comentário!', 'warning');
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
                            const currentCount = parseInt(btnComentar.textContent) + 1;
                            btnComentar.textContent = currentCount;
                            
                            showNotification('Comentário adicionado!', 'success');
                        } else {
                            showNotification(data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        showNotification('Erro ao comentar', 'error');
                    });
            });
        });

        // Permitir enviar comentário com Enter
        document.querySelectorAll('.comment-input').forEach(input => {
            input.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    const postId = this.dataset.postId;
                    document.querySelector(`.comment-submit[data-post-id="${postId}"]`).click();
                }
            });
        });

        // Filtros do feed
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Remover active de todos
                document.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.classList.remove('active');
                });

                // Adicionar active ao clicado
                this.classList.add('active');

                // Implementar lógica de filtro
                const filter = this.dataset.filter;
                console.log('Filtro selecionado:', filter);
            });
        });

        // Menus dropdown
        document.addEventListener('click', (e) => {
            // Fechar todos os menus quando clicar fora
            if (!e.target.closest('.post-menu')) {
                document.querySelectorAll('.menu-dropdown').forEach(menu => {
                    menu.style.opacity = '0';
                    menu.style.visibility = 'hidden';
                    menu.style.transform = 'translateY(-10px)';
                });
            }
        });

        // Sistema de notificações
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.textContent = message;

            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 1rem 1.5rem;
                border-radius: 10px;
                color: white;
                font-weight: 500;
                z-index: 1000;
                animation: slideInRight 0.3s ease;
            `;

            switch (type) {
                case 'success':
                    notification.style.background = 'linear-gradient(135deg, #48bb78, #38a169)';
                    break;
                case 'error':
                    notification.style.background = 'linear-gradient(135deg, #f56565, #e53e3e)';
                    break;
                case 'warning':
                    notification.style.background = 'linear-gradient(135deg, #ed8936, #dd6b20)';
                    break;
                default:
                    notification.style.background = 'linear-gradient(135deg, #667eea, #764ba2)';
            }

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }
    </script>
</body>
