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
                    <!-- As notificações hardcoded serão substituídas pelo JavaScript -->
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
    // Carregar notificações reais do banco de dados
    carregarNotificacoesReais();
    
    // Marcar todas como lidas (conectar com o banco)
    const marcarTodasLidas = document.querySelector('.marcar-todas-lidas');
    
    marcarTodasLidas.addEventListener('click', function() {
        fetch('../controllers/notificacoes.act.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=marcar_todas_lidas'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remover classe nao-lida de todos os elementos
                document.querySelectorAll('.notificacao.nao-lida').forEach(el => {
                    el.classList.remove('nao-lida');
                    const botaoMarcar = el.querySelector('.marcar-lida');
                    if (botaoMarcar) {
                        botaoMarcar.style.display = 'none';
                    }
                });
                
                // Atualizar contador no navbar
                atualizarContadorNavbar();
            }
        });
    });
    
    // Animação de entrada dos elementos (mantém sua animação original)
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

// Função para carregar notificações reais
function carregarNotificacoesReais() {
    const notificationsList = document.querySelector('.notifications-list');
    const emptyState = document.querySelector('.empty-state');
    
    fetch('../controllers/notificacoes.act.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=listar'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (data.notificacoes.length === 0) {
                // Mostrar estado vazio
                notificationsList.innerHTML = '';
                emptyState.style.display = 'block';
                return;
            }
            
            // Esconder estado vazio
            emptyState.style.display = 'none';
            
            // Limpar lista atual
            notificationsList.innerHTML = '';
            
            // Adicionar notificações reais
            data.notificacoes.forEach(notif => {
                const notifElement = document.createElement('div');
                notifElement.className = `notificacao ${notif.lida ? '' : 'nao-lida'} animate-fadeInUp`;
                notifElement.dataset.id = notif.id;
                
                // Determinar avatar
                let avatarContent;
                if (notif.foto_perfil && notif.foto_perfil !== '') {
                    avatarContent = `<img src="../../public/images/perfil/${notif.foto_perfil}" alt="${notif.nome}">`;
                } else {
                    // Criar iniciais
                    const iniciais = notif.nome.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
                    avatarContent = `<div class="avatar-placeholder">${iniciais}</div>`;
                }
                
                notifElement.innerHTML = `
                    <div class="notificacao-avatar">
                        ${avatarContent}
                    </div>
                    <div class="notificacao-conteudo">
                        <h3>${notif.titulo}</h3>
                        <p>${notif.mensagem}</p>
                        <span class="tempo">${notif.tempo}</span>
                    </div>
                    <div class="notificacao-acoes">
                        ${!notif.lida ? `
                        <button class="marcar-lida" data-id="${notif.id}" title="Marcar como lida">
                            <i class="fas fa-check"></i>
                        </button>
                        ` : ''}
                        <button class="excluir-notificacao" data-id="${notif.id}" title="Excluir notificação">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;
                
                notificationsList.appendChild(notifElement);
                
                // Adicionar evento de clique para marcar como lida
                if (!notif.lida) {
                    const botaoMarcar = notifElement.querySelector('.marcar-lida');
                    if (botaoMarcar) {
                        botaoMarcar.addEventListener('click', function(e) {
                            e.stopPropagation();
                            marcarComoLida(notif.id);
                        });
                    }
                }
                                const botaoExcluir = notifElement.querySelector('.excluir-notificacao');

                // Adicionar evento de clique para excluir
                if (botaoExcluir) {
                    botaoExcluir.addEventListener('click', function(e) {
                        e.stopPropagation();
                        excluirNotificacao(notif.id);
                    });
                }
            });
            
            // Inicializar animações
            setTimeout(() => {
                document.querySelectorAll('.animate-fadeInUp').forEach(element => {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                });
            }, 100);
        }
    })
    .catch(error => {
        console.error('Erro ao carregar notificações:', error);
        notificationsList.innerHTML = `
            <div class="notificacao">
                <div class="notificacao-avatar">
                    <i class="fas fa-exclamation-circle" style="color: #ef4444;"></i>
                </div>
                <div class="notificacao-conteudo">
                    <h3>Erro ao carregar notificações</h3>
                    <p>Tente recarregar a página.</p>
                    <span class="tempo">Agora</span>
                </div>
            </div>
        `;
    });
}

// Função para marcar notificação como lida
function marcarComoLida(id) {
    fetch('../controllers/notificacoes.act.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=marcar_lida&id_notificacao=${id}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const notifElement = document.querySelector(`.notificacao[data-id="${id}"]`);
            if (notifElement) {
                notifElement.classList.remove('nao-lida');
                const botaoMarcar = notifElement.querySelector('.marcar-lida');
                if (botaoMarcar) {
                    botaoMarcar.style.display = 'none';
                }
            }
            
            // Atualizar contador no navbar
            atualizarContadorNavbar();
        }
    });
}

// Função para excluir notificação
function excluirNotificacao(id) {
    if (confirm('Tem certeza que deseja excluir esta notificação?')) {
        fetch('../controllers/notificacoes.act.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=excluir&id_notificacao=${id}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remover elemento da tela
                const notifElement = document.querySelector(`.notificacao[data-id="${id}"]`);
                if (notifElement) {
                    notifElement.style.animation = 'fadeOut 0.3s ease';
                    setTimeout(() => {
                        notifElement.remove();
                        
                        // Verificar se ainda há notificações
                        const notificacoesRestantes = document.querySelectorAll('.notificacao');
                        if (notificacoesRestantes.length === 0) {
                            document.querySelector('.empty-state').style.display = 'block';
                        }
                    }, 300);
                }
                
                // Atualizar contador no navbar
                atualizarContadorNavbar();
            } else {
                alert('Erro ao excluir notificação');
            }
        });
    }
}

// Função para atualizar contador no navbar
function atualizarContadorNavbar() {
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
    });
}
    </script>
</body>