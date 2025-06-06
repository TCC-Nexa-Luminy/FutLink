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

            $sql = "SELECT p.id_post, p.conteudo, p.imagem, p.criado_em, p.id_user, u.nome, u.foto_perfil,
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
                    $isOwner = $post['id_user'] == $id_user_logado; // Verificar se é o dono do post

                    echo '<div class="card-post" data-post-id="' . $post['id_post'] . '">';
                    echo '<div class="card-header">';
                    echo '<div class="user-info">';
                    
                    // Avatar com foto de perfil
                    if (!empty($post['foto_perfil']) && file_exists('../../public/images/perfil/' . $post['foto_perfil'])) {
                        echo '<div class="user-avatar">';
                        echo '<img src="../../public/images/perfil/' . $post['foto_perfil'] . '" alt="' . htmlspecialchars($post['nome']) . '">';
                        echo '</div>';
                    } else {
                        $primeiraLetra = strtoupper(substr($post['nome'], 0, 1));
                        echo '<div class="user-avatar avatar-letra">' . $primeiraLetra . '</div>';
                    }
                    
                    echo '<div class="user-details">';
                    echo '<span class="user">@' . htmlspecialchars($post['nome']) . '</span>';
                    echo '<span class="time">' . date('d/m/Y H:i', strtotime($post['criado_em'])) . '</span>';
                    echo '</div>';
                    echo '</div>';
                    
                    // 🆕 BOTÕES DE EDITAR E EXCLUIR (só para o dono do post)
                    if ($isOwner) {
                        echo '<div class="post-actions-owner">';
                        echo '<button class="btn-editar-post" data-post-id="' . $post['id_post'] . '" title="Editar post">';
                        echo '<i class="fas fa-edit"></i>';
                        echo '</button>';
                        echo '<button class="btn-excluir-post" data-post-id="' . $post['id_post'] . '" title="Excluir post">';
                        echo '<i class="fas fa-trash"></i>';
                        echo '</button>';
                        echo '</div>';
                    }
                    
                    echo '</div>';

                    echo '<div class="card-content">';
                    echo '<p class="post-conteudo" data-post-id="' . $post['id_post'] . '">' . htmlspecialchars($post['conteudo']) . '</p>';
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

        // 🆕 FUNÇÃO PARA EDITAR POST
        document.querySelectorAll('.btn-editar-post').forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.dataset.postId;
                const conteudoElement = document.querySelector(`.post-conteudo[data-post-id="${postId}"]`);
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
                            alert('Post editado com sucesso!');
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        alert('Erro ao editar post');
                    });
                }
            });
        });

        // 🆕 FUNÇÃO PARA EXCLUIR POST
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
                            // Remover o post da tela com animação
                            const postElement = document.querySelector(`.card-post[data-post-id="${postId}"]`);
                            postElement.style.animation = 'fadeOut 0.3s ease';
                            setTimeout(() => {
                                postElement.remove();
                            }, 300);
                            alert('Post excluído com sucesso!');
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        alert('Erro ao excluir post');
                    });
                }
            });
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