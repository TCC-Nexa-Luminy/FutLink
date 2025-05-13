<?php include("../views/topo.php"); ?>

<html lang="pt-br">
<head>
    <link rel="stylesheet" href="../../public/css/buscaJogadores.css">
    <title>Buscar Jogadores</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>
    <div class="container">

    <div class="barraPesquisa">
        <div class="pesquisaContainer">
            <form method="GET" action="../controllers/buscaJogadores.act.php">
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
                        <input type="number" placeholder="De" id="idadeMin" min=0>
                        <input type="number" placeholder="Até" id="idadeMax" min=0>
                    </div>
                </div>

                <div class="filtro">
                    <label>Peso (kg):</label>
                    <select id="peso">
                        <option value="">Selecione</option>
                        <option value="asc">Menor peso</option>
                        <option value="desc">Maior peso</option>
                    </select>
                </div>

                <div class="filtro">
                    <label>Altura (cm):</label>
                    <div class="faixa">
                        <input type="number" placeholder="De" id="altura_min" min=0>
                        <input type="number" placeholder="Até" id="altura_max" min=0>
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
            </div>

            <div class="jogadorGrid">
                <div class="jogadorCard">
                    <img src="../../public/images/bambu.png" alt="Foto do jogador">
                    <div class="nome-idade">
                        <span class="nome">Robson Bambu</span>
                        <span class="idade">Idade: 22</span>
                    </div>
                </div>

                <div class="jogadorCard">
                    <img src="../../public/images/felixTorres.png" alt="Foto do jogador">
                    <div class="nome-idade">
                        <span class="nome">Felix Torres</span>
                        <span class="idade">Idade: 16</span>
                    </div>
                </div>

                <div class="jogadorCard">
                    <img src="../../public/images/luan.png" alt="Foto do jogador">
                    <div class="nome-idade">
                        <span class="nome">Rei da America 2017</span>
                        <span class="idade">Idade: 22</span>
                    </div>
                </div>

                <div class="jogadorCard">
                    <img src="player-photo.jpg" alt="Foto do jogador">
                    <div class="nome-idade">
                        <span class="nome">João Silva</span>
                        <span class="idade">Idade: 22</span>
                    </div>
                </div>

                <div class="jogadorCard">
                    <img src="player-photo.jpg" alt="Foto do jogador">
                    <div class="nome-idade">
                        <span class="nome">João Silva</span>
                        <span class="idade">Idade: 22</span>
                    </div>
                </div>

                <div class="jogadorCard">
                    <img src="player-photo.jpg" alt="Foto do jogador">
                    <div class="nome-idade">
                        <span class="nome">João Silva</span>
                        <span class="idade">Idade: 22</span>
                    </div>
                </div>

                <div class="jogadorCard">
                    <img src="player-photo.jpg" alt="Foto do jogador">
                    <div class="nome-idade">
                        <span class="nome">João Silva</span>
                        <span class="idade">Idade: 22</span>
                    </div>
                </div>

                <div class="jogadorCard">
                    <img src="player-photo.jpg" alt="Foto do jogador">
                    <div class="nome-idade">
                        <span class="nome">João Silva</span>
                        <span class="idade">Idade: 22</span>
                    </div>
                </div>

                <div class="jogadorCard">
                    <img src="player-photo.jpg" alt="Foto do jogador">
                    <div class="nome-idade">
                        <span class="nome">João Silva</span>
                        <span class="idade">Idade: 22</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>