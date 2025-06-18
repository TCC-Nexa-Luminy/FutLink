<?php 
include 'topo.php';
@session_start();
require_once("../../config/connect.php");

$id_user = $_SESSION['id'];

$queryUser = "SELECT nome, email, telefone, foto_perfil, data_nasc, bio FROM tbl_usuarios WHERE id_user = ?";
$stmtUser = $conn->prepare($queryUser);
$stmtUser->bind_param("i", $id_user);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$user = $resultUser->fetch_assoc();


$queryPlayer = "SELECT * FROM tbl_jogador WHERE id_user = ?";
$stmtPlayer = $conn->prepare($queryPlayer);
$stmtPlayer->bind_param("i", $id_user);
$stmtPlayer->execute();
$resultPlayer = $stmtPlayer->get_result();
$player = $resultPlayer->fetch_assoc();

if (!$player) {
    header("Location: playerForm.php");
    exit();
}

$id_jogador = $player['id_jogador'];

$queryCarac = "SELECT * FROM tbl_caracteristicas_jogador WHERE id_jogador = ?";
$stmtCarac = $conn->prepare($queryCarac);
$stmtCarac->bind_param("i", $id_jogador);
$stmtCarac->execute();
$resultCarac = $stmtCarac->get_result();
$caracteristicasExistentes = [];
while ($row = $resultCarac->fetch_assoc()) {
    $caracteristicasExistentes[] = $row;
}

$queryConq = "SELECT * FROM tbl_conquistas_jogador WHERE id_jogador = ? ORDER BY ano DESC";
$stmtConq = $conn->prepare($queryConq);
$stmtConq->bind_param("i", $id_jogador);
$stmtConq->execute();
$resultConq = $stmtConq->get_result();
$conquistasExistentes = [];
while ($row = $resultConq->fetch_assoc()) {
    $conquistasExistentes[] = $row;
}


$queryHist = "SELECT * FROM tbl_historico_clubes WHERE id_jogador = ? ORDER BY data_inicio DESC";
$stmtHist = $conn->prepare($queryHist);
$stmtHist->bind_param("i", $id_jogador);
$stmtHist->execute();
$resultHist = $stmtHist->get_result();
$clubesExistentes = [];
while ($row = $resultHist->fetch_assoc()) {
    $clubesExistentes[] = $row;
}

// Lista de características disponíveis
$caracteristicasDisponiveis = [
    'Velocidade', 'Finalização', 'Drible', 'Cabeceio', 'Passe curto', 
    'Passe longo', 'Resistência', 'Posicionamento', 'Visão de jogo', 
    'Marcação', 'Cruzamento', 'Chute de longe', 'Desarme', 'Liderança',
    'Técnica', 'Força física', 'Agilidade', 'Reflexos', 'Concentração'
];
?>

<title>Editar Perfil do Jogador - FutLink</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background: #f5f5f5;
    color: #333;
    line-height: 1.6;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.header {
    background: linear-gradient(135deg, #00c853, #00a843);
    color: white;
    padding: 40px 20px;
    text-align: center;
    border-radius: 15px;
    margin-bottom: 30px;
}

.header h1 {
    font-size: 2.5rem;
    margin-bottom: 10px;
}

.card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    margin-bottom: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.card h2 {
    color: #00a843;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    border-bottom: 2px solid #00c853;
    padding-bottom: 10px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #333;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    transition: border-color 0.3s;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #00c853;
    box-shadow: 0 0 0 3px rgba(0, 200, 83, 0.1);
}

.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.caracteristicas-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 10px;
    margin-top: 10px;
}

.caracteristica-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 8px;
    transition: background-color 0.3s;
}

.caracteristica-item:hover {
    background: #e9ecef;
}

.caracteristica-item input[type="checkbox"] {
    width: auto;
}

.foto-section {
    text-align: center;
    margin-bottom: 30px;
}

.foto-preview {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 5px solid #00c853;
    margin-bottom: 15px;
    transition: transform 0.3s ease;
}

.foto-preview:hover {
    transform: scale(1.05);
}

.item-existente {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 15px;
    border-left: 4px solid #00c853;
    transition: transform 0.3s ease;
}

.item-existente:hover {
    transform: translateX(5px);
}

.btn {
    padding: 12px 30px;
    border: none;
    border-radius: 25px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s;
    margin: 5px;
}

.btn-primary {
    background: #00c853;
    color: white;
}

.btn-primary:hover {
    background: #00a843;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 200, 83, 0.3);
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-2px);
}

.btn-add {
    background: #17a2b8;
    color: white;
    font-size: 14px;
    padding: 8px 16px;
}

.btn-add:hover {
    background: #138496;
    transform: translateY(-2px);
}

.btn-remove {
    background: #dc3545;
    color: white;
    font-size: 12px;
    padding: 5px 10px;
    margin-left: 10px;
}

.btn-remove:hover {
    background: #c82333;
}

.actions {
    text-align: center;
    margin-top: 30px;
    padding-top: 30px;
    border-top: 2px solid #eee;
}

.alert {
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.contador {
    color: #6c757d;
    font-size: 0.85rem;
    margin-top: 5px;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .header h1 {
        font-size: 2rem;
    }
    
    .caracteristicas-grid {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    }
}

@media (max-width: 576px) {
    .card {
        padding: 20px;
    }
    
    .caracteristicas-grid {
        grid-template-columns: 1fr;
    }
    
    .actions {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .btn {
        width: 100%;
        margin: 5px 0;
    }
}
</style>

<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-edit"></i> Editar Perfil do Jogador</h1>
            <p>Atualize suas informações e mantenha seu perfil sempre em dia</p>
        </div>

        <?php if (isset($_SESSION['msg'])): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?= $_SESSION['msg']; unset($_SESSION['msg']); ?>
            </div>
        <?php endif; ?>

        <form action="../controllers/editarPerfilJogador.act.php" method="POST" enctype="multipart/form-data">
            

            <div class="card">
                <h2><i class="fas fa-camera"></i> Foto de Perfil</h2>
                <div class="foto-section">
                    <img src="<?= $user['foto_perfil'] ?: '../../public/images/profilePhotos/defaultPhoto.png' ?>" 
                         alt="Foto atual" class="foto-preview" id="preview-img">
                    <div class="form-group">
                        <label for="foto_perfil">Alterar Foto:</label>
                        <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*" onchange="previewImage(this)">
                    </div>
                </div>
            </div>


            <div class="card">
                <h2><i class="fas fa-user"></i> Informações Pessoais</h2>
                
                <div class="form-group">
                    <label for="nome">Nome Completo:</label>
                    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($user['nome']) ?>" 
                           placeholder="Insira seu nome completo" required>
                </div>

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

                <div class="form-group">
                    <label for="data_nasc">Data de Nascimento:</label>
                    <input type="date" id="data_nasc" name="data_nasc" 
                           value="<?= $user['data_nasc'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="bio">Sobre Mim:</label>
                    <textarea id="bio" name="bio" rows="4" 
                  placeholder="Conte um pouco sobre você..."><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
        <small>Máximo 500 caracteres</small>
                </div>
            </div>


            <div class="card">
                <h2><i class="fas fa-user"></i> Informações Básicas</h2>
                
                <div class="form-group">
                    <label for="apelido">Apelido:</label>
                    <input type="text" id="apelido" name="apelido" value="<?= htmlspecialchars($player['apelido']) ?>" 
                           placeholder="Como você é conhecido no futebol">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="peso">Peso (kg):</label>
                        <input type="number" id="peso" name="peso" step="0.1" min="0" 
                               value="<?= $player['peso'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="altura">Altura (m):</label>
                        <input type="number" id="altura" name="altura" step="0.01" min="0" max="3" 
                               value="<?= $player['altura'] ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="pe_dominante">Pé Dominante:</label>
                        <select id="pe_dominante" name="pe_dominante" required>
                            <option value="Direito" <?= $player['pe_dominante'] == 'Direito' ? 'selected' : '' ?>>Direito</option>
                            <option value="Esquerdo" <?= $player['pe_dominante'] == 'Esquerdo' ? 'selected' : '' ?>>Esquerdo</option>
                            <option value="Ambos" <?= $player['pe_dominante'] == 'Ambos' ? 'selected' : '' ?>>Ambos</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="posicao">Posição:</label>
                        <select id="posicao" name="posicao" required>
                            <option value="Goleiro" <?= $player['posicao'] == 'Goleiro' ? 'selected' : '' ?>>Goleiro</option>
                            <option value="Lateral" <?= $player['posicao'] == 'Lateral' ? 'selected' : '' ?>>Lateral</option>
                            <option value="Zagueiro" <?= $player['posicao'] == 'Zagueiro' ? 'selected' : '' ?>>Zagueiro</option>
                            <option value="Volante" <?= $player['posicao'] == 'Volante' ? 'selected' : '' ?>>Volante</option>
                            <option value="Meia" <?= $player['posicao'] == 'Meia' ? 'selected' : '' ?>>Meia</option>
                            <option value="Atacante" <?= $player['posicao'] == 'Atacante' ? 'selected' : '' ?>>Atacante</option>
                            <option value="Ponta" <?= $player['posicao'] == 'Ponta' ? 'selected' : '' ?>>Ponta</option>
                            <option value="Centroavante" <?= $player['posicao'] == 'Centroavante' ? 'selected' : '' ?>>Centroavante</option>
                            <option value="Segundo-Atacante" <?= $player['posicao'] == 'Segundo-Atacante' ? 'selected' : '' ?>>Segundo Atacante</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="estilo">Estilo de Jogo:</label>
                    <input type="text" id="estilo" name="estilo" value="<?= htmlspecialchars($player['estiloJogo']) ?>" 
                           placeholder="Ex: Raçudo, técnico, habilidoso..." required>
                </div>

                <div class="form-group">
                    <label for="descricao">Sobre Mim:</label>
                    <textarea id="descricao" name="descricao" rows="5" required 
                              placeholder="Fale um pouco sobre você como jogador..."><?= htmlspecialchars($player['descricao']) ?></textarea>
                </div>
            </div>


            <div class="card">
                <h2><i class="fas fa-list-check"></i> Características de Jogo</h2>
                <p>Selecione suas principais características:</p>
                
                <div class="caracteristicas-grid">
                    <?php 
                    $caracSelecionadas = array_column($caracteristicasExistentes, 'caracteristica');
                    foreach ($caracteristicasDisponiveis as $carac): 
                    ?>
                        <div class="caracteristica-item">
                            <input type="checkbox" id="carac_<?= str_replace(' ', '_', $carac) ?>" 
                                   name="caracteristicas[]" value="<?= $carac ?>"
                                   <?= in_array($carac, $caracSelecionadas) ? 'checked' : '' ?>>
                            <label for="carac_<?= str_replace(' ', '_', $carac) ?>"><?= $carac ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="contador">
                    <span id="contador-caracteristicas"><?= count($caracSelecionadas) ?></span> características selecionadas
                </div>
            </div>


            <div class="card">
                <h2><i class="fas fa-trophy"></i> Conquistas e Títulos</h2>
                
                <div id="conquistas-existentes">
                    <?php foreach ($conquistasExistentes as $index => $conquista): ?>
                        <div class="item-existente">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Título:</label>
                                    <input type="text" name="conquistas_existentes[<?= $conquista['id_conquista'] ?>][titulo]" 
                                           value="<?= htmlspecialchars($conquista['titulo']) ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Ano:</label>
                                    <input type="number" name="conquistas_existentes[<?= $conquista['id_conquista'] ?>][ano]" 
                                           value="<?= $conquista['ano'] ?>" min="1990" max="2030" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Clube:</label>
                                    <input type="text" name="conquistas_existentes[<?= $conquista['id_conquista'] ?>][clube]" 
                                           value="<?= htmlspecialchars($conquista['clube']) ?>">
                                </div>
                                <div class="form-group">
                                    <label>Posição:</label>
                                    <select name="conquistas_existentes[<?= $conquista['id_conquista'] ?>][posicao]">
                                        <option value="campeao" <?= $conquista['posicao'] == 'campeao' ? 'selected' : '' ?>>Campeão</option>
                                        <option value="vice" <?= $conquista['posicao'] == 'vice' ? 'selected' : '' ?>>Vice-campeão</option>
                                        <option value="terceiro" <?= $conquista['posicao'] == 'terceiro' ? 'selected' : '' ?>>3º Lugar</option>
                                        <option value="destaque" <?= $conquista['posicao'] == 'destaque' ? 'selected' : '' ?>>Destaque Individual</option>
                                        <option value="participacao" <?= $conquista['posicao'] == 'participacao' ? 'selected' : '' ?>>Participação</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Descrição:</label>
                                <textarea name="conquistas_existentes[<?= $conquista['id_conquista'] ?>][descricao]" 
                                          rows="2"><?= htmlspecialchars($conquista['descricao']) ?></textarea>
                            </div>
                            <button type="button" class="btn btn-remove" onclick="marcarParaExcluir(this, 'conquista', <?= $conquista['id_conquista'] ?>)">
                                <i class="fas fa-trash"></i> Excluir
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div id="novas-conquistas"></div>
                
                <button type="button" class="btn btn-add" onclick="adicionarConquista()">
                    <i class="fas fa-plus"></i> Adicionar Nova Conquista
                </button>
            </div>


            <div class="card">
                <h2><i class="fas fa-history"></i> Histórico de Clubes</h2>
                
                <div id="clubes-existentes">
                    <?php foreach ($clubesExistentes as $index => $clube): ?>
                        <div class="item-existente">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Nome do Clube:</label>
                                    <input type="text" name="clubes_existentes[<?= $clube['id_historico'] ?>][nome]" 
                                           value="<?= htmlspecialchars($clube['nome_clube']) ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Data Início:</label>
                                    <input type="date" name="clubes_existentes[<?= $clube['id_historico'] ?>][data_inicio]" 
                                           value="<?= $clube['data_inicio'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Data Fim:</label>
                                    <input type="date" name="clubes_existentes[<?= $clube['id_historico'] ?>][data_fim]" 
                                           value="<?= $clube['data_fim'] ?>">
                                    <small>Deixe em branco se ainda está no clube</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Posição no Clube:</label>
                                <input type="text" name="clubes_existentes[<?= $clube['id_historico'] ?>][posicao]" 
                                       value="<?= htmlspecialchars($clube['posicao']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Descrição:</label>
                                <textarea name="clubes_existentes[<?= $clube['id_historico'] ?>][descricao]" 
                                          rows="2"><?= htmlspecialchars($clube['descricao']) ?></textarea>
                            </div>
                            <button type="button" class="btn btn-remove" onclick="marcarParaExcluir(this, 'clube', <?= $clube['id_historico'] ?>)">
                                <i class="fas fa-trash"></i> Excluir
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div id="novos-clubes"></div>
                
                <button type="button" class="btn btn-add" onclick="adicionarClube()">
                    <i class="fas fa-plus"></i> Adicionar Novo Clube
                </button>
            </div>


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

            <div class="actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Salvar Alterações
                </button>
                <a href="perfilJogador.php" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </form>
    </div>

    <script>
        let novasConquistasCount = 0;
        let novosClubesCount = 0;

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

        function adicionarConquista() {
            const container = document.getElementById('novas-conquistas');
            const div = document.createElement('div');
            div.className = 'item-existente';
            div.innerHTML = `
                <div class="form-row">
                    <div class="form-group">
                        <label>Título:</label>
                        <input type="text" name="novas_conquistas[${novasConquistasCount}][titulo]" required>
                    </div>
                    <div class="form-group">
                        <label>Ano:</label>
                        <input type="number" name="novas_conquistas[${novasConquistasCount}][ano]" min="1990" max="2030" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Clube:</label>
                        <input type="text" name="novas_conquistas[${novasConquistasCount}][clube]">
                    </div>
                    <div class="form-group">
                        <label>Posição:</label>
                        <select name="novas_conquistas[${novasConquistasCount}][posicao]">
                            <option value="campeao">Campeão</option>
                            <option value="vice">Vice-campeão</option>
                            <option value="terceiro">3º Lugar</option>
                            <option value="destaque">Destaque Individual</option>
                            <option value="participacao">Participação</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Descrição:</label>
                    <textarea name="novas_conquistas[${novasConquistasCount}][descricao]" rows="2"></textarea>
                </div>
                <button type="button" class="btn btn-remove" onclick="this.parentElement.remove()">
                    <i class="fas fa-trash"></i> Remover
                </button>
            `;
            container.appendChild(div);
            novasConquistasCount++;
        }

        function adicionarClube() {
            const container = document.getElementById('novos-clubes');
            const div = document.createElement('div');
            div.className = 'item-existente';
            div.innerHTML = `
                <div class="form-row">
                    <div class="form-group">
                        <label>Nome do Clube:</label>
                        <input type="text" name="novos_clubes[${novosClubesCount}][nome]" required>
                    </div>
                    <div class="form-group">
                        <label>Data Início:</label>
                        <input type="date" name="novos_clubes[${novosClubesCount}][data_inicio]" required>
                    </div>
                    <div class="form-group">
                        <label>Data Fim:</label>
                        <input type="date" name="novos_clubes[${novosClubesCount}][data_fim]">
                        <small>Deixe em branco se ainda está no clube</small>
                    </div>
                </div>
                <div class="form-group">
                    <label>Posição no Clube:</label>
                    <input type="text" name="novos_clubes[${novosClubesCount}][posicao]">
                </div>
                <div class="form-group">
                    <label>Descrição:</label>
                    <textarea name="novos_clubes[${novosClubesCount}][descricao]" rows="2"></textarea>
                </div>
                <button type="button" class="btn btn-remove" onclick="this.parentElement.remove()">
                    <i class="fas fa-trash"></i> Remover
                </button>
            `;
            container.appendChild(div);
            novosClubesCount++;
        }

        function marcarParaExcluir(button, tipo, id) {
            const item = button.parentElement;
            item.style.opacity = '0.5';
            item.style.textDecoration = 'line-through';
            

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `excluir_${tipo}s[]`;
            input.value = id;
            item.appendChild(input);
            

            button.innerHTML = '<i class="fas fa-undo"></i> Desfazer';
            button.onclick = function() {
                item.style.opacity = '1';
                item.style.textDecoration = 'none';
                input.remove();
                button.innerHTML = '<i class="fas fa-trash"></i> Excluir';
                button.onclick = function() { marcarParaExcluir(button, tipo, id); };
            };
        }

        // Contador de características
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('input[name="caracteristicas[]"]');
            const contador = document.getElementById('contador-caracteristicas');
            
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const selecionadas = document.querySelectorAll('input[name="caracteristicas[]"]:checked').length;
                    contador.textContent = selecionadas;
                });
            });
        });

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
            

            if (novaSenha && !senhaAtual) {
                e.preventDefault();
                alert('Para alterar a senha, você deve informar sua senha atual.');
                document.getElementById('senha_atual').focus();
                return false;
            }
            

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