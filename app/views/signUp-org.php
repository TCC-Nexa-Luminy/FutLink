<?php
@session_start();
include("topo.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futlink - Cadastro de Organização</title>
    <link rel="stylesheet" href="../../public/css/signup-org.css">
</head>

<body>
    <?php include("message.php"); ?>
    
    <main class="containerMain">
        <!-- Formulário de Cadastro -->
        <section class="main_content">
            <a href="../../public/index.php" class="back_btn"><i class="fa-solid fa-circle-left"></i></a>
            
            <form action="../controllers/signUp-org.act.php" method="post" id="organizationForm" enctype="multipart/form-data">
                <h1>Cadastro da Organização</h1>
                <h2>Já tem uma conta? <a href="login.php">Entre aqui</a></h2>
                <hr>
                
                <!-- Seção 1: Logo e Informações Básicas -->
                <article class="content-input">
                    <h3>Informações da organização</h3>
                    <div class="form-content-info">
                        <input type="file" name="org_photo" id="logoUpload" style="display: none;" accept=".png, .jpg, .jpeg, .webp">
                        <label for="logoUpload" class="container_photo">
                            <span id="uploadPlaceholder" class="placeholderSpan">Logo (1:1)<br>(Opcional)</span>
                            <img src="/placeholder.svg" alt="Logo da Organização" id="logoPreview" style="display: none;">
                        </label>
                        <div class="form-label_direction">
                            <div class="form-label">
                                <label for="orgName">Nome da Organização</label>
                                <input type="text" name="org_nome" id="orgName" required placeholder="Insira o nome da organização" autocomplete="off" class="input_user">
                            </div>
                            <div class="form-label">
                                <label for="foundationDate">Data de Fundação</label>
                                <input type="date" name="org_data_fund" id="foundationDate" required class="input_user">
                            </div>
                        </div>
                    </div>
                </article>

                <hr>
                
                <!-- Seção 2: Tipo e CNPJ -->
                <article class="content-input">
                    <h3>Informações da Organização</h3>
                    <div class="form-label_direction">
                        <div class="form-label">
                            <label for="orgType">Tipo de Organização</label>
                            <select name="org_tipo" id="orgType" required class="input_user">
                                <option value="">Selecione o tipo</option>
                                <option value="clube">Clube de Futebol</option>
                                <option value="escola">Escola de Futebol</option>
                                <option value="academia">Academia</option>
                                <option value="federacao">Federação</option>
                                <option value="empresa">Empresa</option>
                                <option value="outro">Outro</option>
                            </select>
                        </div>
                        <div class="form-label">
                            <label for="cnpj">CNPJ</label>
                            <input type="text" name="org_cnpj" id="cnpj" placeholder="00.000.000/0000-00" class="input_user">
                        </div>
                    </div>
                </article>

                <hr>
                
                <!-- Seção 3: Localização -->
                <article class="content-input">
                    <h3>Localização</h3>
                    <div class="form-label_direction">
                        
                        <div class="form-label">
                            <label for="icep">Digite seu cep: </label>
                            <input type="number" name="org_cep" id="icep" required placeholder="Ex: 12345678" class="input_user" >
                            <button id="btn_cep">Verificar</button>
                        </div>
                        
                    </div>
                </article>

                <hr>
                
                <!-- Seção 4: Contato -->
                <article class="content-input">
                    <h3>Contato</h3>
                    <div class="form-label_direction">
                        <div class="form-label">
                            <label for="email">Email</label>
                            <input type="email" name="org_email" id="email" required placeholder="email@organizacao.com" autocomplete="off" class="input_user">
                        </div>
                        <div class="form-label">
                            <label for="phone">Telefone</label>
                            <input type="tel" name="org_tel" id="iphone" required placeholder="(11) 99999-9999" class="input_user">
                        </div>
                    </div>
                </article>

                <hr>
                
                <!-- Seção 5: Segurança -->
                <article class="content-input">
                    <h3>Segurança</h3>
                    <div class="form-label_direction">
                        <div class="form-label">
                            <label for="password">Crie uma senha</label>
                            <input type="password" name="org_pass" id="password" required placeholder="Insira sua senha" autocomplete="off" class="input_user">
                        </div>
                        <div class="form-label">
                            <label for="confirmPassword">Confirme sua senha</label>
                            <input type="password" name="org_pass2" id="confirmPassword" required placeholder="Confirme sua senha" autocomplete="off" class="input_user">
                        </div>
                    </div>
                </article>

                <hr>
                
                <!-- Botões de Ação -->
                <div class="form-label_direction">
                    <a href="../../public/index.php" class="form_back-btn"><i class="fa-solid fa-arrow-left"></i> Voltar</a>
                    <input type="submit" value="Finalizar cadastro" class="form_submit">
                </div>
            </form>
        </section>

        <!-- Banner Lateral -->
        <section class="main_banner">
            <div class="banner_content">
                <div class="banner_top">
                    <div class="logo_container">
                        <img src="../../public/images/futlinkLogoBg.png" alt="FutLink Logo">
                    </div>
                    <h1>FutLink</h1>
                </div>
                
                <div class="banner_msg">
                    <h1>Cadastre sua organização!</h1>
                    <h2>Conecte-se com talentos e fortaleça sua equipe</h2>
                </div>
                
                <div class="banner_features">
                    <div class="feature_item">
                        <div class="feature_icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="feature_text">
                            <h3>Encontre Talentos</h3>
                            <p>Acesse perfis de jogadores qualificados</p>
                        </div>
                    </div>
                    
                    <div class="feature_item">
                        <div class="feature_icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="feature_text">
                            <h3>Cresça no Esporte</h3>
                            <p>Desenvolva sua organização esportiva</p>
                        </div>
                    </div>
                    
                    <div class="feature_item">
                        <div class="feature_icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <div class="feature_text">
                            <h3>Conexões Diretas</h3>
                            <p>Comunique-se com jogadores e clubes</p>
                        </div>
                    </div>
                </div>
                
                <div class="banner_rodape">
                    <p>Informe os dados ao lado para se cadastrar na nossa plataforma de recrutamento de jogadores</p>
                </div>
                
                <div class="banner_decoration">
                    <div class="decoration_circle circle1"></div>
                    <div class="decoration_circle circle2"></div>
                    <div class="decoration_circle circle3"></div>
                </div>
            </div>
        </section>
    </main>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script> <!--Biblioteca de mascara de inputs-->

    <script src="../../public/js/signUp-Org.js"></script>
    <script src="../../public/js/signUp.js"></script>
</body>
</html>
