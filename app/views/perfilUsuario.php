<?php include('topo.php'); ?>
<title>Perfil do Usuário - FutLink</title>
<link rel="stylesheet" href="../../public/css/perfilJogador.css">

<?php 
include 'navbar-social.php';

// Incluir conexão com banco ANTES de usar $conn
require_once("../../config/connect.php");

// Verificar se há um parâmetro de ID na URL (para visualizar perfil de outro usuário)
$perfil_id = isset($_GET['id']) ? intval($_GET['id']) : $_SESSION['id'];

// Flag para verificar se o usuário está visualizando seu próprio perfil
$proprio_perfil = ($perfil_id == $_SESSION['id']);
?>

<section class="banner">
  <div class="banner-overlay"></div>
  <div class="banner-container">
    <div class="banner-img">
      <img src="../../public/images/profilePhotos/defaultPhoto.png" alt="Foto do Usuário" id="photo_user" />
      <div class="status-badge" id="status_user">Ativo</div>
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
          <a href="#" class="btn-principal">
            <i class="fas fa-edit"></i> Editar Perfil
          </a>
          <a href="playerForm.php" class="btn-secundario">
            <i class="fas fa-futbol"></i> Virar Jogador
          </a>
        <?php else: ?>
          <button class="btn-principal"><i class="fas fa-paper-plane"></i> Enviar Mensagem</button>
          <button class="btn-secundario"><i class="fas fa-user-plus"></i> Seguir</button>
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
            Este usuário ainda não adicionou uma descrição.
          </p>
        </div>
      </section>

      <section class="card info-jogador">
        <h2><i class="fas fa-id-card"></i> Informações Pessoais</h2>
        <div class="info-grid">
          <div class="info-item">
            <i class="fas fa-birthday-cake"></i>
            <div class="info-content">
              <span class="info-label">Idade</span>
              <span class="info-valor" id="idade_user">- anos</span>
            </div>
          </div>
          <div class="info-item">
            <i class="fas fa-calendar-alt"></i>
            <div class="info-content">
              <span class="info-label">Membro desde</span>
              <span class="info-valor" id="created_at">-</span>
            </div>
          </div>
        </div>
      </section>
    </div>

    <div class="coluna-flex">
      <section class="card">
        <h2><i class="fas fa-info-circle"></i> Torne-se um Jogador</h2>
        <div class="texto-sobre">
          <p>
            Você ainda não é um jogador no FutLink. Complete seu perfil de jogador para ter acesso a todas as funcionalidades da plataforma!
          </p>
          <div style="text-align: center; margin-top: 20px;">
            <a href="playerForm.php" class="btn-principal">
              <i class="fas fa-futbol"></i> Criar Perfil de Jogador
            </a>
          </div>
        </div>
      </section>
    </div>
  </div>

  <section class="card posts">
    <h2><i class="fas fa-stream"></i> Minhas Postagens</h2>
    <div class="posts-lista" id="posts-container">
      <!-- Posts serão carregados aqui via JavaScript -->
      <div class="loading-posts">
        <i class="fas fa-spinner fa-spin"></i>
        <p>Carregando posts...</p>
      </div>
    </div>
    <button class="btn-mais" id="load-more-posts" style="display: none;">Carregar mais posts</button>
  </section>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    carregarPerfilUsuario();
  });

  function carregarPerfilUsuario() {
    const urlParams = new URLSearchParams(window.location.search);
    const perfilId = urlParams.get('id') || '<?php echo $_SESSION['id']; ?>';
    
    fetch('../controllers/getUserProfile.php?id=' + perfilId)
      .then(response => response.json())
      .then(data => {
        console.log('Dados recebidos:', data);
        
        // Atualizar informações básicas do usuário
        if (data.user) {
          document.getElementById('name_user').textContent = data.user.nome || 'Nome não informado';
          document.getElementById('email_user').textContent = data.user.email || 'Email não informado';
          document.getElementById('tel_user').textContent = data.user.telefone || 'Telefone não informado';
          document.getElementById('bio_user').textContent = data.user.bio || 'Este usuário ainda não adicionou uma descrição.';
          document.getElementById('descricao_user').textContent = data.user.bio || 'Este usuário ainda não adicionou uma descrição.';
          
          if (data.user.foto_perfil && data.user.foto_perfil !== '../../public/images/profilePhotos/defaultPhoto.png') {
            document.getElementById('photo_user').src = data.user.foto_perfil;
          }
          
          if (data.user.created_at) {
            const data_criacao = new Date(data.user.created_at);
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('created_at').textContent = data_criacao.toLocaleDateString('pt-BR', options);
          }
        }

        if (data.idade) {
          document.getElementById('idade_user').textContent = data.idade + ' anos';
        }

        // Carregar posts do usuário
        carregarPosts(data.posts || []);
      })
      .catch(error => {
        console.error('Erro ao carregar perfil:', error);
      });
  }

  function carregarPosts(posts) {
    const container = document.getElementById('posts-container');
    
    if (posts.length === 0) {
      container.innerHTML = `
        <div class="empty-posts">
          <i class="fas fa-newspaper"></i>
          <h3>Nenhum post ainda</h3>
          <p>Este usuário ainda não fez nenhuma postagem.</p>
        </div>
      `;
      return;
    }

    container.innerHTML = '';
    
    posts.forEach(post => {
      const postElement = document.createElement('div');
      postElement.className = 'post';
      
      // Calcular tempo decorrido
      const timeAgo = calcularTempoDecorrido(post.criado_em);
      
      postElement.innerHTML = `
        <div class="post-header">
          <img src="../../public/images/profilePhotos/defaultPhoto.png" alt="Foto de perfil" id="post-avatar">
          <div class="post-info">
            <h3 id="post-name">Nome do Usuário</h3>
            <span class="post-data">${timeAgo}</span>
          </div>
        </div>
        <div class="post-conteudo">
          <p>${post.conteudo}</p>
          ${post.imagem ? `<img src="${post.imagem}" alt="Imagem do post" class="post-image">` : ''}
          ${post.video_url ? createVideoEmbed(post.video_url) : ''}
        </div>
        <div class="post-acoes">
          <button class="curtir"><i class="far fa-heart"></i> ${post.total_curtidas} Curtidas</button>
          <button class="comentar"><i class="far fa-comment"></i> ${post.total_comentarios} Comentários</button>
          <button class="compartilhar"><i class="far fa-share-square"></i> Compartilhar</button>
        </div>
      `;
      
      container.appendChild(postElement);
    });
  }

  function calcularTempoDecorrido(dataPost) {
    const agora = new Date();
    const post = new Date(dataPost);
    const diff = Math.floor((agora - post) / 1000);
    
    if (diff < 60) return 'agora';
    if (diff < 3600) return Math.floor(diff / 60) + 'm';
    if (diff < 86400) return Math.floor(diff / 3600) + 'h';
    return Math.floor(diff / 86400) + 'd';
  }

  function createVideoEmbed(url) {
    // YouTube
    const youtubeMatch = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/);
    if (youtubeMatch) {
      return `<div class="video-container">
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/${youtubeMatch[1]}" frameborder="0" allowfullscreen></iframe>
      </div>`;
    }
    
    // Vimeo
    const vimeoMatch = url.match(/vimeo\.com\/(\d+)/);
    if (vimeoMatch) {
      return `<div class="video-container">
        <iframe width="100%" height="315" src="https://player.vimeo.com/video/${vimeoMatch[1]}" frameborder="0" allowfullscreen></iframe>
      </div>`;
    }
    
    return `<div class="video-link">
      <a href="${url}" target="_blank">
        <i class="fas fa-play-circle"></i> Ver vídeo
      </a>
    </div>`;
  }
</script>

<style>
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

  .loading-posts {
    text-align: center;
    padding: 2rem;
    color: var(--cinza);
  }

  .loading-posts i {
    font-size: 2rem;
    margin-bottom: 1rem;
    color: var(--verde);
  }

  .empty-posts {
    text-align: center;
    padding: 3rem;
    color: var(--cinza);
  }

  .empty-posts i {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: var(--verde-claro);
  }

  .empty-posts h3 {
    color: var(--cor-secundaria);
    margin-bottom: 0.5rem;
  }

  .post-image {
    width: 100%;
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    margin-top: 1rem;
  }

  /* Resto dos estilos existentes... */
  .tag {
    background: #e3f2fd;
    color: #1976d2;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 14px;
    margin: 5px;
    display: inline-block;
  }
  
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
