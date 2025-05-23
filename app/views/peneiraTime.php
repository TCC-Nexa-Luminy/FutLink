<?php 
include("topo.php");
require("../../config/connect.php");

// Verificar se foi passado um ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: peneiras.php");
    exit();
}

$peneira_id = (int)$_GET['id'];

// Buscar dados da peneira específica
$sql = "SELECT * FROM peneiras WHERE id = ? AND status != 'Inativa'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $peneira_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: peneiras.php");
    exit();
}

$peneira = $result->fetch_assoc();

// Processar dados da peneira
$fotos = json_decode($peneira['caminho_foto'], true);
$documentos = json_decode($peneira['caminho_documento'], true);

// Determinar foto principal
$foto_principal = '';
if ($fotos && is_array($fotos) && !empty($fotos)) {
    $foto_principal = '../../controllers/' . $fotos[0];
} else {
    $foto_principal = '../../public/images/default-peneira.jpg';
}

// Determinar status
$status_class = '';
$status_text = '';
$status_icon = 'fas fa-circle';

if ($peneira['inscricao'] == 'Aberta' && $peneira['status'] == 'Ativa') {
    $status_class = 'status-open';
    $status_text = 'Inscrições Abertas';
} elseif ($peneira['inscricao'] == 'Fechada') {
    $status_class = 'status-closed';
    $status_text = 'Inscrições Encerradas';
} else {
    $status_class = 'status-soon';
    $status_text = 'Em Breve';
}

// Formatar data e horário
$data_formatada = date('d \d\e F \d\e Y', strtotime($peneira['data']));
$horario_formatado = date('H:i', strtotime($peneira['horario']));

// Meses em português
$meses = [
    'January' => 'Janeiro', 'February' => 'Fevereiro', 'March' => 'Março',
    'April' => 'Abril', 'May' => 'Maio', 'June' => 'Junho',
    'July' => 'Julho', 'August' => 'Agosto', 'September' => 'Setembro',
    'October' => 'Outubro', 'November' => 'Novembro', 'December' => 'Dezembro'
];

foreach ($meses as $en => $pt) {
    $data_formatada = str_replace($en, $pt, $data_formatada);
}
?>

<link rel="stylesheet" href="../../public/css/peneiraTime.css">
<!-- Adicione Font Awesome para ícones -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<body>
    <?php include("navbar-social.php"); ?>
    <main>
        <!-- Hero Banner -->
        <section class="hero-banner">
            <img src="<?php echo $foto_principal; ?>" alt="<?php echo htmlspecialchars($peneira['titulo']); ?>" class="hero-image">
            <div class="hero-overlay"></div>
            <a href="peneiras.php" class="back-button">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="hero-content">
                <div class="club-logo">
                    <img src="../../public/images/club-placeholder.png" alt="Logo <?php echo htmlspecialchars($peneira['clube']); ?>">
                </div>
                <div class="hero-text">
                    <span class="status-badge <?php echo $status_class; ?>">
                        <i class="<?php echo $status_icon; ?>"></i> <?php echo $status_text; ?>
                    </span>
                    <h1 class="hero-title"><?php echo htmlspecialchars($peneira['titulo']); ?></h1>
                    <p class="hero-subtitle"><?php echo htmlspecialchars($peneira['clube']); ?></p>
                </div>
            </div>
        </section>

        <!-- Content Section -->
        <section class="content-section">
            <div class="content-grid">
                <!-- Main Content -->
                <div class="main-content">
                    <!-- Description Card -->
                    <div class="content-card animate-fadeInUp">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <h2 class="card-title">Sobre a Peneira</h2>
                        </div>
                        <div class="card-body">
                            <p class="description-text">
                                <?php echo nl2br(htmlspecialchars($peneira['descricao'])); ?>
                            </p>

                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Localização</div>
                                        <div class="info-value"><?php echo htmlspecialchars($peneira['localizacao']); ?></div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Data</div>
                                        <div class="info-value"><?php echo $data_formatada; ?></div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Horário</div>
                                        <div class="info-value"><?php echo $horario_formatado; ?></div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Inscrição</div>
                                        <div class="info-value">
                                            <?php 
                                            echo ($peneira['inscricao'] == 'Aberta') ? 'Gratuita' : 'Consultar';
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Requirements Card -->
                    <div class="content-card animate-fadeInUp delay-100">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                            <h2 class="card-title">Documentação Obrigatória</h2>
                        </div>
                        <div class="card-body">
                            <?php if ($documentos && is_array($documentos) && !empty($documentos)): ?>
                                <div class="documents-grid">
                                    <?php foreach ($documentos as $documento): ?>
                                        <div class="document-item">
                                            <div class="document-icon">
                                                <i class="fas fa-file-pdf"></i>
                                            </div>
                                            <div class="document-text">
                                                <a href="../../controllers/<?php echo $documento; ?>" target="_blank">
                                                    Ver documento
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <ul class="document-list">
                                    <li class="document-item">
                                        <div class="document-icon">
                                            <i class="fas fa-id-card"></i>
                                        </div>
                                        <div class="document-text">Cópia do RG ou certidão de nascimento</div>
                                    </li>
                                    <li class="document-item">
                                        <div class="document-icon">
                                            <i class="fas fa-file-signature"></i>
                                        </div>
                                        <div class="document-text">Autorização assinada pelos pais ou responsáveis</div>
                                    </li>
                                    <li class="document-item">
                                        <div class="document-icon">
                                            <i class="fas fa-notes-medical"></i>
                                        </div>
                                        <div class="document-text">Atestado médico de aptidão física (emitido nos últimos 6 meses)</div>
                                    </li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Age Requirements Card -->
                    <div class="content-card animate-fadeInUp delay-200">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-child"></i>
                            </div>
                            <h2 class="card-title">Requisitos de Idade</h2>
                        </div>
                        <div class="card-body">
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-birthday-cake"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Faixa Etária</div>
                                    <div class="info-value"><?php echo htmlspecialchars($peneira['faixa_etaria']); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Photos Card -->
                    <div class="content-card animate-fadeInUp delay-300">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-images"></i>
                            </div>
                            <h2 class="card-title">Fotos do Local</h2>
                        </div>
                        <div class="card-body">
                            <div class="photos-grid">
                                <?php if ($fotos && is_array($fotos) && !empty($fotos)): ?>
                                    <?php foreach ($fotos as $index => $foto): ?>
                                        <div class="photo-item">
                                            <img src="../../controllers/<?php echo $foto; ?>" 
                                                 alt="Foto <?php echo $index + 1; ?> da peneira"
                                                 onclick="openPhotoModal(this.src)">
                                        </div>
                                    <?php endforeach; ?>
                                    
                                    <!-- Preencher com placeholders se houver menos de 3 fotos -->
                                    <?php for ($i = count($fotos); $i < 3; $i++): ?>
                                        <div class="photo-item">
                                            <div class="photo-placeholder">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                <?php else: ?>
                                    <!-- Placeholders padrão se não houver fotos -->
                                    <div class="photo-item">
                                        <div class="photo-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    </div>
                                    <div class="photo-item">
                                        <div class="photo-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    </div>
                                    <div class="photo-item">
                                        <div class="photo-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="sidebar">
                    <div class="action-card animate-fadeInUp delay-100">
                        <h3 class="action-title">Informações da Peneira</h3>
                        <p class="action-subtitle">Confira os detalhes antes de se inscrever</p>

                        <div class="action-info">
                            <div class="action-icon">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                            <div class="action-text">
                                <div class="action-label">Data</div>
                                <div class="action-value"><?php echo $data_formatada; ?></div>
                            </div>
                        </div>

                        <div class="action-info">
                            <div class="action-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="action-text">
                                <div class="action-label">Horário</div>
                                <div class="action-value"><?php echo $horario_formatado; ?></div>
                            </div>
                        </div>

                        <div class="action-info">
                            <div class="action-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="action-text">
                                <div class="action-label">Local</div>
                                <div class="action-value"><?php echo htmlspecialchars($peneira['localizacao']); ?></div>
                            </div>
                        </div>

                        <div class="action-info">
                            <div class="action-icon">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div class="action-text">
                                <div class="action-label">Taxa de Inscrição</div>
                                <div class="action-value">
                                    <?php 
                                    echo ($peneira['inscricao'] == 'Aberta') ? 'Gratuita' : 'Consultar';
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="action-info">
                            <div class="action-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="action-text">
                                <div class="action-label">Vagas</div>
                                <div class="action-value">Limitadas</div>
                            </div>
                        </div>

                        <div class="action-info">
                            <div class="action-icon">
                                <i class="fas fa-child"></i>
                            </div>
                            <div class="action-text">
                                <div class="action-label">Faixa Etária</div>
                                <div class="action-value"><?php echo htmlspecialchars($peneira['faixa_etaria']); ?></div>
                            </div>
                        </div>

                        <?php if ($peneira['inscricao'] == 'Aberta' && $peneira['status'] == 'Ativa'): ?>
                            <button class="action-button" onclick="inscreverPeneira(<?php echo $peneira['id']; ?>)">
                                <i class="fas fa-user-plus"></i> Inscrever-se
                            </button>
                        <?php else: ?>
                            <button class="action-button disabled" disabled>
                                <i class="fas fa-times-circle"></i> Inscrições Encerradas
                            </button>
                        <?php endif; ?>

                        <div class="share-buttons">
                            <button class="share-button facebook" onclick="compartilharFacebook()">
                                <i class="fab fa-facebook-f"></i>
                            </button>
                            <button class="share-button twitter" onclick="compartilharTwitter()">
                                <i class="fab fa-twitter"></i>
                            </button>
                            <button class="share-button whatsapp" onclick="compartilharWhatsApp()">
                                <i class="fab fa-whatsapp"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Modal para visualizar fotos -->
    <div id="photoModal" class="photo-modal" onclick="closePhotoModal()">
        <div class="photo-modal-content">
            <span class="photo-modal-close" onclick="closePhotoModal()">&times;</span>
            <img id="photoModalImage" src="/placeholder.svg" alt="Foto ampliada">
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

        // Função para abrir modal de foto
        function openPhotoModal(src) {
            document.getElementById('photoModal').style.display = 'block';
            document.getElementById('photoModalImage').src = src;
        }

        // Função para fechar modal de foto
        function closePhotoModal() {
            document.getElementById('photoModal').style.display = 'none';
        }

        // Função para inscrever na peneira
        function inscreverPeneira(peneiraId) {
            // Aqui você pode implementar a lógica de inscrição
            alert('Funcionalidade de inscrição será implementada em breve!\nPeneira ID: ' + peneiraId);
        }

        // Funções de compartilhamento
        function compartilharFacebook() {
            const url = encodeURIComponent(window.location.href);
            const titulo = encodeURIComponent('<?php echo addslashes($peneira['titulo']); ?>');
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
        }

        function compartilharTwitter() {
            const url = encodeURIComponent(window.location.href);
            const texto = encodeURIComponent('Confira esta peneira: <?php echo addslashes($peneira['titulo']); ?>');
            window.open(`https://twitter.com/intent/tweet?text=${texto}&url=${url}`, '_blank');
        }

        function compartilharWhatsApp() {
            const url = encodeURIComponent(window.location.href);
            const texto = encodeURIComponent('Confira esta peneira: <?php echo addslashes($peneira['titulo']); ?> - ');
            window.open(`https://wa.me/?text=${texto}${url}`, '_blank');
        }

        // Fechar modal com ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePhotoModal();
            }
        });
    </script>

    <style>
        /* Estilos para o modal de fotos */
        .photo-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
        }

        .photo-modal-content {
            position: relative;
            margin: auto;
            padding: 20px;
            width: 90%;
            max-width: 800px;
            top: 50%;
            transform: translateY(-50%);
        }

        .photo-modal-close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
        }

        .photo-modal-close:hover {
            color: #bbb;
        }

        #photoModalImage {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .photos-grid img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .photos-grid img:hover {
            transform: scale(1.05);
        }

        .action-button.disabled {
            background-color: #ccc;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .action-button.disabled:hover {
            background-color: #ccc;
            transform: none;
        }

        .documents-grid {
            display: grid;
            gap: 15px;
        }

        .documents-grid .document-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .documents-grid .document-item:hover {
            background: #e9ecef;
        }

        .documents-grid .document-text a {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }

        .documents-grid .document-text a:hover {
            text-decoration: underline;
        }
    </style>
</body>
