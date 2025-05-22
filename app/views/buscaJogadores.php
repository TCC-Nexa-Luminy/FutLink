<?php include('topo.php'); ?>
    <title>Buscar Jogadores</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Montserrat:wght@600;700;800&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/buscaJogador.css">
<body>

<?php include 'navbar-social.php'; ?>

    <div class="container">
        <h1 class="titulo">Buscar Jogadores</h1>

        <div class="barraPesquisa">
            <div class="pesquisaContainer">
                <form method="GET" action="buscaJogadores.act.php">
                    <input type="text" name="apelido" placeholder="Buscar jogador por nome..." />
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>

        <div class="conteudo">
            <div class="filtros">
                <h3>Filtrar jogadores</h3>

                <div class="filtro">
                    <label>Idade:</label>
                    <div class="faixa">
                        <input type="number" placeholder="De" id="idadeMin" min="0">
                        <input type="number" placeholder="Até" id="idadeMax" min="0">
                    </div>
                </div>

                <div class="filtro">
                    <label>Peso</label>
                    <select id="peso">
                        <option value="">Selecione</option>
                        <option value="asc">Menor peso</option>
                        <option value="desc">Maior peso</option>
                    </select>
                </div>

                <div class="filtro">
                    <label>Altura (cm):</label>
                    <div class="faixa">
                        <input type="number" placeholder="De" id="altura_min" min="0">
                        <input type="number" placeholder="Até" id="altura_max" min="0">
                    </div>
                </div>

                <div class="filtro">
                    <label>Experiência (anos):</label>
                    <select id="experiencia">
                        <option value="">Selecione</option>
                        <option value="asc">Menor tempo</option>
                        <option value="desc">Maior tempo</option>
                    </select>
                </div>

                <div class="filtro">
                    <label>Posição:</label>
                    <div class="posicoes">
                        <button type="button">Goleiro</button>
                        <button type="button">Zagueiro</button>
                        <button type="button">Lateral</button>
                        <button type="button">Meia</button>
                        <button type="button">Atacante</button>
                    </div>
                </div>

                <button class="btnAplicarFiltros">Aplicar Filtros</button>
            </div>

            <div class="jogadorGrid">
                <div class="jogadorCard">
                    <div class="jogadorImagem">
                        <img src="../../public/images/bambu.png" alt="Foto do jogador">
                        <span class="posicaoBadge">Zagueiro</span>
                        <div class="jogadorOverlay">
                            <h3>Robson Bambu</h3>
                            <p>Idade: 22 anos</p>
                        </div>
                    </div>
                    <div class="jogadorInfo">
                        <h3>Robson Bambu</h3>
                        <p>Idade: 22 anos</p>
                        <div class="jogadorAcoes">
                            <a href="#" class="acaoBtn"><i class="fas fa-comment"></i> Contatar</a>
                            <a href="#" class="acaoBtn"><i class="fas fa-user-plus"></i> Ver perfil</a>
                        </div>
                    </div>
                </div>

                <div class="jogadorCard">
                    <div class="jogadorImagem">
                        <img src="images/felixTorres.png" alt="Foto do jogador">
                        <span class="posicaoBadge">Zagueiro</span>
                        <div class="jogadorOverlay">
                            <h3>Felix Torres</h3>
                            <p>Idade: 16 anos</p>
                        </div>
                    </div>
                    <div class="jogadorInfo">
                        <h3>Felix Torres</h3>
                        <p>Idade: 16 anos</p>
                        <div class="jogadorAcoes">
                            <a href="#" class="acaoBtn"><i class="fas fa-comment"></i> Contatar</a>
                            <a href="#" class="acaoBtn"><i class="fas fa-user-plus"></i> Ver perfil</a>
                        </div>
                    </div>
                </div>

                <div class="jogadorCard">
                    <div class="jogadorImagem">
                        <img src="images/luan.png" alt="Foto do jogador">
                        <span class="posicaoBadge">Meia</span>
                        <div class="jogadorOverlay">
                            <h3>Rei da America 2017</h3>
                            <p>Idade: 22 anos</p>
                        </div>
                    </div>
                    <div class="jogadorInfo">
                        <h3>Rei da America 2017</h3>
                        <p>Idade: 22 anos</p>
                        <div class="jogadorAcoes">
                            <a href="#" class="acaoBtn"><i class="fas fa-comment"></i> Contatar</a>
                            <a href="#" class="acaoBtn"><i class="fas fa-user-plus"></i> Ver perfil</a>
                        </div>
                    </div>
                </div>

                <div class="jogadorCard">
                    <div class="jogadorImagem">
                        <img src="player-photo.jpg" alt="Foto do jogador">
                        <span class="posicaoBadge">Atacante</span>
                        <div class="jogadorOverlay">
                            <h3>João Silva</h3>
                            <p>Idade: 22 anos</p>
                        </div>
                    </div>
                    <div class="jogadorInfo">
                        <h3>João Silva</h3>
                        <p>Idade: 22 anos</p>
                        <div class="jogadorAcoes">
                            <a href="#" class="acaoBtn"><i class="fas fa-comment"></i> Contatar</a>
                            <a href="#" class="acaoBtn"><i class="fas fa-user-plus"></i> Ver perfil</a>
                        </div>
                    </div>
                </div>

                <div class="jogadorCard">
                    <div class="jogadorImagem">
                        <img src="player-photo.jpg" alt="Foto do jogador">
                        <span class="posicaoBadge">Goleiro</span>
                        <div class="jogadorOverlay">
                            <h3>Carlos Oliveira</h3>
                            <p>Idade: 25 anos</p>
                        </div>
                    </div>
                    <div class="jogadorInfo">
                        <h3>Carlos Oliveira</h3>
                        <p>Idade: 25 anos</p>
                        <div class="jogadorAcoes">
                            <a href="#" class="acaoBtn"><i class="fas fa-comment"></i> Contatar</a>
                            <a href="#" class="acaoBtn"><i class="fas fa-user-plus"></i> Ver perfil</a>
                        </div>
                    </div>
                </div>

                <div class="jogadorCard">
                    <div class="jogadorImagem">
                        <img src="player-photo.jpg" alt="Foto do jogador">
                        <span class="posicaoBadge">Lateral</span>
                        <div class="jogadorOverlay">
                            <h3>Pedro Santos</h3>
                            <p>Idade: 19 anos</p>
                        </div>
                    </div>
                    <div class="jogadorInfo">
                        <h3>Pedro Santos</h3>
                        <p>Idade: 19 anos</p>
                        <div class="jogadorAcoes">
                            <a href="#" class="acaoBtn"><i class="fas fa-comment"></i> Contatar</a>
                            <a href="#" class="acaoBtn"><i class="fas fa-user-plus"></i> Ver perfil</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="carregarMais">
            <button class="btnCarregarMais">Carregar mais jogadores</button>
        </div>
    </div>
</body>
</html>