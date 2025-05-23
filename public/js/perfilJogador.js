document.addEventListener("DOMContentLoaded", function () {
  dadosPerfil();
});

async function dadosPerfil() {
  $.ajax({
    type: "POST",
    url: "../../app/controllers/perfilJogador.act.php",
    data: { nome: "Shandel" }, //dados a serem enviados ao backend
    dataType: "json", //tipo de dados que se espera, como texto ou JSON
    success: function (response) {
      console.log(response);
      addDados(response);
    },
    error: function (xhr, status, error) {
      console.log("Erro na requisição:", error);
    },
  });
}

function addDados(object) {

  const tagsUserId = [
    { id: "name_user", prop: "nome" },
    { id: "status_user", prop: "status" },
    { id: "email_user", prop: "email" },
    { id: "tel_user", prop: "telefone" },   
    { id: "pe_user", prop: "pe_dominante" },
  ]
  
  const tagsPlayerId = [
    { id: "apelido_user", prop: "apelido" },
    { id: "descricao_user", prop: "descricao" },
    { id: "peso_user", prop: "peso" },
    { id: "altura_user", prop: "altura" },
    { id: "estilo_user", prop: "estiloJogo" },
    { id: "posicao_user", prop: "posicao" },
    { id: "pe_user", prop: "pe_dominante"}
  ]

  tagsUserId.map((item) => {
    $(`#${item.id}`).text(object.user[item.prop]);
  });

  tagsPlayerId.map((item) => {
    $(`#${item.id}`).text(object.player[item.prop]);
  });

  $(`#photo_user`).attr("src", object.user['foto_perfil']);
}
