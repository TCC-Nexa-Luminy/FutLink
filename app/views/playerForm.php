<?php include 'topo.php'; 

@session_start();
?>
  <title>Criar Perfil do Jogador - FutLink</title>
  <link rel="stylesheet" href="../../public/css/playerForm.css" />
  <style>
    .caracteristicas-container {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 10px;
    }
    
    .caracteristica-tag {
      background: #e3f2fd;
      color: #1976d2;
      padding: 5px 12px;
      border-radius: 20px;
      font-size: 14px;
      display: flex;
      align-items: center;
      gap: 5px;
    }
    
    .caracteristica-tag .remove-btn {
      background: none;
      border: none;
      color: #1976d2;
      cursor: pointer;
      font-weight: bold;
    }
    
    .conquista-item, .clube-item {
      border: 1px solid #ddd;
      padding: 15px;
      margin-bottom: 15px;
      border-radius: 8px;
      background: #f9f9f9;
    }
    
    .remove-item-btn {
      background: #ff4444;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 4px;
      cursor: pointer;
      float: right;
    }
    
    .add-item-btn {
      background: #4CAF50;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
    }
    
    .section-divider {
      border-top: 2px solid #e0e0e0;
      margin: 30px 0;
      padding-top: 20px;
    }
  </style>
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


        <div class="section-divider">
          <h3><i class="fas fa-list-check"></i> Características de Jogo</h3>
        </div>

        <div class="campo-completo">
          <label for="nova_caracteristica"><i class="fas fa-plus"></i> Adicionar Característica:</label>
          <div style="display: flex; gap: 10px;">
            <input type="text" id="nova_caracteristica" placeholder="Ex: Velocidade, Finalização, Drible..." />
            <select id="nivel_caracteristica">
              <option value="iniciante">Iniciante</option>
              <option value="intermediario" selected>Intermediário</option>
              <option value="avancado">Avançado</option>
              <option value="expert">Expert</option>
            </select>
            <button type="button" onclick="adicionarCaracteristica()" class="add-item-btn">Adicionar</button>
          </div>
          <div id="caracteristicas-container" class="caracteristicas-container"></div>
          <input type="hidden" id="caracteristicas_json" name="caracteristicas" />
        </div>


        <div class="section-divider">
          <h3><i class="fas fa-trophy"></i> Conquistas e Títulos</h3>
        </div>

        <div class="campo-completo">
          <div id="conquistas-container">
            <div class="conquista-item">
              <button type="button" class="remove-item-btn" onclick="removerConquista(this)">Remover</button>
              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 10px;">
                <div>
                  <label>Título:</label>
                  <input type="text" name="conquistas[0][titulo]" placeholder="Ex: Campeão Regional Sub-17" />
                </div>
                <div>
                  <label>Ano:</label>
                  <input type="number" name="conquistas[0][ano]" min="1990" max="2030" placeholder="2023" />
                </div>
              </div>
              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 10px;">
                <div>
                  <label>Clube:</label>
                  <input type="text" name="conquistas[0][clube]" placeholder="Nome do clube" />
                </div>
                <div>
                  <label>Posição:</label>
                  <select name="conquistas[0][posicao]">
                    <option value="campeao">Campeão</option>
                    <option value="vice">Vice-campeão</option>
                    <option value="terceiro">3º Lugar</option>
                    <option value="destaque">Destaque Individual</option>
                    <option value="participacao">Participação</option>
                  </select>
                </div>
              </div>
              <div>
                <label>Descrição:</label>
                <textarea name="conquistas[0][descricao]" rows="2" placeholder="Descreva sua conquista..."></textarea>
              </div>
            </div>
          </div>
          <button type="button" onclick="adicionarConquista()" class="add-item-btn">
            <i class="fas fa-plus"></i> Adicionar Conquista
          </button>
        </div>


        <div class="section-divider">
          <h3><i class="fas fa-history"></i> Histórico de Clubes</h3>
        </div>

        <div class="campo-completo">
          <div id="clubes-container">
            <div class="clube-item">
              <button type="button" class="remove-item-btn" onclick="removerClube(this)">Remover</button>
              <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; margin-bottom: 10px;">
                <div>
                  <label>Nome do Clube:</label>
                  <input type="text" name="clubes[0][nome]" placeholder="Ex: Juventude FC" />
                </div>
                <div>
                  <label>Data Início:</label>
                  <input type="date" name="clubes[0][data_inicio]" />
                </div>
                <div>
                  <label>Data Fim:</label>
                  <input type="date" name="clubes[0][data_fim]" />
                  <small>Deixe em branco se ainda está no clube</small>
                </div>
              </div>
              <div style="margin-bottom: 10px;">
                <label>Posição no Clube:</label>
                <input type="text" name="clubes[0][posicao]" placeholder="Ex: Atacante titular" />
              </div>
              <div>
                <label>Descrição:</label>
                <textarea name="clubes[0][descricao]" rows="2" placeholder="Descreva sua experiência no clube..."></textarea>
              </div>
            </div>
          </div>
          <button type="button" onclick="adicionarClube()" class="add-item-btn">
            <i class="fas fa-plus"></i> Adicionar Clube
          </button>
        </div>

        <div class="botao-salvar">
          <button type="submit"><i class="fas fa-save"></i> Criar Perfil</button>
        </div>
      </form>
    </section>
  </div>

  <script>
    let caracteristicas = [];
    let conquistasCount = 1;
    let clubesCount = 1;

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

    function adicionarCaracteristica() {
      const input = document.getElementById('nova_caracteristica');
      const nivel = document.getElementById('nivel_caracteristica');
      const container = document.getElementById('caracteristicas-container');
      
      if (input.value.trim() === '') return;
      
      const caracteristica = {
        nome: input.value.trim(),
        nivel: nivel.value
      };
      
      caracteristicas.push(caracteristica);
      
      const tag = document.createElement('div');
      tag.className = 'caracteristica-tag';
      tag.innerHTML = `
        ${caracteristica.nome} (${caracteristica.nivel})
        <button type="button" class="remove-btn" onclick="removerCaracteristica(${caracteristicas.length - 1})">×</button>
      `;
      
      container.appendChild(tag);
      
      document.getElementById('caracteristicas_json').value = JSON.stringify(caracteristicas);
      
      input.value = '';
      nivel.value = 'intermediario';
    }

    function removerCaracteristica(index) {
      caracteristicas.splice(index, 1);
      atualizarCaracteristicas();
    }

    function atualizarCaracteristicas() {
      const container = document.getElementById('caracteristicas-container');
      container.innerHTML = '';
      
      caracteristicas.forEach((carac, index) => {
        const tag = document.createElement('div');
        tag.className = 'caracteristica-tag';
        tag.innerHTML = `
          ${carac.nome} (${carac.nivel})
          <button type="button" class="remove-btn" onclick="removerCaracteristica(${index})">×</button>
        `;
        container.appendChild(tag);
      });
      
      document.getElementById('caracteristicas_json').value = JSON.stringify(caracteristicas);
    }

    function adicionarConquista() {
      const container = document.getElementById('conquistas-container');
      const novaConquista = document.createElement('div');
      novaConquista.className = 'conquista-item';
      novaConquista.innerHTML = `
        <button type="button" class="remove-item-btn" onclick="removerConquista(this)">Remover</button>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 10px;">
          <div>
            <label>Título:</label>
            <input type="text" name="conquistas[${conquistasCount}][titulo]" placeholder="Ex: Campeão Regional Sub-17" />
          </div>
          <div>
            <label>Ano:</label>
            <input type="number" name="conquistas[${conquistasCount}][ano]" min="1990" max="2030" placeholder="2023" />
          </div>
        </div>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 10px;">
          <div>
            <label>Clube:</label>
            <input type="text" name="conquistas[${conquistasCount}][clube]" placeholder="Nome do clube" />
          </div>
          <div>
            <label>Posição:</label>
            <select name="conquistas[${conquistasCount}][posicao]">
              <option value="campeao">Campeão</option>
              <option value="vice">Vice-campeão</option>
              <option value="terceiro">3º Lugar</option>
              <option value="destaque">Destaque Individual</option>
              <option value="participacao">Participação</option>
            </select>
          </div>
        </div>
        <div>
          <label>Descrição:</label>
          <textarea name="conquistas[${conquistasCount}][descricao]" rows="2" placeholder="Descreva sua conquista..."></textarea>
        </div>
      `;
      container.appendChild(novaConquista);
      conquistasCount++;
    }

    function removerConquista(button) {
      button.parentElement.remove();
    }

    function adicionarClube() {
      const container = document.getElementById('clubes-container');
      const novoClube = document.createElement('div');
      novoClube.className = 'clube-item';
      novoClube.innerHTML = `
        <button type="button" class="remove-item-btn" onclick="removerClube(this)">Remover</button>
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; margin-bottom: 10px;">
          <div>
            <label>Nome do Clube:</label>
            <input type="text" name="clubes[${clubesCount}][nome]" placeholder="Ex: Juventude FC" />
          </div>
          <div>
            <label>Data Início:</label>
            <input type="date" name="clubes[${clubesCount}][data_inicio]" />
          </div>
          <div>
            <label>Data Fim:</label>
            <input type="date" name="clubes[${clubesCount}][data_fim]" />
            <small>Deixe em branco se ainda está no clube</small>
          </div>
        </div>
        <div style="margin-bottom: 10px;">
          <label>Posição no Clube:</label>
          <input type="text" name="clubes[${clubesCount}][posicao]" placeholder="Ex: Atacante titular" />
        </div>
        <div>
          <label>Descrição:</label>
          <textarea name="clubes[${clubesCount}][descricao]" rows="2" placeholder="Descreva sua experiência no clube..."></textarea>
        </div>
      `;
      container.appendChild(novoClube);
      clubesCount++;
    }

    function removerClube(button) {
      button.parentElement.remove();
    }
  </script>
</body>
</html>
