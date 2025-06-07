// JavaScript para corrigir o upload de fotos nos posts
document.addEventListener("DOMContentLoaded", () => {
  console.log("Iniciando correção do upload de fotos...")

  // Selecionar todos os inputs de arquivo de imagem
  const imageInputs = document.querySelectorAll('input[type="file"][name="imagem"]')

  imageInputs.forEach((input) => {
    input.addEventListener("change", function (e) {
      console.log("Arquivo selecionado:", e.target.files[0])

      if (this.files && this.files[0]) {
        const file = this.files[0]

        // Verificar se é uma imagem
        if (!file.type.startsWith("image/")) {
          alert("Por favor, selecione apenas arquivos de imagem.")
          this.value = ""
          return
        }

        // Verificar tamanho do arquivo (máximo 5MB)
        if (file.size > 5 * 1024 * 1024) {
          alert("O arquivo deve ter no máximo 5MB.")
          this.value = ""
          return
        }

        // Criar preview da imagem
        const reader = new FileReader()
        reader.onload = (e) => {
          // Encontrar o container de preview mais próximo
          const form = input.closest("form")
          let previewContainer = form.querySelector(".image-preview")

          // Se não existir, criar o container de preview
          if (!previewContainer) {
            previewContainer = document.createElement("div")
            previewContainer.className = "image-preview"
            previewContainer.style.cssText = `
                            margin: 1rem 0;
                            position: relative;
                            display: inline-block;
                            border-radius: 10px;
                            overflow: hidden;
                            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                        `

            // Inserir após o input de arquivo
            input.closest(".media-options").appendChild(previewContainer)
          }

          // Criar a imagem de preview
          previewContainer.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" style="
                            max-width: 100%;
                            max-height: 200px;
                            display: block;
                            border-radius: 10px;
                        ">
                        <button type="button" class="remove-image-btn" style="
                            position: absolute;
                            top: 5px;
                            right: 5px;
                            background: rgba(255, 0, 0, 0.8);
                            color: white;
                            border: none;
                            width: 25px;
                            height: 25px;
                            border-radius: 50%;
                            cursor: pointer;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 12px;
                            transition: all 0.3s ease;
                        " title="Remover imagem">×</button>
                    `

          // Adicionar evento para remover a imagem
          const removeBtn = previewContainer.querySelector(".remove-image-btn")
          removeBtn.addEventListener("click", () => {
            previewContainer.remove()
            input.value = ""
          })

          console.log("Preview da imagem criado com sucesso")
        }

        reader.readAsDataURL(file)
      }
    })
  })

  console.log("Upload de fotos configurado para", imageInputs.length, "inputs")
})
