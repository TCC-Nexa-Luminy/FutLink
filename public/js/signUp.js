$(document).ready(function () {
  $("#iprofile").change(function (e) {
    let img = $("#iphoto");
    let filePhoto = e.target.files[0];

    if (filePhoto) {
      let imgUrl = URL.createObjectURL(filePhoto);
      img.attr("src", imgUrl);
      img.attr("style", "display: block")

      let spanPhoto = $(".placeholderSpan");
      spanPhoto.attr("style", "display: none")
    }
  });

  $("#itel").inputmask("(99) 99999-9999");

  $("#form_cadastro").submit(function (e) {
    let nome = $("#inome").val().trim(); //.val() é o valor do elemento
    let email = $("#iemail").val().trim();
    let senha = $("#ipass").val();
    let senha2 = $("#ipass2").val();

    if (senha != senha2) {
      e.preventDefault();
      sweet_message("As <span><b>senhas</b></span>     não coincidem!");
    }
  });
});

// const form_user = document.querySelector("#form_cadastro");

// form_user.addEventListener("submit", (e)=>{
//     const btn_send = document.querySelector("#send_btn")
//     btn_send.disabled = true

// })
