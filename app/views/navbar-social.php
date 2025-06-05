<?php include 'topo.php'; ?>
<link rel="stylesheet" href="../../public/css/navbar-social.css">
<button id="botao-menu" class="botao-menu">
    <i class="fas fa-bars"></i>
</button>

<div id="overlay" class="overlay"></div>

<nav id="barra-navegacao" class="barra-navegacao">
    <div class="conteudo-barra">
        <div class="logo">
            <a href="home-page.php">
                <img src="../../public/images/logos/logo-fl-branco-solido.png" alt="Logo FutLink">
            </a>
        </div>

        <ul class="lista-icones">
            <li>
                <a href="home-page.php" class="item-menu">
                    <i class="fas fa-home"></i>
                    <span class="texto-nav">Home</span>
                </a>
            </li>
            <li>
                <a href="buscaJogadores.php" class="item-menu">
                    <i class="fas fa-search"></i>
                    <span class="texto-nav">Explorar</span>
                </a>
            </li>
            <li>
                <a href="notificacoes.php" class="item-menu nav-link">
                    <i class="fas fa-bell"></i>
                    <span class="texto-nav">Notificações</span>
                    <span class="notificacoes-contador" id="notificacoes-contador" style="display: none;">0</span>
                </a>
            </li>
            <li>
                <a href="mensagens.php" class="item-menu">
                    <i class="fas fa-envelope"></i>
                    <span class="texto-nav">Mensagens</span>
                </a>
            </li>
            <li>
                <a href="organizacoes.php" class="item-menu">
                    <i class="fas fa-briefcase"></i>
                    <span class="texto-nav">Organizações</span>
                </a>
            </li>
            <li>
                <a href="peneiras.php" class="item-menu">
                    <i class="fas fa-users"></i>
                    <span class="texto-nav">Peneiras</span>
                </a>
            </li>
            <li>
                <a href="perfilJogador.php" class="item-menu">
                    <i class="fas fa-user"></i>
                    <span class="texto-nav">Perfil</span>
                </a>
            </li>
        </ul>

        <div class="container-botao">
            <button id="botao-postar" class="botao-postar">
                <span>Postar</span>
            </button>
            <a href="#" id="botao-escrever" class="botao-escrever">
                <i class="fas fa-pen-to-square"></i>
            </a>
        </div>
    </div>
</nav>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const botaoMenu = document.getElementById("botao-menu");
  const barraNavegacao = document.getElementById("barra-navegacao");
  const overlay = document.getElementById("overlay");
  
  // destaca o item de menu ativo com base no caminho atual
  const caminhoAtual = window.location.pathname;
  const itensMenu = document.querySelectorAll(".item-menu");
  
  itensMenu.forEach(item => {
    const href = item.getAttribute("href");
    if (href && (caminhoAtual.includes(href) || (caminhoAtual === "/" && href.includes("home")))) {
      item.classList.add("ativo");
    }
  });

  // verifica o tamanho da tela e ajusta o menu
  function verificarTamanhoTela() {
    if (window.innerWidth > 768) {
      barraNavegacao.classList.remove("aberta");
      overlay.classList.remove("visivel");
      document.body.classList.remove("menu-aberto");
    }
  }

  // alterna o estado do menu
  function alternarMenu() {
    barraNavegacao.classList.toggle("aberta");
    overlay.classList.toggle("visivel");
    document.body.classList.toggle("menu-aberto");
  }

  // event listeners
  botaoMenu.addEventListener("click", alternarMenu);
  overlay.addEventListener("click", alternarMenu);
  window.addEventListener("resize", verificarTamanhoTela);
  
  // fecha o menu ao clicar em um link em dispositivos moveis
  document.querySelectorAll(".item-menu").forEach(link => {
    link.addEventListener("click", () => {
      if (window.innerWidth <= 768) {
        alternarMenu();
      }
    });
  });

  // verifica o tamanho da tela ao carregar
  verificarTamanhoTela();

  // 🆕 VERIFICAR NOTIFICAÇÕES NÃO LIDAS
  function verificarNotificacoes() {
    fetch('../controllers/notificacoes.act.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=contar_nao_lidas'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const contador = document.getElementById('notificacoes-contador');
            if (contador) {
                if (data.total > 0) {
                    contador.textContent = data.total;
                    contador.style.display = 'inline-flex';
                } else {
                    contador.style.display = 'none';
                }
            }
        }
    })
    .catch(error => {
        console.log('Erro ao verificar notificações:', error);
    });
  }

  // Verificar notificações ao carregar a página
  verificarNotificacoes();
  
  // Verificar notificações a cada 30 segundos
  setInterval(verificarNotificacoes, 30000);
});
</script>