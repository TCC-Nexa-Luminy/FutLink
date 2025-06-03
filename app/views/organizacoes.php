<?php
@session_start();
include("topo.php");
?>
<link rel="stylesheet" href="../../public/css/organizacoes.css">

<body>
    <?php
    include("navbar-social.php");
    include_once("message.php");

    // Verificar se há mensagem de sucesso do cadastro
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                alert('Organização cadastrada com sucesso!');
            });
        </script>";
    }
    ?>

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
                            <input type="text" id="searchInput" placeholder="Buscar por nome, cidade ou especialidade...">
                        </div>
                        <div class="search-filter">
                            <div class="filter-item">
                                <select class="filter-select" id="tipoFilter">
                                    <option value="">Tipo de Organização</option>
                                    <option value="clube de futebol">Clube Profissional</option>
                                    <option value="escola de futebol">Escolinha de Futebol</option>
                                    <option value="academia">Academia</option>
                                    <option value="federacao">Federação</option>
                                    <option value="empresa">Empresa</option>
                                    <option value="outro">Outro</option>
                                </select>
                            </div>
                            <div class="filter-item">
                                <select class="filter-select" id="locationFilter">
                                    <option value="">Localização</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                </select>
                            </div>
                        </div>
                        <button class="search-button" onclick="filtrarOrganizacoes()">
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
                    <div class="filter-tab active" data-filter="all">Todos</div>
                    <div class="filter-tab" data-filter="clube de futebol">Clubes Profissionais</div>
                    <div class="filter-tab" data-filter="escola de futebol">Escolinhas</div>
                    <div class="filter-tab" data-filter="academia">Academias</div>
                    <div class="filter-tab" data-filter="outro">Outros</div>
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
                    <?php
                    // Tentar buscar organizações do banco de dados
                    require("../../config/connect.php");

                    // Verificar se a tabela existe
                    $check_table = $conn->query("SHOW TABLES LIKE 'tbl_organizacao'");
                    $table_exists = $check_table->num_rows > 0;

                    // Se a tabela existir, buscar organizações
                    $orgs = [];
                    if ($table_exists) {
                        $result = $conn->query("SELECT * FROM tbl_organizacao ORDER BY created_at DESC");
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $orgs[] = $row;
                            }
                        }
                    }

                    // Se não houver organizações no banco, usar dados estáticos
                    if (empty($orgs)) {
                    ?>







                        <?php
                    } else {
                        // Exibir organizações do banco de dados
                        foreach ($orgs as $org) {
                            // Determinar o badge
                            $badge_class = 'new';
                            $badge_icon = 'fas fa-bolt';
                            $badge_text = 'Novo';

                            if (isset($org['created_at'])) {
                                $data_criacao = new DateTime($org['created_at']);
                                $hoje = new DateTime();
                                $diferenca = $hoje->diff($data_criacao)->days;

                                if ($diferenca <= 7) {
                                    $badge_class = 'new';
                                    $badge_icon = 'fas fa-bolt';
                                    $badge_text = 'Novo';
                                } elseif ($org['tipo'] === 'clube de futebol') {
                                    $badge_class = 'verified';
                                    $badge_icon = 'fas fa-check-circle';
                                    $badge_text = 'Verificado';
                                } else {
                                    $badge_class = 'featured';
                                    $badge_icon = 'fas fa-star';
                                    $badge_text = 'Destaque';
                                }
                            }

                            // Determinar logo
                            $logo_path = !empty($org['logo_org']) ? '../../' . $org['logo_org'] : '../../public/images/default-org-logo.png';

                            // Calcular estatísticas (simuladas)
                            $anos_funcionamento = isset($org['data_fundacao']) ? date('Y') - date('Y', strtotime($org['data_fundacao'])) : rand(1, 20);
                            $avaliacao = number_format(4.0 + (rand(0, 9) / 10), 1);
                            $atletas = rand(20, 200);
                        ?>

                            <div class="org-card animate-fadeInUp" data-tipo="<?php echo htmlspecialchars($org['tipo'] ?? ''); ?>">
                                <div class="org-badge <?php echo $badge_class; ?>">
                                    <i class="<?php echo $badge_icon; ?>"></i> <?php echo $badge_text; ?>
                                </div>
                                <div class="org-header">
                                    <div class="org-cover" style="background: linear-gradient(135deg, #059669 0%, #047857 100%);"></div>
                                </div>
                                <div class="org-logo">
                                    <img src="<?php echo $logo_path; ?>" alt="Logo <?php echo htmlspecialchars($org['nome_org'] ?? 'da Organização'); ?>" onerror="this.src='../../public/images/default-org-logo.png'">
                                </div>
                                <div class="org-content">
                                    <h3 class="org-title"><?php echo htmlspecialchars($org['nome_org'] ?? 'Nome da Organização'); ?></h3>
                                    <div class="org-location">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <?php
                                        if (!empty($org['cep'])) {
                                            echo "CEP: " . htmlspecialchars(substr($org['cep'], 0, 5) . "-" . substr($org['cep'], 5));
                                        } else {
                                            echo "Localização não informada";
                                        }
                                        ?>
                                    </div>
                                    <p class="org-description">
                                        <?php
                                        $descricao = !empty($org['descricao']) ? $org['descricao'] : 'Organização esportiva comprometida com o desenvolvimento de talentos no futebol.';
                                        echo htmlspecialchars(substr($descricao, 0, 120)) . '...';
                                        ?>
                                    </p>
                                    <div class="org-stats">
                                        <div class="org-stat">
                                            <div class="org-stat-value"><?php echo $atletas; ?>+</div>
                                            <div class="org-stat-label">Atletas</div>
                                        </div>
                                        <div class="org-stat">
                                            <div class="org-stat-value"><?php echo $avaliacao; ?></div>
                                            <div class="org-stat-label">Avaliação</div>
                                        </div>
                                        <div class="org-stat">
                                            <div class="org-stat-value"><?php echo $anos_funcionamento; ?>+</div>
                                            <div class="org-stat-label">Anos</div>
                                        </div>
                                    </div>
                                    <div class="org-tags">
                                        <div class="org-tag"><?php echo htmlspecialchars(ucfirst($org['tipo'] ?? 'Organização')); ?></div>
                                        <?php if (!empty($org['data_fundacao'])): ?>
                                            <div class="org-tag">Fundada em <?php echo date('Y', strtotime($org['data_fundacao'])); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="org-footer">
                                        <a href="organizacao.php?id=<?php echo $org['id_org'] ?? '1'; ?>">
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

                    <?php
                        }
                    }
                    ?>
                </div>





    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-pattern"></div>
        <div class="cta-container">
            <h2 class="cta-title">Cadastre sua Organização</h2>
            <p class="cta-description">Aumente sua visibilidade, encontre novos talentos e faça parte da maior rede de organizações esportivas do Brasil.</p>
            <div class="cta-buttons">
                <a href="signup-org.php">
                    <button class="cta-button cta-button-primary">
                        <i class="fas fa-building"></i> Cadastrar Organização
                    </button>
                </a>
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
                    viewOptions.forEach(opt => opt.classList.remove('active'));
                    this.classList.add('active');

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
                    filterTabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    const filterValue = this.dataset.filter;
                    filtrarPorTipo(filterValue);
                });
            });

            // Função para filtrar por tipo
            function filtrarPorTipo(tipo) {
                const orgCards = document.querySelectorAll('.org-card, .list-org');

                orgCards.forEach(card => {
                    if (tipo === 'all' || card.dataset.tipo === tipo) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            // Função de busca
            window.filtrarOrganizacoes = function() {
                const searchTerm = document.getElementById('searchInput').value.toLowerCase();
                const tipoFilter = document.getElementById('tipoFilter').value;
                const locationFilter = document.getElementById('locationFilter').value;

                const orgCards = document.querySelectorAll('.org-card, .list-org');

                orgCards.forEach(card => {
                    const titulo = card.querySelector('.org-title').textContent.toLowerCase();
                    const tipo = card.dataset.tipo || '';
                    const location = card.querySelector('.org-location').textContent.toLowerCase();

                    let showCard = true;

                    // Filtro por texto
                    if (searchTerm && !titulo.includes(searchTerm) && !location.includes(searchTerm)) {
                        showCard = false;
                    }

                    // Filtro por tipo
                    if (tipoFilter && tipo !== tipoFilter) {
                        showCard = false;
                    }

                    // Filtro por localização
                    if (locationFilter && !location.includes(locationFilter.toLowerCase())) {
                        showCard = false;
                    }

                    card.style.display = showCard ? '' : 'none';
                });
            };

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

            animatedElements.forEach(element => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px)';
                element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            });

            checkScroll();
            window.addEventListener('scroll', checkScroll);
        });
    </script>
</body>