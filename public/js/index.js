const dropdown = document.getElementById('dropdownCadastrar');
const btnCadastrar = document.getElementById('buttoncadastrar');

btnCadastrar.addEventListener('click', function (event) {
  event.preventDefault();
  event.stopPropagation();
  dropdown.classList.toggle('ativo');
});

document.addEventListener('click', function () {
  dropdown.classList.remove('ativo');
});


document.addEventListener("DOMContentLoaded", () => {

  function animateCounters() {
    const counters = document.querySelectorAll(".counter-number")

    counters.forEach((counter) => {
      const target = Number.parseInt(counter.getAttribute("data-count"))
      const duration = 2000 
      const step = target / (duration / 30) 
      let current = 0

      const updateCounter = () => {
        current += step
        if (current < target) {
          counter.textContent = Math.floor(current)
          requestAnimationFrame(updateCounter)
        } else {
          counter.textContent = target
        }
      }

      updateCounter()
    })
  }

  // Verificar se o elemento está visível na tela
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          animateCounters()
          observer.unobserve(entry.target)
        }
      })
    },
    { threshold: 0.1 },
  )

  // Observar a seção
  const orgSection = document.querySelector(".box-org")
  if (orgSection) {
    observer.observe(orgSection)
  }
})
