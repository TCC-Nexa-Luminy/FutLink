<?php include('topo.php'); ?>
<title>Perfil do Jogador - FutLink</title>
<link rel="stylesheet" href="../../public/css/perfilJogador.css">

<?php 
include 'navbar-social.php';

// IMPORTANTE: Incluir a conexão ANTES de usar $conn
require_once("../../config/connect.php");


$perfil_id = null;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $perfil_id = intval($_GET['id']);
} elseif (isset($_GET['apelido']) && !empty($_GET['apelido'])) {

    $apelido = $_GET['apelido'];
    $queryId = "SELECT j.id_user FROM tbl_jogador j WHERE j.apelido = ?";
    $stmtId = $conn->prepare($queryId);
    $stmtId->bind_param("s", $apelido);
    $stmtId->execute();
    $resultId = $stmtId->get_result();
    $rowId = $resultId->fetch_assoc();
    
    if ($rowId) {
        $perfil_id = $rowId['id_user'];
    }
} else {
    $perfil_id = $_SESSION['id'];
}


if (!$perfil_id) {
    $perfil_id = $_SESSION['id'];
}

// Flag para verificar se o usuário está visualizando seu próprio perfil
$proprio_perfil = ($perfil_id == $_SESSION['id']);

// Verificar se o usuário atual é um jogador
$query = "SELECT COUNT(*) as is_player FROM tbl_jogador WHERE id_user = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$is_current_user_player = ($row['is_player'] > 0);
?>

<section class="banner">
  <div class="banner-overlay"></div>
  <div class="banner-container">
    <div class="banner-img">
      <img src="../../public/images/profilePhotos/defaultPhoto.png" alt="Foto do Jogador" id="photo_user" />
      <div class="status-badge" id="status_user">Disponível</div>
    </div>
    <div class="banner-info">
      <div class="nome-social">
        <h1 id="name_user">Nome usuário</h1>
        <div class="social-icons">
          <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="#" title="YouTube"><i class="fab fa-youtube"></i></a>
          <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
        </div>
      </div>
      <p class="bio" id="bio_user">Carregando informações...</p>
      <div class="contato-info">
        <div class="contato-item">
          <i class="fas fa-envelope"></i>
          <span id="email_user">carregando@email.com</span>
        </div>
        <div class="contato-item">
          <i class="fas fa-phone"></i>
          <span id="tel_user">(00) 00000-0000</span>
        </div>
        <div class="contato-item">
          <i class="fas fa-map-marker-alt"></i>
          <span>São Paulo, SP</span>
        </div>
      </div>
      <div class="acoes">
        <?php if ($proprio_perfil): ?>

          <a href="editarPerfilJogador.php" class="btn-principal">
            <i class="fas fa-edit"></i> Editar Perfil
          </a>
        <?php else: ?>

        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<div class="container">
  <div class="grid-flex">
    <div class="coluna-flex">
      <section class="card sobre">
        <h2><i class="fas fa-user"></i> Sobre Mim</h2>
        <div class="texto-sobre">
          <p id="descricao_user">
            Carregando descrição do jogador...
          </p>
        </div>
      </section>

      <section class="card info-jogador">
        <h2><i class="fas fa-id-card"></i> Informações do Jogador</h2>
        <div class="info-grid">
          <div class="info-item">
            <i class="fas fa-user-tag"></i>
            <div class="info-content">
              <span class="info-label">Apelido</span>
              <span class="info-valor" id="apelido_user">-</span>
            </div>
          </div>
          <div class="info-item">
            <i class="fas fa-birthday-cake"></i>
            <div class="info-content">
              <span class="info-label">Idade</span>
              <span class="info-valor" id="idade_user">- anos</span>
            </div>
          </div>
          <div class="info-item">
            <i class="fas fa-weight"></i>
            <div class="info-content">
              <span class="info-label">Peso</span>
              <span class="info-valor" id="peso_user">- kg</span>
            </div>
          </div>
          <div class="info-item">
            <i class="fas fa-ruler-vertical"></i>
            <div class="info-content">
              <span class="info-label">Altura</span>
              <span class="info-valor" id="altura_user">- m</span>
            </div>
          </div>
          <div class="info-item">
            <i class="fas fa-fire"></i>
            <div class="info-content">
              <span class="info-label">Estilo</span>
              <span class="info-valor" id="estilo_user">-</span>
            </div>
          </div>
          <div class="info-item">
            <i class="fas fa-shoe-prints"></i>
            <div class="info-content">
              <span class="info-label">Pé dominante</span>
              <span class="info-valor" id="pe_user">-</span>
            </div>
          </div>
          <div class="info-item">
            <i class="fas fa-futbol"></i>
            <div class="info-content">
              <span class="info-label">Posição</span>
              <span class="info-valor" id="posicao_user">-</span>
            </div>
          </div>
        </div>
      </section>

      <section class="card caracteristicas">
        <h2><i class="fas fa-list-check"></i> Características de Jogo</h2>
        <div class="tags-container" id="caracteristicas-container">
          <span class="tag">Carregando...</span>
        </div>
      </section>
    </div>

    <div class="coluna-flex">
      <section class="card conquistas">
        <h2><i class="fas fa-medal"></i> Conquistas e Títulos</h2>
        <div class="conquistas-lista" id="conquistas-container">
          <div class="conquista-item">
            <div class="conquista-icone">
              <i class="fas fa-trophy"></i>
            </div>
            <div class="conquista-info">
              <h3>Carregando conquistas...</h3>
              <span>Aguarde</span>
            </div>
          </div>
        </div>
      </section>

      <section class="card historico">
        <h2><i class="fas fa-history"></i> Histórico de Clubes</h2>
        <div class="timeline" id="historico-container">
          <div class="timeline-item">
            <div class="timeline-dot"></div>
            <div class="timeline-content">
              <h3>Carregando histórico...</h3>
              <span class="timeline-periodo">Aguarde</span>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>


  <div class="posts-feed">
    <div class="feed-header">
      <h2><i class="fas fa-stream"></i> Minhas Postagens</h2>
    </div>

    <div class="posts" id="posts-container">

      <div class="loading-posts">
        <i class="fas fa-spinner fa-spin"></i>
        <p>Carregando posts...</p>
      </div>
    </div>
  </div>
</div>

<script src="../../public/js/perfilJogador.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {

    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        tabBtns.forEach(b => b.classList.remove('ativo'));
        tabContents.forEach(c => c.classList.remove('ativo'));

        btn.classList.add('ativo');
        const tabId = btn.getAttribute('data-tab');
        document.getElementById(tabId).classList.add('ativo');
      });
    });


    const galeriaItems = document.querySelectorAll('.galeria-item');
    galeriaItems.forEach(item => {
      item.addEventListener('mouseenter', () => {
        const overlay = item.querySelector('.galeria-overlay');
        if (overlay) {
          overlay.style.transform = 'translateY(0)';
        }
      });

      item.addEventListener('mouseleave', () => {
        const overlay = item.querySelector('.galeria-overlay');
        if (overlay) {
          overlay.style.transform = 'translateY(100%)';
        }
      });
    });


    carregarPerfilJogador();
  });

  function carregarPerfilJogador() {

    const urlParams = new URLSearchParams(window.location.search);
    const perfilId = urlParams.get('id');
    const perfilApelido = urlParams.get('apelido');
    
    let apiUrl = '../controllers/getPlayerProfile.php';
    
    if (perfilId) {
        apiUrl += '?id=' + perfilId;
    } else if (perfilApelido) {
        apiUrl += '?apelido=' + encodeURIComponent(perfilApelido);
    } else {
        apiUrl += '?id=<?php echo $_SESSION['id']; ?>';
    }
    
    console.log('Carregando perfil da URL:', apiUrl);
    
    // Fazer a requisição para a API
    fetch(apiUrl)
      .then(response => response.json())
      .then(data => {
        console.log('Dados recebidos:', data);
        
        // Atualizar informações básicas do usuário
        if (data.user) {
          document.getElementById('name_user').textContent = data.user.nome || 'Nome não informado';
          document.getElementById('email_user').textContent = data.user.email || 'Email não informado';
          document.getElementById('tel_user').textContent = data.user.telefone || 'Telefone não informado';
          
          if (data.user.foto_perfil && data.user.foto_perfil !== '../../public/images/profilePhotos/defaultPhoto') {
            document.getElementById('photo_user').src = data.user.foto_perfil;
          }
        }

        // Atualizar informações do jogador
        if (data.player) {
          document.getElementById('descricao_user').textContent = data.player.descricao || 'Descrição não informada';
          document.getElementById('apelido_user').textContent = data.player.apelido || 'Não informado';
          document.getElementById('peso_user').textContent = data.player.peso ? data.player.peso + ' kg' : 'Não informado';
          document.getElementById('altura_user').textContent = data.player.altura ? data.player.altura + ' m' : 'Não informado';
          document.getElementById('estilo_user').textContent = data.player.estiloJogo || 'Não informado';
          document.getElementById('pe_user').textContent = data.player.pe_dominante || 'Não informado';
          document.getElementById('posicao_user').textContent = data.player.posicao || 'Não informado';
          document.getElementById('status_user').textContent = data.player.status || 'Disponível';
          
          // Atualizar bio no banner
          document.getElementById('bio_user').textContent = data.player.descricao || 'Jogador em busca de oportunidades.';
        }

        // Atualizar idade
        if (data.idade) {
          document.getElementById('idade_user').textContent = data.idade + ' anos';
        }

        // Atualizar características
        atualizarCaracteristicas(data.caracteristicas || []);
        
        // Atualizar conquistas
        atualizarConquistas(data.conquistas || []);
        
        // Atualizar histórico de clubes
        atualizarHistoricoClubes(data.historico_clubes || []);

        // Carregar posts do jogador
        carregarPosts(data.posts || []);
      })
      .catch(error => {
        console.error('Erro ao carregar perfil:', error);
        alert('Erro ao carregar o perfil do jogador. Tente novamente.');
      });
  }

  function carregarPosts(posts) {
    const container = document.getElementById('posts-container');
    const id_user_logado = <?php echo $_SESSION['id'] ?? 0; ?>;
    
    if (posts.length === 0) {
      container.innerHTML = `
        <div class="empty-feed">
          <div class="empty-icon"><i class="fas fa-futbol"></i></div>
          <h3>Nenhum post ainda</h3>
          <p>Este jogador ainda não fez nenhuma postagem.</p>
        </div>
      `;
      return;
    }

    container.innerHTML = '';
    
    posts.forEach(post => {
      const curtido = post.usuario_curtiu > 0;
      const isOwner = post.id_user == id_user_logado;
      const timeAgo = calcularTempoDecorrido(post.criado_em);

      const postElement = document.createElement('article');
      postElement.className = 'post-card';
      postElement.setAttribute('data-post-id', post.id_post);
      
      postElement.innerHTML = `
        <header class="post-header">
          <div class="author-info">
            ${post.foto_perfil && post.foto_perfil !== '../../public/images/profilePhotos/defaultPhoto.png' ? 
              `<div class="author-avatar">
                <img src="${post.foto_perfil}" alt="${post.nome}">
              </div>` :
              `<div class="author-avatar avatar-letter">${post.nome.charAt(0).toUpperCase()}</div>`
            }
            <div class="author-details">
              <h4 class="author-name">${post.nome}</h4>
              <time class="post-time">${timeAgo}</time>
            </div>
          </div>
          ${isOwner ? `
            <div class="post-menu">
              <button class="menu-toggle"><i class="fas fa-ellipsis-h"></i></button>
              <div class="menu-dropdown">
                <button class="menu-item btn-editar-post" data-post-id="${post.id_post}">
                  <i class="fas fa-edit"></i> Editar
                </button>
                <button class="menu-item btn-excluir-post" data-post-id="${post.id_post}">
                  <i class="fas fa-trash"></i> Excluir
                </button>
              </div>
            </div>
          ` : ''}
        </header>

        <div class="post-content">
          <p class="post-text" data-post-id="${post.id_post}">${post.conteudo}</p>
        </div>

        ${post.imagem ? `
          <div class="post-media">
            <img src="${post.imagem}" alt="Imagem do post" class="post-image" loading="lazy">
          </div>
        ` : ''}

        ${post.video_url ? `
          <div class="post-media">
            <div class="video-container">
              ${createVideoEmbed(post.video_url)}
            </div>
          </div>
        ` : ''}

        <footer class="post-actions">
          <div class="action-buttons">
            <button class="action-btn btn-curtir ${curtido ? 'active' : ''}" data-post-id="${post.id_post}">
              <i class="${curtido ? 'fas' : 'far'} fa-heart"></i>
              <span>${post.total_curtidas}</span>
            </button>

            <button class="action-btn btn-comentar" data-post-id="${post.id_post}">
              <i class="far fa-comment"></i>
              <span>${post.total_comentarios}</span>
            </button>


          </div>
        </footer>

        <div class="comments-section hidden" id="comentarios-${post.id_post}">
          <div class="comment-form">
            <input type="text" class="comment-input" placeholder="Escreva um comentário..." data-post-id="${post.id_post}">
            <button class="comment-submit" data-post-id="${post.id_post}">
              <i class="fas fa-paper-plane"></i>
            </button>
          </div>
          <div class="comments-list" id="comentarios-lista-${post.id_post}">
          </div>
        </div>
      `;
      
      container.appendChild(postElement);
    });

    // Adicionar event listeners - IGUAL DA HOME-PAGE
    adicionarEventListeners();
  }

  function calcularTempoDecorrido(dataPost) {
    const agora = new Date();
    const post = new Date(dataPost);
    const diff = agora.getTime() - post.getTime();
    const diffDays = Math.floor(diff / (1000 * 60 * 60 * 24));
    const diffHours = Math.floor(diff / (1000 * 60 * 60));
    const diffMinutes = Math.floor(diff / (1000 * 60));
    
    if (diffDays > 0) return diffDays + 'd';
    if (diffHours > 0) return diffHours + 'h';
    if (diffMinutes > 0) return diffMinutes + 'm';
    return 'agora';
  }

  function createVideoEmbed(url) {
    // YouTube
    if (url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/)) {
      const videoId = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/)[1];
      return `<iframe width="100%" height="315" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allowfullscreen></iframe>`;
    }
    
    // Vimeo
    if (url.match(/vimeo\.com\/(\d+)/)) {
      const videoId = url.match(/vimeo\.com\/(\d+)/)[1];
      return `<iframe width="100%" height="315" src="https://player.vimeo.com/video/${videoId}" frameborder="0" allowfullscreen></iframe>`;
    }
    
    return `<a href="${url}" target="_blank" class="video-link">
      <i class="fas fa-play-circle"></i> Ver vídeo
    </a>`;
  }

  // EVENT LISTENERS - COPIADOS DA HOME-PAGE
  function adicionarEventListeners() {

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

    // excluir post
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


    document.querySelectorAll('.comment-input').forEach(input => {
      input.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
          const postId = this.dataset.postId;
          document.querySelector(`.comment-submit[data-post-id="${postId}"]`).click();
        }
      });
    });


    document.addEventListener('click', (e) => {

      if (!e.target.closest('.post-menu')) {
        document.querySelectorAll('.menu-dropdown').forEach(menu => {
          menu.style.opacity = '0';
          menu.style.visibility = 'hidden';
          menu.style.transform = 'translateY(-10px)';
        });
      }
    });
  }


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

  function atualizarCaracteristicas(caracteristicas) {
    const container = document.getElementById('caracteristicas-container');
    
    if (caracteristicas.length === 0) {
      container.innerHTML = '<span class="tag">Nenhuma característica cadastrada</span>';
      return;
    }

    container.innerHTML = '';
    caracteristicas.forEach(carac => {
      const tag = document.createElement('span');
      tag.className = 'tag';
      tag.textContent = `${carac.caracteristica} (${carac.nivel})`;
      container.appendChild(tag);
    });
  }

  function atualizarConquistas(conquistas) {
    const container = document.getElementById('conquistas-container');
    
    if (conquistas.length === 0) {
      container.innerHTML = `
        <div class="conquista-item">
          <div class="conquista-icone">
            <i class="fas fa-info-circle"></i>
          </div>
          <div class="conquista-info">
            <h3>Nenhuma conquista cadastrada</h3>
            <span>Adicione suas conquistas no formulário de perfil</span>
          </div>
        </div>
      `;
      return;
    }

    container.innerHTML = '';
    conquistas.forEach(conquista => {
      const item = document.createElement('div');
      item.className = 'conquista-item';
      
      const icone = getIconeConquista(conquista.posicao);
      
      item.innerHTML = `
        <div class="conquista-icone">
          <i class="${icone}"></i>
        </div>
        <div class="conquista-info">
          <h3>${conquista.titulo}</h3>
          <span>${conquista.ano}${conquista.clube ? ' • ' + conquista.clube : ''}</span>
          ${conquista.descricao ? `<p>${conquista.descricao}</p>` : ''}
        </div>
      `;
      
      container.appendChild(item);
    });
  }

  function atualizarHistoricoClubes(historico) {
    const container = document.getElementById('historico-container');
    
    if (historico.length === 0) {
      container.innerHTML = `
        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <div class="timeline-content">
            <h3>Nenhum histórico cadastrado</h3>
            <span class="timeline-periodo">Adicione seu histórico no formulário</span>
          </div>
        </div>
      `;
      return;
    }

    container.innerHTML = '';
    historico.forEach(clube => {
      const item = document.createElement('div');
      item.className = 'timeline-item';
      
      const dataInicio = new Date(clube.data_inicio).getFullYear();
      const dataFim = clube.data_fim ? new Date(clube.data_fim).getFullYear() : 'Atual';
      const periodo = `${dataInicio} - ${dataFim}`;
      
      item.innerHTML = `
        <div class="timeline-dot ${clube.ativo ? 'ativo' : ''}"></div>
        <div class="timeline-content">
          <h3>${clube.nome_clube}</h3>
          <span class="timeline-periodo">${periodo}</span>
          ${clube.posicao ? `<p><strong>Posição:</strong> ${clube.posicao}</p>` : ''}
          ${clube.descricao ? `<p>${clube.descricao}</p>` : ''}
        </div>
      `;
      
      container.appendChild(item);
    });
  }

  function getIconeConquista(posicao) {
    switch(posicao) {
      case 'campeao':
        return 'fas fa-trophy';
      case 'vice':
        return 'fas fa-medal';
      case 'terceiro':
        return 'fas fa-award';
      case 'destaque':
        return 'fas fa-star';
      default:
        return 'fas fa-certificate';
    }
  }
</script>

<style>


/* Feed de posts - CENTRALIZADO */
.posts-feed {
  width: 100%;
  max-width: 1000px;
  background: var(--branco);
  border-radius: 20px;
  overflow: hidden;
  box-shadow: var(--sombra-media);
  border: 1px solid rgba(6, 163, 72, 0.1);
  margin: 2rem auto 0;
}

.feed-header {
  background: var(--gradiente-navbar);
  color: var(--branco);
  padding: 1.5rem 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.feed-header h2 {
  font-size: 1.5rem;
  font-weight: 600;
  color: var(--branco) !important; 
}

/* Posts */
.posts {
  padding: 1rem;
}

.post-card {
  background: var(--branco);
  border-radius: 15px;
  margin-bottom: 1.5rem;
  overflow: hidden;
  box-shadow: var(--sombra-suave);
  border: 1px solid var(--cor-primaria);
  transition: var(--transicao);
  border-left: 4px solid var(--verde);
}

.post-card:hover {
  transform: translateY(-3px);
  box-shadow: var(--sombra-media);
  border-left-color: var(--verde-escuro);
}

.post-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem 1.5rem 1rem;
}

.author-info {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.author-avatar {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: var(--gradiente-verde);
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  box-shadow: var(--sombra-suave);
}

.author-avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.author-avatar.avatar-letter {
  color: var(--branco);
  font-weight: 600;
  font-size: 1.2rem;
}

.author-name {
  font-size: 1rem;
  font-weight: 600;
  color: var(--cor-secundaria);
  margin-bottom: 0.25rem;
}

.post-time {
  font-size: 0.8rem;
  color: var(--cinza);
}

.post-menu {
  position: relative;
}

.menu-toggle {
  background: none;
  border: none;
  color: var(--cinza);
  cursor: pointer;
  padding: 0.5rem;
  border-radius: 50%;
  transition: var(--transicao);
}

.menu-toggle:hover {
  background: var(--cor-primaria);
  color: var(--verde);
}

.menu-dropdown {
  position: absolute;
  top: 100%;
  right: 0;
  background: var(--branco);
  border-radius: 10px;
  box-shadow: var(--sombra-media);
  border: 1px solid var(--cor-primaria);
  min-width: 150px;
  z-index: 10;
  opacity: 0;
  visibility: hidden;
  transform: translateY(-10px);
  transition: var(--transicao);
}

.menu-toggle:focus + .menu-dropdown,
.menu-dropdown:hover {
  opacity: 1;
  visibility: visible;
  transform: translateY(0);
}

.menu-item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  width: 100%;
  padding: 0.75rem 1rem;
  background: none;
  border: none;
  text-align: left;
  cursor: pointer;
  transition: var(--transicao);
  font-size: 0.9rem;
  color: var(--cor-secundaria);
}

.menu-item:hover {
  background: var(--cor-primaria);
  color: var(--verde);
}

.menu-item:first-child {
  border-radius: 10px 10px 0 0;
}

.menu-item:last-child {
  border-radius: 0 0 10px 10px;
}

.post-content {
  padding: 0 1.5rem 1rem;
}

.post-text {
  font-size: 1rem;
  line-height: 1.6;
  color: var(--cor-secundaria);
  white-space: pre-wrap;
}

.post-media {
  margin: 1rem 0;
  border-radius: 10px;
  overflow: hidden;
}

.post-image {
  width: 100%;
  max-height: 50vh;
  display: block;
  transition: var(--transicao);
  object-fit: contain;
}

.post-image:hover {
  transform: scale(1.02);
}

/* Vídeos */
.video-container {
  margin: 1rem 0;
  border-radius: 10px;
  overflow: hidden;
}

.video-container iframe {
  width: 100%;
  height: 315px;
  border: none;
}

.video-link {
  margin: 1rem 0;
  text-align: center;
}

.video-link a {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  background: var(--gradiente-verde);
  color: white;
  padding: 1rem 2rem;
  border-radius: 25px;
  text-decoration: none;
  font-weight: 600;
  transition: var(--transicao);
}

.video-link a:hover {
  transform: translateY(-2px);
  box-shadow: var(--sombra-media);
}

.post-actions {
  padding: 1rem 1.5rem;
  border-top: 1px solid var(--cor-primaria);
  background: #fafafa;
}

.action-buttons {
  display: flex;
  gap: 1rem;
}

.action-btn {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  background: none;
  border: none;
  color: var(--cinza);
  cursor: pointer;
  padding: 0.5rem 1rem;
  border-radius: 20px;
  transition: var(--transicao);
  font-size: 0.9rem;
}

.action-btn:hover {
  background: var(--branco);
  color: var(--verde);
  transform: translateY(-2px);
  box-shadow: var(--sombra-suave);
}

.action-btn.active {
  color: #e53e3e;
  background: rgba(229, 62, 62, 0.1);
}

.action-btn i {
  font-size: 1.1rem;
}

/* Comentários */
.comments-section {
  border-top: 1px solid var(--cor-primaria);
  background: #fafafa;
  padding: 1rem 1.5rem;
}

.comment-form {
  display: flex;
  gap: 0.75rem;
  margin-bottom: 1rem;
}

.comment-input {
  flex: 1;
  padding: 0.75rem 1rem;
  border: 1px solid var(--cor-primaria);
  border-radius: 20px;
  background: var(--branco);
  font-size: 0.9rem;
  transition: var(--transicao);
}

.comment-input:focus {
  outline: none;
  border-color: var(--verde);
  box-shadow: 0 0 0 3px rgba(0, 200, 83, 0.1);
}

.comment-submit {
  background: var(--gradiente-verde);
  color: var(--branco);
  border: none;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  cursor: pointer;
  transition: var(--transicao);
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: var(--sombra-suave);
}

.comment-submit:hover {
  transform: scale(1.1);
  box-shadow: var(--sombra-media);
}

.comment-item {
  background: var(--branco);
  padding: 1rem;
  border-radius: 10px;
  margin-bottom: 0.5rem;
  border-left: 3px solid var(--verde);
  transition: var(--transicao);
  box-shadow: var(--sombra-suave);
}

.comment-item:hover {
  transform: translateX(5px);
  box-shadow: var(--sombra-media);
}

.comment-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.5rem;
}

.comment-author {
  font-weight: 600;
  color: var(--verde);
  font-size: 0.9rem;
}

.comment-time {
  color: var(--cinza);
  font-size: 0.8rem;
}

.comment-content {
  color: var(--cor-secundaria);
  line-height: 1.5;
  font-size: 0.9rem;
}

/* Estado vazio */
.empty-feed {
  text-align: center;
  padding: 4rem 2rem;
  color: var(--cinza);
}

.empty-icon {
  font-size: 4rem;
  margin-bottom: 1rem;
  opacity: 0.5;
  color: var(--verde-claro);
}

.empty-feed h3 {
  font-size: 1.5rem;
  margin-bottom: 0.5rem;
  color: var(--cor-secundaria);
  font-family: var(--fonte-titulo-moderna);
}

/* Loading state */
.loading-posts {
  text-align: center;
  padding: 2rem;
  color: var(--cinza);
}

.loading-posts i {
  font-size: 2rem;
  margin-bottom: 1rem;
  color: var(--verde);
  animation: spin 1s linear infinite;
}

@keyframes spin {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

/* Utilitários */
.hidden {
  display: none !important;
}

/* Animações */
@keyframes slideInRight {
  from {
    opacity: 0;
    transform: translateX(100%);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes slideOutRight {
  from {
    opacity: 1;
    transform: translateX(0);
  }
  to {
    opacity: 0;
    transform: translateX(100%);
  }
}

@keyframes slideOutUp {
  from {
    opacity: 1;
    transform: translateY(0);
  }
  to {
    opacity: 0;
    transform: translateY(-30px);
  }
}

@keyframes slideInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.post-card {
  animation: slideInUp 0.5s ease-out;
}

/* Responsividade */
@media (max-width: 768px) {
  .feed-header {
    flex-direction: column;
    gap: 1rem;
    text-align: center;
  }

  .action-buttons {
    justify-content: space-around;
  }
}

@media (max-width: 480px) {
  .post-card {
    margin: 0 -0.5rem 1rem;
    border-radius: 10px;
  }

  .post-header {
    padding: 1rem;
    flex-direction: column;
    gap: 1rem;
  }

  .action-btn span {
    display: none;
  }
}

  .video-input {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 1rem;
  }

  .video-url-input {
    flex: 1;
    padding: 0.75rem 1rem;
    border: 2px solid var(--cor-primaria);
    border-radius: 10px;
    font-size: 0.9rem;
    transition: var(--transicao);
  }

  .video-url-input:focus {
    outline: none;
    border-color: var(--verde);
    box-shadow: 0 0 0 3px rgba(0, 200, 83, 0.1);
  }

  .remove-video-btn {
    background: #ff4757;
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    transition: var(--transicao);
  }

  .remove-video-btn:hover {
    background: #ff3742;
    transform: scale(1.1);
  }

  .media-btn.active {
    background: var(--verde-claro);
    color: var(--branco);
    border-color: var(--verde);
  }

  .tag {
    background: #e3f2fd;
    color: #1976d2;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 14px;
    margin: 5px;
    display: inline-block;
  }
  
  .timeline-dot.ativo {
    background: #4CAF50;
    box-shadow: 0 0 0 4px rgba(76, 175, 80, 0.3);
  }
  
  .conquista-icone i {
    font-size: 24px;
  }
  
  .conquista-icone .fa-trophy {
    color: #FFD700;
  }
  
  .conquista-icone .fa-medal {
    color: #C0C0C0;
  }
  
  .conquista-icone .fa-award {
    color: #CD7F32;
  }
  
  .conquista-icone .fa-star {
    color: #FF6B35;
  }
  
  .conquista-icone .fa-certificate {
    color: #4CAF50;
  }
  
  /* Estilo para o botão de editar perfil */
  .btn-principal {
    display: inline-block;
    background: linear-gradient(135deg, #00c853, #00a843);
    color: white;
    padding: 10px 20px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-right: 10px;
  }
  
  .btn-principal:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    background: linear-gradient(135deg, #00b84d, #00973d);
  }
  
  .btn-secundario {
    display: inline-block;
    background: linear-gradient(135deg, #2196f3, #1976d2);
    color: white;
    padding: 10px 20px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }
  
  .btn-secundario:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    background: linear-gradient(135deg, #1e88e5, #1565c0);
  }
</style>

<?php include("footer.php"); ?>

</body>
</html>
