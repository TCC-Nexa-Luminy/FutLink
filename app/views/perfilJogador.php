<?php include('topo.php'); ?>
<title>Perfil do Jogador - FutLink</title>
<link rel="stylesheet" href="../../public/css/perfilJogador.css">

<?php 
include 'navbar-social.php';

// Verificar se há um parâmetro de ID na URL (para visualizar perfil de outro jogador)
$perfil_id = isset($_GET['id']) ? intval($_GET['id']) : $_SESSION['id'];

// Flag para verificar se o usuário está visualizando seu próprio perfil
$proprio_perfil = ($perfil_id == $_SESSION['id']);

// Verificar se o usuário atual é um jogador
require_once("../../config/connect.php");
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
          <!-- Botão de Editar Perfil - só aparece se for o próprio perfil -->
          <a href="editarPerfilJogador.php" class="btn-principal">
            <i class="fas fa-edit"></i> Editar Perfil
          </a>
        <?php else: ?>
          <!-- Botões para interagir com outros jogadores -->
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

  <section class="card posts">
    <h2><i class="fas fa-stream"></i> Minhas Postagens</h2>
    <div class="posts-lista">
      <div class="post">
        <div class="post-header">
          <img src="https://via.placeholder.com/50" alt="Foto de perfil">
          <div class="post-info">
            <h3 id="post-name">Nome do Jogador</h3>
            <span class="post-data">Publicado há 1 hora</span>
          </div>
        </div>
        <div class="post-conteudo">
          <p>Gol na final do campeonato! Me dediquei bastante para esse momento.</p>
          <img src="https://via.placeholder.com/600x300" alt="Gol">
        </div>
        <div class="post-acoes">
          <button class="curtir"><i class="far fa-heart"></i> 42 Curtidas</button>
          <button class="comentar"><i class="far fa-comment"></i> 8 Comentários</button>
          <button class="compartilhar"><i class="far fa-share-square"></i> Compartilhar</button>
        </div>
      </div>
    </div>
    <button class="btn-mais">Carregar mais posts</button>
  </section>
</div>

<script src="../../public/js/perfilJogador.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Código para as abas da galeria expandida
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

    // Efeito de hover nas galerias
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

    // Carregar dados do perfil
    carregarPerfilJogador();
  });

  function carregarPerfilJogador() {
    // Verificar se há um ID na URL
    const urlParams = new URLSearchParams(window.location.search);
    const perfilId = urlParams.get('id') || '<?php echo $_SESSION['id']; ?>';
    
    // Passar o ID como parâmetro para a API
    fetch('../controllers/getPlayerProfile.php?id=' + perfilId)
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
      })
      .catch(error => {
        console.error('Erro ao carregar perfil:', error);
      });
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
