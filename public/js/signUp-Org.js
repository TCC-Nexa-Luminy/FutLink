document.addEventListener("DOMContentLoaded", () => {
  // Preview da logo/banner
  const logoUpload = document.getElementById("logoUpload")
  const logoPreview = document.getElementById("logoPreview")
  const uploadPlaceholder = document.getElementById("uploadPlaceholder")

  if (logoUpload) {
    logoUpload.addEventListener("change", function (e) {
      const file = e.target.files[0]

      if (file) {
        // Verificar tipo de arquivo
        const allowedTypes = ["image/jpeg", "image/jpg", "image/png", "image/webp"]
        if (!allowedTypes.includes(file.type)) {
          alert("Tipo de arquivo não permitido. Use apenas JPG, PNG ou WEBP.")
          this.value = ""
          return
        }

        // Verificar tamanho (5MB)
        if (file.size > 5 * 1024 * 1024) {
          alert("Arquivo muito grande. Tamanho máximo: 5MB.")
          this.value = ""
          return
        }

        // Mostrar preview
        const reader = new FileReader()
        reader.onload = (e) => {
          logoPreview.src = e.target.result
          logoPreview.style.display = "block"
          uploadPlaceholder.style.display = "none"
        }
        reader.readAsDataURL(file)
      } else {
        // Resetar preview
        logoPreview.style.display = "none"
        uploadPlaceholder.style.display = "block"
      }
    })
  }

  // Contador de caracteres para bio
  const bioInput = document.getElementById("bio")
  if (bioInput) {
    bioInput.addEventListener("input", (e) => {
      const maxLength = 300
      const currentLength = e.target.value.length
      const remaining = maxLength - currentLength

      const small = e.target.parentNode.querySelector("small")
      if (small) {
        small.textContent = `${remaining} caracteres restantes`
        small.style.color = remaining < 50 ? "#dc2626" : "#6b7280"
      }
    })
  }

  // Validação do formulário
  const form = document.getElementById("organizationForm")
  if (form) {
    form.addEventListener("submit", (e) => {
      const senha = document.getElementById("password").value
      const confirmSenha = document.getElementById("confirmPassword").value

      if (senha !== confirmSenha) {
        e.preventDefault()
        alert("As senhas não coincidem!")
        return false
      }

      if (senha.length < 6) {
        e.preventDefault()
        alert("A senha deve ter pelo menos 6 caracteres!")
        return false
      }

      // Validar bio
      const bio = document.getElementById("bio").value
      if (bio.length > 300) {
        e.preventDefault()
        alert("A bio deve ter no máximo 300 caracteres!")
        return false
      }

      // Validar descrição
      const descricao = document.getElementById("descricao").value
      if (descricao.length < 50) {
        e.preventDefault()
        alert("A descrição deve ter pelo menos 50 caracteres!")
        return false
      }
    })
  }

  // Máscara para telefone
  const phoneInput = document.getElementById("iphone")
  if (phoneInput) {
    phoneInput.addEventListener("input", (e) => {
      let value = e.target.value.replace(/\D/g, "")
      value = value.replace(/(\d{2})(\d)/, "($1) $2")
      value = value.replace(/(\d{5})(\d)/, "$1-$2")
      e.target.value = value
    })
  }

  // Máscara para CEP
  const cepInput = document.getElementById("icep")
  if (cepInput) {
    cepInput.addEventListener("input", (e) => {
      let value = e.target.value.replace(/\D/g, "")
      value = value.replace(/(\d{5})(\d)/, "$1-$2")
      e.target.value = value
    })
  }

  // Busca CEP
  const btnCep = document.getElementById("btn_cep")

  if (btnCep) {
    btnCep.addEventListener("click", (e) => {
      e.preventDefault()
      const cep = cepInput.value.replace(/\D/g, "")

      if (cep.length === 8) {
        btnCep.textContent = "Buscando..."
        btnCep.disabled = true

        fetch(`https://viacep.com.br/ws/${cep}/json/`)
          .then((response) => response.json())
          .then((data) => {
            if (data.erro) {
              alert("CEP não encontrado!")
            } else {
              alert(`CEP encontrado: ${data.logradouro}, ${data.bairro}, ${data.localidade} - ${data.uf}`)
            }
          })
          .catch((error) => {
            alert("Erro ao buscar CEP!")
          })
          .finally(() => {
            btnCep.textContent = "Verificar"
            btnCep.disabled = false
          })
      } else {
        alert("Digite um CEP válido com 8 dígitos!")
      }
    })
  }
})
