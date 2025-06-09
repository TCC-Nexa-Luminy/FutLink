// JavaScript para funcionalidade das abas
document.addEventListener("DOMContentLoaded", () => {
    const botoesAba = document.querySelectorAll(".botao-aba")
    const conteudosAba = document.querySelectorAll(".conteudo-aba")
  
    // Verificar se os elementos existem antes de adicionar eventos
    if (botoesAba.length > 0 && conteudosAba.length > 0) {
      botoesAba.forEach((botao) => {
        botao.addEventListener("click", function () {
          const abaAlvo = this.getAttribute("data-aba")
  
          // Remove classe ativo de todos os botões
          botoesAba.forEach((b) => {
            b.classList.remove("ativo")
          })
  
          // Remove classe ativo de todos os conteúdos
          conteudosAba.forEach((c) => {
            c.classList.remove("ativo")
          })
  
          // Adiciona classe ativo ao botão clicado
          this.classList.add("ativo")
  
          // Adiciona classe ativo ao conteúdo correspondente
          const conteudoAlvo = document.getElementById("conteudo-" + abaAlvo)
          if (conteudoAlvo) {
            conteudoAlvo.classList.add("ativo")
          }
        })
      })
    }
  })
  