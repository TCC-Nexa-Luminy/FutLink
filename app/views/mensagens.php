<?php 
@session_start();
include("topo.php");
?>
<link rel="stylesheet" href="../../public/css/mensagens.css">


<body>
    <?php
    include("navbar-social.php");
    // include_once("message.php");
    // include("components/back-button.php");
    ?>
    


    
    <div class="container-site">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-bg"></div>
            <div class="hero-content">
                <div class="hero-text animate-fadeInUp">
                    <h1 class="hero-title">Suas <span>Mensagens</span></h1>
                    <p class="hero-description">Conecte-se com clubes, atletas e organizações esportivas</p>
                </div>
            </div>
        </section>


        <div class="main-content">
            <div class="messages-container">

                <div class="conversations-sidebar">
                    <div class="sidebar-header">
                        <h2>Conversas</h2>
                        <button class="new-message-btn">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Buscar conversas...">
                    </div>
                    
                    <div class="conversations-list">

                        <div class="conversation-item active">
                            <div class="conversation-avatar">
                                <img src="../../public/images/corinthians-logo.png" alt="Corinthians">
                                <span class="status-online"></span>
                            </div>
                            <div class="conversation-content">
                                <div class="conversation-header">
                                    <h3 class="conversation-name">Corinthians FC</h3>
                                    <span class="conversation-time">12:45</span>
                                </div>
                                <div class="conversation-preview">
                                    <p>Olá! Gostaríamos de convidá-lo para...</p>
                                    <span class="unread-count">2</span>
                                </div>
                            </div>
                        </div>
                        

                        <div class="conversation-item">
                            <div class="conversation-avatar">
                                <img src="../../public/images/palmeiras-logo.png" alt="Palmeiras">
                            </div>
                            <div class="conversation-content">
                                <div class="conversation-header">
                                    <h3 class="conversation-name">Palmeiras</h3>
                                    <span class="conversation-time">Ontem</span>
                                </div>
                                <div class="conversation-preview">
                                    <p>Obrigado pelo seu interesse na peneira...</p>
                                </div>
                            </div>
                        </div>
                        

                        <div class="conversation-item">
                            <div class="conversation-avatar">
                                <img src="../../public/images/santos-logo.png" alt="Santos">
                                <span class="status-online"></span>
                            </div>
                            <div class="conversation-content">
                                <div class="conversation-header">
                                    <h3 class="conversation-name">Santos FC</h3>
                                    <span class="conversation-time">09:30</span>
                                </div>
                                <div class="conversation-preview">
                                    <p>Confirmamos sua presença na peneira...</p>
                                    <span class="unread-count">1</span>
                                </div>
                            </div>
                        </div>
                        

                        <div class="conversation-item">
                            <div class="conversation-avatar">
                                <img src="../../public/images/sao-paulo-logo.png" alt="São Paulo">
                            </div>
                            <div class="conversation-content">
                                <div class="conversation-header">
                                    <h3 class="conversation-name">São Paulo FC</h3>
                                    <span class="conversation-time">Seg</span>
                                </div>
                                <div class="conversation-preview">
                                    <p>Parabéns! Você foi aprovado para a...</p>
                                </div>
                            </div>
                        </div>
                        

                        <div class="conversation-item">
                            <div class="conversation-avatar">
                                <div class="avatar-placeholder">CF</div>
                                <span class="status-online"></span>
                            </div>
                            <div class="conversation-content">
                                <div class="conversation-header">
                                    <h3 class="conversation-name">Carlos Ferreira</h3>
                                    <span class="conversation-time">3d</span>
                                </div>
                                <div class="conversation-preview">
                                    <p>Você viu a nova peneira do Flamengo?</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

                <div class="chat-area">
                    <div class="chat-header">
                        <div class="chat-user-info">
                            <div class="chat-avatar">
                                <img src="../../public/images/corinthians-logo.png" alt="Corinthians">
                                <span class="status-online"></span>
                            </div>
                            <div class="chat-user-details">
                                <h3>Corinthians FC</h3>
                                <span class="user-status">Online agora</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="chat-messages">

                        <div class="message received">
                            <div class="message-avatar">
                                <img src="../../public/images/corinthians-logo.png" alt="Corinthians">
                            </div>
                            <div class="message-content">
                                <div class="message-bubble">
                                    <p>Olá! Gostaríamos de convidá-lo para participar da nossa próxima peneira que acontecerá no dia 15 de junho.</p>
                                </div>
                                <span class="message-time">10:30</span>
                            </div>
                        </div>
                        

                        <div class="message received">
                            <div class="message-avatar">
                                <img src="../../public/images/corinthians-logo.png" alt="Corinthians">
                            </div>
                            <div class="message-content">
                                <div class="message-bubble">
                                    <p>A peneira será para as categorias Sub-15 e Sub-17. Você tem interesse em participar?</p>
                                </div>
                                <span class="message-time">10:32</span>
                            </div>
                        </div>
                        

                        <div class="message sent">
                            <div class="message-content">
                                <div class="message-bubble">
                                    <p>Olá! Sim, tenho muito interesse em participar da peneira. Estou na categoria Sub-17.</p>
                                </div>
                                <span class="message-time">11:45</span>
                            </div>
                        </div>
                        

                        <div class="message received">
                            <div class="message-avatar">
                                <img src="../../public/images/corinthians-logo.png" alt="Corinthians">
                            </div>
                            <div class="message-content">
                                <div class="message-bubble">
                                    <p>Ótimo! Estamos enviando todas as informações necessárias para sua inscrição. Por favor, preencha o formulário até o dia 10 de junho.</p>
                                </div>
                                <span class="message-time">12:01</span>
                            </div>
                        </div>
                        

                        <div class="message sent">
                            <div class="message-content">
                                <div class="message-bubble">
                                    <p>Perfeito! Vou providenciar toda a documentação e enviar dentro do prazo. Muito obrigado pela oportunidade!</p>
                                </div>
                                <span class="message-time">12:45</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="chat-input-area">
                        <div class="chat-input">
                            <input type="text" placeholder="Digite sua mensagem..." id="messageInput">
                            <button class="emoji-btn">
                                <i class="far fa-smile"></i>
                            </button>
                        </div>
                        <button class="send-btn">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {

    const conversationItems = document.querySelectorAll('.conversation-item');
    const conversationsSidebar = document.querySelector('.conversations-sidebar');
    const chatArea = document.querySelector('.chat-area');
    const messageInput = document.getElementById('messageInput');
    const sendBtn = document.querySelector('.send-btn');
    

    const chatHeader = document.querySelector('.chat-header');
    const chatUserInfo = document.querySelector('.chat-user-info');
    
    const mobileBackBtn = document.createElement('button');
    mobileBackBtn.className = 'mobile-back-btn';
    mobileBackBtn.innerHTML = '<i class="fas fa-arrow-left"></i>';
    mobileBackBtn.style.display = 'none';
    
    chatHeader.insertBefore(mobileBackBtn, chatUserInfo);
    

    function showChat() {
        if (window.innerWidth <= 768) {
            conversationsSidebar.classList.add('hidden');
            mobileBackBtn.style.display = 'flex';
        }
    }
    

    function showConversations() {
        if (window.innerWidth <= 768) {
            conversationsSidebar.classList.remove('hidden');
            mobileBackBtn.style.display = 'none';
        }
    }
    

    conversationItems.forEach(item => {
        item.addEventListener('click', function() {

            conversationItems.forEach(i => i.classList.remove('active'));

            this.classList.add('active');

            const unreadBadge = this.querySelector('.unread-count');
            if (unreadBadge) {
                unreadBadge.remove();
            }
            
            // No mobile, mostra o chat
            showChat();
        });
    });
    

    mobileBackBtn.addEventListener('click', function() {
        showConversations();
    });
    

    function sendMessage() {
        const message = messageInput.value.trim();
        if (message) {
            console.log('Enviando mensagem:', message);
            messageInput.value = '';
        }
    }
    
    sendBtn.addEventListener('click', sendMessage);
    
    messageInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });
    
    // Scroll automático para última mensagem
    const chatMessages = document.querySelector('.chat-messages');
    chatMessages.scrollTop = chatMessages.scrollHeight;
    

    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            conversationsSidebar.classList.remove('hidden');
            mobileBackBtn.style.display = 'none';
        } else {

            const activeConversation = document.querySelector('.conversation-item.active');
            if (!activeConversation) {
                showConversations();
            } else {
                showChat();
            }
        }
    });
    

    if (window.innerWidth <= 768) {
        showConversations();
    }
});
</script>
</body>
