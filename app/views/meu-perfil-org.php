<?php
@session_start();

// Verificar se é uma organização logada
if (!isset($_SESSION['org_id'])) {
    header('Location: login.php');
    exit();
}

include('topo.php');

// Buscar dados da organização logada
require("../../config/connect.php");

$org_id = $_SESSION['org_id'];

// Buscar organização do banco
$query = "SELECT * FROM tbl_organizacao WHERE id_org = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $org_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $org = $result->fetch_assoc();
} else {
    // Logout se não encontrar a organização
    session_destroy();
    header('Location: login.php');
    exit();
}

// Calcular anos de funcionamento
$anos_funcionamento = isset($org['data_fundacao']) ? date('Y') - date('Y', strtotime($org['data_fundacao'])) : 0;

// Determinar banner
$banner_path = !empty($org['logo_org']) ? '../../' . $org['logo_org'] : '/placeholder.svg?height=300&width=300';

// Buscar peneiras da organização
// $peneiras_query = "SELECT * FROM tbl_peneiras WHERE org_id = ? ORDER BY data ASC";
// $peneiras_stmt = $conn->prepare($peneiras_query);
// $peneiras_stmt->bind_param("i", $org_id);
// $peneiras_stmt->execute();
// $peneiras_result = $peneiras_stmt->get_result();
// $peneiras = [];
// while ($row = $peneiras_result->fetch_assoc()) {
//     $peneiras[] = $row;
// }

// DASHBOARD DA ORGANIZAÇÃO - Mostrar controles de edição
$is_own_org = true;

// Verificar se há mensagem de sucesso
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            alert('Peneira criada com sucesso!');
        });
    </script>";
}
?>

<title>Meu Perfil - <?php echo htmlspecialchars($org['nome_org']); ?> - FutLink</title>
<link rel="stylesheet" href="../../public/css/organizacao.css">

<body>
    <?php include 'navbar-social.php'; ?>

    <main>
        <section class="banner">
            <div class="banner-overlay"></div>
            <div class="banner-container">
                <div class="logo-org">
                    <img src="<?php echo htmlspecialchars($banner_path); ?>" alt="Logo da <?php echo htmlspecialchars($org['nome_org']); ?>">
                    <!-- DASHBOARD: Botão para editar logo -->
                    <div class="edit-logo-btn" onclick="editarLogo()">
                        <i class="fas fa-camera"></i>
                    </div>
                </div>
                <div class="banner-info">
                    <div class="nome-social">
                        <h1><?php echo htmlspecialchars($org['nome_org']); ?></h1>
                        <div class="social-icons">
                            <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" title="YouTube"><i class="fab fa-youtube"></i></a>
                            <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                            <!-- DASHBOARD: Botão para editar redes sociais -->
                            <button class="edit-social-btn" onclick="editarRedesSociais()">
                                <i class="fas fa-edit"></i>
                            </button>
                        </div>
                    </div>
                    <?php if (!empty($org['bio'])): ?>
                    <p class="bio">
                        <?php echo htmlspecialchars($org['bio']); ?>
                        <!-- DASHBOARD: Botão para editar bio -->
                        <button class="edit-bio-btn" onclick="editarBio()">
                            <i class="fas fa-edit"></i>
                        </button>
                    </p>
                    <?php endif; ?>
                    
                    <div class="contato-info">
                        <?php if (!empty($org['email'])): ?>
                        <div class="contato-item">
                            <i class="fas fa-envelope"></i>
                            <span><?php echo htmlspecialchars($org['email']); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($org['telefone_org'])): ?>
                        <div class="contato-item">
                            <i class="fas fa-phone"></i>
                            <span><?php echo htmlspecialchars($org['telefone_org']); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($org['cep'])): ?>
                        <div class="contato-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>CEP: <?php 
                                $cep_formatado = strlen($org['cep']) >= 8 ? 
                                    substr($org['cep'], 0, 5) . "-" . substr($org['cep'], 5) : 
                                    $org['cep'];
                                echo htmlspecialchars($cep_formatado);
                            ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- DASHBOARD: Botões de gerenciamento -->
                    <div class="acoes">
                        <button class="btn-principal" onclick="editarPerfil()">
                            <i class="fas fa-edit"></i> Editar Perfil
                        </button>
                        <a href="organizacao.php?id=<?php echo $org_id; ?>" class="btn-secundario">
                            <i class="fas fa-eye"></i> Ver Perfil Público
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <div class="container">
            <!-- DASHBOARD: Estatísticas rápidas -->
            <div class="stats-dashboard">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo count($peneiras); ?></h3>
                        <p>Peneiras Ativas</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3>1.2k</h3>
                        <p>Seguidores</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-info">
                        <h3>3.4k</h3>
                        <p>Visualizações</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="stat-info">
                        <h3>89</h3>
                        <p>Curtidas</p>
                    </div>
                </div>
            </div>

            <div class="grid-principal">
                <div class="coluna-esquerda">
                    <?php if (!empty($org['descricao']) || !empty($org['bio'])): ?>
                    <section class="card sobre">
                        <h2>
                            <i class="fas fa-building"></i> Sobre a Organização
                            <!-- DASHBOARD: Botão para editar descrição -->
                            <button class="edit-section-btn" onclick="editarDescricao()">
                                <i class="fas fa-edit"></i>
                            </button>
                        </h2>
                        <div class="texto-sobre">
                            <?php if (!empty($org['descricao'])): ?>
                            <p><?php echo nl2br(htmlspecialchars($org['descricao'])); ?></p>
                            <?php endif; ?>
                        </div>
                    </section>
                    <?php endif; ?>

                    <?php 
                    // Só mostrar seção de informações se tiver dados relevantes
                    $has_info = !empty($org['data_fundacao']) || !empty($org['tipo']) || $anos_funcionamento > 0 || !empty($org['email']) || !empty($org['telefone_org']);
                    if ($has_info): 
                    ?>
                    <section class="card info-org">
                        <h2>
                            <i class="fas fa-info-circle"></i> Informações
                            <!-- DASHBOARD: Botão para editar informações -->
                            <button class="edit-section-btn" onclick="editarInformacoes()">
                                <i class="fas fa-edit"></i>
                            </button>
                        </h2>
                        <div class="info-grid">
                            <?php if (!empty($org['data_fundacao'])): ?>
                            <div class="info-item">
                                <i class="fas fa-calendar-alt"></i>
                                <div class="info-content">
                                    <span class="info-label">Fundação</span>
                                    <span class="info-valor"><?php echo date('Y', strtotime($org['data_fundacao'])); ?></span>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($org['tipo'])): ?>
                            <div class="info-item">
                                <i class="fas fa-tag"></i>
                                <div class="info-content">
                                    <span class="info-label">Tipo</span>
                                    <span class="info-valor"><?php echo htmlspecialchars(ucfirst($org['tipo'])); ?></span>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($anos_funcionamento > 0): ?>
                            <div class="info-item">
                                <i class="fas fa-clock"></i>
                                <div class="info-content">
                                    <span class="info-label">Anos de Atividade</span>
                                    <span class="info-valor"><?php echo $anos_funcionamento; ?> anos</span>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($org['email'])): ?>
                            <div class="info-item">
                                <i class="fas fa-envelope"></i>
                                <div class="info-content">
                                    <span class="info-label">Email</span>
                                    <span class="info-valor"><?php echo htmlspecialchars($org['email']); ?></span>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($org['telefone_org'])): ?>
                            <div class="info-item">
                                <i class="fas fa-phone"></i>
                                <div class="info-content">
                                    <span class="info-label">Telefone</span>
                                    <span class="info-valor"><?php echo htmlspecialchars($org['telefone_org']); ?></span>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </section>
                    <?php endif; ?>

                    <section class="card posts">
                        <h2>
                            <i class="fas fa-stream"></i> Minhas Publicações
                            <!-- DASHBOARD: Botão para criar post -->
                            <button class="edit-section-btn" onclick="criarPost()">
                                <i class="fas fa-plus"></i>
                            </button>
                        </h2>
                        <div class="posts-lista">
                            <div class="post">
                                <div class="post-header">
                                    <img src="<?php echo htmlspecialchars($banner_path); ?>" alt="Logo pequeno">
                                    <div class="post-info">
                                        <h3><?php echo htmlspecialchars($org['nome_org']); ?></h3>
                                        <span class="post-data">Publicado há 2 dias</span>
                                    </div>
                                    <!-- DASHBOARD: Botões de edição do post -->
                                    <div class="post-actions">
                                        <button onclick="editarPost(1)"><i class="fas fa-edit"></i></button>
                                        <button onclick="excluirPost(1)"><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                                <div class="post-conteudo">
                                    <p>Estamos muito felizes em anunciar nossa nova temporada! Continuamos trabalhando para desenvolver novos talentos para o futebol brasileiro.</p>
                                    <img src="/placeholder.svg?height=300&width=600" alt="Imagem do post">
                                </div>
                                <div class="post-acoes">
                                    <button class="curtir"><i class="far fa-heart"></i> 42 Curtidas</button>
                                    <button class="comentar"><i class="far fa-comment"></i> 8 Comentários</button>
                                    <button class="compartilhar"><i class="far fa-share-square"></i> Compartilhar</button>
                                </div>
                            </div>
                        </div>
                        <button class="btn-mais">Carregar mais posts</button>
                    </section>
                </div>

                <div class="coluna-direita">
                    <section class="card peneiras">
                        <h2><i class="fas fa-search"></i> Minhas Peneiras</h2>
                        
                        <!-- DASHBOARD: Botão para criar peneira -->
                        <a href="addPeneira-org.php" class="btn-criar-peneira">
                            <i class="fas fa-plus"></i> Criar Nova Peneira
                        </a>
                        
                        <div class="lista-peneiras">
                            <?php if (count($peneiras) > 0): ?>
                                <?php foreach ($peneiras as $peneira): ?>
                                <div class="peneira-item">
                                    <div class="peneira-header">
                                        <h3><?php echo htmlspecialchars($peneira['titulo']); ?></h3>
                                        <span class="peneira-badge <?php echo strtolower($peneira['status']); ?>">
                                            <?php echo htmlspecialchars($peneira['status']); ?>
                                        </span>
                                        <!-- DASHBOARD: Botões de edição da peneira -->
                                        <div class="peneira-actions">
                                            <button onclick="editarPeneira(<?php echo $peneira['id_peneira']; ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button onclick="excluirPeneira(<?php echo $peneira['id_peneira']; ?>)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="peneira-info">
                                        <div class="info-row">
                                            <i class="fas fa-calendar"></i>
                                            <span><?php echo date('d/m/Y', strtotime($peneira['data'])); ?></span>
                                        </div>
                                        <div class="info-row">
                                            <i class="fas fa-clock"></i>
                                            <span><?php echo date('H:i', strtotime($peneira['horario'])); ?></span>
                                        </div>
                                        <div class="info-row">
                                            <i class="fas fa-map-pin"></i>
                                            <span><?php echo htmlspecialchars($peneira['localizacao']); ?></span>
                                        </div>
                                        <div class="info-row">
                                            <i class="fas fa-users"></i>
                                            <span><?php echo htmlspecialchars($peneira['faixa_etaria']); ?></span>
                                        </div>
                                        <div class="info-row">
                                            <i class="fas fa-money-bill-wave"></i>
                                            <span>
                                                <?php 
                                                if (isset($peneira['tipo_taxa']) && $peneira['tipo_taxa'] === 'gratuita') {
                                                    echo 'Gratuita';
                                                } elseif (isset($peneira['valor_inscricao']) && $peneira['valor_inscricao'] > 0) {
                                                    echo 'R$ ' . number_format($peneira['valor_inscricao'], 2, ',', '.');
                                                } elseif (!empty($peneira['inscricao'])) {
                                                    echo htmlspecialchars($peneira['inscricao']);
                                                } else {
                                                    echo 'Consultar';
                                                }
                                                ?>
                                            </span>
                                        </div>
                                        <!-- DASHBOARD: Estatísticas da peneira -->
                                        <div class="info-row">
                                            <i class="fas fa-eye"></i>
                                            <span>156 visualizações</span>
                                        </div>
                                        <div class="info-row">
                                            <i class="fas fa-hand-paper"></i>
                                            <span>23 interessados</span>
                                        </div>
                                    </div>
                                    <button class="btn-peneira" onclick="gerenciarPeneira(<?php echo $peneira['id_peneira']; ?>)">
                                        <i class="fas fa-cog"></i> Gerenciar
                                    </button>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="empty-state">
                                    <i class="fas fa-search"></i>
                                    <h3>Nenhuma peneira cadastrada</h3>
                                    <p>Crie sua primeira peneira para começar a atrair talentos!</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <?php if (count($peneiras) > 3): ?>
                        <button class="btn-mais">Ver todas as peneiras</button>
                        <?php endif; ?>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <?php include("footer.php"); ?>

    <script>
        // Funcionalidades do dashboard
        function editarLogo() {
            alert('Funcionalidade de editar logo será implementada em breve!');
        }
        
        function editarRedesSociais() {
            alert('Funcionalidade de editar redes sociais será implementada em breve!');
        }
        
        function editarBio() {
            alert('Funcionalidade de editar bio será implementada em breve!');
        }
        
        function editarPerfil() {
            alert('Funcionalidade de editar perfil será implementada em breve!');
        }
        
        function editarDescricao() {
            alert('Funcionalidade de editar descrição será implementada em breve!');
        }
        
        function editarInformacoes() {
            alert('Funcionalidade de editar informações será implementada em breve!');
        }
        
        function criarPost() {
            alert('Funcionalidade de criar post será implementada em breve!');
        }
        
        function editarPost(postId) {
            alert('Editar post #' + postId);
        }
        
        function excluirPost(postId) {
            if (confirm('Tem certeza que deseja excluir este post?')) {
                alert('Post #' + postId + ' excluído!');
            }
        }
        
        function editarPeneira(peneiraId) {
            alert('Editar peneira #' + peneiraId);
        }
        
        function excluirPeneira(peneiraId) {
            if (confirm('Tem certeza que deseja excluir esta peneira?')) {
                alert('Peneira #' + peneiraId + ' excluída!');
            }
        }
        
        function gerenciarPeneira(peneiraId) {
            alert('Gerenciar peneira #' + peneiraId + '\n- Ver inscritos\n- Editar detalhes\n- Alterar status');
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Funcionalidade dos botões de ação dos posts
            const curtirButtons = document.querySelectorAll('.curtir');
            curtirButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    if (icon.classList.contains('far')) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        this.style.color = '#f43f5e';
                    } else {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        this.style.color = '';
                    }
                });
            });
        });
    </script>

    <style>
        /* Estilos específicos para o dashboard */
        .edit-logo-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .edit-logo-btn:hover {
            background: rgba(0, 0, 0, 0.9);
            transform: scale(1.1);
        }
        
        .edit-social-btn,
        .edit-bio-btn,
        .edit-section-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
            transition: all 0.3s ease;
        }
        
        .edit-section-btn {
            color: var(--verde);
            background: rgba(0, 150, 36, 0.1);
        }
        
        .edit-social-btn:hover,
        .edit-bio-btn:hover,
        .edit-section-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }
        
        .stats-dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--verde) 0%, var(--verde-claro) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }
        
        .stat-info h3 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--verde-escuro);
            margin: 0;
        }
        
        .stat-info p {
            color: var(--cinza);
            margin: 0;
            font-size: 0.9rem;
        }
        
        .post-actions,
        .peneira-actions {
            display: flex;
            gap: 5px;
            margin-left: auto;
        }
        
        .post-actions button,
        .peneira-actions button {
            background: rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .post-actions button:hover,
        .peneira-actions button:hover {
            background: rgba(0, 0, 0, 0.2);
            transform: scale(1.1);
        }
        
        .peneira-header {
            position: relative;
        }
        
        .peneira-actions {
            position: absolute;
            top: 0;
            right: 0;
        }
        
        /* Responsividade */
        @media (max-width: 768px) {
            .stats-dashboard {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .edit-social-btn,
            .edit-bio-btn {
                display: none;
            }
        }
    </style>
</body>
</html>
