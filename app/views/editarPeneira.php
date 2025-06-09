<?php
@session_start();

// Verificar se é uma organização logada
if (!isset($_SESSION['id']) || !isset($_SESSION['tipoLogin']) || $_SESSION['tipoLogin'] !== 'organizacao') {
    header('Location: login.php');
    exit();
}

// Verificar se o ID da peneira foi fornecido
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['msg'] = 'ID da peneira não fornecido.';
    header('Location: meu-perfil-org.php');
    exit();
}

$id_peneira = intval($_GET['id']);
$id_org = $_SESSION['id'];

require("../../config/connect.php");

// Buscar dados da peneira
$query = "SELECT * FROM peneiras WHERE id = ? LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_peneira);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['msg'] = 'Peneira não encontrada.';
    header('Location: meu-perfil-org.php');
    exit();
}

$peneira = $result->fetch_assoc();

// Verificar se a peneira pertence à organização logada
if ($peneira['id_org'] != $id_org) {
    $_SESSION['msg'] = 'Você não tem permissão para editar esta peneira.';
    header('Location: meu-perfil-org.php');
    exit();
}

// Processar dados para exibição
$tipo_taxa = (strpos($peneira['inscricao'], 'Gratuita') !== false) ? 'gratuita' : 'paga';
$valor_inscricao = '';
if ($tipo_taxa === 'paga') {
    // Extrair valor numérico da string "R$ XX,XX"
    preg_match('/R\$ ([0-9,.]+)/', $peneira['inscricao'], $matches);
    if (isset($matches[1])) {
        $valor_inscricao = str_replace(',', '.', $matches[1]);
    }
}

// Mapear status de inscrição para o formato do formulário
$status_inscricao_map_reverse = [
    'status-open' => 'Aberta',
    'status-closed' => 'Fechada',
    'status-soon' => 'Em Breve'
];
$status_inscricao = $status_inscricao_map_reverse[$peneira['status_inscricao']] ?? 'Em Breve';

// Mapear badge type para o formato do formulário
$badge_type_map_reverse = [
    'new' => 'Nova',
    'featured' => 'Destaque',
    'normal' => 'Ativa'
];
$status = $badge_type_map_reverse[$peneira['badge_type']] ?? 'Ativa';
if ($status === 'Ativa' && $peneira['status'] === 'Inativa') {
    $status = 'Inativa';
}

// Decodificar arrays JSON
$fotos_extras = json_decode($peneira['fotos'] ?? '[]', true) ?: [];
$documentos = json_decode($peneira['documentos'] ?? '[]', true) ?: [];

include("topo.php");
?>
<link rel="stylesheet" href="../../public/css/addPeneira-org.css">

<body>
    <?php
    include("navbar-social.php");
    include_once("message.php");
    ?>
    
    <div class="container-site">
        <!-- Botão de voltar -->
        <a href="organizacao.php?id=<?php echo $_SESSION['id']; ?>" class="back-button">
            <i class="fas fa-arrow-left"></i>
        </a>
        
        <div class="form-container animate-fadeInUp">
            <h1 class="form-title">Editar Peneira</h1>
            
            <form action="../controllers/editarPeneira.act.php" method="POST" enctype="multipart/form-data" id="peneiraForm">
                <input type="hidden" name="id_peneira" value="<?php echo $id_peneira; ?>">
                
                <div class="form-group">
                    <label for="titulo" class="form-label">Nome da peneira</label>
                    <input type="text" id="titulo" name="titulo" class="form-control" required 
                           placeholder="Ex: Peneira Oficial Sub-17" value="<?php echo htmlspecialchars($peneira['titulo']); ?>">
                </div>
                
                <div class="form-group">
                    <label for="clube" class="form-label">Clube da organização</label>
                    <input type="text" id="clube" name="clube" class="form-control" required 
                           placeholder="Ex: Santos Futebol Clube" value="<?php echo htmlspecialchars($peneira['clube']); ?>">
                </div>
                
                <!-- FOTO PRINCIPAL DA PENEIRA -->
                <div class="form-group">
                    <label for="foto_peneira" class="form-label">Foto Principal da Peneira</label>
                    <div class="form-hint">Esta será a imagem de destaque que aparecerá na listagem de peneiras</div>
                    
                    <div class="foto-peneira-container">
                        <input type="file" id="foto_peneira" name="foto_peneira" accept="image/*" class="form-file" 
                               style="display:none" onchange="previewMainImage(this)">
                        <input type="hidden" name="foto_peneira_atual" value="<?php echo htmlspecialchars($peneira['foto_peneira']); ?>">
                        
                        <label for="foto_peneira" class="foto-peneira-upload" style="<?php echo !empty($peneira['foto_peneira']) ? 'display:none' : ''; ?>">
                            <div class="upload-content">
                                <i class="fas fa-camera"></i>
                                <span>Clique para alterar a foto principal</span>
                                <small>JPG, PNG ou WEBP (máx. 5MB)</small>
                            </div>
                        </label>
                        
                        <div id="mainImagePreview" class="main-image-preview" style="<?php echo !empty($peneira['foto_peneira']) ? '' : 'display:none'; ?>">
                            <?php if (!empty($peneira['foto_peneira'])): ?>
                                <img src="../../<?php echo htmlspecialchars($peneira['foto_peneira']); ?>" class="main-preview-image" alt="Foto principal">
                                <button type="button" class="remove-image-btn" onclick="removeMainImage()">
                                    <i class="fas fa-times"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea id="descricao" name="descricao" class="form-control" required 
                              placeholder="Descreva os detalhes da peneira, requisitos e informações importantes..."><?php echo htmlspecialchars($peneira['descricao']); ?></textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="localizacao" class="form-label">Localização</label>
                            <input type="text" id="localizacao" name="localizacao" class="form-control" required 
                                   placeholder="Ex: CT Rei Pelé, Santos - SP" value="<?php echo htmlspecialchars($peneira['localizacao']); ?>">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="faixa_etaria" class="form-label">Faixa Etária</label>
                            <input type="text" id="faixa_etaria" name="faixa_etaria" class="form-control" required 
                                   placeholder="Ex: 15-17 anos" value="<?php echo htmlspecialchars($peneira['faixa_etaria']); ?>">
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="data" class="form-label">Data</label>
                            <input type="date" id="data" name="data" class="form-control" required 
                                   value="<?php echo htmlspecialchars($peneira['data']); ?>">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="horario" class="form-label">Horário</label>
                            <input type="time" id="horario" name="horario" class="form-control" required 
                                   value="<?php echo htmlspecialchars($peneira['horario']); ?>">
                        </div>
                    </div>
                </div>
                
                <!-- TAXA DE INSCRIÇÃO -->
                <div class="form-group">
                    <label class="form-label">Taxa de Inscrição</label>
                    <div class="form-hint">Defina se a peneira é gratuita ou paga</div>
                    
                    <div class="taxa-container">
                        <div class="taxa-options">
                            <div class="taxa-option">
                                <input type="radio" id="gratuita" name="tipo_taxa" value="gratuita" 
                                       <?php echo ($tipo_taxa === 'gratuita') ? 'checked' : ''; ?> onchange="toggleTaxaInput()">
                                <label for="gratuita" class="taxa-label">
                                    <div class="taxa-icon">
                                        <i class="fas fa-gift"></i>
                                    </div>
                                    <div class="taxa-text">
                                        <strong>Gratuita</strong>
                                        <small>Sem custo para participar</small>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="taxa-option">
                                <input type="radio" id="paga" name="tipo_taxa" value="paga" 
                                       <?php echo ($tipo_taxa === 'paga') ? 'checked' : ''; ?> onchange="toggleTaxaInput()">
                                <label for="paga" class="taxa-label">
                                    <div class="taxa-icon">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <div class="taxa-text">
                                        <strong>Paga</strong>
                                        <small>Definir valor da inscrição</small>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <div id="valorContainer" class="valor-container" style="<?php echo ($tipo_taxa === 'paga') ? 'display:block' : 'display:none'; ?>">
                            <div class="form-group">
                                <label for="valor_inscricao" class="form-label">Valor da Inscrição</label>
                                <div class="input-with-prefix">
                                    <span class="input-prefix">R$</span>
                                    <input type="number" id="valor_inscricao" name="valor_inscricao" class="form-control" 
                                           step="0.01" min="0" placeholder="0,00" value="<?php echo $valor_inscricao; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="status_inscricao" class="form-label">Status das Inscrições</label>
                            <select id="status_inscricao" name="status_inscricao" class="form-select" required>
                                <option value="Aberta" <?php echo ($status_inscricao === 'Aberta') ? 'selected' : ''; ?>>Inscrições Abertas</option>
                                <option value="Fechada" <?php echo ($status_inscricao === 'Fechada') ? 'selected' : ''; ?>>Inscrições Encerradas</option>
                                <option value="Em Breve" <?php echo ($status_inscricao === 'Em Breve') ? 'selected' : ''; ?>>Em Breve</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="status" class="form-label">Status da Peneira</label>
                            <select id="status" name="status" class="form-select" required>
                                <option value="Ativa" <?php echo ($status === 'Ativa') ? 'selected' : ''; ?>>Ativa</option>
                                <option value="Inativa" <?php echo ($status === 'Inativa') ? 'selected' : ''; ?>>Inativa</option>
                                <option value="Destaque" <?php echo ($status === 'Destaque') ? 'selected' : ''; ?>>Destaque</option>
                                <option value="Nova" <?php echo ($status === 'Nova') ? 'selected' : ''; ?>>Nova</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- IMAGENS ADICIONAIS -->
                <div class="form-group">
                    <label class="form-label">Imagens Adicionais da Peneira</label>
                    <div class="form-hint">Adicione até 3 imagens extras para ilustrar a peneira (máx. 2MB cada)</div>
                    
                    <div class="form-row">
                        <?php for ($i = 0; $i < 3; $i++): ?>
                            <div class="form-col">
                                <label for="fotos<?php echo $i+1; ?>" class="form-file-custom">
                                    <i class="fas fa-upload"></i> Imagem Extra <?php echo $i+1; ?>
                                </label>
                                <input type="file" id="fotos<?php echo $i+1; ?>" name="fotos[]" accept="image/*" 
                                       class="form-file" style="display:none" onchange="previewImage(this, 'preview<?php echo $i+1; ?>')">
                                
                                <div id="preview<?php echo $i+1; ?>" class="form-preview">
                                    <?php if (isset($fotos_extras[$i])): ?>
                                        <div class="existing-image">
                                            <img src="../../<?php echo htmlspecialchars($fotos_extras[$i]); ?>" alt="Imagem extra <?php echo $i+1; ?>">
                                            <button type="button" class="remove-extra-image" 
                                                    onclick="removeExtraImage(<?php echo $i; ?>, 'preview<?php echo $i+1; ?>')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            <input type="hidden" name="fotos_existentes[]" value="<?php echo htmlspecialchars($fotos_extras[$i]); ?>">
                                            <input type="hidden" name="remover_fotos[]" value="0" id="remover_foto_<?php echo $i; ?>">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
                
                <!-- DOCUMENTOS -->
                <div class="form-group">
                    <label for="documentos" class="form-label">Documentos Obrigatórios</label>
                    <div class="form-hint">Adicione documentos necessários para a inscrição (PDF ou imagens)</div>
                    
                    <?php if (!empty($documentos)): ?>
                        <div class="existing-documents">
                            <h4>Documentos Atuais:</h4>
                            <ul id="existing-docs-list">
                                <?php foreach ($documentos as $index => $doc): ?>
                                    <li>
                                        <?php echo htmlspecialchars(basename($doc)); ?>
                                        <button type="button" class="remove-doc-btn" onclick="removeDocument(<?php echo $index; ?>)">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <input type="hidden" name="documentos_existentes[]" value="<?php echo htmlspecialchars($doc); ?>">
                                        <input type="hidden" name="remover_documentos[]" value="0" id="remover_doc_<?php echo $index; ?>">
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <label for="documentos" class="form-file-custom">
                        <i class="fas fa-file-upload"></i> Adicionar Novos Documentos
                    </label>
                    <input type="file" id="documentos" name="documentos[]" accept=".pdf,image/*" multiple 
                           class="form-file" style="display:none" onchange="updateFileList(this)">
                    <div id="fileList" class="form-hint" style="margin-top: 10px;"></div>
                </div>
                
                <button type="submit" class="form-submit">
                    <i class="fas fa-save"></i> Salvar Alterações
                </button>
            </form>
        </div>
    </div>
    
    <script>
        // Alternar campo de valor
        function toggleTaxaInput() {
            const valorContainer = document.getElementById('valorContainer');
            const valorInput = document.getElementById('valor_inscricao');
            const tipoPaga = document.getElementById('paga').checked;
            
            if (tipoPaga) {
                valorContainer.style.display = 'block';
                valorInput.required = true;
            } else {
                valorContainer.style.display = 'none';
                valorInput.required = false;
                valorInput.value = '';
            }
        }
        
        // Remover imagem principal
        function removeMainImage() {
            const input = document.getElementById('foto_peneira');
            const preview = document.getElementById('mainImagePreview');
            const uploadLabel = document.querySelector('.foto-peneira-upload');
            const hiddenInput = document.querySelector('input[name="foto_peneira_atual"]');
            
            input.value = '';
            preview.innerHTML = '';
            uploadLabel.style.display = 'flex';
            hiddenInput.value = '';
        }
        
        // Preview da foto principal
        function previewMainImage(input) {
            const preview = document.getElementById('mainImagePreview');
            const uploadLabel = document.querySelector('.foto-peneira-upload');
            
            preview.innerHTML = '';
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'main-preview-image';
                    
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'remove-image-btn';
                    removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                    removeBtn.onclick = function() {
                        input.value = '';
                        preview.innerHTML = '';
                        uploadLabel.style.display = 'flex';
                    };
                    
                    preview.appendChild(img);
                    preview.appendChild(removeBtn);
                    preview.style.display = 'block';
                    uploadLabel.style.display = 'none';
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                uploadLabel.style.display = 'flex';
                preview.style.display = 'none';
            }
        }
        
        // Remover imagem extra
        function removeExtraImage(index, previewId) {
            const preview = document.getElementById(previewId);
            const removerInput = document.getElementById('remover_foto_' + index);
            
            if (preview.querySelector('.existing-image')) {
                removerInput.value = '1';
                preview.querySelector('.existing-image').style.display = 'none';
            }
        }
        
        // Preview de imagem extra
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const existingImage = preview.querySelector('.existing-image');
            
            // Se já existe uma imagem e está marcada para remoção, não faça nada
            if (existingImage && existingImage.style.display === 'none') {
                return;
            }
            
            // Se já existe uma imagem, esconda-a
            if (existingImage) {
                existingImage.style.display = 'none';
                const removerInput = existingImage.querySelector('input[name="remover_fotos[]"]');
                if (removerInput) {
                    removerInput.value = '1';
                }
            }
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const newPreview = document.createElement('div');
                    newPreview.className = 'new-image-preview';
                    
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'preview-image';
                    
                    newPreview.appendChild(img);
                    preview.appendChild(newPreview);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        // Remover documento
        function removeDocument(index) {
            const removerInput = document.getElementById('remover_doc_' + index);
            const docItem = removerInput.parentElement;
            
            removerInput.value = '1';
            docItem.style.display = 'none';
        }
        
        // Atualizar lista de arquivos
        function updateFileList(input) {
            const fileList = document.getElementById('fileList');
            fileList.innerHTML = '';
            
            if (input.files.length > 0) {
                const list = document.createElement('ul');
                list.style.paddingLeft = '20px';
                list.style.marginTop = '5px';
                
                for (let i = 0; i < input.files.length; i++) {
                    const item = document.createElement('li');
                    item.textContent = input.files[i].name;
                    list.appendChild(item);
                }
                
                fileList.appendChild(list);
            }
        }
        
        // Animação de entrada dos elementos
        document.addEventListener('DOMContentLoaded', function() {
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

    <style>
        /* Estilos para documentos existentes */
        .existing-documents {
            margin-bottom: 1rem;
            padding: 1rem;
            background: #f9fafb;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }
        
        .existing-documents h4 {
            margin-top: 0;
            margin-bottom: 0.5rem;
            font-size: 1rem;
            color: #374151;
        }
        
        #existing-docs-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        #existing-docs-list li {
            display: flex;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #e5e7eb;
        }
        
        #existing-docs-list li:last-child {
            border-bottom: none;
        }
        
        .remove-doc-btn {
            margin-left: auto;
            background: none;
            border: none;
            color: #ef4444;
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 4px;
            transition: all 0.2s ease;
        }
        
        .remove-doc-btn:hover {
            background: #fee2e2;
        }
        
        /* Estilos para imagens existentes */
        .existing-image {
            position: relative;
            margin-bottom: 0.5rem;
        }
        
        .existing-image img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
        }
        
        .remove-extra-image {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(239, 68, 68, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .remove-extra-image:hover {
            background: #dc2626;
            transform: scale(1.1);
        }
        
        .new-image-preview {
            margin-top: 0.5rem;
        }
        
        .new-image-preview img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
        }
        
        /* Estilos herdados do formulário de criação */
        .foto-peneira-container {
            position: relative;
            margin-bottom: 1rem;
        }
        
        .foto-peneira-upload {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            padding: 2rem;
            background: #f9fafb;
            cursor: pointer;
            transition: all 0.3s ease;
            min-height: 200px;
        }
        
        .foto-peneira-upload:hover {
            border-color: #059669;
            background: #f0fdf4;
        }
        
        .upload-content {
            text-align: center;
        }
        
        .upload-content i {
            font-size: 3rem;
            color: #6b7280;
            margin-bottom: 1rem;
            transition: color 0.3s ease;
        }
        
        .foto-peneira-upload:hover .upload-content i {
            color: #059669;
        }
        
        .upload-content span {
            display: block;
            font-size: 1.1rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        
        .upload-content small {
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        .main-image-preview {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .main-preview-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 12px;
        }
        
        .remove-image-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(239, 68, 68, 0.9);
            color: white;
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
        
        .remove-image-btn:hover {
            background: #dc2626;
            transform: scale(1.1);
        }
        
        /* Estilos para taxa de inscrição */
        .taxa-container {
            background: #f9fafb;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid #e5e7eb;
        }
        
        .taxa-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        
        .taxa-option {
            position: relative;
        }
        
        .taxa-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .taxa-label {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .taxa-option input[type="radio"]:checked + .taxa-label {
            border-color: #059669;
            background: #f0fdf4;
        }
        
        .taxa-icon {
            width: 40px;
            height: 40px;
            background: #f3f4f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #6b7280;
            transition: all 0.3s ease;
        }
        
        .taxa-option input[type="radio"]:checked + .taxa-label .taxa-icon {
            background: #059669;
            color: white;
        }
        
        .taxa-text {
            flex: 1;
        }
        
        .taxa-text strong {
            display: block;
            font-size: 1rem;
            color: #374151;
            margin-bottom: 0.25rem;
        }
        
        .taxa-text small {
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        .valor-container {
            animation: slideDown 0.3s ease;
        }
        
        .input-with-prefix {
            position: relative;
            display: flex;
            align-items: center;
        }
        
        .input-prefix {
            position: absolute;
            left: 1rem;
            color: #6b7280;
            font-weight: 600;
            z-index: 1;
        }
        
        .input-with-prefix input {
            padding-left: 3rem;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Responsividade */
        @media (max-width: 768px) {
            .taxa-options {
                grid-template-columns: 1fr;
            }
            
            .form-row {
                flex-direction: column;
            }
            
            .form-col {
                width: 100%;
            }
        }
    </style>
</body>
</html>