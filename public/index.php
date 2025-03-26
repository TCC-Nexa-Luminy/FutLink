<?php
include("../app/views/topo.php");
?>
<link rel="stylesheet" href="css/index.css">

<body>

    <nav class="navbar">
        <div class="logo">
            <a href="index.php">
                <img src="../public/images/futlinkLogoBg.png" alt="">
            </a>
        </div>
        <ul class="infos">
            <li><a href="">Sobre nós</a></li>
            <li><a href="">Serviços</a></li>
            <li><a href="">Contato</a></li>
        </ul>
        <div class="buttons">
            <a href="../app/views/login.php">Login <i class="fa-solid fa-angle-down"></i></a>
            <a href="../app/views/signUp.php">Cadastrar <i class="fa-solid fa-angle-down"></i></a>
        </div>
    </nav>

    <div class="navbar-container">

        <div class="img-banner-phone">
            <img src="../public/images/banners/SlonganFutLink.png" alt="">
        </div>

        <div class="h1-page">
            <h1>Sua chance de <br> brilhar no futebol <br> começa aqui!</h1>
        </div>
        <div class="h2-page">
            <p>Mostre seu jogo, conquiste <br>
                oportunidades e faça história no futebol.</p>
        </div>
        <div class="button-se-cadastre">
            <button type="submit">
                Criar seu perfil <i class=" fa-solid fa-angle-right"></i>
            </button>
        </div>



    </div>
    <script src="js/index.js"></script>
</body>

</html>