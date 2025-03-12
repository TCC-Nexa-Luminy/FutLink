<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futlink - Login</title>
    <link rel="stylesheet" href="../../public/css/login.css">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>

<body>
    <div class="container-login">
        <div class="banner-left">
            <div class="banner">
                <img src="../../public/images/bannerLogin.png" alt="Banner do Futlink">
            </div>
        </div>
        <div class="login-form">
            <h2>Informe seu e-mail para acessar <br> ou se cadastrar no Futlink.</h2>
            <form>
                <input type="email" placeholder="Email" required>
                <button type="submit" id="button-continue">Continuar</button>
            </form>
            <div class="separator">
                <span>Ou escolha</span>
            </div>


            <div class="g_id_signin"
                data-type="standard"
                data-size="large"
                data-theme="outline">
            </div>


            <button class="social-button google">
                <img src="../../public/images/icons/Logo-Google-G.png" alt="Google" id="button-ads"> Continuar com Google
            </button>
            <button class="social-button apple" id="button-ads">
                <img src="../../public/images/icons/Logo-Apple.png" alt="Apple"> Continuar com Apple
            </button>
        </div>

        
    </div>
</body>

</html>