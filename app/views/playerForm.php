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
    <main id="pageMain">

        <h1>Quer se candidatar a jogadores em nossos times registrados neste plataforma?</h1>
        <h2>Informe estes dados para se tornar um jogador aqui no FutLink</h2>
        
        <p>Desenvolver o front-end desta página de formulario de jogador</p>
        
        <p>Este formulario deve pedir os seguintes dados do usuário para que se torne um jogador:</p>
        <ul>
            <li>peso</li>
            <li>altura</li>
            <li>descrição</li>
            <li>posição</li>
            <li>pé dominante</li>
        </ul>
        <p>abaixo são inputs meramente ilustrativos, eles podem ser removidos ou modificados pelo dev front-end</p>
        <form action="../controllers/playerForm.act.php" method="post">
            <input type="number" name="peso" id="" step="0,01" min='0' required placeholder="peso">
            <input type="hidden" name="id_user" value="<?= $_SESSION['id']; ?>"> <!--input que retorna o id do usuario, ele deve estar dentro de um form-->
            
            <input type="submit" value="Enviar">
        </form>
    </main>
</body>

</html>