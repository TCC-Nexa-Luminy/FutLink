<?php
include("../views/topo.php");
include("navbar-social.php");
?>

<link rel="stylesheet" href="../../public/css/buscaJogadores.css">
<title>Buscar Jogadores</title>


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

        
</div>
<?php include("footer.php"); ?>
</body>

</html>