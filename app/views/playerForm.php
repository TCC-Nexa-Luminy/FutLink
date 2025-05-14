<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Criar Perfil do Jogador</title>
  <link rel="stylesheet" href="../../public/css/playerForm.css" />
  
</head>
<body>

  <section class="criar-perfil">
    <h2>Criar Perfil do Jogador</h2>
    <form action="salvar_jogador.php" method="POST" class="form-grid" enctype="multipart/form-data">

      <div class="campo-completo">
        <label>Apelido (Opcional):</label>
        <input type="text" name="apelido" />
      </div>

      <div class="campo-metade">
        <label>Peso (kg):</label>
        <input type="number" name="peso" step="0.1" required min="0"/>
      </div>

      <div class="campo-metade">
        <label>Altura (m):</label>
         <input name="altura" oninput="this.value=this.value.replace(/\D/g,'').replace(/^(\d{1})(\d{0,2})$/,'$1,$2')"  placeholder="Ex: 1,75">
      </div>

      <div class="campo-metade">
        <label>Status:</label>
        <input type="text" name="status" placeholder="Ex: Em busca de clube" required />
      </div>

      <div class="campo-completo">
        <label>Estilo de Jogo:</label>
        <input type="text" name="estilo" placeholder="Ex: Raçudo, técnico, habilidoso..." required />
      </div>

      <div class="campo-metade">
        <label>Pé Dominante:</label>
        <select name="pe_dominante" required>
          <option value="">Selecione</option>
          <option value="Direito">Direito</option>
          <option value="Esquerdo">Esquerdo</option>
          <option value="Ambos">Ambos</option>
        </select>
      </div>

      <div class="campo-metade">
        <label>Estado (UF):</label>
        <select name="estado" required>
          <option value="">Selecione</option>
          <option value="AC">Acre</option>
          <option value="AL">Alagoas</option>
          <option value="AP">Amapá</option>
          <option value="AM">Amazonas</option>
          <option value="BA">Bahia</option>
          <option value="CE">Ceará</option>
          <option value="DF">Distrito Federal</option>
          <option value="ES">Espírito Santo</option>
          <option value="GO">Goiás</option>
          <option value="MA">Maranhão</option>
          <option value="MT">Mato Grosso</option>
          <option value="MS">Mato Grosso do Sul</option>
          <option value="MG">Minas Gerais</option>
          <option value="PA">Pará</option>
          <option value="PB">Paraíba</option>
          <option value="PR">Paraná</option>
          <option value="PE">Pernambuco</option>
          <option value="PI">Piauí</option>
          <option value="RJ">Rio de Janeiro</option>
          <option value="RN">Rio Grande do Norte</option>
          <option value="RS">Rio Grande do Sul</option>
          <option value="RO">Rondônia</option>
          <option value="RR">Roraima</option>
          <option value="SC">Santa Catarina</option>
          <option value="SP">São Paulo</option>
          <option value="SE">Sergipe</option>
          <option value="TO">Tocantins</option>
        </select>
      </div>

      <div class="campo-completo">
        <label>Posição:</label>
        <select name="posicao" required>
          <option value="">Selecione</option>
          <option value="Goleiro">Goleiro</option>
          <option value="Lateral">Lateral</option>
          <option value="Zagueiro">Zagueiro</option>
          <option value="Volante">Volante</option>
          <option value="Meia">Meia</option>
          <option value="Atacante">Atacante</option>
          <option value="Ponta">Ponta</option>
          <option value="Centroavante">Centroavante</option>
        </select>
      </div>

      <div class="campo-completo">
        <label>Sobre Mim:</label>
        <textarea name="sobre_mim" rows="5" placeholder="Fale um pouco sobre você como jogador..." required></textarea>
      </div>

      <div class="campo-completo">
        <label>Clube Atual (se tiver):</label>
        <select name="clube_atual">
          <option value="">Nenhum</option>
        </select>
      </div>

      <div class="botao-salvar">
        <button type="submit">Criar Perfil</button>
      </div>

    </form>
  </section>

</body>
</html>