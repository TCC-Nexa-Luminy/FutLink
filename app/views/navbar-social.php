<?php 
// Verificar se há sessão ativa
if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

// Verificar se usuário está logado - se não estiver, redirecionar
if (!isset($_SESSION['id']) || !isset($_SESSION['tipoLogin'])) {
    header('Location: login.php');
    exit();
}

// Determinar o tipo de usuário e link do perfil baseado no sistema de login atual
$perfil_link = "perfil.php"; // ALTERAÇÃO: Usar o novo redirecionador automático
$perfil_texto = "Perfil";
$tipo_usuario = $_SESSION['tipoLogin']; // 'usuario' ou 'organizacao'

if ($tipo_usuario === 'organizacao') {
   // Usuário é uma organização
   $perfil_link = "meu-perfil-org.php";
   $perfil_texto = "Meu Perfil";
} elseif ($tipo_usuario === 'usuario') {
   // ALTERAÇÃO: Usuário comum - usar redirecionador que verifica se é jogador
   $perfil_link = "perfil.php";
   $perfil_texto = "Perfil";
}
?>

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
           
           <?php if ($tipo_usuario === 'usuario'): ?>
               <!-- MENU PARA JOGADORES -->
               <li>
                   <a href="buscaJogadores.php" class="item-menu">
                       <i class="fas fa-search"></i>
                       <span class="texto-nav">Explorar</span>
                   </a>
               </li>
               <li>
                   <a href="notificacoes.php" class="item-menu">
                       <i class="fas fa-bell"></i>
                       <span class="texto-nav">Notificações</span>
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
                   <a href="<?php echo $perfil_link; ?>" class="item-menu">
                       <i class="fas fa-user"></i>
                       <span class="texto-nav"><?php echo $perfil_texto; ?></span>
                   </a>
               </li>
               
           <?php elseif ($tipo_usuario === 'organizacao'): ?>
               <!-- MENU PARA ORGANIZAÇÕES -->
               <li>
                   <a href="buscaJogadores.php" class="item-menu">
                       <i class="fas fa-search"></i>
                       <span class="texto-nav">Buscar Talentos</span>
                   </a>
               </li>
               <li>
                   <a href="addPeneira-org.php" class="item-menu">
                       <i class="fas fa-plus-circle"></i>
                       <span class="texto-nav">Criar Peneira</span>
                   </a>
               </li>
               <li>
                   <a href="notificacoes.php" class="item-menu">
                       <i class="fas fa-bell"></i>
                       <span class="texto-nav">Notificações</span>
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
                   <a href="<?php echo $perfil_link; ?>" class="item-menu">
                       <i class="fas fa-building"></i>
                       <span class="texto-nav"><?php echo $perfil_texto; ?></span>
                   </a>
               </li>
           <?php endif; ?>
           
           <!-- BOTÃO DE LOGOUT SEMPRE PRESENTE -->
           <li>
               <a href="../controllers/logout.php" class="item-menu logout-btn">
                   <i class="fas fa-sign-out-alt"></i>
                   <span class="texto-nav">Sair</span>
               </a>
           </li>
       </ul>

       <div class="container-botao">
               <button id="botao-postar" class="botao-postar">
                   <span>Postar</span>
               </button>
               <a href="<?php echo $perfil_link; ?>" id="botao-escrever" class="botao-escrever" title="Meu Perfil">
                   <i class="fas fa-user"></i>
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

 // Adicionar confirmação para logout
 const logoutBtn = document.querySelector('.logout-btn');
 if (logoutBtn) {
   logoutBtn.addEventListener('click', (e) => {
     if (!confirm('Tem certeza que deseja sair?')) {
       e.preventDefault();
     }
   });
 }
});

// Debug para verificar tipo de usuário
console.log('Tipo de usuário detectado: <?php echo $tipo_usuario; ?>');
console.log('Link do perfil: <?php echo $perfil_link; ?>');
console.log('ID do usuário: <?php echo $_SESSION['id']; ?>');
</script>

<style>
/* Estilos adicionais para os novos elementos */
.logout-btn {
   color: #ef4444 !important;
}

.logout-btn:hover {
   background-color: rgba(239, 68, 68, 0.1) !important;
}

/* Responsividade para botões */
@media (max-width: 768px) {
   .container-botao {
       flex-direction: column;
       gap: 10px;
   }
   
   .container-botao .botao-postar,
   .container-botao .botao-escrever {
       width: 100%;
       text-align: center;
       justify-content: center;
   }
}
</style>
