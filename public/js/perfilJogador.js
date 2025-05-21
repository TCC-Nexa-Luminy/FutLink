document.addEventListener("DOMContentLoaded", function () {
  const navbar = document.querySelector(".navbar");
    dadosPerfil();

  window.addEventListener("scroll", function () {
    if (window.scrollY > 100) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }
  });
});

async function dadosPerfil() {
    $.ajax({
        type: "POST",
        url: "../../app/controllers/perfilJogador.act.php",
        data: {nome: "Shandel"},       //dados a serem enviados ao backend
        dataType: "text",           //tipo de dados que se espera, como texto ou JSON
        success: function (response) {
            console.log(response);
        },
        error: function (xhr, status, error) {
            console.error("Erro na requisição:", error);
        }
    });
}

