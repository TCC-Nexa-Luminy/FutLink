<?php include("topo.php"); ?>
<link rel="stylesheet" href="../../public/css/signUp.css">

<body>
    <main class="containerMain">
        <section class="main_content">
            <a href="../../public/index.php" class="back_btn"><i class="fa-solid fa-circle-left"></i></a>
            <form action="../controllers/signUp.act.php" method="post" id="form_cadastro">
                <h1>Cadastro</h1>
                <h2>Já tem uma conta? <a href="">Entre aqui</a></h2>
                <label for="iprofile">
                    <input type="file" name="user_photo" id="iprofile" style="display: none;">
                    Foto de Perfil
                </label>

                <hr>
                <article class="content-input">
                    <h3>Informações pessoais</h3>
                    <div class="form-label_direction">

                        <div class="form-label">
                            <label for="inome">Nome</i></label>
                            <input type="text" name="user_nome" id="inome" required placeholder="Insira seu nome completo" autocomplete="off" class="input_user">
                        </div>
                        <div class="form-label">
                            <label for="idate">Data de Nascimento</i></label>
                            <input type="date" name="user_data_nasc" id="idate" required class="input_user">
                        </div>
                    </div>

                    <fieldset>
                        <legend><i class="fa-solid fa-venus-mars"></i> Gênero:</legend>
                        <input type="radio" name="genero" id="imasc" value="masculino" checked>
                        <label for="imasc">Masculino</label>

                        <input type="radio" name="genero" id="ifem" value="feminino">
                        <label for="ifem">Feminino</label>

                        <input type="radio" name="genero" id="ioutro" value="outro">
                        <label for="ioutro">Outro</label>

                        <input type="radio" name="genero" id="iprefiro" value="prefiro não dizer">
                        <label for="iprefiro">Prefiro não dizer</label>
                    </fieldset>
                </article>

                <hr>
                <article class="content-input">
                    <h3>Contato</h3>
                    <div class="form-label_direction">

                        <div class="form-label">
                            <label for="iemail">Email</label>
                            <input type="email" name="user_email" id="iemail" required placeholder="seuemail@email.com" autocomplete="off" class="input_user">
                        </div>
                        <div class="form-label">
                            <label for="itel">Telefone</label>
                            <input type="tel" name="user_tel" id="itel" placeholder="(xx)12345-6789">
                        </div>
                    </div>
                </article>

                <hr>
                <article class="content-input">
                    <h3>Segurança</h3>
                    <div class="form-label_direction">
                        <div class="form-label">
                            <label for="ipass">Senha</label>
                            <input type="password" name="user_pass" id="ipass" required placeholder="Insira sua senha" autocomplete="off" class="input_user">
                        </div>
                        <div class="form-label">
                            <label for="ipass2">Confirme sua senha</i></label>
                            <input type="password" name="user_pass2" id="ipass2" required placeholder="Confirme sua senha" autocomplete="off" class="input_user">
                        </div>
                    </div>
                </article>



                <input type="submit" value="Finalizar cadastro">
            </form>
        </section>
        <section class="main_banner">
            <div class="banner_top">
                <img src="../../public/images/futlinkLogoBg.png" alt="">
                <h1>FutLink</h1>
            </div>
            <div class="banner_msg">
                <h1>Junte-se à nossa família!</h1>
                <h2>Um clique para se juntar ao time dos seus sonhos!</h2>
            </div>
            <div class="banner_rodape">
                <p>Informe seus dados ao lado e desfrute de nossa grande plataforma de recrutamento de jogadores</p>
            </div>
        </section>
    </main>
    <script src="../../public/js/signUp.js"></script>
</body>

</html>