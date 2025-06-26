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
    <link rel="stylesheet" href="../../public/css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/all.min.css">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>

<body>
    <?php include_once("message.php"); ?>
    
    <div class="page-container">
        <div class="container-login">

            <div class="banner-left">

                <div class="desktop-banner">
                    <img src="../../public/images/banners/bannerLogin.png" alt="Banner do Futlink">
                </div>
                
                <div class="mobile-banner">
                    <div class="mobile-banner-content">
                        <div class="logo-section">
                            <div class="logo-circle">
                                <i class="fas fa-futbol"></i>
                            </div>
                            <h1>FutLink</h1>
                        </div>
                        
                        <div class="banner-text">
                            <h2>Conecte-se ao futuro do futebol</h2>
                            <p>A plataforma que conecta jogadores, clubes e oportunidades no mundo do futebol.</p>
                        </div>
                        
                        <div class="features-grid">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <span>Conecte-se com jogadores</span>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <span>Encontre oportunidades</span>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <span>Acompanhe seu progresso</span>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <span>Destaque seus talentos</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="login-form">
                <div class="form-container">
                    <div class="form-header">
                        <h2>Bem-vindo de volta!</h2>
                        <p>Informe seus dados para acessar sua conta</p>
                    </div>


                    <form action="../controllers/login.act.php" method="POST">
                        <div class="input-group">
                            <div class="input-wrapper">
                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email" name="user_email" placeholder="Email" required autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="input-wrapper">
                                <i class="fas fa-lock input-icon"></i>
                                <input type="password" name="user_pass" id="password" placeholder="Senha" required>
                                <button type="button" class="password-toggle" onclick="togglePassword()">
                                    <i class="fas fa-eye" id="password-icon"></i>
                                </button>
                            </div>
                            <div class="form-options">
                                <div class="remember-me">
                                    <input type="checkbox" id="remember" name="remember">
                                    <label for="remember">Lembrar-me</label>
                                </div>
                                <a href="#" class="forgot-password">Esqueceu sua senha?</a>
                            </div>
                        </div>
                        <button type="submit" id="button-continue">
                            <span>Entrar</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>

                    <!-- <div class="separator">
                        <span>Ou continue com</span>
                    </div> -->


                    <!-- <div class="social-login">
                        <button class="social-btn google-btn">
                            <i class="fab fa-google"></i>
                            <span>Google</span>
                        </button>
                    </div> -->


                    <div class="form-footer">
                        <p>Não tem uma conta? <a href="signup.php">Cadastre-se gratuitamente</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        function togglePassword() {
            const passwordField = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }


        window.onload = function() {
            google.accounts.id.initialize({
                client_id: "YOUR_GOOGLE_CLIENT_ID",
                callback: handleCredentialResponse
            });

            google.accounts.id.renderButton(
                document.getElementById("google-login-button"), {
                    theme: "outline",
                    size: "large"
                }
            );

            const formElements = document.querySelectorAll('.input-group, #button-continue, .social-login');
            formElements.forEach((element, index) => {
                setTimeout(() => {
                    element.classList.add('animate-in');
                }, index * 100 + 300);
            });
        };

        function handleCredentialResponse(response) {
            const data = response.credential;
            console.log("Google Token: ", data);
        }
    </script>
</body>
</html>
