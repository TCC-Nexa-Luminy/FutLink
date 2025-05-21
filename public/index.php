<?php include("../app/views/topo.php") ?>
<link rel="stylesheet" href="./css/index.css">

<body>
    <nav class="navbar">
        <div class="logo">
            <a href="home.php">
                <img src="./images/logos/logo-fl-branco-solido.png" alt="">
            </a>
        </div>

        <ul class="infos">
            <li><a href="">Sobre nós</a></li>
            <li><a href="">Serviços</a></li>
            <li><a href="">Contato</a></li>
        </ul>

        <div class="buttons">
            <a href="../app/views/login.php" id="buttonlogin">Login <i class="fa-solid fa-angle-down"></i></a>

            <div class="dropdown-cadastrar" id="dropdownCadastrar">
                <a href="#" id="buttoncadastrar">Cadastrar <i class="fa-solid fa-angle-down"></i></a>
                <div class="dropdown-menu-cadastrar">
                    <a href="../app/views/signUp.php">Cadastrar como Jogador</a>
                    <a href="../app/views/signUp-org.php">Cadastrar como Organização</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="navbar-container">
        <div class="img-banner">
            <img src="./images/banners/BannerDeviceMockup.png" alt="">
        </div>
        <div class="h1-page">
            <h1>Sua chance de <br> brilhar no futebol <br> começa aqui!</h1>
        </div>
        <div class="h2-page">
            <p>Mostre seu jogo, conquiste <br>
                oportunidades e faça história no futebol.</p>
        </div>
        <div class="button-se-cadastre">
            <a href="../app/views/signUp.php" class="button-se-cadastre-link">
                <button>
                    <i class="fa-solid fa-user"></i> Criar seu perfil <i class="fa-solid fa-angle-right"></i>
                </button>
            </a>
        </div>
    </div>

    <div class="box-two">
        <div class="img-banner-phone">
            <img src="./images/banners/foto-banner-celular-fundo2.png" alt="">
        </div>
        <div class="banner-phone-text">
            <h1>Somos a FutLink,<br> seu talento no <br> caminho certo.</h1>
            <ul>
                <li>
                    Somos uma ponte entre atletas e oportunidades reais.
                </li>
                <li>
                    Somos pessoas que acreditam no poder do esporte.
                </li>
                <li>
                    Somos uma rede de conexões, sem barreiras ou burocracia.
                </li>
                <li>
                    Somos a chance de visibilidade para quem vem da quebrada ou do interior.
                </li>
                <li>
                    Somos uma plataforma feita exclusivamente para o futebol brasileiro.
                </li>
                <li>
                    Somos acesso fácil, rápido e direto ao seu futuro no esporte.
                </li>
            </ul>

            <button id="buttonbannerphone">
                Saiba Mais <i class="fa-solid fa-angle-right"></i>
            </button>

        </div>


    </div>

    <div class="box-three">
        <div class="cards-infos">
            <h1>Transforme sua jornada esportiva</h1>
            <p>Conecte-se com oportunidades, mostre seu talento e conquiste seu espaço no mundo dos esportes.</p>
        </div>
        <div class="cards-container">

            <div class="cards">
                <i class="fa-solid fa-futbol" style="color: #06b850;"></i>
                <div class="written-cards">
                    <div class="title-card">
                        <h3>Conecte-se sem barreiras</h3>
                    </div>
                    <div class="card-text">
                        <p>A gente aproxima atletas e oportunidades.
                            Com o FutLink, você cria seu perfil profissional
                            sem precisar de indicações ou contatos difíceis.
                            Aqui, o talento fala mais alto.</p>
                    </div>
                </div>
            </div>

            <div class="cards">
                <i class="fa-solid fa-magnifying-glass" style="color: #06b850;"></i>
                <div class="written-cards">
                    <div class="title-card">
                        <h3>Descubra ou seja descoberto</h3>
                    </div>
                    <div class="card-text">
                        <p>Empresários, clubes e olheiros podem buscar atletas
                            filtrando por posição, idade, localização e muito mais.
                            E se você é jogador, seu perfil fica visível pra quem
                            tá procurando exatamente o que você oferece.</p>
                    </div>
                </div>
            </div>

            <div class="cards">
                <i class="fa-solid fa-trophy" style="color: #06b850;"></i>
                <div class="written-cards">
                    <div class="title-card">
                        <h3>Mostre suas conquistas</h3>
                    </div>
                    <div class="card-text">
                        <p>No seu perfil, você pode registrar suas experiências,
                            campeonatos, gols e prêmios. Tudo organizado, direto
                            e fácil de visualizar. Sua trajetória esportiva num
                            só lugar. </p>
                    </div>
                </div>
            </div>

            <div class="cards">
                <i class="fa-solid fa-earth-americas" style="color: #06b850"></i>
                <div class="written-cards">
                    <div class="title-card">
                        <h3>Oportunidade para todos</h3>
                    </div>
                    <div class="card-text">
                        <p>Não importa se você tá na capital ou na quebrada:
                            sua chance de ser visto é real. A plataforma é acessível
                            pra qualquer um que queira transformar sonho em carreira.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="box-org">
        <h1>Crie seu clube. Conquiste respeito. Vire lenda no Footlink.</h1>
        <p>Monte seu clube do zero e desafie outras equipes no Footlink. Mostre que seu nome tem peso.</p>

        <a id="buttonorg" href="../app/views/signUp-org.php">
            Criar Organização <i class="fa-solid fa-angle-right"></i>
        </a>
    </div>

    <?php include("../app/views/footer.php"); ?>
</html>
<script src="../public/js/index.js"></script>

</body>