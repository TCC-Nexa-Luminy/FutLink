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