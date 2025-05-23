<?php include 'topo.php'; ?>
<title>Perfil da Organização - FutLink</title>
<link rel="stylesheet" href="../../public/css/organizacao.css">

<body>

<?php include 'navbar-social.php'; ?>

    <main>
        <section class="banner">
            <div class="banner-overlay"></div>
            <div class="banner-container">
                <div class="logo-org">
                    <img src="../../public/images/bambu.png" alt="Logo da Organização">
                    <div class="status-badge">Verificado</div>
                </div>
                <div class="banner-info">
                    <div class="nome-social">
                        <h1>Nome da Organização</h1>
                        <div class="social-icons">
                            <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" title="YouTube"><i class="fab fa-youtube"></i></a>
                            <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                    <p class="bio">Clube de futebol com foco em desenvolvimento de jovens talentos. Tradição e inovação desde 1985.</p>
                    <div class="contato-info">
                        <div class="contato-item">
                            <i class="fas fa-envelope"></i>
                            <span>contato@organizacao.com</span>
                        </div>
                        <div class="contato-item">
                            <i class="fas fa-phone"></i>
                            <span>(11) 99999-9999</span>
                        </div>
                        <div class="contato-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>São Paulo, SP</span>
                        </div>
                    </div>
                    <div class="acoes">
                        <button class="btn-principal"><i class="fas fa-paper-plane"></i> Enviar Mensagem</button>
                        <button class="btn-secundario"><i class="fas fa-user-plus"></i> Seguir</button>
                    </div>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="grid-principal">
                <div class="coluna-esquerda">
                    <section class="card sobre">
                        <h2><i class="fas fa-building"></i> Sobre a Organização</h2>
                        <div class="texto-sobre">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor.</p>
                            <p>Proin quis tortor orci. Etiam at risus et justo dignissim congue. Donec congue lacinia dui, a porttitor lectus condimentum laoreet.</p>
                        </div>
                    </section>

                    <section class="card info-org">
                        <h2><i class="fas fa-info-circle"></i> Informações</h2>
                        <div class="info-grid">
                            <div class="info-item">
                                <i class="fas fa-calendar-alt"></i>
                                <div class="info-content">
                                    <span class="info-label">Fundação</span>
                                    <span class="info-valor">1985</span>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-users"></i>
                                <div class="info-content">
                                    <span class="info-label">Categorias</span>
                                    <span class="info-valor">Sub-15, Sub-17, Sub-20, Profissional</span>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-trophy"></i>
                                <div class="info-content">
                                    <span class="info-label">Títulos</span>
                                    <span class="info-valor">12 títulos regionais, 3 estaduais</span>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-map-marked-alt"></i>
                                <div class="info-content">
                                    <span class="info-label">Localização</span>
                                    <span class="info-valor">São Paulo, SP</span>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-futbol"></i>
                                <div class="info-content">
                                    <span class="info-label">Estilo de jogo</span>
                                    <span class="info-valor">Ofensivo, posse de bola</span>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-graduation-cap"></i>
                                <div class="info-content">
                                    <span class="info-label">Formação</span>
                                    <span class="info-valor">Mais de 50 atletas profissionais</span>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="card galeria">
                        <h2><i class="fas fa-images"></i> Galeria de Fotos</h2>
                        <div class="galeria-grid">
                            <div class="galeria-item destaque">
                                <img src="https://via.placeholder.com/600x400" alt="Estádio principal">
                                <div class="galeria-overlay">
                                    <span>Estádio principal - Vista aérea</span>
                                </div>
                            </div>
                            <div class="galeria-item">
                                <img src="https://via.placeholder.com/300x200" alt="Treino da equipe">
                                <div class="galeria-overlay">
                                    <span>Treino tático</span>
                                </div>
                            </div>
                            <div class="galeria-item">
                                <img src="https://via.placeholder.com/300x200" alt="Comemoração">
                                <div class="galeria-overlay">
                                    <span>Comemoração de título</span>
                                </div>
                            </div>
                            <div class="galeria-item">
                                <img src="https://via.placeholder.com/300x200" alt="Centro de treinamento">
                                <div class="galeria-overlay">
                                    <span>Centro de treinamento</span>
                                </div>
                            </div>
                            <div class="galeria-item">
                                <img src="https://via.placeholder.com/300x200" alt="Equipe técnica">
                                <div class="galeria-overlay">
                                    <span>Equipe técnica</span>
                                </div>
                            </div>
                        </div>
                        <button class="btn-mais">Ver mais fotos</button>
                    </section>
                </div>

                <div class="coluna-direita">
                    <section class="card peneiras">
                        <h2><i class="fas fa-search"></i> Próximas Peneiras</h2>
                        <div class="lista-peneiras">
                            <div class="peneira-item">
                                <div class="peneira-header">
                                    <h3>Peneira Sub-17</h3>
                                    <span class="peneira-badge">Vagas limitadas</span>
                                </div>
                                <div class="peneira-info">
                                    <div class="info-row">
                                        <i class="fas fa-calendar"></i>
                                        <span>15 de Junho, 2025</span>
                                    </div>
                                    <div class="info-row">
                                        <i class="fas fa-clock"></i>
                                        <span>09:00 - 12:00</span>
                                    </div>
                                    <div class="info-row">
                                        <i class="fas fa-map-pin"></i>
                                        <span>Estádio Municipal, São Paulo</span>
                                    </div>
                                    <div class="info-row">
                                        <i class="fas fa-money-bill-wave"></i>
                                        <span>Taxa: R$ 50,00</span>
                                    </div>
                                </div>
                                <button class="btn-peneira">Ver mais</button>
                            </div>

                            <div class="peneira-item">
                                <div class="peneira-header">
                                    <h3>Peneira Sub-20</h3>
                                    <span class="peneira-badge">Destaque</span>
                                </div>
                                <div class="peneira-info">
                                    <div class="info-row">
                                        <i class="fas fa-calendar"></i>
                                        <span>22 de Junho, 2025</span>
                                    </div>
                                    <div class="info-row">
                                        <i class="fas fa-clock"></i>
                                        <span>14:00 - 17:00</span>
                                    </div>
                                    <div class="info-row">
                                        <i class="fas fa-map-pin"></i>
                                        <span>Centro de Treinamento, São Paulo</span>
                                    </div>
                                    <div class="info-row">
                                        <i class="fas fa-money-bill-wave"></i>
                                        <span>Taxa: R$ 70,00</span>
                                    </div>
                                </div>
                                <button class="btn-peneira">Ver mais</button>
                            </div>

                            <div class="peneira-item">
                                <div class="peneira-header">
                                    <h3>Peneira Profissional</h3>
                                    <span class="peneira-badge especial">Especial</span>
                                </div>
                                <div class="peneira-info">
                                    <div class="info-row">
                                        <i class="fas fa-calendar"></i>
                                        <span>30 de Junho, 2025</span>
                                    </div>
                                    <div class="info-row">
                                        <i class="fas fa-clock"></i>
                                        <span>10:00 - 16:00</span>
                                    </div>
                                    <div class="info-row">
                                        <i class="fas fa-map-pin"></i>
                                        <span>Estádio Principal, São Paulo</span>
                                    </div>
                                    <div class="info-row">
                                        <i class="fas fa-money-bill-wave"></i>
                                        <span>Taxa: R$ 100,00</span>
                                    </div>
                                </div>
                                <button class="btn-peneira">Ver mais</button>
                            </div>
                        </div>
                        <button class="btn-mais">Ver todas as peneiras</button>
                    </section>

                    <section class="card posts">
                        <h2><i class="fas fa-stream"></i> Últimas Atualizações</h2>
                        <div class="posts-lista">
                            <div class="post">
                                <div class="post-header">
                                    <img src="https://via.placeholder.com/50" alt="Logo pequeno">
                                    <div class="post-info">
                                        <h3>Nome da Organização</h3>
                                        <span class="post-data">Publicado há 2 dias</span>
                                    </div>
                                </div>
                                <div class="post-conteudo">
                                    <p>Estamos muito felizes em anunciar nossa nova parceria com a Escola de Futebol Campeões! Juntos, vamos desenvolver novos talentos para o futebol brasileiro.</p>
                                    <img src="https://via.placeholder.com/600x300" alt="Imagem do post">
                                </div>
                                <div class="post-acoes">
                                    <button class="curtir"><i class="far fa-heart"></i> 42 Curtidas</button>
                                    <button class="comentar"><i class="far fa-comment"></i> 8 Comentários</button>
                                    <button class="compartilhar"><i class="far fa-share-square"></i> Compartilhar</button>
                                </div>
                            </div>

                            <div class="post">
                                <div class="post-header">
                                    <img src="https://via.placeholder.com/50" alt="Logo pequeno">
                                    <div class="post-info">
                                        <h3>Nome da Organização</h3>
                                        <span class="post-data">Publicado há 5 dias</span>
                                    </div>
                                </div>
                                <div class="post-conteudo">
                                    <p>Nosso time sub-17 conquistou o campeonato regional! Parabéns a todos os jogadores e comissão técnica pelo excelente trabalho.</p>
                                    <img src="https://via.placeholder.com/600x300" alt="Imagem do post">
                                </div>
                                <div class="post-acoes">
                                    <button class="curtir"><i class="far fa-heart"></i> 56 Curtidas</button>
                                    <button class="comentar"><i class="far fa-comment"></i> 12 Comentários</button>
                                    <button class="compartilhar"><i class="far fa-share-square"></i> Compartilhar</button>
                                </div>
                            </div>
                        </div>
                        <button class="btn-mais">Carregar mais posts</button>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <?php include("footer.php"); ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // efeito hover na galeria
            const galeriaItems = document.querySelectorAll('.galeria-item');
            
            galeriaItems.forEach(item => {
                item.addEventListener('mouseenter', () => {
                    const overlay = item.querySelector('.galeria-overlay');
                    if (overlay) {
                        overlay.style.transform = 'translateY(0)';
                    }
                });
                
                item.addEventListener('mouseleave', () => {
                    const overlay = item.querySelector('.galeria-overlay');
                    if (overlay) {
                        overlay.style.transform = 'translateY(100%)';
                    }
                });
            });
        });
    </script>
</body>
</html>
