 // preview foto
        document.getElementById('foto_perfil').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-foto').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Contadores de caracteres
        document.getElementById('descricao').addEventListener('input', function() {
            document.getElementById('contador-desc').textContent = this.value.length;
        });

        document.getElementById('objetivos').addEventListener('input', function() {
            document.getElementById('contador-obj').textContent = this.value.length;
        });

        // Inicializar contadores
        document.getElementById('contador-desc').textContent = document.getElementById('descricao').value.length;
        document.getElementById('contador-obj').textContent = document.getElementById('objetivos').value.length;

        // Funções para adicionar/remover itens
        function removerItem(botao) {
            if (confirm('Tem certeza que deseja remover este item?')) {
                botao.parentElement.remove();
            }
        }

        function adicionarDisponibilidade() {
            const container = document.getElementById('disponibilidades');
            const div = document.createElement('div');
            div.className = 'item-existente';
            div.innerHTML = `
                <div class="form-row">
                    <div class="form-group">
                        <label>Tipo</label>
                        <select name="disponibilidade_tipo[]">
                            <option value="local">Local</option>
                            <option value="regional">Regional</option>
                            <option value="nacional">Nacional</option>
                            <option value="internacional">Internacional</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Descrição</label>
                        <input type="text" name="disponibilidade_desc[]" placeholder="Descreva sua disponibilidade">
                    </div>
                </div>
                <button type="button" class="btn btn-remove" onclick="removerItem(this)">Remover</button>
            `;
            container.appendChild(div);
        }

        function adicionarConquista() {
            const container = document.getElementById('conquistas');
            const div = document.createElement('div');
            div.className = 'item-existente';
            div.innerHTML = `
                <div class="form-group">
                    <label>Título</label>
                    <input type="text" name="conquista_titulo[]" placeholder="Ex: Campeão Regional">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Ano</label>
                        <input type="number" name="conquista_ano[]" min="1990" max="2024">
                    </div>
                    <div class="form-group">
                        <label>Clube</label>
                        <input type="text" name="conquista_clube[]" placeholder="Nome do clube">
                    </div>
                </div>
                <div class="form-group">
                    <label>Descrição</label>
                    <textarea name="conquista_desc[]" rows="2" placeholder="Descreva a conquista"></textarea>
                </div>
                <button type="button" class="btn btn-remove" onclick="removerItem(this)">Remover</button>
            `;
            container.appendChild(div);
        }

        function adicionarClube() {
            const container = document.getElementById('clubes');
            const div = document.createElement('div');
            div.className = 'item-existente';
            div.innerHTML = `
                <div class="form-group">
                    <label>Nome do Clube</label>
                    <input type="text" name="clube_nome[]" placeholder="Ex: Juventude FC">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Ano Início</label>
                        <input type="number" name="clube_inicio[]" min="1990" max="2024">
                    </div>
                    <div class="form-group">
                        <label>Ano Fim</label>
                        <input type="number" name="clube_fim[]" min="1990" max="2024" placeholder="Atual se vazio">
                    </div>
                </div>
                <div class="form-group">
                    <label>Descrição</label>
                    <textarea name="clube_desc[]" rows="2" placeholder="Sua experiência no clube"></textarea>
                </div>
                <button type="button" class="btn btn-remove" onclick="removerItem(this)">Remover</button>
            `;
            container.appendChild(div);
        }

        // Funções de ação
        function cancelarEdicao() {
            if (confirm('Tem certeza que deseja cancelar a edição? Todas as alterações serão perdidas.')) {
                window.history.back();
            }
        }

        function salvarPerfil() {
            // Validação básica
            const apelido = document.getElementById('apelido').value.trim();
            const descricao = document.getElementById('descricao').value.trim();
            
            if (!apelido) {
                alert('O apelido é obrigatório!');
                return;
            }
            
            if (!descricao) {
                alert('A descrição é obrigatória!');
                return;
            }
            
            // Simulação de envio
            const alertaSucesso = document.querySelector('.alert-success');
            alertaSucesso.style.display = 'block';
            
            // Rolar para o topo para ver a mensagem
            window.scrollTo({ top: 0, behavior: 'smooth' });
            
            // Esconder a mensagem após 3 segundos
            setTimeout(() => {
                alertaSucesso.style.display = 'none';
            }, 3000);
        }