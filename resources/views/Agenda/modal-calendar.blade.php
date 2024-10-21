<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    #pacienteSuggestions {
    max-height: 200px;
    overflow-y: auto;
    background-color: white; 
    border: 1px solid #ddd; 
    border-radius: 0.25rem; 
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); 
}

#pacienteSuggestions .list-group-item {
    cursor: pointer; 
}

  </style>
</head>
<body>
  
<!-- Modal -->
<div class="modal fade" id="modalCalendar" tabindex="-1" aria-labelledby="titleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="w-100 d-flex justify-content-center">
                    <h1 class="modal-title fs-5" id="titleModal"></h1>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div id="message"></div>
                    <form id="formEvent" class="row g-3">
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="color" id="color" value="#9D9D9B">

                        <div class="col-12">
    <label for="paciente" class="form-label">Paciente</label>
    <input type="text" class="form-control" name="paciente" id="paciente" placeholder="Informe o nome" oninput="buscarPacientes(this.value)">
    <div id="pacienteSuggestions" class="list-group" style="display: none; position: absolute; z-index: 1000;"></div>
</div>



                        <div class="col-12">
                            <label for="professional" class="form-label">Profissional</label>
                            <select class="form-select" id="professional" aria-label="Default select example">
                                <option selected>Selecione o Profissional</option>
                                {{-- Adicione as opções de profissionais aqui --}}
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="procedimento_id" class="form-label">Procedimento</label>
                            <select class="form-select" id="procedimento_id" name="procedimento_id" aria-label="Default select example">
                                <option selected>Selecione um Procedimento</option>
                                @foreach($procedimentos as $procedimento)
                                    <option value="{{ $procedimento->pk_cod_proc }}">{{ $procedimento->nome_proc }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="eventDate" class="form-label">Data do Evento</label>
                            <input type="date" class="form-control" name="eventDate" id="eventDate">
                        </div>

                        <div class="col-12">
                            <label for="start" class="form-label">Hora Inicial</label>
                            <input type="time" class="form-control" name="start" id="start">
                        </div>

                        <div class="col-12">
                            <label for="end" class="form-label">Hora Final</label>
                            <input type="time" class="form-control" name="end" id="end">
                        </div>

                        <div class="col-12">
                            <label class="form-check-label d-block" for="flexSwitchCheckRepeate">Repetição</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckRepeate">
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="convenio" class="form-label">Convênio do Paciente</label>
                            <select class="form-select" id="convenio" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                {{-- Adicione as opções de convênios aqui --}}
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                {{-- Adicione as opções de status aqui --}}
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger deleteEvent">Excluir</button>
                <button type="button" class="btn btn-primary saveEvent">Cadastrar Horário</button>
            </div>
        </div>
    </div>
</div>

<script>
function buscarPacientes(query) {
    console.log("Buscando pacientes com a consulta:", query);
    const sugestoesDiv = document.getElementById('pacienteSuggestions');

    if (query.length < 1) {
        sugestoesDiv.style.display = 'none';
        sugestoesDiv.innerHTML = '';
        return;
    }

    fetch(`/pacientes/buscar?query=${query}`)
        .then(response => response.json())
        .then(data => {
            sugestoesDiv.innerHTML = '';
            if (data.length > 0) {
                data.forEach(nome => {
                    const item = document.createElement('a');
                    item.className = 'list-group-item list-group-item-action';
                    item.href = '#';
                    item.textContent = nome;
                    item.onclick = function () {
                        document.getElementById('paciente').value = nome;
                        sugestoesDiv.style.display = 'none';
                    };
                    sugestoesDiv.appendChild(item);
                });
                sugestoesDiv.style.display = 'block';
            } else {
                sugestoesDiv.style.display = 'none';
            }
        })
        .catch(error => console.error('Erro:', error));
}

</script>

</body>
</html>