<?php include 'topo.php'; 

@session_start();
?>
  <title>Criar Perfil do Jogador - FutLink</title>
  <link rel="stylesheet" href="../../public/css/playerForm.css" />
<body>
  <div class="container">
    <section class="criar-perfil">
      <h2><i class="fas fa-user-plus"></i> Criar Perfil do Jogador</h2>
      <form action="../controllers/playerForm.act.php" method="POST" class="form-grid" enctype="multipart/form-data">
        
        <div class="campo-foto">
          <div class="foto-preview">
            <div class="foto-placeholder">
              <i class="fas fa-user"></i>
            </div>
            <img id="preview-img" src="#" alt="Prévia da foto" style="display: none;">
          </div>
          <div class="foto-upload">
            <label for="foto_perfil" class="btn-upload">
              <i class="fas fa-camera"></i> Escolher Foto
            </label>
            <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*" onchange="previewImage(this)">
            <p class="foto-info">Escolha uma foto de perfil para seu cadastro</p>
          </div>
        </div>

        <div class="campo-completo">
          <label for="apelido"><i class="fas fa-user-tag"></i> Apelido (Opcional):</label>
          <input type="text" id="apelido" name="apelido" placeholder="Como você é conhecido no futebol" />
        </div>

        <div class="campo-metade">
          <label for="peso"><i class="fas fa-weight"></i> Peso (kg):</label>
          <input type="number" id="peso" name="peso" step="0.1" required min="0" placeholder="Ex: 68.5"/>
        </div>

        <div class="campo-metade">
          <label for="altura"><i class="fas fa-ruler-vertical"></i> Altura (m):</label>
          <input id="altura" name="altura" oninput="this.value=this.value.replace(/\D/g,'').replace(/^(\d{1})(\d{0,2})$/,'$1,$2')" placeholder="Ex: 1,75" required>
        </div>

        <div class="campo-completo">
          <label for="estilo"><i class="fas fa-fire"></i> Estilo de Jogo:</label>
          <input type="text" id="estilo" name="estilo" placeholder="Ex: Raçudo, técnico, habilidoso..." required />
        </div>

        <div class="campo-metade">
          <label for="pe_dominante"><i class="fas fa-shoe-prints"></i> Pé Dominante:</label>
          <select id="pe_dominante" name="pe_dominante" required>
            <option value="">Selecione</option>
            <option value="Direito">Direito</option>
            <option value="Esquerdo">Esquerdo</option>
            <option value="Ambos">Ambos</option>
          </select>
        </div>

        <div class="campo-metade">
          <label for="posicao"><i class="fas fa-futbol"></i> Posição:</label>
          <select id="posicao" name="posicao" required>
            <option value="">Selecione</option>
            <option value="Goleiro">Goleiro</option>
            <option value="Lateral">Lateral</option>
            <option value="Zagueiro">Zagueiro</option>
            <option value="Volante">Volante</option>
            <option value="Meia">Meia</option>
            <option value="Atacante">Atacante</option>
            <option value="Ponta">Ponta</option>
            <option value="Centroavante">Centroavante</option>
            <option value="Segundo-Atacante">Segundo Atacante</option>
          </select>
        </div>

        <div class="campo-completo">
          <label for="sobre_mim"><i class="fas fa-comment-alt"></i> Sobre Mim:</label>
          <textarea id="sobre_mim" name="sobre_mim" rows="5" placeholder="Fale um pouco sobre você como jogador, suas habilidades e objetivos..." required></textarea>
        </div>

        <div class="botao-salvar">
          <button type="submit"><i class="fas fa-save"></i> Criar Perfil</button>
        </div>
      </form>
    </section>
  </div>
  <script>
    function previewImage(input) {
      const preview = document.getElementById('preview-img');
      const placeholder = document.querySelector('.foto-placeholder');
      
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
          placeholder.style.display = 'none';
        }
        
        reader.readAsDataURL(input.files[0]);
      } else {
        preview.style.display = 'none';
        placeholder.style.display = 'flex';
      }
    }
  </script>
</body>
</html>
