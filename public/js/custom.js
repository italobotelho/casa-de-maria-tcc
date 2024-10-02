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

  // Renderizar o calendário
  calendar.render();
});