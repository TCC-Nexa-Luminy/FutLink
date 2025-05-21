document.addEventListener("DOMContentLoaded", function () {
  const navbar = document.querySelector(".navbar");
  const dados = dadosPerfil();

  writeDados('nome_user', 'nome', dados);


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
    data: { nome: "Shandel" }, //dados a serem enviados ao backend
    dataType: "json", //tipo de dados que se espera, como texto ou JSON
    success: function (response) {
        console.log(response);
        return response;
    },
    error: function (xhr, status, error) {
      console.error("Erro na requisição:", error);
    },
  });
}

