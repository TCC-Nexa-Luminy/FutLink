<?php
@session_start();
include("topo.php");
?>
<link rel="stylesheet" href="../../public/css/peneiras.css">

<body>
    <?php
    include("navbar-social.php");
    include_once("message.php");
    
    // Conecta ao banco de dados
    require("../../config/connect.php");
    
    // Busca peneiras do banco de dados
    $sql = "SELECT * FROM peneiras ORDER BY data DESC";
    $result = $conn->query($sql);
    
    // Mensagens de feedback
    if(isset($_GET['success'])) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                alert('Peneira criada com sucesso!');
            });
        </script>";
    }
    
    if(isset($_GET['error'])) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                alert('Erro ao criar peneira. Tente novamente.');
            });
        </script>";
    }
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
                    <h2 class="section-title">Peneiras Disponíveis</h2>
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
                    <?php
                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            // Determina o badge baseado na data e status
                            $data_peneira = new DateTime($row['data']);
                            $hoje = new DateTime();
                            $diferenca = $hoje->diff($data_peneira)->days;
                            
                            $badge_class = '';
                            $badge_text = '';
                            $badge_icon = '';
                            
                            if($diferenca <= 7 && $data_peneira > $hoje) {
                                $badge_class = 'new';
                                $badge_text = 'Novo';
                                $badge_icon = 'fas fa-bolt';
                            } elseif($row['status'] == 'Ativa' && $row['inscricao'] == 'Aberta') {
                                $badge_class = 'featured';
                                $badge_text = 'Destaque';
                                $badge_icon = 'fas fa-star';
                            }
                            
                            // Determina o status
                            $status_class = '';
                            $status_text = '';
                            
                            if($row['inscricao'] == 'Aberta' && $row['status'] == 'Ativa') {
                                $status_class = 'status-open';
                                $status_text = 'Inscrições Abertas';
                            } elseif($row['inscricao'] == 'Fechada') {
                                $status_class = 'status-closed';
                                $status_text = 'Inscrições Encerradas';
                            } else {
                                $status_class = 'status-soon';
                                $status_text = 'Em Breve';
                            }
                            
                            // Processa as fotos
                            $fotos = json_decode($row['caminho_foto'], true);
                            $primeira_foto = '';
                            
                            if($fotos && is_array($fotos) && !empty($fotos)) {
                                $primeira_foto = '../../controllers/' . $fotos[0];
                            } else {
                                // Foto padrão se não houver foto
                                $primeira_foto = '../../public/images/default-peneira.jpg';
                            }
                            
                            // Formata a data
                            $data_formatada = date('d/m/Y', strtotime($row['data']));
                            $horario_formatado = date('H:i', strtotime($row['horario']));
                    ?>
                    
                    <div class="card animate-fadeInUp delay-300">
                        <?php if($badge_text): ?>
                        <div class="card-badge <?php echo $badge_class; ?>">
                            <i class="<?php echo $badge_icon; ?>"></i> <?php echo $badge_text; ?>
                        </div>
                        <?php endif; ?>
                        
                        <div class="card-image">
                            <img src="<?php echo $primeira_foto; ?>" alt="<?php echo htmlspecialchars($row['titulo']); ?>">
                        </div>
                        
                        <div class="card-content">
                            <span class="card-status <?php echo $status_class; ?>">
                                <i class="fas fa-circle"></i> <?php echo $status_text; ?>
                            </span>
                            
                            <h3 class="card-title"><?php echo htmlspecialchars($row['titulo']); ?></h3>
                            <p class="card-description"><?php echo htmlspecialchars(substr($row['descricao'], 0, 150)) . '...'; ?></p>
                            
                            <div class="card-details">
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong><?php echo $data_formatada; ?></strong>
                                        Data
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong><?php echo $horario_formatado; ?></strong>
                                        Horário
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong><?php echo htmlspecialchars($row['localizacao']); ?></strong>
                                        Local
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-child"></i>
                                    </div>
                                    <div class="detail-text">
                                        <strong><?php echo htmlspecialchars($row['faixa_etaria']); ?></strong>
                                        Idade
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-footer">
                                <a href="peneiraTime.php?id=<?php echo $row['id']; ?>">
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
                    
                    <?php
                        }
                    } else {
                        echo "<p class='no-peneiras'>Nenhuma peneira encontrada. <a href='criar-peneira.php'>Criar a primeira peneira</a></p>";
                    }
                    ?>
                </div>

                <!-- List View (hidden by default) -->
                <div class="cards-list" id="list-view" style="display: none;">
                    <!-- O conteúdo da lista será gerado dinamicamente via JavaScript -->
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

            <!-- CTA Section -->
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
