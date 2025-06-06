<?php
@session_start();
include('topo.php');

// Buscar dados da organização
require("../../config/connect.php");

$org_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

// Buscar organização do banco
$query = "SELECT * FROM tbl_organizacao WHERE id_org = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $org_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $org = $result->fetch_assoc();
} else {
    // Redirecionar se não encontrar a organização
    header('Location: organizacoes.php');
    exit();
}

// Calcular anos de funcionamento
$anos_funcionamento = isset($org['data_fundacao']) ? date('Y') - date('Y', strtotime($org['data_fundacao'])) : 0;

// Determinar banner
$banner_path = !empty($org['logo_org']) ? '../../' . $org['logo_org'] : '/placeholder.svg?height=300&width=300';

// CORRIGIDO: Buscar peneiras da organização usando a tabela 'peneiras' existente
$peneiras = [];
try {
    // Verificar se a tabela peneiras existe
    $check_table = $conn->query("SHOW TABLES LIKE 'peneiras'");
    if ($check_table && $check_table->num_rows > 0) {
        // Como não temos org_id na tabela peneiras atual, vamos buscar todas as peneiras ativas
        // Em um sistema real, você deveria adicionar um campo org_id na tabela peneiras
        $peneiras_query = "SELECT * FROM peneiras WHERE `id_org` = '$org_id' ORDER BY data ASC LIMIT 10";
        $peneiras_result = $conn->query($peneiras_query);
        
        if ($peneiras_result) {
            while ($row = $peneiras_result->fetch_assoc()) {
                $peneiras[] = $row;
            }
        }
    }
} catch (Exception $e) {
    // Se houver erro, continuar sem peneiras
    error_log("Erro ao buscar peneiras: " . $e->getMessage());
    $peneiras = [];
}

// PÁGINA PÚBLICA - Não mostrar controles de edição
$is_public_view = true;
?>

<title><?php echo htmlspecialchars($org['nome_org']); ?> - FutLink</title>
<link rel="stylesheet" href="../../public/css/organizacao.css">

<body>
    <?php include 'navbar-social.php'; ?>

    <main>
        <section class="banner">
            <div class="banner-overlay"></div>
            <div class="banner-container">
                <div class="logo-org">
                    <img src="<?php echo htmlspecialchars($banner_path); ?>" alt="Logo da <?php echo htmlspecialchars($org['nome_org']); ?>">
                </div>
                <div class="banner-info">
                    <div class="nome-social">
                        <h1><?php echo htmlspecialchars($org['nome_org']); ?></h1>
                        <div class="social-icons">
                            <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" title="YouTube"><i class="fab fa-youtube"></i></a>
                            <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                    <?php if (!empty($org['bio'])): ?>
                    <p class="bio"><?php echo htmlspecialchars($org['bio']); ?></p>
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
                    
                    <!-- PÁGINA PÚBLICA: Botões de interação para visitantes -->
                    <div class="acoes">
                        <button class="btn-principal" onclick="abrirModalContato()">
                            <i class="fas fa-paper-plane"></i> Enviar Mensagem
                        </button>
                        <button class="btn-secundario" onclick="seguirOrganizacao()">
                            <i class="fas fa-user-plus"></i> Seguir
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="grid-principal">
                <div class="coluna-esquerda">
                    <?php if (!empty($org['descricao']) || !empty($org['bio'])): ?>
                    <section class="card sobre">
                        <h2><i class="fas fa-building"></i> Sobre a Organização</h2>
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
                        <h2><i class="fas fa-info-circle"></i> Informações</h2>
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
                            
                            <div class="info-item">
                                <i class="fas fa-users"></i>
                                <div class="info-content">
                                    <span class="info-label">Seguidores</span>
                                    <span class="info-valor">1.2k</span>
                                </div>
                            </div>
                            
                            <div class="info-item">
                                <i class="fas fa-trophy"></i>
                                <div class="info-content">
                                    <span class="info-label">Peneiras Ativas</span>
                                    <span class="info-valor"><?php echo count($peneiras); ?></span>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php endif; ?>

                    <section class="card posts">
                        <h2><i class="fas fa-stream"></i> Últimas Atualizações</h2>
                        <div class="posts-lista">
                            <div class="post">
                                <div class="post-header">
                                    <img src="<?php echo htmlspecialchars($banner_path); ?>" alt="Logo pequeno">
                                    <div class="post-info">
                                        <h3><?php echo htmlspecialchars($org['nome_org']); ?></h3>
                                        <span class="post-data">Publicado há 2 dias</span>
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

                            <div class="post">
                                <div class="post-header">
                                    <img src="<?php echo htmlspecialchars($banner_path); ?>" alt="Logo pequeno">
                                    <div class="post-info">
                                        <h3><?php echo htmlspecialchars($org['nome_org']); ?></h3>
                                        <span class="post-data">Publicado há 5 dias</span>
                                    </div>
                                </div>
                                <div class="post-conteudo">
                                    <p>Nossos jovens atletas continuam se destacando nos campeonatos regionais. Parabéns a todos os jogadores e comissão técnica pelo excelente trabalho!</p>
                                    <img src="/placeholder.svg?height=300&width=600" alt="Imagem do post">
                                </div>
                                <div class="post-acoes">
                                    <button class="curtir"><i class="far fa-heart"></i> 56 Curtidas</button>
                                    <button class="comentar"><i class="far fa-comment"></i> 12 Comentários</button>
                                    <button class="compartilhar"><i class="far fa-share-square"></i> Compartilhar</button>
                                </div>
                            </div>
                        </div>
                        <button class="btn-mais">Carregar mais posts</button>
                    </section>
                </div>

                <div class="coluna-direita">
                    <section class="card peneiras">
                        <h2><i class="fas fa-search"></i> Peneiras Disponíveis</h2>
                        
                        <!-- PÁGINA PÚBLICA: Não mostrar botão de criar peneira -->
                        
                        <div class="lista-peneiras">
                            <?php if (count($peneiras) > 0): ?>
                                <?php foreach ($peneiras as $peneira): ?>
                                <div class="peneira-item">
                                    <div class="peneira-header">
                                        <h3><?php echo htmlspecialchars($peneira['titulo']); ?></h3>
                                        <span class="peneira-badge <?php 
                                            // Mapear badge_type para classes CSS
                                            $badge_class = 'normal';
                                            if (isset($peneira['badge_type'])) {
                                                switch($peneira['badge_type']) {
                                                    case 'new': $badge_class = 'nova'; break;
                                                    case 'featured': $badge_class = 'destaque'; break;
                                                    default: $badge_class = 'normal'; break;
                                                }
                                            }
                                            echo $badge_class;
                                        ?>">
                                            <?php 
                                            // Exibir texto do badge
                                            if (isset($peneira['badge_type'])) {
                                                switch($peneira['badge_type']) {
                                                    case 'new': echo 'Nova'; break;
                                                    case 'featured': echo 'Destaque'; break;
                                                    default: echo 'Ativa'; break;
                                                }
                                            } else {
                                                echo 'Ativa';
                                            }
                                            ?>
                                        </span>
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
                                            <span><?php echo htmlspecialchars($peneira['inscricao'] ?? 'Consultar'); ?></span>
                                        </div>
                                        
                                        <!-- NOVO: Status das inscrições -->
                                        <div class="info-row">
                                            <i class="fas fa-info-circle"></i>
                                            <span class="status-inscricao <?php 
                                                $status_class = 'status-open';
                                                if (isset($peneira['status_inscricao'])) {
                                                    $status_class = $peneira['status_inscricao'];
                                                }
                                                echo $status_class;
                                            ?>">
                                                <?php 
                                                // Mapear status para texto legível
                                                $status_text = 'Inscrições Abertas';
                                                if (isset($peneira['status_inscricao'])) {
                                                    switch($peneira['status_inscricao']) {
                                                        case 'status-open': $status_text = 'Inscrições Abertas'; break;
                                                        case 'status-closed': $status_text = 'Inscrições Encerradas'; break;
                                                        case 'status-soon': $status_text = 'Em Breve'; break;
                                                        default: $status_text = 'Consultar'; break;
                                                    }
                                                }
                                                echo $status_text;
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <!-- Botão dinâmico baseado no status -->
                                    <?php 
                                    $btn_disabled = '';
                                    $btn_text = 'Tenho Interesse';
                                    $btn_icon = 'fas fa-hand-paper';
                                    
                                    if (isset($peneira['status_inscricao']) && $peneira['status_inscricao'] === 'status-closed') {
                                        $btn_disabled = 'disabled';
                                        $btn_text = 'Inscrições Encerradas';
                                        $btn_icon = 'fas fa-times-circle';
                                    } elseif (isset($peneira['status_inscricao']) && $peneira['status_inscricao'] === 'status-soon') {
                                        $btn_disabled = 'disabled';
                                        $btn_text = 'Em Breve';
                                        $btn_icon = 'fas fa-clock';
                                    }
                                    ?>
                                    
                                    <button class="btn-peneira <?php echo $btn_disabled; ?>" 
                                            onclick="interesseNaPeneira(<?php echo $peneira['id']; ?>)" 
                                            <?php echo $btn_disabled; ?>>
                                        <i class="<?php echo $btn_icon; ?>"></i> <?php echo $btn_text; ?>
                                    </button>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="empty-state">
                                    <i class="fas fa-search"></i>
                                    <h3>Nenhuma peneira disponível</h3>
                                    <p>Esta organização não possui peneiras ativas no momento.</p>
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

    <!-- Modal de Contato MELHORADO -->
    <div id="modalContato" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="fecharModalContato()">&times;</span>
            <div class="modal-header">
                <h2><i class="fas fa-envelope"></i> Entrar em Contato</h2>
                <p>Envie uma mensagem para <strong><?php echo htmlspecialchars($org['nome_org']); ?></strong></p>
            </div>
            <form id="formContato" onsubmit="enviarMensagem(event)">
                <div class="form-group">
                    <label for="nomeContato"><i class="fas fa-user"></i> Seu Nome:</label>
                    <input type="text" id="nomeContato" required placeholder="Digite seu nome completo">
                </div>
                <div class="form-group">
                    <label for="emailContato"><i class="fas fa-envelope"></i> Seu Email:</label>
                    <input type="email" id="emailContato" required placeholder="seu@email.com">
                </div>
                <div class="form-group">
                    <label for="assuntoContato"><i class="fas fa-tag"></i> Assunto:</label>
                    <select id="assuntoContato" required>
                        <option value="">Selecione o assunto</option>
                        <option value="peneira">Interesse em Peneira</option>
                        <option value="parceria">Proposta de Parceria</option>
                        <option value="informacoes">Solicitar Informações</option>
                        <option value="outro">Outro</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="mensagemContato"><i class="fas fa-comment"></i> Mensagem:</label>
                    <textarea id="mensagemContato" rows="4" required placeholder="Digite sua mensagem..."></textarea>
                    <small class="char-count">0/500 caracteres</small>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn-secundario" onclick="fecharModalContato()">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit" class="btn-principal">
                        <i class="fas fa-paper-plane"></i> Enviar Mensagem
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php include("footer.php"); ?>

    <script>
        // Funcionalidades para página pública MELHORADAS
        function abrirModalContato() {
            document.getElementById('modalContato').style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevenir scroll
        }
        
        function fecharModalContato() {
            document.getElementById('modalContato').style.display = 'none';
            document.body.style.overflow = 'auto'; // Restaurar scroll
            // Limpar formulário
            document.getElementById('formContato').reset();
            updateCharCount();
        }
        
        function seguirOrganizacao() {
            // Simular seguir/desseguir
            const btn = event.target;
            const icon = btn.querySelector('i');
            
            if (btn.textContent.includes('Seguir')) {
                btn.innerHTML = '<i class="fas fa-user-check"></i> Seguindo';
                btn.style.background = 'rgba(255, 255, 255, 0.25)';
                showNotification('Você agora está seguindo ' + '<?php echo htmlspecialchars($org['nome_org']); ?>!', 'success');
            } else {
                btn.innerHTML = '<i class="fas fa-user-plus"></i> Seguir';
                btn.style.background = 'rgba(255, 255, 255, 0.15)';
                showNotification('Você parou de seguir ' + '<?php echo htmlspecialchars($org['nome_org']); ?>', 'info');
            }
        }
        
        function interesseNaPeneira(peneiraId) {
            if (confirm('Deseja demonstrar interesse nesta peneira?\n\nVocê será redirecionado para mais informações.')) {
                showNotification('Interesse registrado! Em breve você receberá mais informações.', 'success');
                // Aqui você pode implementar o redirecionamento ou envio de dados
            }
        }
        
        function enviarMensagem(event) {
            event.preventDefault();
            
            const nome = document.getElementById('nomeContato').value;
            const email = document.getElementById('emailContato').value;
            const assunto = document.getElementById('assuntoContato').value;
            const mensagem = document.getElementById('mensagemContato').value;
            
            // Simular envio
            showNotification('Mensagem enviada com sucesso! A organização entrará em contato em breve.', 'success');
            fecharModalContato();
            
            // Aqui você implementaria o envio real via AJAX
        }
        
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                <span>${message}</span>
                <button onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
            `;
            
            document.body.appendChild(notification);
            
            // Auto remover após 5 segundos
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 5000);
        }
        
        function updateCharCount() {
            const textarea = document.getElementById('mensagemContato');
            const counter = document.querySelector('.char-count');
            if (textarea && counter) {
                const count = textarea.value.length;
                counter.textContent = `${count}/500 caracteres`;
                counter.style.color = count > 450 ? '#ef4444' : '#6b7280';
            }
        }
        
        // Fechar modal clicando fora
        window.onclick = function(event) {
            const modal = document.getElementById('modalContato');
            if (event.target == modal) {
                fecharModalContato();
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Funcionalidade dos botões de ação dos posts
            const curtirButtons = document.querySelectorAll('.curtir');
            curtirButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    const countSpan = this.textContent.match(/\d+/);
                    let count = countSpan ? parseInt(countSpan[0]) : 0;
                    
                    if (icon.classList.contains('far')) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        this.style.color = '#f43f5e';
                        count++;
                        this.innerHTML = `<i class="fas fa-heart"></i> ${count} Curtidas`;
                    } else {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        this.style.color = '';
                        count--;
                        this.innerHTML = `<i class="far fa-heart"></i> ${count} Curtidas`;
                    }
                });
            });
            
            // Contador de caracteres no modal
            const textarea = document.getElementById('mensagemContato');
            if (textarea) {
                textarea.addEventListener('input', updateCharCount);
                textarea.addEventListener('keyup', updateCharCount);
            }
        });
    </script>

    <style>
        /* Estilos melhorados para o modal */
        .modal {
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.6);
            backdrop-filter: blur(5px);
            animation: fadeIn 0.3s ease;
        }
        
        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 0;
            border-radius: 16px;
            width: 90%;
            max-width: 600px;
            position: relative;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            animation: slideIn 0.3s ease;
            max-height: 90vh;
            overflow-y: auto;
        }
        
        .modal-header {
            background: linear-gradient(135deg, var(--verde) 0%, var(--verde-claro) 100%);
            color: white;
            padding: 30px;
            border-radius: 16px 16px 0 0;
            text-align: center;
        }
        
        .modal-header h2 {
            margin: 0 0 10px 0;
            font-size: 1.5rem;
        }
        
        .modal-header p {
            margin: 0;
            opacity: 0.9;
        }
        
        .close {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .close:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }
        
        #formContato {
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
            font-size: 0.95rem;
        }
        
        .form-group label i {
            margin-right: 8px;
            color: var(--verde);
            width: 16px;
        }
        
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: inherit;
        }
        
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--verde);
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .char-count {
            display: block;
            text-align: right;
            margin-top: 5px;
            font-size: 0.8rem;
            color: #6b7280;
        }
        
        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }
        
        .form-actions button {
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            border: none;
        }
        
        .btn-secundario {
            background: #f3f4f6;
            color: #6b7280;
        }
        
        .btn-secundario:hover {
            background: #e5e7eb;
            color: #374151;
        }
        
        .btn-principal {
            background: linear-gradient(135deg, var(--verde) 0%, var(--verde-claro) 100%);
            color: white;
        }
        
        .btn-principal:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(5, 150, 105, 0.3);
        }
        
        /* Estilos para status das inscrições */
        .status-inscricao {
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
        }
        
        .status-inscricao.status-open {
            background: #d1fae5;
            color: #065f46;
        }
        
        .status-inscricao.status-closed {
            background: #fee2e2;
            color: #991b1b;
        }
        
        .status-inscricao.status-soon {
            background: #fef3c7;
            color: #92400e;
        }
        
        /* Botão peneira desabilitado */
        .btn-peneira:disabled,
        .btn-peneira.disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
        }
        
        /* Notificações */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            padding: 16px 20px;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 1001;
            animation: slideInRight 0.3s ease;
            max-width: 400px;
        }
        
        .notification-success {
            border-left: 4px solid #10b981;
        }
        
        .notification-error {
            border-left: 4px solid #ef4444;
        }
        
        .notification-info {
            border-left: 4px solid #3b82f6;
        }
        
        .notification i {
            font-size: 1.2rem;
        }
        
        .notification-success i {
            color: #10b981;
        }
        
        .notification-error i {
            color: #ef4444;
        }
        
        .notification-info i {
            color: #3b82f6;
        }
        
        .notification button {
            background: none;
            border: none;
            cursor: pointer;
            color: #6b7280;
            margin-left: auto;
        }
        
        /* Animações */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideIn {
            from { 
                opacity: 0;
                transform: translateY(-50px) scale(0.95);
            }
            to { 
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        /* Responsividade */
        @media (max-width: 768px) {
            .modal-content {
                margin: 10px;
                width: calc(100% - 20px);
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .form-actions button {
                width: 100%;
                justify-content: center;
            }
            
            .notification {
                right: 10px;
                left: 10px;
                max-width: none;
            }
        }
    </style>
</body>
</html>
