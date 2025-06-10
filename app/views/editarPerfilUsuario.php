<?php 
include 'topo.php';
@session_start();
require_once("../../config/connect.php");

$id_user = $_SESSION['id'];

// Buscar dados do usuário
$queryUser = "SELECT * FROM tbl_usuarios WHERE id_user = ?";
$stmtUser = $conn->prepare($queryUser);
$stmtUser->bind_param("i", $id_user);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$user = $resultUser->fetch_assoc();

if (!$user) {
    header("Location: login.php");
    exit();
}

// Calcular idade
$idade = null;
if ($user['data_nasc']) {
    $nascimento = new DateTime($user['data_nasc']);
    $hoje = new DateTime();
    $idade = $hoje->diff($nascimento)->y;
}
?>

<title>Editar Perfil - FutLink</title>
<link rel="stylesheet" href="../../public/css/editarPerfilUsuario.css">
<body>
    <div class="container">
        <a href="perfilUsuario.php" class="back-btn">
            <i class="fas fa-arrow-left"></i> Voltar ao Perfil
        </a>

        <div class="header">
            <h1><i class="fas fa-edit"></i> Editar Perfil</h1>
            <p>Atualize suas informações pessoais e mantenha seu perfil sempre em dia</p>
        </div>

        <?php if (isset($_SESSION['msg'])): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?= $_SESSION['msg']; unset($_SESSION['msg']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form action="../controllers/editarPerfilUsuario.act.php" method="POST" enctype="multipart/form-data">
            
            <!-- Foto de Perfil -->
            <div class="card">
                <h2><i class="fas fa-camera"></i> Foto de Perfil</h2>
                <div class="foto-section">
                    <img src="<?= $user['foto_perfil'] ?: '../../public/images/profilePhotos/defaultPhoto.png' ?>" 
                         alt="Foto atual" class="foto-preview" id="preview-img">
                    <div class="form-group">
                        <label for="foto_perfil">Alterar Foto:</label>
                        <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*" onchange="previewImage(this)">
                        <small>Formatos aceitos: PNG, JPG, JPEG, WEBP (máx. 5MB)</small>
                    </div>
                </div>
            </div>

            <!-- Informações Pessoais -->
            <div class="card">
                <h2><i class="fas fa-user"></i> Informações Pessoais</h2>
                
                <div class="form-group">
                    <label for="nome">Nome Completo:</label>
                    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($user['nome']) ?>" 
                           placeholder="Insira seu nome completo" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="data_nasc">Data de Nascimento:</label>
                        <input type="date" id="data_nasc" name="data_nasc" 
                               value="<?= $user['data_nasc'] ?>" required>
                        <?php if ($idade): ?>
                            <small>Idade atual: <?= $idade ?> anos</small>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="bio">Sobre Mim:</label>
                    <textarea id="bio" name="bio" rows="4" 
                              placeholder="Conte um pouco sobre você..."><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
                    <small>Máximo 500 caracteres</small>
                </div>
            </div>

            <!-- Informações de Contato -->
            <div class="card">
                <h2><i class="fas fa-envelope"></i> Informações de Contato</h2>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" 
                               placeholder="seuemail@email.com" required>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="tel" id="telefone" name="telefone" value="<?= htmlspecialchars($user['telefone']) ?>" 
                               placeholder="(xx) 12345-6789" required>
                    </div>
                </div>
            </div>

            <!-- Alterar Senha -->
            <div class="card">
                <h2><i class="fas fa-lock"></i> Alterar Senha</h2>
                <p>Deixe os campos em branco para manter a senha atual</p>
                
                <div class="form-group">
                    <label for="senha_atual">Senha Atual:</label>
                    <input type="password" id="senha_atual" name="senha_atual" 
                           placeholder="Digite sua senha atual">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="nova_senha">Nova Senha:</label>
                        <input type="password" id="nova_senha" name="nova_senha" 
                               placeholder="Digite sua nova senha">
                        <small>Mínimo 6 caracteres</small>
                    </div>
                    <div class="form-group">
                        <label for="confirmar_senha">Confirmar Nova Senha:</label>
                        <input type="password" id="confirmar_senha" name="confirmar_senha" 
                               placeholder="Confirme sua nova senha">
                    </div>
                </div>
            </div>

            <!-- Botões de Ação -->
            <div class="actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Salvar Alterações
                </button>
                <a href="perfilUsuario.php" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </form>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview-img');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Validação de senha
        document.getElementById('confirmar_senha').addEventListener('input', function() {
            const novaSenha = document.getElementById('nova_senha').value;
            const confirmarSenha = this.value;
            
            if (novaSenha !== confirmarSenha && confirmarSenha !== '') {
                this.setCustomValidity('As senhas não coincidem');
            } else {
                this.setCustomValidity('');
            }
        });

        // Máscara para telefone
        document.getElementById('telefone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/(\d{2})(\d)/, '($1) $2');
            value = value.replace(/(\d{5})(\d)/, '$1-$2');
            e.target.value = value;
        });

        // Contador de caracteres para bio
        const bioTextarea = document.getElementById('bio');
        const maxLength = 500;
        
        bioTextarea.addEventListener('input', function() {
            const remaining = maxLength - this.value.length;
            const small = this.nextElementSibling;
            
            if (remaining < 0) {
                small.textContent = `Excedeu ${Math.abs(remaining)} caracteres do limite`;
                small.style.color = '#dc3545';
            } else {
                small.textContent = `${remaining} caracteres restantes`;
                small.style.color = '#6c757d';
            }
        });

        // Validação do formulário
        document.querySelector('form').addEventListener('submit', function(e) {
            const novaSenha = document.getElementById('nova_senha').value;
            const senhaAtual = document.getElementById('senha_atual').value;
            
            // Se está tentando alterar senha, deve informar a atual
            if (novaSenha && !senhaAtual) {
                e.preventDefault();
                alert('Para alterar a senha, você deve informar sua senha atual.');
                document.getElementById('senha_atual').focus();
                return false;
            }
            
            // Validar tamanho da nova senha
            if (novaSenha && novaSenha.length < 6) {
                e.preventDefault();
                alert('A nova senha deve ter pelo menos 6 caracteres.');
                document.getElementById('nova_senha').focus();
                return false;
            }
        });
    </script>
</body>
</html>