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
  ];

  tagsUserId.map((item) => {
    $(`#${item.id}`).text(object.user[item.prop]);
  });

  $(`#photo_user`).attr("src", object.user["foto_perfil"]);

  let idade = calcularIdade(object.user["data_nasc"]);
  $('#idade_user').text(idade);

  
  const tagsPlayerId = [
    { id: "apelido_user", prop: "apelido" },
    { id: "descricao_user", prop: "descricao" },
    { id: "peso_user", prop: "peso" },
    { id: "altura_user", prop: "altura" },
    { id: "estilo_user", prop: "estiloJogo" },
    { id: "posicao_user", prop: "posicao" },
    { id: "pe_user", prop: "pe_dominante" },
  ];
  if(object.player !== null){
    
    tagsPlayerId.map((item) => {
      let dado = object.player[item.prop]
      $(`#${item.id}`).text(dado);
    });
  }else{
    tagsPlayerId.map((item) => {
      $(`#${item.id}`).text("?");
    });
  }
}

function calcularIdade(dataNasc){
  const hoje = new Date();
  const nasc = new Date(dataNasc);
  
  let idade = hoje.getFullYear() - nasc.getFullYear();
  const mes = hoje.getMonth() - nasc.getMonth();

  if (mes < 0 || (mes === 0 && hoje.getDate() < nasc.getDate())) {
    idade--;
  }

  return String(idade + " anos");
}