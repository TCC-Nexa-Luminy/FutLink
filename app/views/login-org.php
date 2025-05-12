<?php
@session_start();
include_once("topo.php")
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futlink - Login</title>
    <link rel="stylesheet" href="../../public/css/login-org.css">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>

<body>
    <?php include_once("message.php"); ?>
    <div class="container-login">


        <div class="banner-left">
            <div class="banner">
                <img src="../../public/images/bannerLogin.png" alt="Banner do Futlink">
            </div>
        </div>



        <div class="login-form">

        <div class="painel-gradient">
            <a href="login.php" class="back_btn"><i class="fa-solid fa-circle-left"></i></a>
        </div>

            <h2>Informe seu e-mail para acessar seu clube no Futlink.</h2>


            <!-- Formulário de login -->
            <form action="../controllers/login.act.php" method="POST">
                <div class="input-group">
                    <input type="email" name="user_email" placeholder="Email" required autocomplete="off">
                </div>
                <div class="input-group">
                    <input type="password" name="user_pass" placeholder="Senha" required>
                    <a href="#">Esqueceu sua senha?</a>
                </div>
                <button type="submit" id="button-continue">Continuar</button>
            </form>

            <div class="separator">
                <span>Ou escolha</span>
            </div>

            <!-- Login com Google -->
            <div id="google-login-button" class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="outline" data-text="signin_with" data-size="large"></div>
            <script>
                window.onload = function() {
                    google.accounts.id.initialize({
                        client_id: "YOUR_GOOGLE_CLIENT_ID", // Substitua pelo seu Client ID
                        callback: handleCredentialResponse
                    });

                    google.accounts.id.renderButton(
                        document.getElementById("google-login-button"), {
                            theme: "outline",
                            size: "large"
                        }
                    );
                };

                function handleCredentialResponse(response) {
                    const data = response.credential;
                    // Agora, você pode enviar o token para o backend PHP para fazer a autenticação no seu sistema
                    console.log("Google Token: ", data);
                }
            </script>





            <!-- Login com Apple
            <button class="social-button apple" id="apple-login">
                <img src="../../public/images/icons/Logo-Apple.png" alt="Apple"> Continuar com Apple
            </button> -->

        </div>
    </div>
</body>

</html>