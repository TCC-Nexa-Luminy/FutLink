<?php 
@session_start();
include_once("topo.php");
?>

<!--ARQUIVO CSS JÁ EXISTENTE, DESENVOLVER SEU FRONT-END-->
<link rel="stylesheet" href="../../public/css/playerForm.css">

    <?php
    include_once("message.php");
    ?>
<body>
    <form action="../controllers/playerForm.act.php" method="post">
        <h1>Quer se candidatar a jogadores em nossos times registrados neste plataforma?</h1>
        <h2>Informe estes dados para se tornar um jogador aqui no FutLink</h2>

        <p>Desenvolver o front-end desta página de formulario de jogador</p>

        <input type="text" name="descrip" id="" placeholder="Sobre mim">

        <label for="ipeso">Informe seu peso: </label>
        <input type="number" name="peso" id="ipeso" placeholder="Ex: 70.5" step="0.01" min="0" max="500" required>

        <label for="ialtura">Informe sua altura: </label>
        <input type="number" name="altura" id="ialtura" placeholder="Ex: 1.75" step="0.01" min="0" max="3" required>

        <input type="hidden" name="id_user" value="<?= $_SESSION['id']; ?>"> <!--input que retorna o id do usuario-->

        <label for="iposicao">Qual a sua posição? </label>
        <select name="posicao" id="iposicao" required>
            <option value="">Seletione uma das opções</option>
            <option value="atacante">Atacante</option>
            <option value="meia">Meia</option>
            <option value="lateral">Lateral</option>
            <option value="zagueiro">Zagueiro</option>
            <option value="goleiro">Goleiro</option>
        </select>
        <input type="submit" value="Enviar">
    </form>
</body>

</html>