// Animações para a seção de contato
document.addEventListener("DOMContentLoaded", () => {
  // Animação de entrada dos cards
  const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
  }

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = "1"
        entry.target.style.transform = "translateY(0)"
      }
    })
  }, observerOptions)

  const cardsContato = document.querySelectorAll(".card-contato")
  cardsContato.forEach((card, index) => {
    card.style.opacity = "0"
    card.style.transform = "translateY(30px)"
    card.style.transition = `opacity 0.6s ease ${index * 0.2}s, transform 0.6s ease ${index * 0.2}s`
    observer.observe(card)
  })

  // Efeito de hover nos cards
  cardsContato.forEach((card) => {
    card.addEventListener("mouseenter", () => {
      card.style.transform = "translateY(-10px) scale(1.02)"
    })

    card.addEventListener("mouseleave", () => {
      card.style.transform = "translateY(0) scale(1)"
    })
  })

  // Animação do ícone central
  const iconeCentral = document.querySelector(".icone-central")
  if (iconeCentral) {
    setInterval(() => {
      iconeCentral.style.transform = "scale(1.1)"
      setTimeout(() => {
        iconeCentral.style.transform = "scale(1)"
      }, 200)
    }, 3000)
  }

  // Efeito de clique nos botões
  const botoes = document.querySelectorAll(".botao-contato, .botao-cta-principal, .botao-cta-secundario")
  botoes.forEach((botao) => {
    botao.addEventListener("click", (e) => {
      // Efeito ripple
      const ripple = document.createElement("span")
      const rect = botao.getBoundingClientRect()
      const size = Math.max(rect.width, rect.height)
      const x = e.clientX - rect.left - size / 2
      const y = e.clientY - rect.top - size / 2

      ripple.style.width = ripple.style.height = size + "px"
      ripple.style.left = x + "px"
      ripple.style.top = y + "px"
      ripple.classList.add("ripple")

      botao.appendChild(ripple)

      setTimeout(() => {
        ripple.remove()
      }, 600)
    })
  })
})

// CSS para o efeito ripple
const style = document.createElement("style")
style.textContent = `
  .ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.6);
    transform: scale(0);
    animation: ripple-animation 0.6s linear;
    pointer-events: none;
  }

  @keyframes ripple-animation {
    to {
      transform: scale(4);
      opacity: 0;
    }
  }

  .botao-contato, .botao-cta-principal, .botao-cta-secundario {
    position: relative;
    overflow: hidden;
  }
`
document.head.appendChild(style)
