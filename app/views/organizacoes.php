<?php
include("topo.php");
?>
<link rel="stylesheet" href="../../public/css/organizacoes.css">

<body>
    <?php include("navbar-social.php"); ?>

    <div class="container-site">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-pattern"></div>
            <div class="hero-container">
                <h1 class="hero-title animate-fadeInUp">Encontre as Melhores Organizações Esportivas</h1>
                <p class="hero-description animate-fadeInUp delay-100">Conecte-se com clubes, escolinhas e academias de futebol que podem impulsionar sua carreira ou oferecer as melhores oportunidades para seu desenvolvimento.</p>
                
                <!-- Search Box -->
                <div class="search-container animate-fadeInUp delay-200">
                    <div class="search-box">
                        <div class="search-input">
                            <input type="text" placeholder="Buscar por nome, cidade ou especialidade...">
                        </div>
                        <div class="search-filter">
                            <div class="filter-item">
                                <select class="filter-select">
                                    <option value="">Tipo de Organização</option>
                                    <option value="clube">Clube Profissional</option>
                                    <option value="escolinha">Escolinha de Futebol</option>
                                    <option value="academia">Academia</option>
                                    <option value="ong">ONG Esportiva</option>
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
                            Buscar Organizações
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="main-content">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Organizações em Destaque</h2>
                    <p class="section-description">Conheça as organizações mais bem avaliadas e com maior número de atletas formados em nossa plataforma.</p>
                </div>

                <!-- Filter Tabs -->
                <div class="filter-tabs">
                    <div class="filter-tab active">Todos</div>
                    <div class="filter-tab">Clubes Profissionais</div>
                    <div class="filter-tab">Escolinhas</div>
                    <div class="filter-tab">Academias</div>
                    <div class="filter-tab">ONGs Esportivas</div>
                </div>

                <!-- View Options -->
                <div class="view-options">
                    <div class="view-option active" data-view="grid">
                        <i class="fas fa-th-large"></i>
                    </div>
                    <div class="view-option" data-view="list">
                        <i class="fas fa-list"></i>
                    </div>
                </div>

                <!-- Grid View (default) -->
                <div class="orgs-grid" id="grid-view">
                    <!-- Org Card 1 -->
                    <div class="org-card animate-fadeInUp">
                        <div class="org-badge verified">
                            <i class="fas fa-check-circle"></i> Verificado
                        </div>
                        <div class="org-header">
                            <img src="../../public/images/org-cover-1.png" alt="Capa da Organização" class="org-cover">
                        </div>
                        <div class="org-logo">
                            <img src="../../public/images/corinthians-logo.png" alt="Logo da Organização">
                        </div>
                        <div class="org-content">
                            <h3 class="org-title">Sport Club Corinthians Paulista</h3>
                            <div class="org-location">
                                <i class="fas fa-map-marker-alt"></i> São Paulo, SP
                            </div>
                            <p class="org-description">Clube de futebol com foco em desenvolvimento de jovens talentos. Tradição e inovação desde 1910, com uma das maiores torcidas do Brasil.</p>
                            <div class="org-stats">
                                <div class="org-stat">
                                    <div class="org-stat-value">120+</div>
                                    <div class="org-stat-label">Atletas</div>
                                </div>
                                <div class="org-stat">
                                    <div class="org-stat-value">4.9</div>
                                    <div class="org-stat-label">Avaliação</div>
                                </div>
                                <div class="org-stat">
                                    <div class="org-stat-value">35+</div>
                                    <div class="org-stat-label">Peneiras</div>
                                </div>
                            </div>
                            <div class="org-tags">
                                <div class="org-tag">Clube Profissional</div>
                                <div class="org-tag">Base</div>
                                <div class="org-tag">Alto Rendimento</div>
                            </div>
                            <div class="org-footer">
                                <a href="organizacao.php">
                                    <button class="org-button">
                                        Ver detalhes <i class="fas fa-arrow-right"></i>
                                    </button>
                                </a>
                                <div class="org-actions">
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

                    <!-- Org Card 2 -->
                    <div class="org-card animate-fadeInUp delay-100">
                        <div class="org-badge featured">
                            <i class="fas fa-star"></i> Destaque
                        </div>
                        <div class="org-header">
                            <img src="../../public/images/org-cover-2.png" alt="Capa da Organização" class="org-cover">
                        </div>
                        <div class="org-logo">
                            <img src="../../public/images/palmeiras-logo.png" alt="Logo da Organização">
                        </div>
                        <div class="org-content">
                            <h3 class="org-title">Sociedade Esportiva Palmeiras</h3>
                            <div class="org-location">
                                <i class="fas fa-map-marker-alt"></i> São Paulo, SP
                            </div>
                            <p class="org-description">Academia de futebol de alto rendimento com foco na formação de atletas para o mercado nacional e internacional. Estrutura completa e metodologia avançada.</p>
                            <div class="org-stats">
                                <div class="org-stat">
                                    <div class="org-stat-value">150+</div>
                                    <div class="org-stat-label">Atletas</div>
                                </div>
                                <div class="org-stat">
                                    <div class="org-stat-value">4.8</div>
                                    <div class="org-stat-label">Avaliação</div>
                                </div>
                                <div class="org-stat">
                                    <div class="org-stat-value">42+</div>
                                    <div class="org-stat-label">Peneiras</div>
                                </div>
                            </div>
                            <div class="org-tags">
                                <div class="org-tag">Clube Profissional</div>
                                <div class="org-tag">Base</div>
                                <div class="org-tag">Internacional</div>
                            </div>
                            <div class="org-footer">
                                <a href="organizacao.php">
                                    <button class="org-button">
                                        Ver detalhes <i class="fas fa-arrow-right"></i>
                                    </button>
                                </a>
                                <div class="org-actions">
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

                    <!-- Org Card 3 -->
                    <div class="org-card animate-fadeInUp delay-200">
                        <div class="org-badge new">
                            <i class="fas fa-bolt"></i> Novo
                        </div>
                        <div class="org-header">
                            <img src="../../public/images/org-cover-3.png" alt="Capa da Organização" class="org-cover">
                        </div>
                        <div class="org-logo">
                            <img src="../../public/images/santos-logo.png" alt="Logo da Organização">
                        </div>
                        <div class="org-content">
                            <h3 class="org-title">Santos Futebol Clube</h3>
                            <div class="org-location">
                                <i class="fas fa-map-marker-alt"></i> Santos, SP
                            </div>
                            <p class="org-description">Conhecido mundialmente por revelar grandes talentos como Pelé e Neymar, o Santos FC mantém sua tradição de excelência na formação de atletas.</p>
                            <div class="org-stats">
                                <div class="org-stat">
                                    <div class="org-stat-value">130+</div>
                                    <div class="org-stat-label">Atletas</div>
                                </div>
                                <div class="org-stat">
                                    <div class="org-stat-value">4.7</div>
                                    <div class="org-stat-label">Avaliação</div>
                                </div>
                                <div class="org-stat">
                                    <div class="org-stat-value">28+</div>
                                    <div class="org-stat-label">Peneiras</div>
                                </div>
                            </div>
                            <div class="org-tags">
                                <div class="org-tag">Clube Profissional</div>
                                <div class="org-tag">Base</div>
                                <div class="org-tag">Exportação</div>
                            </div>
                            <div class="org-footer">
                                <a href="organizacao.php">
                                    <button class="org-button">
                                        Ver detalhes <i class="fas fa-arrow-right"></i>
                                    </button>
                                </a>
                                <div class="org-actions">
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

                    <!-- Org Card 4 -->
                    <div class="org-card animate-fadeInUp delay-300">
                        <div class="org-header">
                            <img src="../../public/images/org-cover-4.png" alt="Capa da Organização" class="org-cover">
                        </div>
                        <div class="org-logo">
                            <img src="../../public/images/sao-paulo-logo.png" alt="Logo da Organização">
                        </div>
                        <div class="org-content">
                            <h3 class="org-title">São Paulo Futebol Clube</h3>
                            <div class="org-location">
                                <i class="fas fa-map-marker-alt"></i> São Paulo, SP
                            </div>
                            <p class="org-description">Centro de formação de atletas com metodologia própria e foco no desenvolvimento técnico, tático, físico e mental dos jovens jogadores.</p>
                            <div class="org-stats">
                                <div class="org-stat">
                                    <div class="org-stat-value">140+</div>
                                    <div class="org-stat-label">Atletas</div>
                                </div>
                                <div class="org-stat">
                                    <div class="org-stat-value">4.6</div>
                                    <div class="org-stat-label">Avaliação</div>
                                </div>
                                <div class="org-stat">
                                    <div class="org-stat-value">32+</div>
                                    <div class="org-stat-label">Peneiras</div>
                                </div>
                            </div>
                            <div class="org-tags">
                                <div class="org-tag">Clube Profissional</div>
                                <div class="org-tag">Base</div>
                                <div class="org-tag">Tecnologia</div>
                            </div>
                            <div class="org-footer">
                                <a href="organizacao.php">
                                    <button class="org-button">
                                        Ver detalhes <i class="fas fa-arrow-right"></i>
                                    </button>
                                </a>
                                <div class="org-actions">
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

                    <!-- Org Card 5 -->
                    <div class="org-card animate-fadeInUp delay-400">
                        <div class="org-header">
                            <img src="../../public/images/org-cover-5.png" alt="Capa da Organização" class="org-cover">
                        </div>
                        <div class="org-logo">
                            <img src="../../public/images/flamengo-logo.png" alt="Logo da Organização">
                        </div>
                        <div class="org-content">
                            <h3 class="org-title">Clube de Regatas do Flamengo</h3>
                            <div class="org-location">
                                <i class="fas fa-map-marker-alt"></i> Rio de Janeiro, RJ
                            </div>
                            <p class="org-description">Um dos maiores clubes do Brasil, com forte investimento na base e estrutura de ponta para formação de atletas de alto rendimento.</p>
                            <div class="org-stats">
                                <div class="org-stat">
                                    <div class="org-stat-value">160+</div>
                                    <div class="org-stat-label">Atletas</div>
                                </div>
                                <div class="org-stat">
                                    <div class="org-stat-value">4.8</div>
                                    <div class="org-stat-label">Avaliação</div>
                                </div>
                                <div class="org-stat">
                                    <div class="org-stat-value">38+</div>
                                    <div class="org-stat-label">Peneiras</div>
                                </div>
                            </div>
                            <div class="org-tags">
                                <div class="org-tag">Clube Profissional</div>
                                <div class="org-tag">Base</div>
                                <div class="org-tag">Multiesportivo</div>
                            </div>
                            <div class="org-footer">
                                <a href="organizacao.php">
                                    <button class="org-button">
                                        Ver detalhes <i class="fas fa-arrow-right"></i>
                                    </button>
                                </a>
                                <div class="org-actions">
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

                    <!-- Org Card 6 -->
                    <div class="org-card animate-fadeInUp delay-400">
                        <div class="org-header">
                            <img src="../../public/images/org-cover-6.png" alt="Capa da Organização" class="org-cover">
                        </div>
                        <div class="org-logo">
                            <img src="../../public/images/cruzeiro-logo.png" alt="Logo da Organização">
                        </div>
                        <div class="org-content">
                            <h3 class="org-title">Cruzeiro Esporte Clube</h3>
                            <div class="org-location">
                                <i class="fas fa-map-marker-alt"></i> Belo Horizonte, MG
                            </div>
                            <p class="org-description">Tradicional clube mineiro com forte trabalho de base e formação de atletas para o mercado nacional e internacional.</p>
                            <div class="org-stats">
                                <div class="org-stat">
                                    <div class="org-stat-value">125+</div>
                                    <div class="org-stat-label">Atletas</div>
                                </div>
                                <div class="org-stat">
                                    <div class="org-stat-value">4.7</div>
                                    <div class="org-stat-label">Avaliação</div>
                                </div>
                                <div class="org-stat">
                                    <div class="org-stat-value">30+</div>
                                    <div class="org-stat-label">Peneiras</div>
                                </div>
                            </div>
                            <div class="org-tags">
                                <div class="org-tag">Clube Profissional</div>
                                <div class="org-tag">Base</div>
                                <div class="org-tag">Formação</div>
                            </div>
                            <div class="org-footer">
                                <a href="organizacao.php">
                                    <button class="org-button">
                                        Ver detalhes <i class="fas fa-arrow-right"></i>
                                    </button>
                                </a>
                                <div class="org-actions">
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
                <div class="orgs-list" id="list-view" style="display: none;">
                    <!-- List Org 1 -->
                    <div class="list-org">
                        <div class="list-org-logo">
                            <img src="../../public/images/corinthians-logo.png" alt="Logo da Organização">
                            <div class="list-org-badge verified">
                                <i class="fas fa-check-circle"></i> Verificado
                            </div>
                        </div>
                        <div class="list-org-content">
                            <div class="list-org-header">
                                <div class="list-org-title-group">
                                    <h3 class="list-org-title">Sport Club Corinthians Paulista</h3>
                                    <div class="list-org-location">
                                        <i class="fas fa-map-marker-alt"></i> São Paulo, SP
                                    </div>
                                </div>
                                <div class="list-org-actions">
                                    <button class="action-button favorite">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button class="action-button share">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <p class="list-org-description">Clube de futebol com foco em desenvolvimento de jovens talentos. Tradição e inovação desde 1910, com uma das maiores torcidas do Brasil. Estrutura completa para formação de atletas de alto rendimento.</p>
                            <div class="list-org-tags">
                                <div class="list-org-tag">Clube Profissional</div>
                                <div class="list-org-tag">Base</div>
                                <div class="list-org-tag">Alto Rendimento</div>
                            </div>
                            <div class="list-org-footer">
                                <div class="list-org-stats">
                                    <div class="list-org-stat">
                                        <i class="fas fa-users"></i>
                                        <span class="list-org-stat-value">120+ Atletas</span>
                                    </div>
                                    <div class="list-org-stat">
                                        <i class="fas fa-star"></i>
                                        <span class="list-org-stat-value">4.9 Avaliação</span>
                                    </div>
                                    <div class="list-org-stat">
                                        <i class="fas fa-search"></i>
                                        <span class="list-org-stat-value">35+ Peneiras</span>
                                    </div>
                                </div>
                                <a href="organizacao.php">
                                    <button class="org-button">
                                        Ver detalhes <i class="fas fa-arrow-right"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- List Org 2 -->
                    <div class="list-org">
                        <div class="list-org-logo">
                            <img src="../../public/images/palmeiras-logo.png" alt="Logo da Organização">
                            <div class="list-org-badge featured">
                                <i class="fas fa-star"></i> Destaque
                            </div>
                        </div>
                        <div class="list-org-content">
                            <div class="list-org-header">
                                <div class="list-org-title-group">
                                    <h3 class="list-org-title">Sociedade Esportiva Palmeiras</h3>
                                    <div class="list-org-location">
                                        <i class="fas fa-map-marker-alt"></i> São Paulo, SP
                                    </div>
                                </div>
                                <div class="list-org-actions">
                                    <button class="action-button favorite">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button class="action-button share">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <p class="list-org-description">Academia de futebol de alto rendimento com foco na formação de atletas para o mercado nacional e internacional. Estrutura completa e metodologia avançada para desenvolvimento de jovens talentos.</p>
                            <div class="list-org-tags">
                                <div class="list-org-tag">Clube Profissional</div>
                                <div class="list-org-tag">Base</div>
                                <div class="list-org-tag">Internacional</div>
                            </div>
                            <div class="list-org-footer">
                                <div class="list-org-stats">
                                    <div class="list-org-stat">
                                        <i class="fas fa-users"></i>
                                        <span class="list-org-stat-value">150+ Atletas</span>
                                    </div>
                                    <div class="list-org-stat">
                                        <i class="fas fa-star"></i>
                                        <span class="list-org-stat-value">4.8 Avaliação</span>
                                    </div>
                                    <div class="list-org-stat">
                                        <i class="fas fa-search"></i>
                                        <span class="list-org-stat-value">42+ Peneiras</span>
                                    </div>
                                </div>
                                <a href="organizacao.php">
                                    <button class="org-button">
                                        Ver detalhes <i class="fas fa-arrow-right"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="pagination">
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
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="cta-pattern"></div>
            <div class="cta-container">
                <h2 class="cta-title">Cadastre sua Organização</h2>
                <p class="cta-description">Aumente sua visibilidade, encontre novos talentos e faça parte da maior rede de organizações esportivas do Brasil.</p>
                <div class="cta-buttons">
                    <button class="cta-button cta-button-primary">
                        <i class="fas fa-building"></i> Cadastrar Organização
                    </button>
                    <button class="cta-button cta-button-secondary">
                        <i class="fas fa-info-circle"></i> Saiba Mais
                    </button>
                </div>
            </div>
        </section>
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

            // Funcionalidade de filtro por tabs
            const filterTabs = document.querySelectorAll('.filter-tab');
            
            filterTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove a classe active de todas as tabs
                    filterTabs.forEach(t => t.classList.remove('active'));
                    
                    // Adiciona a classe active à tab clicada
                    this.classList.add('active');
                    
                    // Aqui você pode adicionar a lógica de filtro real
                    // Por enquanto, apenas um alerta
                    console.log('Filtro selecionado: ' + this.textContent);
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
