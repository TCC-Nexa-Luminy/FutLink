<?php
@session_start();
include("topo.php");
?>
<link rel="stylesheet" href="../../public/css/signUp-org.css">

<body>
    <?php include("message.php"); ?>
    <main class="containerMain">
        <section class="main_content">
            <a href="../../public/index.php" class="back_btn"><i class="fa-solid fa-circle-left"></i></a>
            <form action="../controllers/signUpOrg.act.php" method="post" id="form_cadastro" enctype="multipart/form-data">
                <input type="file" name="org_photo" id="iprofile" style="display: none;" accept=".png, .jpg, .jpeg, .webp">
                <h1>Cadastro da Organização</h1>
                <h2>Já tem uma conta? <a href="login.php">Entre aqui</a></h2>
                <hr>
                <article class="content-input">
                    <h3>Informações da organização</h3>
                    <div class="form-content-info">
                        <label for="iprofile" class="container_photo">
                            <span class="placeholderSpan">Logo (1:1)<br>(Opcional)</span>
                            <img src="" alt="Logo da Organização" id="iphoto" style="display: none;">
                        </label>
                        <div class="form-label_direction">
                            <div class="form-label">
                                <label for="inome">Nome da Organização</label>
                                <input type="text" name="org_nome" id="inome" required placeholder="Insira o nome da organização" autocomplete="off" class="input_user">
                            </div>
                            <div class="form-label">
                                <label for="idata">Data de Fundação</label>
                                <input type="date" name="org_data_fund" id="idata" required class="input_user">
                            </div>
                        </div>
                    </div>
                </article>

                <hr>
                <article class="content-input">
                    <h3>Contato</h3>
                    <div class="form-label_direction">
                        <div class="form-label">
                            <label for="iemail">Email</label>
                            <input type="email" name="org_email" id="iemail" required placeholder="email@organizacao.com" autocomplete="off" class="input_user">
                        </div>
                        <div class="form-label">
                            <label for="itel">Telefone</label>
                            <input type="tel" name="org_tel" id="itel" required placeholder="(xx)12345-6789">
                        </div>
                    </div>
                </article>

                <hr>
                <article class="content-input">
                    <h3>Segurança</h3>
                    <div class="form-label_direction">
                        <div class="form-label">
                            <label for="ipass">Crie uma senha</label>
                            <input type="password" name="org_pass" id="ipass" required placeholder="Insira sua senha" autocomplete="off" class="input_user">
                        </div>
                        <div class="form-label">
                            <label for="ipass2">Confirme sua senha</label>
                            <input type="password" name="org_pass2" id="ipass2" required placeholder="Confirme sua senha" autocomplete="off" class="input_user">
                        </div>
                    </div>
                </article>

                <article class="content-input">
                    <h3>Informações da Organização</h3>
                    <div class="form-label_direction">
                        <div class="form-label">
                            <label for="iorgname">Nome da Organização</label>
                            <input type="text" name="org_nome" id="iorgname" required placeholder="Nome oficial do clube" class="input_user">
                        </div>
                        <div class="form-label">
                            <label for="icnpj">CNPJ</label>
                            <input type="text" name="org_cnpj" id="icnpj" placeholder="00.000.000/0000-00" class="input_user">
                        </div>
                    </div>
                </article>


                <hr>
                <div class="form-label_direction">
                    <a href="../../public/index.php" class="form_back-btn"><i class="fa-solid fa-arrow-left"></i> Voltar</a>
                    <input type="submit" value="Finalizar cadastro" class="form_submit">
                </div>
            </form>
        </section>

        <section class="main_banner">
            <div class="banner_top">
                <img src="../../public/images/futlinkLogoBg.png" alt="">
                <h1>FutLink</h1>
            </div>
            <div class="banner_msg">
                <h1>Cadastre sua organização!</h1>
                <h2>Conecte-se com talentos e fortaleça sua equipe</h2>
            </div>
            <div class="banner_rodape">
                <p>Informe os dados ao lado para se cadastrar na nossa plataforma de recrutamento de jogadores</p>
            </div>
        </section>
    </main>

    <script src="../../public/js/signUp.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>
</body>

</html>