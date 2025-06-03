<?php
include("topo.php");
?>

<link rel="stylesheet" href="../../public/css/editarPerfilJogador.css">

<body>

<?php include 'navbar-social.php'; ?>

    <div class="container">
        <div class="header">
            <h1><i class="fas fa-edit"></i> Editar Meu Perfil</h1>
            <p>Atualize suas informações para atrair mais oportunidades</p>
        </div>

        <!-- mensagem de sucesso se quiser -->
        <div class="alert alert-success" style="display: none;">
            <i class="fas fa-check-circle"></i> Perfil atualizado com sucesso!
        </div>

        <form id="form-editar-perfil">
            
            <!-- FOTO DE PERFIL -->
            <div class="card">
                <h2><i class="fas fa-camera"></i> Foto de Perfil</h2>
                <div class="foto-section">
                    <img src="https://via.placeholder.com/150/00c853/ffffff?text=RS" alt="Foto Atual" class="foto-preview" id="preview-foto">
                    <br>
                    <input type="file" id="foto_perfil" accept="image/*">
                    <small>Formatos: JPG, PNG, GIF. Máximo: 5MB</small>
                </div>
            </div>

            <!-- INFORMAÇOES BASICAS -->
            <div class="card">
                <h2><i class="fas fa-user"></i> Informações Básicas</h2>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="apelido">Apelido *</label>
                        <input type="text" id="apelido" name="apelido" value="Juninho" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status Atual *</label>
                        <select id="status" name="status" required>
                            <option value="Disponível" selected>Disponível</option>
                            <option value="Buscando clube">Buscando clube</option>
                            <option value="Lesionado">Lesionado</option>
                            <option value="Em teste">Em teste</option>
                            <option value="Contratado">Contratado</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="peso">Peso (kg) *</label>
                        <input type="number" id="peso" name="peso" value="68.5" step="0.1" required>
                    </div>
                    <div class="form-group">
                        <label for="altura">Altura (m) *</label>
                        <input type="number" id="altura" name="altura" value="1.78" step="0.01" required>
                    </div>
                </div>
            </div>

            <!-- CONTATO -->
            <div class="card">
                <h2><i class="fas fa-address-book"></i> Contato e Redes Sociais</h2>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" value="robson.silva@email.com">
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="tel" id="telefone" name="telefone" value="(11) 99999-9999">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <input type="text" id="cidade" name="cidade" value="São Paulo">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <input type="text" id="estado" name="estado" value="SP">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="instagram"><i class="fab fa-instagram"></i> Instagram</label>
                        <input type="url" id="instagram" name="instagram" value="https://instagram.com/juninho_silva">
                    </div>
                    <div class="form-group">
                        <label for="youtube"><i class="fab fa-youtube"></i> YouTube</label>
                        <input type="url" id="youtube" name="youtube" value="https://youtube.com/juninho_futebol">
                    </div>
                </div>
                <div class="form-group">
                    <label for="twitter"><i class="fab fa-twitter"></i> Twitter</label>
                    <input type="url" id="twitter" name="twitter" value="https://twitter.com/juninho_silva">
                </div>
            </div>

            <!-- SOBRE MIM -->
            <div class="card">
                <h2><i class="fas fa-align-left"></i> Sobre Mim</h2>
                <div class="form-group">
                    <label for="descricao">Descrição Pessoal *</label>
                    <textarea id="descricao" name="descricao" rows="4" maxlength="500" required>Sou um jogador dedicado e apaixonado por futebol, sempre em busca de novos desafios e oportunidades para crescer e melhorar. Tenho uma forte ética de trabalho, e minha mentalidade de equipe sempre se destaca dentro e fora de campo.</textarea>
                    <div class="contador"><span id="contador-desc">178</span>/500 caracteres</div>
                </div>
            </div>

            <!-- CARACTERISTICAS -->
            <div class="card">
                <h2><i class="fas fa-list-check"></i> Características de Jogo</h2>
                <div class="caracteristicas-grid">
                    <div class="caracteristica-item">
                        <input type="checkbox" name="caracteristicas[]" value="Velocidade" id="velocidade" checked>
                        <label for="velocidade">Velocidade</label>
                    </div>
                    <div class="caracteristica-item">
                        <input type="checkbox" name="caracteristicas[]" value="Finalização" id="finalizacao" checked>
                        <label for="finalizacao">Finalização</label>
                    </div>
                    <div class="caracteristica-item">
                        <input type="checkbox" name="caracteristicas[]" value="Drible" id="drible" checked>
                        <label for="drible">Drible</label>
                    </div>
                    <div class="caracteristica-item">
                        <input type="checkbox" name="caracteristicas[]" value="Cabeceio" id="cabeceio" checked>
                        <label for="cabeceio">Cabeceio</label>
                    </div>
                    <div class="caracteristica-item">
                        <input type="checkbox" name="caracteristicas[]" value="Passe curto" id="passe_curto" checked>
                        <label for="passe_curto">Passe curto</label>
                    </div>
                    <div class="caracteristica-item">
                        <input type="checkbox" name="caracteristicas[]" value="Passe longo" id="passe_longo">
                        <label for="passe_longo">Passe longo</label>
                    </div>
                    <div class="caracteristica-item">
                        <input type="checkbox" name="caracteristicas[]" value="Resistência" id="resistencia" checked>
                        <label for="resistencia">Resistência</label>
                    </div>
                    <div class="caracteristica-item">
                        <input type="checkbox" name="caracteristicas[]" value="Posicionamento" id="posicionamento" checked>
                        <label for="posicionamento">Posicionamento</label>
                    </div>
                    <div class="caracteristica-item">
                        <input type="checkbox" name="caracteristicas[]" value="Visão de jogo" id="visao_jogo">
                        <label for="visao_jogo">Visão de jogo</label>
                    </div>
                    <div class="caracteristica-item">
                        <input type="checkbox" name="caracteristicas[]" value="Marcação" id="marcacao">
                        <label for="marcacao">Marcação</label>
                    </div>
                    <div class="caracteristica-item">
                        <input type="checkbox" name="caracteristicas[]" value="Cruzamento" id="cruzamento">
                        <label for="cruzamento">Cruzamento</label>
                    </div>
                    <div class="caracteristica-item">
                        <input type="checkbox" name="caracteristicas[]" value="Força física" id="forca_fisica">
                        <label for="forca_fisica">Força física</label>
                    </div>
                </div>
            </div>

            <!-- DISPONIBILIDADES -->
            <div class="card">
                <h2><i class="fas fa-calendar-check"></i> Disponibilidade para Testes</h2>
                <div id="disponibilidades">
                    <div class="item-existente">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Tipo</label>
                                <select name="disponibilidade_tipo[]">
                                    <option value="local">Local</option>
                                    <option value="regional" selected>Regional</option>
                                    <option value="nacional">Nacional</option>
                                    <option value="internacional">Internacional</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Descrição</label>
                                <input type="text" name="disponibilidade_desc[]" value="Disponível para testes em São Paulo e região">
                            </div>
                        </div>
                        <button type="button" class="btn btn-remove" onclick="removerItem(this)">Remover</button>
                    </div>
                    <div class="item-existente">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Tipo</label>
                                <select name="disponibilidade_tipo[]">
                                    <option value="local">Local</option>
                                    <option value="regional">Regional</option>
                                    <option value="nacional" selected>Nacional</option>
                                    <option value="internacional">Internacional</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Descrição</label>
                                <input type="text" name="disponibilidade_desc[]" value="Disponível para viagens nacionais">
                            </div>
                        </div>
                        <button type="button" class="btn btn-remove" onclick="removerItem(this)">Remover</button>
                    </div>
                </div>
                <button type="button" class="btn btn-add" onclick="adicionarDisponibilidade()">
                    <i class="fas fa-plus"></i> Adicionar
                </button>
            </div>

            <!-- CONQUISTAS -->
            <div class="card">
                <h2><i class="fas fa-medal"></i> Conquistas e Títulos</h2>
                <div id="conquistas">
                    <div class="item-existente">
                        <div class="form-group">
                            <label>Título</label>
                            <input type="text" name="conquista_titulo[]" value="Campeão Regional Sub-17">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Ano</label>
                                <input type="number" name="conquista_ano[]" value="2023">
                            </div>
                            <div class="form-group">
                                <label>Clube</label>
                                <input type="text" name="conquista_clube[]" value="Juventude FC">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <textarea name="conquista_desc[]" rows="2">Artilheiro da competição com 8 gols em 10 jogos.</textarea>
                        </div>
                        <button type="button" class="btn btn-remove" onclick="removerItem(this)">Remover</button>
                    </div>
                    <div class="item-existente">
                        <div class="form-group">
                            <label>Título</label>
                            <input type="text" name="conquista_titulo[]" value="Vice-Campeão Estadual Sub-15">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Ano</label>
                                <input type="number" name="conquista_ano[]" value="2021">
                            </div>
                            <div class="form-group">
                                <label>Clube</label>
                                <input type="text" name="conquista_clube[]" value="Escolinha Craques do Futuro">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <textarea name="conquista_desc[]" rows="2">Eleito revelação da competição.</textarea>
                        </div>
                        <button type="button" class="btn btn-remove" onclick="removerItem(this)">Remover</button>
                    </div>
                </div>
                <button type="button" class="btn btn-add" onclick="adicionarConquista()">
                    <i class="fas fa-plus"></i> Adicionar
                </button>
            </div>

            <!-- HISTORICO DE CLUBES -->
            <div class="card">
                <h2><i class="fas fa-history"></i> Histórico de Clubes</h2>
                <div id="clubes">
                    <div class="item-existente">
                        <div class="form-group">
                            <label>Nome do Clube</label>
                            <input type="text" name="clube_nome[]" value="Juventude FC">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Ano Início</label>
                                <input type="number" name="clube_inicio[]" value="2023">
                            </div>
                            <div class="form-group">
                                <label>Ano Fim</label>
                                <input type="number" name="clube_fim[]" value="" placeholder="Atual se vazio">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <textarea name="clube_desc[]" rows="2">Atacante titular no time sub-17, participando do campeonato estadual.</textarea>
                        </div>
                        <button type="button" class="btn btn-remove" onclick="removerItem(this)">Remover</button>
                    </div>
                    <div class="item-existente">
                        <div class="form-group">
                            <label>Nome do Clube</label>
                            <input type="text" name="clube_nome[]" value="Escolinha Craques do Futuro">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Ano Início</label>
                                <input type="number" name="clube_inicio[]" value="2020">
                            </div>
                            <div class="form-group">
                                <label>Ano Fim</label>
                                <input type="number" name="clube_fim[]" value="2022">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <textarea name="clube_desc[]" rows="2">Formação nas categorias de base, com destaque no campeonato regional.</textarea>
                        </div>
                        <button type="button" class="btn btn-remove" onclick="removerItem(this)">Remover</button>
                    </div>
                </div>
                <button type="button" class="btn btn-add" onclick="adicionarClube()">
                    <i class="fas fa-plus"></i> Adicionar
                </button>
            </div>

            <div class="card">
                <h2><i class="fas fa-bullseye"></i> Objetivos</h2>
                <div class="form-group">
                    <label for="objetivos">Seus Objetivos no Futebol</label>
                    <textarea id="objetivos" name="objetivos" rows="4" maxlength="300">Busco uma oportunidade em um clube profissional onde possa desenvolver meu potencial e contribuir para o sucesso da equipe.</textarea>
                    <div class="contador"><span id="contador-obj">115</span>/300 caracteres</div>
                </div>
            </div>

            <div class="actions">
                <button type="button" class="btn btn-secondary" onclick="cancelarEdicao()">
                    <i class="fas fa-times"></i> Cancelar
                </button>
                <button type="button" class="btn btn-primary" onclick="salvarPerfil()">
                    <i class="fas fa-save"></i> Salvar Alterações
                </button>
            </div>
        </form>
    </div>

      <?php include("footer.php"); ?>

    <script src="../../public/js/editarPerfilJogador.js"></script>
</body>
</html>