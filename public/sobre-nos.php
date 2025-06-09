<?php
@session_start();
include("../app/views/topo.php");
?>
<link rel="stylesheet" href="./css/index.css">
<link rel="stylesheet" href="./css/sobre-nos.css">

<body>
    <?php
    include_once("../app/views/message.php");
    include("../app/views/navbarIndex.php");
    ?>

    <!-- Seção Sobre Nós -->
    <section class="secao-sobre-nos" id="sobre-nos">
        <div class="container-sobre-nos">
            
            <!-- Introdução da Equipe -->
            <div class="intro-equipe">
                <div class="conteudo-intro">
                    <h2 class="titulo-sobre-nos">Sobre Nós</h2>
                    <h3 class="subtitulo-equipe">Equipe Nexa Luminy</h3>
                    <p class="descricao-equipe">
                        Somos uma equipe apaixonada por tecnologia e futebol, formada por estudantes da 
                        <strong>ETEC de Itaquera</strong>. Unidos pela paixão em criar soluções inovadoras, 
                        desenvolvemos o FutLink com o objetivo de revolucionar a forma como jogadores e 
                        organizações se conectam no mundo do futebol brasileiro.
                    </p>
                    <p class="descricao-equipe">
                        Nossa missão é democratizar o acesso às oportunidades no futebol, utilizando a 
                        tecnologia como ponte entre talentos e clubes. Cada linha de código que escrevemos 
                        carrega nossa dedicação em transformar sonhos em realidade.
                    </p>
                    <div class="stats-equipe">
                        <div class="stat-item">
                            <span class="numero">6</span>
                            <span class="label">Desenvolvedores</span>
                        </div>
                        <div class="stat-item">
                            <span class="numero">1</span>
                            <span class="label">Missão</span>
                        </div>
                        <div class="stat-item">
                            <span class="numero">∞</span>
                            <span class="label">Paixão</span>
                        </div>
                    </div>
                </div>
                <div class="imagem-equipe">
                    <img src="./images/equipe/equipe-nexa-luminy.jpg" alt="Equipe Nexa Luminy" class="foto-equipe">
                    <div class="overlay-equipe">
                        <div class="logo-etec">
                            <i class="fa-solid fa-graduation-cap"></i>
                            <span>ETEC Itaquera</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Título da Seção de Membros -->
            <div class="titulo-membros">
                <h3>Conheça Nossa Equipe</h3>
                <p>Cada membro traz sua expertise única para criar a melhor experiência possível</p>
            </div>

            <!-- Grid de Membros -->
            <div class="grid-membros">
                
                <!-- Pedro -->
                <div class="card-membro">
                    <div class="foto-membro">
                        <img src="./images/equipe/pedro.jpg" alt="Pedro" class="imagem-membro">
                        <div class="overlay-membro">
                            <div class="icones-tech">
                                <i class="fa-brands fa-html5"></i>
                                <i class="fa-brands fa-js"></i>
                                <i class="fa-brands fa-php"></i>
                            </div>
                        </div>
                    </div>
                    <div class="info-membro">
                        <h4 class="nome-membro">Pedro</h4>
                        <p class="cargo-membro">Full Stack Developer</p>
                        <p class="descricao-membro">
                            Responsável pelo desenvolvimento Front-end e Back-end, 
                            garantindo a integração perfeita entre interface e servidor.
                        </p>
                        <div class="skills-membro">
                            <span class="skill">Frontend</span>
                            <span class="skill">Backend</span>
                            <span class="skill">API</span>
                        </div>
                    </div>
                </div>

                <!-- Daniel -->
                <div class="card-membro">
                    <div class="foto-membro">
                        <img src="./images/equipe/daniel.jpg" alt="Daniel" class="imagem-membro">
                        <div class="overlay-membro">
                            <div class="icones-tech">
                                <i class="fa-solid fa-file-alt"></i>
                                <i class="fa-solid fa-palette"></i>
                                <i class="fa-solid fa-sitemap"></i>
                            </div>
                        </div>
                    </div>
                    <div class="info-membro">
                        <h4 class="nome-membro">Daniel</h4>
                        <p class="cargo-membro">Documentation & Design Lead</p>
                        <p class="descricao-membro">
                            Responsável pela Documentação do projeto, Manual de Identidade Visual 
                            e Modelagem de Casos de Uso.
                        </p>
                        <div class="skills-membro">
                            <span class="skill">Documentação</span>
                            <span class="skill">Design</span>
                            <span class="skill">UML</span>
                        </div>
                    </div>
                </div>

                <!-- Eduardo -->
                <div class="card-membro">
                    <div class="foto-membro">
                        <img src="./images/equipe/eduardo.jpg" alt="Eduardo" class="imagem-membro">
                        <div class="overlay-membro">
                            <div class="icones-tech">
                                <i class="fa-solid fa-code"></i>
                                <i class="fa-solid fa-paint-brush"></i>
                                <i class="fa-solid fa-mobile-alt"></i>
                            </div>
                        </div>
                    </div>
                    <div class="info-membro">
                        <h4 class="nome-membro">Eduardo</h4>
                        <p class="cargo-membro">Full Stack & UI/UX Designer</p>
                        <p class="descricao-membro">
                            Atua no desenvolvimento Front-end e Back-end, além de contribuir 
                            como UI/UX Designer criando experiências incríveis.
                        </p>
                        <div class="skills-membro">
                            <span class="skill">Frontend</span>
                            <span class="skill">Backend</span>
                            <span class="skill">UI/UX</span>
                        </div>
                    </div>
                </div>

                <!-- Murilo -->
                <div class="card-membro">
                    <div class="foto-membro">
                        <img src="./images/equipe/murilo.jpg" alt="Murilo" class="imagem-membro">
                        <div class="overlay-membro">
                            <div class="icones-tech">
                                <i class="fa-solid fa-server"></i>
                                <i class="fa-solid fa-file-text"></i>
                                <i class="fa-solid fa-graduation-cap"></i>
                            </div>
                        </div>
                    </div>
                    <div class="info-membro">
                        <h4 class="nome-membro">Murilo</h4>
                        <p class="cargo-membro">Backend Developer & ABNT Specialist</p>
                        <p class="descricao-membro">
                            Responsável pelo desenvolvimento Back-end e apoio na Documentação ABNT, 
                            garantindo código limpo e documentação padronizada.
                        </p>
                        <div class="skills-membro">
                            <span class="skill">Backend</span>
                            <span class="skill">ABNT</span>
                            <span class="skill">APIs</span>
                        </div>
                    </div>
                </div>

                <!-- Shandel -->
                <div class="card-membro">
                    <div class="foto-membro">
                        <img src="./images/equipe/shandel.jpg" alt="Shandel" class="imagem-membro">
                        <div class="overlay-membro">
                            <div class="icones-tech">
                                <i class="fa-solid fa-database"></i>
                                <i class="fa-solid fa-project-diagram"></i>
                                <i class="fa-solid fa-server"></i>
                            </div>
                        </div>
                    </div>
                    <div class="info-membro">
                        <h4 class="nome-membro">Shandel</h4>
                        <p class="cargo-membro">Database Architect & Backend Dev</p>
                        <p class="descricao-membro">
                            Responsável pela Modelagem Lógica, desenvolvimento Back-end 
                            e estruturação do Banco de Dados.
                        </p>
                        <div class="skills-membro">
                            <span class="skill">Database</span>
                            <span class="skill">Backend</span>
                            <span class="skill">Modelagem</span>
                        </div>
                    </div>
                </div>

                <!-- Thiago -->
                <div class="card-membro">
                    <div class="foto-membro">
                        <img src="./images/equipe/thiago.jpg" alt="Thiago" class="imagem-membro">
                        <div class="overlay-membro">
                            <div class="icones-tech">
                                <i class="fa-solid fa-laptop-code"></i>
                                <i class="fa-solid fa-magic"></i>
                                <i class="fa-solid fa-heart"></i>
                            </div>
                        </div>
                    </div>
                    <div class="info-membro">
                        <h4 class="nome-membro">Thiago</h4>
                        <p class="cargo-membro">Full Stack & UX/UI Designer</p>
                        <p class="descricao-membro">
                            Atua no desenvolvimento Front-end e Back-end, além de contribuir 
                            como UX/UI Designer focando na experiência do usuário.
                        </p>
                        <div class="skills-membro">
                            <span class="skill">Frontend</span>
                            <span class="skill">Backend</span>
                            <span class="skill">UX/UI</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- CTA Final -->
            <div class="cta-equipe">
                <h3>Junte-se à Nossa Jornada</h3>
                <p>Estamos transformando o futebol brasileiro através da tecnologia. Faça parte dessa revolução!</p>
                <div class="botoes-cta-equipe">
                    <a href="../app/views/signUp.php" class="botao-cta-equipe primario">
                        <i class="fa-solid fa-rocket"></i>
                        Começar Agora
                    </a>
                    <a href="#contato" class="botao-cta-equipe secundario">
                        <i class="fa-solid fa-envelope"></i>
                        Entre em Contato
                    </a>
                </div>
            </div>

        </div>
    </section>

    <?php include("../app/views/footer.php"); ?>

    <script src="../public/js/index.js"></script>
    <script src="./js/sobre-nos.js"></script>
</body>
</html>
