<?php include('topo.php'); ?>
<title>Perfil do Jogador - FutLink</title>
<link rel="stylesheet" href="../../public/css/perfilJogador.css">

<body>
  <?php include 'navbar-social.php'; ?>

  <section class="banner">
    <div class="banner-overlay"></div>
    <div class="banner-container">
      <div class="banner-img">
        <img src="../../public/images/profilePhotos/default" alt="Foto do Jogador" id="photo_user"/>
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
        <p class="bio">Atacante com foco em finalização e velocidade. Buscando oportunidades para crescer profissionalmente.</p>
        <div class="contato-info">
          <div class="contato-item">
            <i class="fas fa-envelope"></i>
            <span id="email_user">robsonbambu@gmail.com</span>
          </div>
          <div class="contato-item">
            <i class="fas fa-phone"></i>
            <span id="tel_user">(11) 99999-9999</span>
          </div>
          <div class="contato-item">
            <i class="fas fa-map-marker-alt"></i>
            <span>São Paulo, SP</span>

          </div>
        </div>
        <div class="acoes">
          <button class="btn-principal"><i class="fas fa-paper-plane"></i> Enviar Mensagem</button>
          <button class="btn-secundario"><i class="fas fa-user-plus"></i> Seguir</button>
        </div>
      </div>
    </div>
  </section>

  <div class="container">
    <section class="card galeria-expandida destaque-midia">
      <h2><i class="fas fa-photo-film"></i> Portfólio de Mídia</h2>
      <div class="galeria-tabs">
        <button class="tab-btn ativo" data-tab="fotos">Fotos</button>
        <button class="tab-btn" data-tab="videos">Vídeos</button>
      </div>

      <div class="tab-content ativo" id="fotos">
        <div class="galeria-grid-expandida">
          <div class="galeria-item destaque">
            <img src="campeao.png" alt="Lance decisivo">
            <div class="galeria-overlay">
              <span>Lance decisivo - Final do Campeonato</span>
            </div>
          </div>
          <div class="galeria-item medio">
            <img src="https://via.placeholder.com/400x300" alt="Drible">
            <div class="galeria-overlay">
              <span>Drible em partida oficial</span>
            </div>
          </div>
          <div class="galeria-item medio">
            <img src="https://via.placeholder.com/400x300" alt="Comemoração">
            <div class="galeria-overlay">
              <span>Comemoração após gol</span>
            </div>
          </div>
          <div class="galeria-item">
            <img src="https://via.placeholder.com/300x200" alt="Treino">
            <div class="galeria-overlay">
              <span>Treino físico</span>
            </div>
          </div>
          <div class="galeria-item">
            <img src="https://via.placeholder.com/300x200" alt="Aquecimento">
            <div class="galeria-overlay">
              <span>Aquecimento pré-jogo</span>
            </div>
          </div>
          <div class="galeria-item">
            <img src="https://via.placeholder.com/300x200" alt="Passe">
            <div class="galeria-overlay">
              <span>Passe decisivo</span>
            </div>
          </div>
          <div class="galeria-item">
            <img src="https://via.placeholder.com/300x200" alt="Cabeceio">
            <div class="galeria-overlay">
              <span>Cabeceio</span>
            </div>
          </div>
          <div class="galeria-item">
            <img src="https://via.placeholder.com/300x200" alt="Finalização">
            <div class="galeria-overlay">
              <span>Finalização</span>
            </div>
          </div>
          <div class="galeria-item">
            <img src="https://via.placeholder.com/300x200" alt="Marcação">
            <div class="galeria-overlay">
              <span>Marcação</span>
            </div>
          </div>
          <div class="galeria-item">
            <img src="https://via.placeholder.com/300x200" alt="Jogada individual">
            <div class="galeria-overlay">
              <span>Jogada individual</span>
            </div>
          </div>
          <div class="galeria-item">
            <img src="https://via.placeholder.com/300x200" alt="Cobrança de falta">
            <div class="galeria-overlay">
              <span>Cobrança de falta</span>
            </div>
          </div>
          <div class="galeria-item">
            <img src="https://via.placeholder.com/300x200" alt="Disputa de bola">
            <div class="galeria-overlay">
              <span>Disputa de bola</span>
            </div>
          </div>
        </div>
        <button class="btn-mais">Ver mais fotos</button>
      </div>

      <div class="tab-content" id="videos">
        <div class="videos-lista-expandida">
          <div class="video-item">
            <div class="video-container">
              <video controls poster="https://via.placeholder.com/800x450">
                <source src="#" type="video/mp4">
                Seu navegador não suporta a tag de vídeo.
              </video>
              <div class="video-overlay">
                <i class="fas fa-play-circle"></i>
              </div>
            </div>
            <div class="video-info">
              <h3>Melhores momentos - Campeonato Regional 2023</h3>
              <span>Duração: 2:45 • 1.2K visualizações</span>
            </div>
          </div>

          <div class="video-item">
            <div class="video-container">
              <video controls poster="https://via.placeholder.com/800x450">
                <source src="#" type="video/mp4">
                Seu navegador não suporta a tag de vídeo.
              </video>
              <div class="video-overlay">
                <i class="fas fa-play-circle"></i>
              </div>
            </div>
            <div class="video-info">
              <h3>Gol decisivo na final do campeonato</h3>
              <span>Duração: 0:48 • 3.5K visualizações</span>
            </div>
          </div>

          <div class="video-item">
            <div class="video-container">
              <video controls poster="https://via.placeholder.com/800x450">
                <source src="#" type="video/mp4">
                Seu navegador não suporta a tag de vídeo.
              </video>
              <div class="video-overlay">
                <i class="fas fa-play-circle"></i>
              </div>
            </div>
            <div class="video-info">
              <h3>Treino de finalização - Preparação para o campeonato</h3>
              <span>Duração: 1:32 • 856 visualizações</span>
            </div>
          </div>

          <div class="video-item">
            <div class="video-container">
              <video controls poster="https://via.placeholder.com/800x450">
                <source src="#" type="video/mp4">
                Seu navegador não suporta a tag de vídeo.
              </video>
              <div class="video-overlay">
                <i class="fas fa-play-circle"></i>
              </div>
            </div>
            <div class="video-info">
              <h3>Entrevista pós-jogo - Semifinal do Campeonato</h3>
              <span>Duração: 3:15 • 742 visualizações</span>
            </div>
          </div>

          <div class="video-item">
            <div class="video-container">
              <video controls poster="https://via.placeholder.com/800x450">
                <source src="#" type="video/mp4">
                Seu navegador não suporta a tag de vídeo.
              </video>
              <div class="video-overlay">
                <i class="fas fa-play-circle"></i>
              </div>
            </div>
            <div class="video-info">
              <h3>Compilação de dribles e finalizações - Temporada 2023</h3>
              <span>Duração: 4:27 • 2.1K visualizações</span>
            </div>
          </div>

          <div class="video-item">
            <div class="video-container">
              <video controls poster="https://via.placeholder.com/800x450">
                <source src="#" type="video/mp4">
                Seu navegador não suporta a tag de vídeo.
              </video>
              <div class="video-overlay">
                <i class="fas fa-play-circle"></i>
              </div>
            </div>
            <div class="video-info">
              <h3>Treinamento específico - Aprimorando a finalização</h3>
              <span>Duração: 2:18 • 635 visualizações</span>
            </div>
          </div>
        </div>
        <button class="btn-mais">Ver mais vídeos</button>
      </div>
    </section>

    <div class="grid-flex">
      <div class="coluna-flex">
        <section class="card sobre">
          <h2><i class="fas fa-user"></i> Sobre Mim</h2>
          <div class="texto-sobre">
            <p id="descricao_user">
              Sou um jogador dedicado e apaixonado por futebol, sempre em busca de novos desafios e oportunidades para crescer e melhorar. Tenho uma forte ética de trabalho, e minha mentalidade de equipe sempre se destaca dentro e fora de campo.
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
                <span class="info-valor" id="apelido_user">Juninho</span>
              </div>
            </div>
            <div class="info-item">
              <i class="fas fa-birthday-cake"></i>
              <div class="info-content">
                <span class="info-label">Idade</span>
                <span class="info-valor" id="idade_user">17 anos</span>
              </div>
            </div>
            <div class="info-item">
              <i class="fas fa-weight"></i>
              <div class="info-content">
                <span class="info-label">Peso</span>
                <span class="info-valor" id="peso_user">68 kg</span>
              </div>
            </div>
            <div class="info-item">
              <i class="fas fa-ruler-vertical"></i>
              <div class="info-content">
                <span class="info-label">Altura</span>
                <span class="info-valor" id="altura_user">1.78 m</span>
              </div>
            </div>
            <div class="info-item">
              <i class="fas fa-fire"></i>
              <div class="info-content">
                <span class="info-label">Estilo</span>
                <span class="info-valor" id="estilo_user">Raçudo 1</span>
              </div>
            </div>
            <div class="info-item">
              <i class="fas fa-shoe-prints"></i>
              <div class="info-content">
                <span class="info-label">Pé dominante</span>
                <span class="info-valor" id="pe_user">Direito1</span>
              </div>
            </div>
            <div class="info-item">
              <i class="fas fa-futbol"></i>
              <div class="info-content">
                <span class="info-label">Posição</span>
                <span class="info-valor" id="posicao_user">Atacante</span>
              </div>
            </div>
          </div>
        </section>

        <section class="card caracteristicas">
          <h2><i class="fas fa-list-check"></i> Características de Jogo</h2>
          <div class="tags-container">
            <span class="tag">Velocidade</span>
            <span class="tag">Finalização</span>
            <span class="tag">Drible</span>
            <span class="tag">Cabeceio</span>
            <span class="tag">Passe curto</span>
            <span class="tag">Resistência</span>
            <span class="tag">Posicionamento</span>
            <span class="tag">Visão de jogo</span>
            <span class="tag">Marcação</span>
            <span class="tag">Cruzamento</span>
          </div>
        </section>
      </div>

      <div class="coluna-flex">
        <section class="card disponibilidade">
          <h2><i class="fas fa-calendar-check"></i> Disponibilidade para Testes</h2>
          <div class="disponibilidade-info">
            <div class="disponibilidade-item">
              <i class="fas fa-check-circle"></i>
              <span>Disponível para testes em São Paulo e região</span>
            </div>
            <div class="disponibilidade-item">
              <i class="fas fa-check-circle"></i>
              <span>Disponível para viagens nacionais</span>
            </div>
            <div class="disponibilidade-item">
              <i class="fas fa-check-circle"></i>
              <span>Preferência por testes aos finais de semana</span>
            </div>
            <div class="disponibilidade-item">
              <i class="fas fa-info-circle"></i>
              <span>Atualmente sem vínculo contratual</span>
            </div>
          </div>
        </section>

        <section class="card conquistas">
          <h2><i class="fas fa-medal"></i> Conquistas e Títulos</h2>
          <div class="conquistas-lista">
            <div class="conquista-item">
              <div class="conquista-icone">
                <i class="fas fa-trophy"></i>
              </div>
              <div class="conquista-info">
                <h3>Campeão Regional Sub-17</h3>
                <span>2023 • Juventude FC</span>
                <p>Artilheiro da competição com 8 gols em 10 jogos.</p>
              </div>
            </div>
            <div class="conquista-item">
              <div class="conquista-icone">
                <i class="fas fa-medal"></i>
              </div>
              <div class="conquista-info">
                <h3>Vice-Campeão Estadual Sub-15</h3>
                <span>2021 • Escolinha Craques do Futuro</span>
                <p>Eleito revelação da competição.</p>
              </div>
            </div>
            <div class="conquista-item">
              <div class="conquista-icone">
                <i class="fas fa-award"></i>
              </div>
              <div class="conquista-info">
                <h3>Melhor Jogador do Torneio Escolar</h3>
                <span>2019 • Colégio São Francisco</span>
                <p>5 gols e 3 assistências durante a competição.</p>
              </div>
            </div>
          </div>
        </section>

        <section class="card historico">
          <h2><i class="fas fa-history"></i> Histórico de Clubes</h2>
          <div class="timeline">
            <div class="timeline-item">
              <div class="timeline-dot"></div>
              <div class="timeline-content">
                <h3>Juventude FC</h3>
                <span class="timeline-periodo">2023 - Atual</span>
                <p>Atacante titular no time sub-17, participando do campeonato estadual.</p>
              </div>
            </div>
            <div class="timeline-item">
              <div class="timeline-dot"></div>
              <div class="timeline-content">
                <h3>Escolinha Craques do Futuro</h3>
                <span class="timeline-periodo">2020 - 2022</span>
                <p>Formação nas categorias de base, com destaque no campeonato regional.</p>
              </div>
            </div>
            <div class="timeline-item">
              <div class="timeline-dot"></div>
              <div class="timeline-content">
                <h3>Início no Futebol</h3>
                <span class="timeline-periodo">2018 - 2020</span>
                <p>Primeiros passos no futebol amador e participação em torneios escolares.</p>
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
              <h3>Robson Bambu</h3>
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

        <div class="post">
          <div class="post-header">
            <img src="https://via.placeholder.com/50" alt="Foto de perfil">
            <div class="post-info">
              <h3>Robson Bambu</h3>
              <span class="post-data">Publicado há 2 horas</span>
            </div>
          </div>
          <div class="post-conteudo">
            <p>Treino de finalização de hoje. Foco total!</p>
            <div class="video-container">
              <video controls poster="https://via.placeholder.com/600x300">
                <source src="#" type="video/mp4">
                Seu navegador não suporta a tag de vídeo.
              </video>
            </div>
          </div>
          <div class="post-acoes">
            <button class="curtir"><i class="far fa-heart"></i> 38 Curtidas</button>
            <button class="comentar"><i class="far fa-comment"></i> 5 Comentários</button>
            <button class="compartilhar"><i class="far fa-share-square"></i> Compartilhar</button>
          </div>
        </div>

        <div class="post">
          <div class="post-header">
            <img src="https://via.placeholder.com/50" alt="Foto de perfil">
            <div class="post-info">
              <h3>Robson Bambu</h3>
              <span class="post-data">Publicado há 3 horas</span>
            </div>
          </div>
          <div class="post-conteudo">
            <p>Momento de descontração após o jogo com a galera!</p>
            <img src="https://via.placeholder.com/600x300" alt="Descontração">
          </div>
          <div class="post-acoes">
            <button class="curtir"><i class="far fa-heart"></i> 56 Curtidas</button>
            <button class="comentar"><i class="far fa-comment"></i> 12 Comentários</button>
            <button class="compartilhar"><i class="far fa-share-square"></i> Compartilhar</button>
          </div>
        </div>
      </div>
      <button class="btn-mais">Carregar mais posts</button>
    </section>
  </div>

  <footer class="footer">
    <div class="footer-grid">
      <div class="footer-col brand">
        <h2>Fut<span>Link</span></h2>
        <p>Conectando talentos ao futuro do futebol.</p>
      </div>

      <div class="footer-col">
        <h3>Plataforma</h3>
        <ul>
          <li><a href="#">Perfil do Jogador</a></li>
          <li><a href="#">Peneiras</a></li>
          <li><a href="#">Empresários</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h3>Institucional</h3>
        <ul>
          <li><a href="#">Sobre Nós</a></li>
          <li><a href="#">Contato</a></li>
          <li><a href="#">Termos e Privacidade</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h3>Redes</h3>
        <div class="footer-social">
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
    <div class="footer-copy">
      &copy; 2025 <strong>FutLink</strong> — Todos os direitos reservados.
    </div>
  </footer>

  <script src="../../public/js/perfilJogador.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // codigo para as abas da galeria expandida
      const tabBtns = document.querySelectorAll('.tab-btn');
      const tabContents = document.querySelectorAll('.tab-content');

      tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
          // remove a classe ativo de todos os botões e conteúdos
          tabBtns.forEach(b => b.classList.remove('ativo'));
          tabContents.forEach(c => c.classList.remove('ativo'));

          // adiciona a classe ativo ao botão clicado
          btn.classList.add('ativo');

          // adiciona a classe ativo ao conteúdo correspondente
          const tabId = btn.getAttribute('data-tab');
          document.getElementById(tabId).classList.add('ativo');
        });
      });

      // efeito de hover nas galerias
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
    });
  </script>
</body>

</html>