<?php
@session_start();
include("../app/views/topo.php");
?>
<link rel="stylesheet" href="./css/index.css">
<link rel="stylesheet" href="./css/termos.css">

<body>
    <?php
    include_once("../app/views/message.php");
    include("../app/views/navbarIndex.php");
    ?>


    <section class="secao-termos" id="termos">
        <div class="container-termos">

            <div class="cabecalho-termos">
                <h1 class="titulo-termos">Termos de Uso e Política de Privacidade</h1>
                <p class="subtitulo-termos">FutLink - Plataforma de Conexão Esportiva</p>
                <p class="data-atualizacao">Última atualização: Janeiro de 2025</p>
            </div>


            <div class="conteudo-termos">
                

                <div class="secao-documento">
                    <div class="icone-secao">
                        <i class="fa-solid fa-file-contract"></i>
                    </div>
                    <h2>Termos de Uso</h2>
                    
                    <div class="item-termo">
                        <h3>1. Aceitação dos Termos</h3>
                        <p>Ao acessar e usar a plataforma FutLink, você concorda com estes termos de uso. Se não concordar, não utilize nossos serviços.</p>
                    </div>

                    <div class="item-termo">
                        <h3>2. Descrição do Serviço</h3>
                        <p>O FutLink é uma plataforma que conecta jogadores de futebol com clubes e organizações esportivas, facilitando a descoberta de talentos e oportunidades no esporte.</p>
                    </div>

                    <div class="item-termo">
                        <h3>3. Responsabilidades do Usuário</h3>
                        <ul>
                            <li>Fornecer informações verdadeiras e atualizadas</li>
                            <li>Manter a confidencialidade de sua conta</li>
                            <li>Não usar a plataforma para atividades ilegais</li>
                            <li>Respeitar outros usuários e organizações</li>
                        </ul>
                    </div>

                    <div class="item-termo">
                        <h3>4. Conteúdo do Usuário</h3>
                        <p>Você é responsável pelo conteúdo que publica na plataforma. Não permitimos conteúdo ofensivo, falso ou que viole direitos de terceiros.</p>
                    </div>

                    <div class="item-termo">
                        <h3>5. Limitação de Responsabilidade</h3>
                        <p>O FutLink atua apenas como intermediário. Não nos responsabilizamos por acordos ou contratos firmados entre usuários e organizações.</p>
                    </div>
                </div>


                <div class="secao-documento">
                    <div class="icone-secao">
                        <i class="fa-solid fa-shield-alt"></i>
                    </div>
                    <h2>Política de Privacidade</h2>
                    
                    <div class="item-termo">
                        <h3>1. Coleta de Informações</h3>
                        <p>Coletamos informações que você nos fornece diretamente, como:</p>
                        <ul>
                            <li>Dados pessoais (nome, idade, localização)</li>
                            <li>Informações esportivas (posição, experiência)</li>
                            <li>Fotos e vídeos de perfil</li>
                            <li>Dados de contato</li>
                        </ul>
                    </div>

                    <div class="item-termo">
                        <h3>2. Uso das Informações</h3>
                        <p>Utilizamos suas informações para:</p>
                        <ul>
                            <li>Conectar jogadores com oportunidades</li>
                            <li>Melhorar nossos serviços</li>
                            <li>Comunicar sobre atualizações da plataforma</li>
                            <li>Garantir a segurança da plataforma</li>
                        </ul>
                    </div>

                    <div class="item-termo">
                        <h3>3. Compartilhamento de Dados</h3>
                        <p>Não vendemos suas informações pessoais. Compartilhamos dados apenas:</p>
                        <ul>
                            <li>Com clubes e organizações (conforme sua autorização)</li>
                            <li>Quando exigido por lei</li>
                            <li>Para proteger nossos direitos e segurança</li>
                        </ul>
                    </div>

                    <div class="item-termo">
                        <h3>4. Segurança dos Dados</h3>
                        <p>Implementamos medidas de segurança para proteger suas informações contra acesso não autorizado, alteração ou destruição.</p>
                    </div>

                    <div class="item-termo">
                        <h3>5. Seus Direitos</h3>
                        <p>Você tem o direito de:</p>
                        <ul>
                            <li>Acessar seus dados pessoais</li>
                            <li>Corrigir informações incorretas</li>
                            <li>Solicitar exclusão de sua conta</li>
                            <li>Retirar consentimento a qualquer momento</li>
                        </ul>
                    </div>
                </div>

                <!-- Cookies -->
                <!-- <div class="secao-documento">
                    <div class="icone-secao">
                        <i class="fa-solid fa-cookie-bite"></i>
                    </div>
                    <h2>Política de Cookies</h2>
                    
                    <div class="item-termo">
                        <h3>O que são Cookies?</h3>
                        <p>Cookies são pequenos arquivos de texto armazenados em seu dispositivo para melhorar sua experiência na plataforma.</p>
                    </div>

                    <div class="item-termo">
                        <h3>Como Usamos Cookies</h3>
                        <ul>
                            <li>Manter você logado na plataforma</li>
                            <li>Lembrar suas preferências</li>
                            <li>Analisar o uso da plataforma</li>
                            <li>Personalizar conteúdo</li>
                        </ul>
                    </div>
                </div> -->


                <div class="secao-contato-termos">
                    <div class="card-contato-termos">
                        <h3>Dúvidas sobre nossos Termos?</h3>
                        <p>Se você tiver alguma dúvida sobre estes termos ou nossa política de privacidade, entre em contato conosco:</p>
                        <!-- <div class="info-contato-termos">
                            <div class="item-contato-termos">
                                <i class="fa-solid fa-envelope"></i>
                                <span>contato@futlink.com.br</span>
                            </div> -->
                            <div class="item-contato-termos">
                                <i class="fa-brands fa-github"></i>
                                <a href="https://github.com/TCC-Nexa-Luminy/FutLink" target="_blank">GitHub - Nexa Luminy</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php include("../app/views/footer.php"); ?>

    <script src="../public/js/index.js"></script>
</body>
</html>
