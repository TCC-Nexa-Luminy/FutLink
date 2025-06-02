$(document).ready(function () {
      $("#iphone").inputmask("(99) 99999-9999");

});
$("#btn_cep").click(function (e) { 
    e.preventDefault();
    let cep = $("#icep").val();
    verificaCep(cep)
});

async function verificaCep(cep) {
    $.ajax({
        type: "GET",
        url: `https://viacep.com.br/ws/${cep}/json/`,
        data: "JSON",
        success: function (response) {
            if (response.erro) {
                sweet_message("CEP não encontrado");
            } else {
                sweet_message(`
                    Endereço: ${response.logradouro}, 
                    Bairro: ${response.bairro}, 
                    Cidade: ${response.localidade}, 
                    Estado: ${response.uf}
                `);
            }
        },
        error: function() {
            sweet_message("Erro ao buscar cep")
        }
    });
}