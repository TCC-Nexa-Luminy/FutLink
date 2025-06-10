<?php
@session_start();
include("../app/views/topo.php");
?>
<link rel="stylesheet" href="./css/index.css">
<link rel="stylesheet" href="./css/contato.css">

<body>
    <?php
    include_once("../app/views/message.php");
    include("../app/views/navbarIndex.php");
    ?>


    <section class="secao-contato" id="contato">
        <div class="container-contato">
            

            <div class="cabecalho-contato">
                <h2 class="titulo-contato">Entre em Contato</h2>
                <p class="subtitulo-contato">Equipe Nexa Luminy</p>
                <p class="descricao-contato">
                    Conecte-se conosco nas redes sociais! Estamos sempre compartilhando novidades sobre o FutLink, 
                    tecnologia e futebol. Siga a gente para acompanhar nossa jornada e tirar suas dúvidas.
                </p>
            </div>


            <div class="grid-contatos">

    <div class="card-contato github">
        <div class="icone-contato">
            <i class="fa-brands fa-github"></i>
        </div>
        <div class="info-contato">
            <h3>GitHub</h3>
            <p>Veja nossos projetos e contribuições</p>
            <span class="handle">@nexaluminy</span>
        </div>
        <a href="https://github.com/TCC-Nexa-Luminy/FutLink" target="_blank" class="botao-contato">
            <span>Seguir</span>
            <i class="fa-solid fa-external-link-alt"></i>
        </a>
    </div>

</div>

            <!-- Seção ETEC -->
            <div class="secao-etec">
                <div class="card-etec">
                    <div class="icone-etec">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <div class="info-etec">
                        <h3>ETEC de Itaquera</h3>
                        <p>Orgulhosamente formados pela ETEC de Itaquera, onde desenvolvemos nossa paixão por tecnologia e inovação.</p>
                        <div class="badges-etec">
                            <span class="badge">Desenvolvimento de Sistemas</span>
                            <span class="badge">Turma 2024</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="cta-contato">
                <div class="conteudo-cta">
                    <h3>Vamos Conversar?</h3>
                    <p>Tem alguma dúvida sobre o FutLink? Quer saber mais sobre nossos projetos? Ou simplesmente quer bater um papo sobre tecnologia e futebol? Confira nosso GitHub!</p>
                    <div class="botoes-cta-contato">
    <a href="https://github.com/TCC-Nexa-Luminy/FutLink" target="_blank" class="botao-cta-principal">
        <i class="fa-brands fa-github"></i>
        Veja nossos projetos
    </a>
    <a href="../app/views/signUp.php" class="botao-cta-secundario">
        <i class="fa-solid fa-rocket"></i>
        Experimente o FutLink
    </a>
</div>
                </div>
                <div class="ilustracao-cta">
                    <div class="circulo-animado circulo-1"></div>
                    <div class="circulo-animado circulo-2"></div>
                    <div class="circulo-animado circulo-3"></div>
                    <i class="fa-solid fa-comments icone-central"></i>
                </div>
            </div>

            <!-- Footer da Seção -->
            <div class="footer-contato">
                <p>
                    <i class="fa-solid fa-heart"></i>
                    Feito com muito amor e café pela Equipe Nexa Luminy
                    <i class="fa-solid fa-coffee"></i>
                </p>
            </div>

        </div>
    </section>

    <?php include("../app/views/footer.php"); ?>

    <script src="../public/js/index.js"></script>
    <script src="./js/contato.js"></script>
</body>
</html>
