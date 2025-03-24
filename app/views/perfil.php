<?php include("topo.php"); ?>
<?php include("header.php") ?>
<?php include("navbar.php") ?>
<link rel="stylesheet" href="../../public/css/perfil.css">

<body>
    <main>



        <div class="painel-gradient">
            <a href="../../public/index.php" class="back_btn"><i class="fa-solid fa-circle-left"></i></a>
        </div>


        <section class="section-formulario">
            <div class="infos">
                <img src="../../public/images/icon_user_image.png" alt="Foto do usuário" id="imagemUsuario" onclick="abrirModal()">
                <h2>Thiago Ribeiro Costa<br>email@example.com</h2>
            </div>

            <div id="modalFoto" class="modal">
                <div class="modal-conteudo">
                    <span class="fechar" onclick="fecharModal()">&times;</span>
                    <h3>Mudar Foto de Perfil</h3>
                    <input type="file" id="inputFoto" name="inputFoto">
                    <div class="botoes">
                        <button onclick="adicionarFoto()">Adicionar Foto</button>
                        <button onclick="excluirFoto()">Excluir Foto</button>
                    </div>
                </div>
            </div>

            <div class="container-perfil">
                <div class="perfil-label">
                    <div class="form_perfil">
                        <p>Nome</p>
                        <label for="nome">
                            <input type="text" name="user_name" placeholder="Seu nome" id="">
                        </label>
                    </div>
                    <div class="form_perfil">
                        <p>Email</p>
                        <label for="email">
                            <input type="email" name="user_email" placeholder="Seu email" id="">
                        </label>
                    </div>
                    <div class="form_perfil">
                        <p>Data de nascimento</p>
                        <label for="datanasc">
                            <input type="date" name="user_data_nasc" placeholder="Sua data de nascimento" id="">
                        </label>
                    </div>
                    <div class="form_perfil">
                        <p>Telefone</p>
                        <label for="telefone">
                            <input type="text" name="user_phone" placeholder="Seu telefone" id="">
                        </label>
                    </div>
                    <div class="form_perfil">
                        <p>Gênero</p>
                        <label for="genero">
                            <select name="genero" id="genero">
                                <option value="masculino">Masculino</option>
                                <option value="feminino">Feminino</option>
                                <option value="outro">Outro</option>
                                <option value="prefiro_nao_dizer">Prefiro não dizer</option>
                            </select>
                        </label>
                    </div>
                    <div class="form_perfil">
                        <p>CEP</p>
                        <label for="cep">
                            <input type="text" name="user_cep" placeholder="Seu CEP" id="">
                        </label>
                    </div>
                    <div class="form_perfil">
                        <p>Rua</p>
                        <label for="rua">
                            <input type="text" name="user_logradouro" placeholder="Sua rua" id="">
                        </label>
                    </div>
                    <div class="form_perfil">
                        <p>Bairro</p>
                        <label for="bairro">
                            <input type="text" name="user_bairro" placeholder="Seu bairro" id="">
                        </label>
                    </div>
                    <div class="form_perfil">
                        <p>Cidade</p>
                        <label for="cidade">
                            <input type="text" name="user_cidade" placeholder="Sua cidade" id="">
                        </label>
                    </div>
                    <div class="form_perfil">
                        <p>Estado</p>
                        <label for="estado">
                            <input type="text" name="user_estado" placeholder="Seu estado" id="">
                        </label>
                    </div>
                    <div class="form_perfil">
                        <p>Status</p>
                        <label for="status">
                            <select name="status" id="status">
                                <option value="ativo">Ativo</option>
                                <option value="suspenso">Suspenso</option>
                                <option value="desativado">Desativado</option>
                            </select>
                        </label>
                    </div>
                    <div class="form_perfil">
                        <p>Biografia</p>
                        <label for="biografia">
                            <input type="text" name="user_biografia" placeholder="Sua biografia" id="">
                        </label>
                    </div>
                </div>
                <input type="submit" value="Atualizar" id="button-editar">
            </div>
            </div>
        </section>
    </main>
    <?php include("footer.php") ?>
    <script src="../../public/js/perfil.js"></script>
</body>