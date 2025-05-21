<?php
  include("topo.php");
?>
<link rel="stylesheet" href="../../public/css/perfilJogador.css">
<body>

    <header class="navbar">
        <div class="navbar-container">
          <div class="logo">FutLink</div>
          <nav class="menu">
            <a href="#">Início</a>
            <a href="#">Sobre Nós</a>
            <a href="#">Contato</a>
            <a href="#">Perfil</a>
          </nav>
        </div>
      </header>
      
      <section class="banner">
        <div class="banner-overlay"></div>
        <div class="banner-container">
          <div class="banner-img">
            <img src="../../public/images/bambu.png" alt="Foto do Jogador" />
          </div>
          <div class="banner-info">
            <h1 id="nome_user">Robson Bambu</h1>
            <p>Vou acabar com a raça do meu próprio time memo</p>
            <p><strong>Contato:</strong> robsonbambu@gmail.com</p>
          </div>
        </div>
      </section>

  <div class="container-info">

    <div class="descricao">
      <h3>Sobre Mim</h3>
      <p>
        Sou um jogador dedicado e apaixonado por futebol, sempre em busca de novos desafios e oportunidades para crescer e melhorar. Tenho uma forte ética de trabalho, e minha mentalidade de equipe sempre se destaca dentro e fora de campo. Com foco em desenvolvimento contínuo, busco aprimorar minhas habilidades e alcançar novos patamares na minha carreira esportiva. Acredito no poder da perseverança, no trabalho árduo e na importância de cada treino para conquistar grandes vitórias.
      </p>
    </div>

    <section class="info-jogador">
      <h2>Informações do Jogador</h2>
      <div class="info-grid">
        <div class="info-item"><i class="fas fa-user-tag"></i><strong> Apelido:</strong> Juninho</div>
        <div class="info-item"><i class="fas fa-birthday-cake"></i><strong> Idade:</strong> 17</div>
        <div class="info-item"><i class="fas fa-weight"></i><strong> Peso:</strong> 68 kg</div>
        <div class="info-item"><i class="fas fa-ruler-vertical"></i><strong> Altura:</strong> 1.78 m</div>
        <div class="info-item"><i class="fas fa-bolt"></i><strong> Status:</strong> Em busca de clube</div>
        <div class="info-item"><i class="fas fa-fire"></i><strong> Estilo:</strong> Raçudo</div>
        <div class="info-item"><i class="fas fa-shoe-prints"></i><strong> Pé dominante:</strong> Direito</div>
        <div class="info-item"><i class="fas fa-map-marker-alt"></i><strong> Estado:</strong> SP</div>
        <div class="info-item"><i class="fas fa-futbol"></i><strong> Posição:</strong> Atacante</div>
      </div>
    </section>

  </div>

  <div class="rede-social">
    <h3>Minhas Postagens</h3>

    <div class="post">
      <p>Gol na final do campeonato! Me dediquei bastante para esse momento.</p>
      <img src="../../public/images/gol.png" alt="Gol">
      <div class="post-actions">
        <div class="like-comment">
          <i class="fa fa-thumbs-up like"></i>
          <i class="fa fa-comment-alt comment"></i>
        </div>
        <span class="time">1 hora atrás</span>
      </div>
    </div>

    <div class="post">
      <p>Treino de finalização de hoje. Foco total!</p>
      <video controls>
        <source src="treino.mp4" type="video/mp4">
        Seu navegador não suporta a tag de vídeo.
      </video>
      <div class="post-actions">
        <div class="like-comment">
          <i class="fa fa-thumbs-up like"></i>
          <i class="fa fa-comment-alt comment"></i>
        </div>
        <span class="time">2 horas atrás</span>
      </div>
    </div>

    <div class="post">
      <p>Momento de descontração após o jogo com a galera!</p>
      <img src="../../public/images/campeao.png" alt="Descontração">
      <div class="post-actions">
        <div class="like-comment">
          <i class="fa fa-thumbs-up like"></i>
          <i class="fa fa-comment-alt comment"></i>
        </div>
        <span class="time">3 horas atrás</span>
      </div>
    </div>

    <div class="post">
      <p>Momento de descontração após o jogo com a galera!</p>
      <img src="../../public/images/campeao.png" alt="Descontração">
      <div class="post-actions">
        <div class="like-comment">
          <i class="fa fa-thumbs-up like"></i>
          <i class="fa fa-comment-alt comment"></i>
        </div>
        <span class="time">3 horas atrás</span>
      </div>
    </div>

     <div class="post">
      <p>Momento de descontração após o jogo com a galera!</p>
      <img src="../../public/images/campeao.png" alt="Descontração">
      <div class="post-actions">
        <div class="like-comment">
          <i class="fa fa-thumbs-up like"></i>
          <i class="fa fa-comment-alt comment"></i>
        </div>
        <span class="time">3 horas atrás</span>
      </div>
    </div>

    <div class="post">
      <p>Momento de descontração após o jogo com a galera!</p>
      <img src="../../public/images/campeao.png" alt="Descontração">
      <div class="post-actions">
        <div class="like-comment">
          <i class="fa fa-thumbs-up like"></i>
          <i class="fa fa-comment-alt comment"></i>
        </div>
        <span class="time">3 horas atrás</span>
      </div>
    </div>

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
          <a href="#"><i class="fab fa-x-twitter"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
    <div class="footer-copy">
      &copy; 2025 <strong>FutLink</strong> — Todos os direitos reservados.
    </div>
  </footer>

  <script src="../../public/js/perfilJogador.js"></script>
</body>
</html>
