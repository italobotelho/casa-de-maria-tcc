// Executar quando o documento HTML for completamente carregado
document.addEventListener("DOMContentLoaded", function () {

  // Receber o SELETOR calendar do atributo ID
  var calendarEl = document.getElementById("calendar");

  //instanciar FullCalendar.Calendar e atribuir a variavel calendar
  var calendar = new FullCalendar.Calendar(calendarEl, {
    // incluindo o bootstrap
    themeSystem: 'bootstrap5',

    // criar o cabeçalho do calendário
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay",
    },

    // difinir  o idioma usado no calendário
    locale: 'pr-br',

    // dofinir a data inicial
    //initialDate: "2024-10-02",


    // permitir clicar nos nomes e nos dias da semana
    navLinks: true,

    // permitri clicar e arrastar o mouse sobre um ou varios dias no calendário 
    selectable: true,

    // selecionar visualmente a area que sera selecionada antes que o usuario solte o botao do mouse para confirmar a seleçãoo 
    selectMirror: true,


    //permitir arrastar e redimencionar os eventos diretamente no calendário
    editable: true,
    //numero máximo de eventos em um determinado dia,se for true, o numero de consulta sera limitado a altura da célula do dia 
    dayMaxEvents: true,


    //events: [

    // ],

    // Função para abrir o modal de cadastro ao clicar em um dia no calendário
    select: function (info) {
      const cadastrarModal = new bootstrap.Modal(document.getElementById("cadastrarModal"));

      // Converter e preencher a data no modal no formato yyyy-mm-dd
      const dataFormatada = converterData(info.start);
      document.getElementById("data_cons").value = dataFormatada;

      cadastrarModal.show();
    }
  });

     // Função para converter a data para o formato yyyy-mm-dd hh:mm
     function converterData(data) {
      const dataObj = new Date(data);
      const ano = dataObj.getFullYear();
      const mes = String(dataObj.getMonth() + 1).padStart(2, '0');
      const dia = String(dataObj.getDate()).padStart(2, '0');
      const horas = String(dataObj.getHours()).padStart(2, '0');
      const minutos = String(dataObj.getMinutes()).padStart(2, '0');

      return `${ano}-${mes}-${dia}T${horas}:${minutos}`; // Adiciona o 'T' para o formato datetime-local
  }

  

    // Adicionar um evento ao modal para limpar os campos ao fechar
    var cadastrarModalElement = document.getElementById("cadastrarModal");
    cadastrarModalElement.addEventListener('hidden.bs.modal', function () {
        document.getElementById("nome_paciente").value = ''; // Limpar campo nome do paciente
        document.getElementById("profissional").value = ''; // Limpar campo profissional
        document.getElementById("especialidade").value = ''; // Limpar campo especialidade
        document.getElementById("data_cons").value = ''; // Limpar campo data
        document.getElementById('sugestoes').style.display = 'none'; // Ocultar sugestões
    });
  // Renderizar o calendário
  calendar.render();
});





//função para carregar os nomes dos pacientes cadastrado no modal quando for fazer o agendamento
function buscarPacientes(query) {
  // Se a consulta estiver vazia, ocultar as sugestões e sair da função
  if (query.length < 1) {
      document.getElementById('sugestoes').style.display = 'none';
      return;
  }

  // Fazer uma requisição para buscar pacientes que correspondem à consulta
  fetch(`/pacientes/buscar?query=${query}`)

      .then(response => response.json()) // Converter a resposta em JSON
      .then(data => {
          const sugestoesDiv = document.getElementById('sugestoes');
          sugestoesDiv.innerHTML = ''; // Limpar sugestões anteriores

          // Verificar se há resultados
          if (data.length > 0) {
              data.forEach(nome => {
                  // Criar um elemento <a> para cada nome retornado
                  const item = document.createElement('a');
                  item.className = 'list-group-item list-group-item-action'; // Estilização do item
                  item.href = '#'; // Definir o href como '#', já que é um link fictício
                  item.textContent = nome; // Definir o texto do link como o nome do paciente
                  
                  // Adicionar um evento de clique ao item
                  item.onclick = function () {
                      document.getElementById('nome_paciente').value = nome; // Preencher o campo de entrada com o nome selecionado
                      sugestoesDiv.style.display = 'none'; // Ocultar as sugestões
                  };

                  // Adicionar o item à lista de sugestões
                  sugestoesDiv.appendChild(item);
              });
              sugestoesDiv.style.display = 'block'; // Mostrar a lista de sugestões
          } else {
              // Se não houver resultados, ocultar a lista de sugestões
              sugestoesDiv.style.display = 'none';
          }
      })
      .catch(error => console.error('Erro:', error)); // Tratar erros da requisição
}  


// Função para carregar os nomes dos médicos cadastrados no modal quando for fazer o agendamento
function buscarMedicos(query) {
  // Se a consulta estiver vazia, ocultar as sugestões e sair da função
  if (query.length < 1) {
      document.getElementById('sugestoes_medicos').style.display = 'none';
      return;
  }

  // Fazer uma requisição para buscar médicos que correspondem à consulta
  fetch(`/medicos/buscar?query=${query}`)
      .then(response => response.json()) // Converter a resposta em JSON
      .then(data => {
          const sugestoesDiv = document.getElementById('sugestoes_medicos');
          sugestoesDiv.innerHTML = ''; // Limpar sugestões anteriores

          // Verificar se há resultados
          if (data.length > 0) {
              data.forEach(nome => {
                  // Criar um elemento <a> para cada nome retornado
                  const item = document.createElement('a');
                  item.className = 'list-group-item list-group-item-action'; // Estilização do item
                  item.href = '#'; // Definir o href como '#', já que é um link fictício
                  item.textContent = nome; // Definir o texto do link como o nome do médico

                  // Adicionar um evento de clique ao item
                  item.onclick = function () {
                      document.getElementById('profissional').value = nome; // Preencher o campo de entrada com o nome selecionado
                      sugestoesDiv.style.display = 'none'; // Ocultar as sugestões
                  };

                  // Adicionar o item à lista de sugestões
                  sugestoesDiv.appendChild(item);
              });
              sugestoesDiv.style.display = 'block'; // Mostrar a lista de sugestões
          } else {
              // Se não houver resultados, ocultar a lista de sugestões
              sugestoesDiv.style.display = 'none';
          }
      })
      .catch(error => console.error('Erro:', error)); // Tratar erros da requisição
}



document.addEventListener("DOMContentLoaded", function () {

  document.addEventListener('click', function(event) {
      const sugestoesDiv = document.getElementById('sugestoes');
      const sugestoesMedicosDiv = document.getElementById('sugestoes_medicos');
      const nomePacienteInput = document.getElementById('nome_paciente');
      const profissionalInput = document.getElementById('profissional');

      // Verifica se o clique foi fora do campo de input ou da lista de sugestões
      if (!nomePacienteInput.contains(event.target) && !sugestoesDiv.contains(event.target)) {
          sugestoesDiv.style.display = 'none'; // Oculta sugestões de pacientes
      }
      if (!profissionalInput.contains(event.target) && !sugestoesMedicosDiv.contains(event.target)) {
          sugestoesMedicosDiv.style.display = 'none'; // Oculta sugestões de médicos
      }
  });


});




