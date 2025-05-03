<?php include_once("topo.php");?>

<link rel="stylesheet" href="../../public/css/playerForm.css">

<body>
    <form action="#" method="post" class="form">
        <h1>Quer se candidatar a jogadores em nossos times registrados neste plataforma?</h1>
        <h2>Informe estes dados para se tornar um jogador aqui no FutLink</h2>
        <input type="number" name="peso" id="" placeholder="Informe seu peso" required>
        <input type="number" name="altura" id="" placeholder="Informe sua altura" required>
        <select name="" id="" required>
            <option value="">Seletione uma das opções</option>
            <option value="1">Atacante</option>
            <option value="2">Meia</option>
            <option value="3">Lateral</option>
            <option value="4">Zagueiro</option>
            <option value="5">Goleiro</option>
        </select>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>