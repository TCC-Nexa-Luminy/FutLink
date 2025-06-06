<?php include('topo.php'); ?>
<title>Perfil do Usuário - FutLink</title>
<link rel="stylesheet" href="../../public/css/perfilJogador.css">

<?php 
include 'navbar-social.php';

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
          <!-- Botão de Editar Perfil - só aparece se for o próprio perfil -->
          <a href="#" class="btn-principal">
            <i class="fas fa-edit"></i> Editar Perfil
          </a>
          <!-- Botão de Virar Jogador - só aparece se for o próprio perfil -->
          <a href="playerForm.php" class="btn-secundario">
            <i class="fas fa-futbol"></i> Virar Jogador
          </a>
        <?php else: ?>
          <!-- Botões para interagir com outros usuários -->
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
    <div class="posts-lista">
      <div class="post">
        <div class="post-header">
          <img src="https://via.placeholder.com/50" alt="Foto de perfil">
          <div class="post-info">
            <h3 id="post-name">Nome do Usuário</h3>
            <span class="post-data">Publicado há 1 hora</span>
          </div>
        </div>
        <div class="post-conteudo">
          <p>Minha primeira postagem no FutLink!</p>
        </div>
        <div class="post-acoes">
          <button class="curtir"><i class="far fa-heart"></i> 5 Curtidas</button>
          <button class="comentar"><i class="far fa-comment"></i> 2 Comentários</button>
          <button class="compartilhar"><i class="far fa-share-square"></i> Compartilhar</button>
        </div>
      </div>
    </div>
    <button class="btn-mais">Carregar mais posts</button>
  </section>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Carregar dados do perfil
    carregarPerfilUsuario();
  });

  function carregarPerfilUsuario() {
    // Verificar se há um ID na URL
    const urlParams = new URLSearchParams(window.location.search);
    const perfilId = urlParams.get('id') || '<?php echo $_SESSION['id']; ?>';
    
    // Passar o ID como parâmetro para a API
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
          
          if (data.user.foto_perfil && data.user.foto_perfil !== '../../public/images/profilePhotos/defaultPhoto.png') {
            document.getElementById('photo_user').src = data.user.foto_perfil;
          }
          
          // Formatar data de criação da conta
          if (data.user.created_at) {
            const data = new Date(data.user.created_at);
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('created_at').textContent = data.toLocaleDateString('pt-BR', options);
          }
        }

        // Atualizar idade
        if (data.idade) {
          document.getElementById('idade_user').textContent = data.idade + ' anos';
        }
      })
      .catch(error => {
        console.error('Erro ao carregar perfil:', error);
      });
  }
</script>

<style>
  .tag {
    background: #e3f2fd;
    color: #1976d2;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 14px;
    margin: 5px;
    display: inline-block;
  }
  
  /* Estilo para os botões */
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

</body>
</html>
