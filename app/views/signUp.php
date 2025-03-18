<?php include("topo.php"); ?>
<link rel="stylesheet" href="../../public/css/signUp.css">

<body>
    <main class="containerMain">
        <section>
            <a href="../../public/index.php" class="back_btn"><i class="fa-solid fa-circle-left"></i></a>
            <form action="../controllers/signUp.act.php" method="post" id="form_cadastro">
                <label for="iprofile">
                    <input type="file" name="user_photo" id="iprofile" style="display: none;">
                    Foto de Perfil
                </label>
                <div class="form_label">
                    <label for="inome"><i class="fa-regular fa-user"></i></label>
                    <input type="text" name="user_nome" id="inome" required placeholder="Nome Completo" autocomplete="off" class="input_user">
                </div>
                <div class="form_label">
                    <label for="iemail"><i class="fa-solid fa-envelope"></i></label>
                    <input type="email" name="user_email" id="iemail" required placeholder="seuemail@email.com" autocomplete="off" class="input_user">
                </div>
                <input type="date" name="user_data_nasc" id="" required class="input_user">
                
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
                <div class="form_label">
                    <label for="ipass"><i class="fa-solid fa-lock"></i></label>
                    <input type="password" name="user_pass" id="ipass" required placeholder="Insira sua senha" autocomplete="off" class="input_user">
                </div>
                <div class="form_label">
                    <label for="ipass2"><i class="fa-solid fa-lock"></i></label>
                    <input type="password" name="user_pass2" id="ipass2" required placeholder="Confirme sua senha" autocomplete="off" class="input_user">
                </div>
                <input type="submit" value="Finalizar cadastro">
            </form>
        </section>
        <section>

        </section>
    </main>
    <script src="../../public/js/signUp.js"></script>
</body>

</html>