<?php 
@session_start();
include("topo.php");
?>
<link rel="stylesheet" href="../../public/css/notificacoes.css">
<!-- Adicione Font Awesome para ícones -->

<body>
    <?php
    include("navbar-social.php");
    // include_once("message.php");
    // include("components/back-button.php");
    ?>
    
    <!-- Botão de voltar -->

    
    <div class="container-site">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-content">
                <h1 class="hero-title">Notificações</h1>
                <p class="hero-description">Suas atualizações mais recentes</p>
            </div>
        </section>

        <!-- Main Content -->
        <div class="main-content">
            <div class="notifications-container">
                <!-- Header com ações simples -->
                <div class="notifications-header">
                    <h2>Suas Notificações</h2>
                    <button class="marcar-todas-lidas">
                        <i class="fas fa-check-double"></i> Marcar todas como lidas
                    </button>
                </div>
                
                <!-- Lista de notificações -->
                <div class="notifications-list">
                    <!-- Notificação simples -->
                    <div class="notificacao nao-lida">
                        <div class="notificacao-avatar">
                            <img src="../../public/images/corinthians-logo.png" alt="Corinthians">
                        </div>
                        <div class="notificacao-conteudo">
                            <h3>Nova mensagem de Corinthians FC</h3>
                            <p>Olá! Gostaríamos de convidá-lo para participar da nossa próxima peneira.</p>
                            <span class="tempo">Agora</span>
                        </div>
                        <button class="marcar-lida">
                            <i class="fas fa-check"></i>
                        </button>
                    </div>
                    
                    <!-- Notificação tipo peneira (não lida) -->
                    <div class="notificacao nao-lida">
                        <div class="notificacao-avatar">
                            <img src="../../public/images/palmeiras-logo.png" alt="Palmeiras">
                        </div>
                        <div class="notificacao-conteudo">
                            <h3>Nova peneira disponível</h3>
                            <p>Palmeiras abriu inscrições para peneira na categoria Sub-17. Inscrições até 20/06.</p>
                            <span class="tempo">5 min</span>
                        </div>
                        <button class="marcar-lida">
                            <i class="fas fa-check"></i>
                        </button>
                    </div>

                    <!-- Notificação tipo like (não lida) -->
                    <div class="notificacao nao-lida">
                        <div class="notificacao-avatar">
                            <div class="avatar-placeholder">MR</div>
                        </div>
                        <div class="notificacao-conteudo">
                            <h3>Marcos Ribeiro curtiu seu post</h3>
                            <p>Marcos curtiu sua publicação sobre "Minha experiência na peneira do Santos".</p>
                            <span class="tempo">30 min</span>
                        </div>
                        <button class="marcar-lida">
                            <i class="fas fa-check"></i>
                        </button>
                    </div>

                    <!-- Notificação tipo sistema (lida) -->
                    <div class="notificacao">
                        <div class="notificacao-avatar">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="notificacao-conteudo">
                            <h3>Atualização do sistema</h3>
                            <p>Novos recursos foram adicionados à plataforma. Confira as novidades!</p>
                            <span class="tempo">2h</span>
                        </div>
                    </div>
                    
                    <!-- Notificação tipo peneira (lida) -->
                    <div class="notificacao">
                        <div class="notificacao-avatar">
                            <img src="../../public/images/santos-logo.png" alt="Santos">
                        </div>
                        <div class="notificacao-conteudo">
                            <h3>Lembrete de peneira</h3>
                            <p>A peneira do Santos FC acontecerá amanhã às 9h. Não se esqueça de levar todos os documentos.</p>
                            <span class="tempo">1d</span>
                        </div>
                    </div>
                    
                    <!-- Notificação tipo mensagem (lida) -->
                    <div class="notificacao">
                        <div class="notificacao-avatar">
                            <img src="../../public/images/sao-paulo-logo.png" alt="São Paulo">
                        </div>
                        <div class="notificacao-conteudo">
                            <h3>Nova mensagem de São Paulo FC</h3>
                            <p>Parabéns! Você foi aprovado para a próxima fase da peneira. Confira os detalhes na mensagem.</p>
                            <span class="tempo">2d</span>
                        </div>
                    </div>
                    
                    <!-- Notificação tipo follow (lida) -->
                    <div class="notificacao">
                        <div class="notificacao-avatar">
                            <div class="avatar-placeholder">JP</div>
                        </div>
                        <div class="notificacao-conteudo">
                            <h3>João Pedro começou a seguir você</h3>
                            <p>João Pedro agora está seguindo seu perfil.</p>
                            <span class="tempo">3d</span>
                        </div>
                    </div>
                    
                    <!-- Notificação tipo like (lida) -->
                    <div class="notificacao">
                        <div class="notificacao-avatar">
                            <div class="avatar-placeholder">AC</div>
                        </div>
                        <div class="notificacao-conteudo">
                            <h3>Ana Carolina comentou em seu post</h3>
                            <p>"Muito bom! Também participei dessa peneira e foi uma experiência incrível."</p>
                            <span class="tempo">5d</span>
                        </div>
                    </div>
                </div>
                
                <!-- Estado vazio -->
                <div class="empty-state" style="display: none;">
                    <div class="empty-icon">
                        <i class="far fa-bell-slash"></i>
                    </div>
                    <h3>Nenhuma notificação encontrada</h3>
                    <p>Você não tem notificações no momento.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Marcar notificação como lida
            const marcarLidaBotoes = document.querySelectorAll('.marcar-lida');
            
            marcarLidaBotoes.forEach(botao => {
                botao.addEventListener('click', function() {
                    const notificacao = this.closest('.notificacao');
                    notificacao.classList.remove('nao-lida');
                    this.style.display = 'none';
                });
            });
            
            // Marcar todas como lidas
            const marcarTodasLidas = document.querySelector('.marcar-todas-lidas');
            
            marcarTodasLidas.addEventListener('click', function() {
                const notificacoesNaoLidas = document.querySelectorAll('.notificacao.nao-lida');
                
                notificacoesNaoLidas.forEach(notificacao => {
                    notificacao.classList.remove('nao-lida');
                    const botaoMarcar = notificacao.querySelector('.marcar-lida');
                    if (botaoMarcar) {
                        botaoMarcar.style.display = 'none';
                    }
                });
            });
            
            // Animação de entrada dos elementos
            const animatedElements = document.querySelectorAll('.animate-fadeInUp');
            
            function checkScroll() {
                animatedElements.forEach(element => {
                    const elementTop = element.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;
                    
                    if (elementTop < windowHeight * 0.9) {
                        element.style.opacity = '1';
                        element.style.transform = 'translateY(0)';
                    }
                });
            }
            
            // Inicialmente, definir os elementos como invisíveis
            animatedElements.forEach(element => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px)';
                element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            });
            
            // Verificar posição inicial
            checkScroll();
            
            // Verificar ao rolar
            window.addEventListener('scroll', checkScroll);
        });
    </script>
</body>
