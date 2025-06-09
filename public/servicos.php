<?php
@session_start();
include("../app/views/topo.php");
?>
<link rel="stylesheet" href="./css/index.css">
<link rel="stylesheet" href="./css/servicos.css">

<body>
    <?php
    include_once("../app/views/message.php");
    include("../app/views/navbarIndex.php");
    ?>

    <!-- Seção de Serviços -->
    <section class="secao-servicos" id="servicos">
        <div class="container-servicos">
            <div class="cabecalho-servicos">
                <h2 class="titulo-principal">Nossos Serviços</h2>
                <p class="descricao-principal">
                    O FutLink é uma plataforma completa que conecta jogadores e organizações de forma simples e eficiente,
                    criando oportunidades reais no mundo do futebol brasileiro.
                </p>
            </div>

            <!-- Abas de navegação -->
            <div class="container-abas">
                <button class="botao-aba ativo" data-aba="jogador">
                    <i class="fa-solid fa-user"></i>
                    Jogador
                </button>
                <button class="botao-aba" data-aba="organizacao">
                    <i class="fa-solid fa-building"></i>
                    Organização
                </button>
                <button class="botao-aba" data-aba="usuario">
                    <i class="fa-solid fa-users"></i>
                    Usuário
                </button>
            </div>

            <!-- Conteúdo dos serviços -->
            <div class="grid-servicos">
                <!-- Imagem ilustrativa -->
                <div class="container-imagem">
                    <div class="circulo-decorativo circulo-1"></div>
                    <div class="circulo-decorativo circulo-2"></div>
                    <img src="./images/banners/BannerDeviceMockup.png" alt="Serviços FutLink" class="imagem-servicos">
                </div>

                <!-- Conteúdo baseado na aba ativa -->
                <div class="container-conteudo">

                    <!-- Conteúdo Jogador -->
                    <div class="conteudo-aba ativo" id="conteudo-jogador">
                        <div class="cabecalho-aba">
                            <h3 class="titulo-aba">Para Jogadores</h3>
                            <p class="descricao-aba">
                                Mostre seu talento, seja descoberto e alcance novas oportunidades no futebol. O FutLink oferece
                                todas as ferramentas para impulsionar sua carreira esportiva.
                            </p>
                        </div>

                        <div class="grid-funcionalidades">
                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Perfil Profissional</h4>
                                    <p class="descricao-funcionalidade">Crie um perfil detalhado com suas características, habilidades e experiências.</p>
                                </div>
                            </div>

                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-video"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Portfólio de Vídeos</h4>
                                    <p class="descricao-funcionalidade">Faça upload de vídeos com seus melhores lances e jogadas para impressionar.</p>
                                </div>
                            </div>

                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-calendar"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Peneiras e Seletivas</h4>
                                    <p class="descricao-funcionalidade">Inscreva-se em peneiras organizadas por clubes de todo o Brasil.</p>
                                </div>
                            </div>

                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-map-marker-alt"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Oportunidades Locais</h4>
                                    <p class="descricao-funcionalidade">Encontre oportunidades próximas à sua localização geográfica.</p>
                                </div>
                            </div>

                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Destaque suas Conquistas</h4>
                                    <p class="descricao-funcionalidade">Registre títulos, prêmios e reconhecimentos da sua carreira.</p>
                                </div>
                            </div>

                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-comments"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Chat com Organizações</h4>
                                    <p class="descricao-funcionalidade">Comunique-se diretamente com clubes e olheiros interessados.</p>
                                </div>
                            </div>

                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-bell"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Alertas Personalizados</h4>
                                    <p class="descricao-funcionalidade">Receba notificações sobre oportunidades que combinam com seu perfil.</p>
                                </div>
                            </div>

                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-share-alt"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Feed de Atualizações</h4>
                                    <p class="descricao-funcionalidade">Compartilhe sua rotina de treinos, jogos e evolução na carreira.</p>
                                </div>
                            </div>
                        </div>

                        <div class="destaque-aba">
                            <h4 class="titulo-destaque">Destaque-se no Mundo do Futebol</h4>
                            <p class="texto-destaque">
                                Com o FutLink, seu talento ganha visibilidade nacional. Jogadores de todas as regiões do Brasil têm
                                a chance de mostrar seu potencial para clubes e organizações esportivas.
                            </p>
                            <div class="badges-destaque">
                                <div class="badge-destaque">
                                    <i class="fa-solid fa-eye"></i>
                                    <span>Visibilidade garantida</span>
                                </div>
                                <div class="badge-destaque">
                                    <i class="fa-solid fa-shield-alt"></i>
                                    <span>Oportunidades verificadas</span>
                                </div>
                                <div class="badge-destaque">
                                    <i class="fa-solid fa-bolt"></i>
                                    <span>Conexões diretas</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Conteúdo Organização -->
                    <div class="conteudo-aba" id="conteudo-organizacao">
                        <div class="cabecalho-aba">
                            <h3 class="titulo-aba">Para Organizações</h3>
                            <p class="descricao-aba">
                                Encontre talentos, organize peneiras e gerencie seu clube de forma eficiente. O FutLink oferece
                                ferramentas completas para descobrir os melhores jogadores para sua equipe.
                            </p>
                        </div>

                        <div class="grid-funcionalidades">
                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-building"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Perfil Institucional</h4>
                                    <p class="descricao-funcionalidade">Apresente seu clube, história, estrutura e filosofia de trabalho.</p>
                                </div>
                            </div>

                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-search"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Busca Avançada</h4>
                                    <p class="descricao-funcionalidade">Encontre jogadores usando filtros por posição, idade, região e habilidades.</p>
                                </div>
                            </div>

                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-calendar-plus"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Criação de Peneiras</h4>
                                    <p class="descricao-funcionalidade">Organize seletivas e receba inscrições diretamente pela plataforma.</p>
                                </div>
                            </div>

                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-file-alt"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Relatórios Detalhados</h4>
                                    <p class="descricao-funcionalidade">Acesse relatórios sobre inscritos e participantes das suas peneiras.</p>
                                </div>
                            </div>

                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-comments"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Contato Direto</h4>
                                    <p class="descricao-funcionalidade">Comunique-se com jogadores que despertaram interesse do seu clube.</p>
                                </div>
                            </div>

                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-chart-bar"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Análise de Talentos</h4>
                                    <p class="descricao-funcionalidade">Compare estatísticas e desempenho de diferentes jogadores.</p>
                                </div>
                            </div>

                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-trophy"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Divulgação de Conquistas</h4>
                                    <p class="descricao-funcionalidade">Compartilhe títulos e conquistas do seu clube para atrair talentos.</p>
                                </div>
                            </div>

                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-user-plus"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Gestão de Categorias</h4>
                                    <p class="descricao-funcionalidade">Organize suas categorias de base e equipes profissionais.</p>
                                </div>
                            </div>
                        </div>

                        <div class="destaque-aba">
                            <h4 class="titulo-destaque">Descubra Novos Talentos</h4>
                            <p class="texto-destaque">
                                O FutLink conecta sua organização com jogadores de todo o Brasil, facilitando o processo de
                                descoberta de talentos e tornando a captação mais eficiente e assertiva.
                            </p>
                            <div class="badges-destaque">
                                <div class="badge-destaque">
                                    <i class="fa-solid fa-search"></i>
                                    <span>Busca inteligente</span>
                                </div>
                                <div class="badge-destaque">
                                    <i class="fa-solid fa-clock"></i>
                                    <span>Economia de tempo</span>
                                </div>
                                <div class="badge-destaque">
                                    <i class="fa-solid fa-award"></i>
                                    <span>Talentos verificados</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Conteúdo Usuário -->
                    <div class="conteudo-aba" id="conteudo-usuario">
                        <div class="cabecalho-aba">
                            <h3 class="titulo-aba">Para Usuários</h3>
                            <p class="descricao-aba">
                                Explore o mundo do futebol e acompanhe o desenvolvimento de jogadores e clubes. O FutLink oferece
                                uma experiência completa para todos os apaixonados pelo esporte.
                            </p>
                        </div>

                        <div class="grid-funcionalidades">
                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-user-plus"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Cadastro Simples</h4>
                                    <p class="descricao-funcionalidade">Crie sua conta em poucos passos e acesse todas as funcionalidades.</p>
                                </div>
                            </div>

                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-search"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Explorar Talentos</h4>
                                    <p class="descricao-funcionalidade">Descubra jogadores promissores e acompanhe suas carreiras.</p>
                                </div>
                            </div>

                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-building"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Conhecer Clubes</h4>
                                    <p class="descricao-funcionalidade">Explore o perfil de clubes e organizações esportivas de todo o Brasil.</p>
                                </div>
                            </div>

                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-calendar"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Acompanhar Peneiras</h4>
                                    <p class="descricao-funcionalidade">Fique por dentro das seletivas que acontecem em sua região.</p>
                                </div>
                            </div>

                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-bell"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Notificações</h4>
                                    <p class="descricao-funcionalidade">Receba alertas sobre novidades de jogadores e clubes que você segue.</p>
                                </div>
                            </div>

                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-share-alt"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Compartilhar Conteúdo</h4>
                                    <p class="descricao-funcionalidade">Compartilhe perfis e oportunidades com sua rede de contatos.</p>
                                </div>
                            </div>

                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-comments"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Interação na Comunidade</h4>
                                    <p class="descricao-funcionalidade">Participe de discussões e interaja com outros usuários da plataforma.</p>
                                </div>
                            </div>

                            <div class="card-funcionalidade">
                                <div class="icone-funcionalidade">
                                    <i class="fa-solid fa-eye"></i>
                                </div>
                                <div class="texto-funcionalidade">
                                    <h4 class="titulo-funcionalidade">Visualização de Conteúdo</h4>
                                    <p class="descricao-funcionalidade">Acesse vídeos, estatísticas e históricos de jogadores e clubes.</p>
                                </div>
                            </div>
                        </div>

                        <div class="destaque-aba">
                            <h4 class="titulo-destaque">Faça Parte da Comunidade FutLink</h4>
                            <p class="texto-destaque">
                                Após fazer login, você pode explorar todas as funcionalidades da plataforma e, se desejar,
                                transformar seu perfil em um perfil de jogador para mostrar seu talento.
                            </p>
                            <div class="badges-destaque">
                                <div class="badge-destaque">
                                    <i class="fa-solid fa-users"></i>
                                    <span>Comunidade ativa</span>
                                </div>
                                <div class="badge-destaque">
                                    <i class="fa-solid fa-bolt"></i>
                                    <span>Conteúdo exclusivo</span>
                                </div>
                                <div class="badge-destaque">
                                    <i class="fa-solid fa-shield-alt"></i>
                                    <span>Ambiente seguro</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Final -->
            <div class="cta-final">
                <h3 class="titulo-cta">Pronto para transformar sua jornada no futebol?</h3>
                <div class="botoes-cta">
                    <a href="../app/views/signUp.php" class="botao-cta botao-usuario">
                        <i class="fa-solid fa-user"></i>
                        Criar conta de usuário
                        <i class="fa-solid fa-angle-right"></i>
                    </a>
                    <a href="../app/views/signUp-org.php" class="botao-cta botao-organizacao">
                        <i class="fa-solid fa-building"></i>
                        Criar conta de organização
                        <i class="fa-solid fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php include("../app/views/footer.php"); ?>

    <script src="../public/js/index.js"></script>
    <script src="./js/servicos.js"></script>
</body>
</html>
