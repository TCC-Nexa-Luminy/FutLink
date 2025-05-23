<?php
@session_start();
include("topo.php");
?>
<link rel="stylesheet" href="../../public/css/peneiras.css">

<body>
    <?php
    include("navbar-social.php");
    include_once("message.php");        //faz a inclusao de um pop-up formatado(sweet message)
    ?>
    <div class="container-site">
        <!-- Botão de voltar -->
        <a href="javascript:history.back()" class="back-button">
            <i class="fas fa-arrow-left"></i>
        </a>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-bg"></div>
            <div class="hero-content">
                <div class="hero-text animate-fadeInUp">
                    <h1 class="hero-title">Descubra as <span>melhores peneiras</span> de futebol do Brasil</h1>
                    <p class="hero-description">Encontre oportunidades exclusivas para mostrar seu talento e iniciar sua carreira profissional nos maiores clubes do país.</p>
                </div>
            </div>
        </section>

        <!-- Search Section -->
        <div class="search-container">
            <div class="search-box animate-fadeInUp delay-100">
                <div class="search-input">
                    <input type="text" placeholder="Buscar por clube, cidade ou categoria...">
                </div>
                <div class="search-filter">
                    <div class="filter-item">
                        <select class="filter-select">
                            <option value="">Categoria</option>
                            <option value="sub-13">Sub-13</option>
                            <option value="sub-15">Sub-15</option>
                            <option value="sub-17">Sub-17</option>
                            <option value="sub-20">Sub-20</option>
                        </select>
                    </div>
                    <div class="filter-item">
                        <select class="filter-select">
                            <option value="">Localização</option>
                            <option value="sp">São Paulo</option>
                            <option value="rj">Rio de Janeiro</option>
                            <option value="mg">Minas Gerais</option>
                            <option value="rs">Rio Grande do Sul</option>
                        </select>
                    </div>
                </div>
                <button class="search-button">
                    <i class="fas fa-search"></i>
                    Buscar Peneiras
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Featured Section -->
            <section class="animate-fadeInUp delay-200">
                <div class="section-header">
                    <h2 class="section-title">Peneiras em Destaque</h2>
                    <div class="view-options">
                        <div class="view-option active" data-view="grid">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="view-option" data-view="list">
                            <i class="fas fa-list"></i>
                        </div>
                    </div>
                </div>

                <!-- Grid View (default) -->
                <div class="cards-grid" id="grid-view">
                    <!-- Card 1 -->
                    <div class="card animate-fadeInUp delay-300">
                        <div class="card-badge featured">
                            <i class="fas fa-star"></i> Destaque
                        </div>
                        <div class="card-image">
                            <img src="../../public/images/corinthians_p000Pmj_widexl.jpeg" alt="Peneira Corinthians">
                        </div>
                        <div class="card-logo">
                            <img src="../../public/images/corinthians-logo.png" alt="Logo Corinthians">
                        </div>
                        <div class="card-content">
                            <span class="card-status status-open">
                                <i class="fas fa-circle"></i> Inscrições Abertas
                            </span>
                            <h3 class="card-title">Peneira Corinthians - Sub-15 e Sub-17</h3>
                            <p class="card-description">O Sport Club Corinthians Paulista está realizando seleções para novos talentos nas categorias Sub-15 e Sub-17.</p>
                            <div class="card-details">
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>15/06/2023</strong>
                                        Data
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>09:00</strong>
                                        Horário
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>CT Joaquim Grava</strong>
                                        Local
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-child"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>14-17 anos</strong>
                                        Idade
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="peneiraTime.php">
                                    <button class="card-button">
                                        Ver detalhes <i class="fas fa-arrow-right"></i>
                                    </button>
                                </a>
                                <div class="card-actions">
                                    <button class="action-button favorite">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button class="action-button share">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="card animate-fadeInUp delay-300">
                        <div class="card-badge new">
                            <i class="fas fa-bolt"></i> Novo
                        </div>
                        <div class="card-image">
                            <img src="../../public/images/palmeiras.jpg" alt="Peneira Palmeiras">
                        </div>
                        <div class="card-logo">
                            <img src="../../public/images/palmeiras-logo.png" alt="Logo Palmeiras">
                        </div>
                        <div class="card-content">
                            <span class="card-status status-open">
                                <i class="fas fa-circle"></i> Inscrições Abertas
                            </span>
                            <h3 class="card-title">Peneira Palmeiras - Categoria Sub-14</h3>
                            <p class="card-description">A Sociedade Esportiva Palmeiras está em busca de novos talentos para sua categoria de base Sub-14.</p>
                            <div class="card-details">
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>22/06/2023</strong>
                                        Data
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>14:00</strong>
                                        Horário
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>Academia de Futebol</strong>
                                        Local
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-child"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>13-14 anos</strong>
                                        Idade
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="peneiraTime.php">
                                    <button class="card-button">
                                        Ver detalhes <i class="fas fa-arrow-right"></i>
                                    </button>
                                </a>
                                <div class="card-actions">
                                    <button class="action-button favorite">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button class="action-button share">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="card animate-fadeInUp delay-300">
                        <div class="card-image">
                            <img src="../../public/images/santos.jpg" alt="Peneira Santos">
                        </div>
                        <div class="card-logo">
                            <img src="../../public/images/santos-logo.png" alt="Logo Santos">
                        </div>
                        <div class="card-content">
                            <span class="card-status status-closed">
                                <i class="fas fa-circle"></i> Inscrições Encerradas
                            </span>
                            <h3 class="card-title">Peneira Santos FC - Sub-13 e Sub-15</h3>
                            <p class="card-description">O Santos Futebol Clube, conhecido mundialmente por revelar grandes talentos como Pelé e Neymar, está realizando avaliações para suas categorias de base.</p>
                            <div class="card-details">
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>10/06/2023</strong>
                                        Data
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>08:30</strong>
                                        Horário
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>CT Rei Pelé</strong>
                                        Local
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-child"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>12-15 anos</strong>
                                        Idade
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="peneiraTime.php">
                                    <button class="card-button">
                                        Ver detalhes <i class="fas fa-arrow-right"></i>
                                    </button>
                                </a>
                                <div class="card-actions">
                                    <button class="action-button favorite">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button class="action-button share">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="card animate-fadeInUp delay-400">
                        <div class="card-image">
                            <img src="../../public/images/sao-paulo.png" alt="Peneira São Paulo">
                        </div>
                        <div class="card-logo">
                            <img src="../../public/images/sao-paulo-logo.png" alt="Logo São Paulo">
                        </div>
                        <div class="card-content">
                            <span class="card-status status-soon">
                                <i class="fas fa-circle"></i> Em Breve
                            </span>
                            <h3 class="card-title">Peneira São Paulo FC - Sub-17</h3>
                            <p class="card-description">O São Paulo Futebol Clube abrirá em breve inscrições para avaliações técnicas na categoria Sub-17, buscando novos talentos para seu elenco de base.</p>
                            <div class="card-details">
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>05/07/2023</strong>
                                        Data
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>10:00</strong>
                                        Horário
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>CT Barra Funda</strong>
                                        Local
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-child"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>16-17 anos</strong>
                                        Idade
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="peneiraTime.php">
                                    <button class="card-button">
                                        Ver detalhes <i class="fas fa-arrow-right"></i>
                                    </button>
                                </a>
                                <div class="card-actions">
                                    <button class="action-button favorite">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button class="action-button share">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- List View (hidden by default) -->
                <div class="cards-list" id="list-view" style="display: none;">
                    <!-- List Card 1 -->
                    <div class="list-card">
                        <div class="list-card-image">
                            <img src="../../public/images/corinthians_p000Pmj_widexl.jpeg" alt="Peneira Corinthians">
                            <div class="list-card-badge featured">
                                <i class="fas fa-star"></i> Destaque
                            </div>
                        </div>
                        <div class="list-card-content">
                            <div class="list-card-header">
                                <div class="list-card-title-group">
                                    <span class="list-card-status status-open">
                                        <i class="fas fa-circle"></i> Inscrições Abertas
                                    </span>
                                    <h3 class="list-card-title">Peneira Corinthians - Sub-15 e Sub-17</h3>
                                </div>
                                <div class="list-card-actions">
                                    <button class="action-button favorite">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button class="action-button share">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <p class="list-card-description">O Sport Club Corinthians Paulista está realizando seleções para novos talentos nas categorias Sub-15 e Sub-17. Uma oportunidade única para jovens atletas mostrarem seu potencial.</p>
                            <div class="list-card-details">
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>15/06/2023</strong>
                                        Data
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>09:00</strong>
                                        Horário
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>CT Joaquim Grava</strong>
                                        Local
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-child"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>14-17 anos</strong>
                                        Idade
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>Gratuita</strong>
                                        Taxa
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>Limitadas</strong>
                                        Vagas
                                    </div>
                                </div>
                            </div>
                            <div class="list-card-footer">
                                <div class="list-card-club">
                                    <div class="list-card-club-logo">
                                        <img src="../../public/images/corinthians-logo.png" alt="Logo Corinthians">
                                    </div>
                                    <div class="list-card-club-name">
                                        Sport Club Corinthians Paulista
                                    </div>
                                </div>
                                <a href="peneiraTime.php">
                                    <button class="card-button">
                                        Ver detalhes <i class="fas fa-arrow-right"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- List Card 2 -->
                    <div class="list-card">
                        <div class="list-card-image">
                            <img src="../../public/images/palmeiras.jpg" alt="Peneira Palmeiras">
                            <div class="list-card-badge new">
                                <i class="fas fa-bolt"></i> Novo
                            </div>
                        </div>
                        <div class="list-card-content">
                            <div class="list-card-header">
                                <div class="list-card-title-group">
                                    <span class="list-card-status status-open">
                                        <i class="fas fa-circle"></i> Inscrições Abertas
                                    </span>
                                    <h3 class="list-card-title">Peneira Palmeiras - Categoria Sub-14</h3>
                                </div>
                                <div class="list-card-actions">
                                    <button class="action-button favorite">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button class="action-button share">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <p class="list-card-description">A Sociedade Esportiva Palmeiras está em busca de novos talentos para sua categoria de base Sub-14. Venha fazer parte de um dos clubes com melhor estrutura de formação de atletas do Brasil.</p>
                            <div class="list-card-details">
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>22/06/2023</strong>
                                        Data
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>14:00</strong>
                                        Horário
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>Academia de Futebol</strong>
                                        Local
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-child"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>13-14 anos</strong>
                                        Idade
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>R$ 50,00</strong>
                                        Taxa
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong>100</strong>
                                        Vagas
                                    </div>
                                </div>
                            </div>
                            <div class="list-card-footer">
                                <div class="list-card-club">
                                    <div class="list-card-club-logo">
                                        <img src="../../public/images/palmeiras-logo.png" alt="Logo Palmeiras">
                                    </div>
                                    <div class="list-card-club-name">
                                        Sociedade Esportiva Palmeiras
                                    </div>
                                </div>
                                <a href="peneiraTime.php">
                                    <button class="card-button">
                                        Ver detalhes <i class="fas fa-arrow-right"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="pagination animate-fadeInUp delay-400">
                    <div class="page-item disabled">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                    <div class="page-item active">1</div>
                    <div class="page-item">2</div>
                    <div class="page-item">3</div>
                    <div class="page-item">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
            </section>

            <!-- CTA Section com fundo verde -->
            <section class="cta-section animate-fadeInUp delay-400">
                <h2 class="cta-title">Pronto para iniciar sua carreira?</h2>
                <p class="cta-description">Cadastre-se agora e receba alertas sobre novas peneiras próximas a você. Não perca nenhuma oportunidade de mostrar seu talento!</p>
                <div class="cta-buttons">
                    <button class="cta-button cta-button-primary">
                        <i class="fas fa-user-plus"></i> Cadastrar Atleta
                    </button>
                    <button class="cta-button cta-button-secondary">
                        <i class="fas fa-info-circle"></i> Saiba Mais
                    </button>
                </div>
            </section>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle entre visualização em grid e lista
            const viewOptions = document.querySelectorAll('.view-option');
            const gridView = document.getElementById('grid-view');
            const listView = document.getElementById('list-view');

            viewOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remove a classe active de todas as opções
                    viewOptions.forEach(opt => opt.classList.remove('active'));

                    // Adiciona a classe active à opção clicada
                    this.classList.add('active');

                    // Mostra a visualização correspondente
                    if (this.dataset.view === 'grid') {
                        gridView.style.display = 'grid';
                        listView.style.display = 'none';
                    } else {
                        gridView.style.display = 'none';
                        listView.style.display = 'flex';
                    }
                });
            });

            // Funcionalidade de favoritar
            const favoriteButtons = document.querySelectorAll('.action-button.favorite');

            favoriteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    this.classList.toggle('active');

                    if (this.classList.contains('active')) {
                        this.querySelector('i').classList.remove('far');
                        this.querySelector('i').classList.add('fas');
                    } else {
                        this.querySelector('i').classList.remove('fas');
                        this.querySelector('i').classList.add('far');
                    }
                });
            });

            // Funcionalidade de compartilhamento
            const shareButtons = document.querySelectorAll('.action-button.share');

            shareButtons.forEach(button => {
                button.addEventListener('click', function() {
                    alert('Funcionalidade de compartilhamento será implementada em breve!');
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