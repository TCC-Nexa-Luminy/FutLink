<?php
@session_start();

// Verificar se é uma organização logada usando o sistema de login atual
if (!isset($_SESSION['id']) || !isset($_SESSION['tipoLogin']) || $_SESSION['tipoLogin'] !== 'organizacao') {
    header('Location: login.php');
    exit();
}

include("topo.php");
?>
<link rel="stylesheet" href="../../public/css/addPeneira-org.css">

<body>
    <?php
    include("navbar-social.php");
    include_once("message.php");
    ?>
    
    <div class="container-site">

        <a href="organizacao.php?id=<?php echo $_SESSION['id']; ?>" class="back-button">
            <i class="fas fa-arrow-left"></i>
        </a>
        
        <div class="form-container animate-fadeInUp">
            <h1 class="form-title">Criar Nova Peneira</h1>
            
            <form action="../controllers/addPeneira-org.act.php" method="POST" enctype="multipart/form-data" id="peneiraForm">
                <div class="form-group">
                    <label for="titulo" class="form-label">Nome da peneira</label>
                    <input type="text" id="titulo" name="titulo" class="form-control" required placeholder="Ex: Peneira Oficial Sub-17">
                </div>
                
                <div class="form-group">
                    <label for="clube" class="form-label">Clube da organização</label>
                    <input type="text" id="clube" name="clube" class="form-control" required placeholder="Ex: Santos Futebol Clube">
                </div>
                
                <!-- FOTO PRINCIPAL DA PENEIRA -->
                <div class="form-group">
                    <label for="foto_peneira" class="form-label">Foto Principal da Peneira</label>
                    <div class="form-hint">Esta será a imagem de destaque que aparecerá na listagem de peneiras</div>
                    
                    <div class="foto-peneira-container">
                        <input type="file" id="foto_peneira" name="foto_peneira" accept="image/*" class="form-file" style="display:none" onchange="previewMainImage(this)" required>
                        <label for="foto_peneira" class="foto-peneira-upload">
                            <div class="upload-content">
                                <i class="fas fa-camera"></i>
                                <span>Clique para adicionar a foto principal</span>
                                <small>JPG, PNG ou WEBP (máx. 5MB)</small>
                            </div>
                        </label>
                        <div id="mainImagePreview" class="main-image-preview"></div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea id="descricao" name="descricao" class="form-control" required placeholder="Descreva os detalhes da peneira, requisitos e informações importantes..."></textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="localizacao" class="form-label">Localização</label>
                            <input type="text" id="localizacao" name="localizacao" class="form-control" required placeholder="Ex: CT Rei Pelé, Santos - SP">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="faixa_etaria" class="form-label">Faixa Etária</label>
                            <input type="text" id="faixa_etaria" name="faixa_etaria" class="form-control" required placeholder="Ex: 15-17 anos">
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="data" class="form-label">Data</label>
                            <input type="date" id="data" name="data" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="horario" class="form-label">Horário</label>
                            <input type="time" id="horario" name="horario" class="form-control" required>
                        </div>
                    </div>
                </div>
                

                <div class="form-group">
                    <label class="form-label">Taxa de Inscrição</label>
                    <div class="form-hint">Defina se a peneira é gratuita ou paga</div>
                    
                    <div class="taxa-container">
                        <div class="taxa-options">
                            <div class="taxa-option">
                                <input type="radio" id="gratuita" name="tipo_taxa" value="gratuita" checked onchange="toggleTaxaInput()">
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
                                <input type="radio" id="paga" name="tipo_taxa" value="paga" onchange="toggleTaxaInput()">
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
                        
                        <div id="valorContainer" class="valor-container" style="display: none;">
                            <div class="form-group">
                                <label for="valor_inscricao" class="form-label">Valor da Inscrição</label>
                                <div class="input-with-prefix">
                                    <span class="input-prefix">R$</span>
                                    <input type="number" id="valor_inscricao" name="valor_inscricao" class="form-control" step="0.01" min="0" placeholder="0,00">
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
                                <option value="Aberta">Inscrições Abertas</option>
                                <option value="Fechada">Inscrições Encerradas</option>
                                <option value="Em Breve">Em Breve</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="status" class="form-label">Status da Peneira</label>
                            <select id="status" name="status" class="form-select" required>
                                <option value="Ativa">Ativa</option>
                                <option value="Inativa">Inativa</option>
                                <option value="Destaque">Destaque</option>
                                <option value="Nova">Nova</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Imagens Adicionais da Peneira</label>
                    <div class="form-hint">Adicione até 3 imagens extras para ilustrar a peneira (máx. 2MB cada)</div>
                    
                    <div class="form-row">
                        <div class="form-col">
                            <label for="fotos1" class="form-file-custom">
                                <i class="fas fa-upload"></i> Imagem Extra 1
                            </label>
                            <input type="file" id="fotos1" name="fotos[]" accept="image/*" class="form-file" style="display:none" onchange="previewImage(this, 'preview1')">
                            <div id="preview1" class="form-preview"></div>
                        </div>
                        <div class="form-col">
                            <label for="fotos2" class="form-file-custom">
                                <i class="fas fa-upload"></i> Imagem Extra 2
                            </label>
                            <input type="file" id="fotos2" name="fotos[]" accept="image/*" class="form-file" style="display:none" onchange="previewImage(this, 'preview2')">
                            <div id="preview2" class="form-preview"></div>
                        </div>
                        <div class="form-col">
                            <label for="fotos3" class="form-file-custom">
                                <i class="fas fa-upload"></i> Imagem Extra 3
                            </label>
                            <input type="file" id="fotos3" name="fotos[]" accept="image/*" class="form-file" style="display:none" onchange="previewImage(this, 'preview3')">
                            <div id="preview3" class="form-preview"></div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="documentos" class="form-label">Documentos Obrigatórios</label>
                    <div class="form-hint">Adicione documentos necessários para a inscrição (PDF ou imagens)</div>
                    <label for="documentos" class="form-file-custom">
                        <i class="fas fa-file-upload"></i> Selecionar Documentos
                    </label>
                    <input type="file" id="documentos" name="documentos[]" accept=".pdf,image/*" multiple class="form-file" style="display:none" onchange="updateFileList(this)">
                    <div id="fileList" class="form-hint" style="margin-top: 10px;"></div>
                </div>
                
                <button type="submit" class="form-submit">
                    <i class="fas fa-plus-circle"></i> Criar Peneira
                </button>
            </form>
        </div>
    </div>
    
    <script>

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
                    uploadLabel.style.display = 'none';
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                uploadLabel.style.display = 'flex';
            }
        }
        
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            preview.innerHTML = '';
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'preview-image';
                    preview.appendChild(img);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
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
            

            animatedElements.forEach(element => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px)';
                element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            });
            

            checkScroll();
            

            window.addEventListener('scroll', checkScroll);
        });
    </script>

    <style>
        /* ESTILOS PARA A FOTO PRINCIPAL */
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
        
        /* NOVOS ESTILOS PARA TAXA DE INSCRIÇÃO */
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
        
        /* Responsividade para taxa */
        @media (max-width: 768px) {
            .taxa-options {
                grid-template-columns: 1fr;
            }
        }
    </style>
</body>
</html>
