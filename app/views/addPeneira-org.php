<?php
@session_start();
include("topo.php");
?>
<link rel="stylesheet" href="../../public/css/peneiras.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .form-container {
        max-width: 800px;
        margin: 30px auto;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        padding: 30px;
    }
    
    .form-title {
        color: var(--primary-color);
        margin-bottom: 25px;
        font-size: 28px;
        font-weight: 700;
        text-align: center;
        position: relative;
    }
    
    .form-title:after {
        content: '';
        display: block;
        width: 60px;
        height: 4px;
        background: var(--primary-color);
        margin: 10px auto;
        border-radius: 2px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 16px;
        transition: border-color 0.3s;
    }
    
    .form-control:focus {
        border-color: var(--primary-color);
        outline: none;
        box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.2);
    }
    
    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }
    
    .form-select {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 16px;
        background-color: #fff;
        cursor: pointer;
    }
    
    .form-file {
        display: block;
        margin-top: 8px;
    }
    
    .form-file-custom {
        display: inline-block;
        padding: 10px 15px;
        background: #f5f5f5;
        border: 1px dashed #ccc;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .form-file-custom:hover {
        background: #eee;
        border-color: #aaa;
    }
    
    .form-submit {
        display: block;
        width: 100%;
        padding: 14px;
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
        margin-top: 30px;
    }
    
    .form-submit:hover {
        background: var(--primary-dark);
    }
    
    .form-row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }
    
    .form-col {
        flex: 1;
        padding: 0 10px;
        min-width: 200px;
    }
    
    .form-hint {
        font-size: 13px;
        color: #666;
        margin-top: 5px;
    }
    
    .form-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }
    
    .preview-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 5px;
        border: 2px solid #ddd;
    }
    
    @media (max-width: 768px) {
        .form-col {
            flex: 100%;
        }
    }
</style>

<body>
    <?php
    include("navbar-social.php");
    include_once("message.php");
    ?>
    
    <div class="container-site">
        <!-- Botão de voltar -->
        <a href="javascript:history.back()" class="back-button">
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
                
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="inscricao" class="form-label">Status da Inscrição</label>
                            <select id="inscricao" name="inscricao" class="form-select" required>
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
                    <label class="form-label">Imagens da Peneira</label>
                    <div class="form-hint">Adicione até 3 imagens para ilustrar a peneira (máx. 2MB cada)</div>
                    
                    <div class="form-row">
                        <div class="form-col">
                            <label for="fotos1" class="form-file-custom">
                                <i class="fas fa-upload"></i> Imagem Principal
                            </label>
                            <input type="file" id="fotos1" name="fotos[]" accept="image/*" class="form-file" style="display:none" onchange="previewImage(this, 'preview1')">
                            <div id="preview1" class="form-preview"></div>
                        </div>
                        <div class="form-col">
                            <label for="fotos2" class="form-file-custom">
                                <i class="fas fa-upload"></i> Imagem Secundária
                            </label>
                            <input type="file" id="fotos2" name="fotos[]" accept="image/*" class="form-file" style="display:none" onchange="previewImage(this, 'preview2')">
                            <div id="preview2" class="form-preview"></div>
                        </div>
                        <div class="form-col">
                            <label for="fotos3" class="form-file-custom">
                                <i class="fas fa-upload"></i> Imagem Adicional
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
</body>
