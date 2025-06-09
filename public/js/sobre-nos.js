// Animações para a seção sobre nós
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
  
    // Observar cards dos membros
    const cardsMembros = document.querySelectorAll(".card-membro")
    cardsMembros.forEach((card, index) => {
      card.style.opacity = "0"
      card.style.transform = "translateY(30px)"
      card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`
      observer.observe(card)
    })
  
    // Animação dos números das estatísticas
    const animateNumbers = () => {
      const statNumbers = document.querySelectorAll(".stat-item .numero")
  
      statNumbers.forEach((number) => {
        const finalNumber = number.textContent
        if (finalNumber !== "∞") {
          let currentNumber = 0
          const increment = finalNumber / 30
  
          const timer = setInterval(() => {
            currentNumber += increment
            if (currentNumber >= finalNumber) {
              number.textContent = finalNumber
              clearInterval(timer)
            } else {
              number.textContent = Math.floor(currentNumber)
            }
          }, 50)
        }
      })
    }
  
    // Observar seção de stats
    const statsSection = document.querySelector(".stats-equipe")
    if (statsSection) {
      const statsObserver = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              animateNumbers()
              statsObserver.unobserve(entry.target)
            }
          })
        },
        { threshold: 0.5 },
      )
  
      statsObserver.observe(statsSection)
    }
  
    // Efeito parallax suave na imagem da equipe
    window.addEventListener("scroll", () => {
      const scrolled = window.pageYOffset
      const parallaxElement = document.querySelector(".foto-equipe")
  
      if (parallaxElement) {
        const speed = scrolled * 0.1
        parallaxElement.style.transform = `translateY(${speed}px)`
      }
    })
  })
  