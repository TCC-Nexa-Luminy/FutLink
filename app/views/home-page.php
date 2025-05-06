<?php
include("topo.php");
?>
<link rel="stylesheet" href="../../public/css/home-page.css">

<body>
    <?php include("navbar-social.php"); ?>

    <div class="feed-wrapper">

        <div class="feed-header">
            <h2>Explorar FutLink</h2>
            <input type="text" placeholder="🔍 Buscar por atletas, clubes ou hashtags...">
        </div>

        <div class="new-post-card">
            <div class="profile-circle">👤</div>
            <div class="post-form">
                <textarea placeholder="Compartilhe uma jogada, treino ou conquista..."></textarea>
                <div class="form-actions">
                    <label for="upload-img">📷 Imagem</label>
                    <input type="file" id="upload-img" class="upload-input">
                    <button class="publish-btn">Publicar</button>
                </div>
            </div>
        </div>

        <div class="feed-section">
            <div class="card-post">
                <div class="card-header">
                    <span class="user">@caioatanque171</span>
                    <span class="time">há 2h</span>
                </div>
                <p>Primeiro treinoOOO! com o time novo HAHAHAH 💚⚽ #FutLink #Neymar</p>
                <img src="https://via.placeholder.com/500x250" alt="Imagem do treino" class="post-image">
                <div class="card-footer">
                    <span>❤️ 152</span>
                    <span>💬 18</span>
                    <span>🔁 9</span>
                </div>
            </div>
        </div>
    </div>



    </div>

</body>