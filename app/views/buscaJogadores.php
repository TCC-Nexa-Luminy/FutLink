<?php include("../views/topo.php"); ?>

<html lang="pt-br">
<link rel="stylesheet" href="../../public/css/buscaJogadores.css">
<title>Buscar Jogadores</title>
<body>
    <div class="container">

        <div class="barra-pesquisa">
        <input type="text" placeholder="Buscar jogadores...">
        <i class="fa fa-search"></i>
        </div>

        <div class="content">
            <div class="filtros">
                <h2>ORDENAR ATLETAS POR:</h2>

                <label>Idade</label>
                <input type="number" placeholder="De">
                <input type="number" placeholder="Até">

                <label>Altura</label>
                <input type="number" placeholder="De">
                <input type="number" placeholder="Até">

                <label>Posição</label>
                <div class="checkbox-group">
                    <div><input type="checkbox"> Atacantes</div>
                    <div><input type="checkbox"> Meio-Campistas</div>
                    <div><input type="checkbox"> Defensores</div>
                    <div><input type="checkbox"> Goleiros</div>
                </div>

                <label>Tempo de carreira</label>
                <div class="detalhes-carreira">
                    <div> Mais experiente</div>
                    <div>Menos experiente</div>
                </div>

                <label>Popularidade</label>
                <div class="radio-group">
                    <div><input type="radio" name="popularidade"> Mais popular primeiro</div>
                    <div><input type="radio" name="popularidade"> Menos popular primeiro</div>
                </div>
            </div>

            <div class="grade-cards">
                <div class="card-jogadores"><span>Representante, 17</span></div>
                <div class="card-jogadores"><span>Lanches, 42</span></div>
                <div class="card-jogadores"><span>Henrique, 19</span></div>
                <div class="card-jogadores"><span>Gótico, 17</span></div>
                <div class="card-jogadores"><span>Buzeria, 17</span></div>
                <div class="card-jogadores"><span>Gabriel Nazi, 16</span></div>
            </div>
        </div>
    </div>
</body>
