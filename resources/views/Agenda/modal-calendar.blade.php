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

                <div class="col-md-6">
                  <label for="title" class="form-label">Paciente</label>
                  <input type="text" class="form-control" name="title" id="title" placeholder="Informe o nome, código ou data de nascimento...">
                  <input type="hidden" name="id">
                </div>

                <div class="col-md-6">
                  <label for="" class="form-label">Profissional</label>
                  <select class="form-select" aria-label="Default select example">
                    <option selected>Selecione o Profissional</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>

                {{-- <div class="form-check form-switch col col-ms-auto text-center">
                  <label class="form-check-label d-block" for="flexSwitchCheckDefault">Bloqueado</label>
                  <div class="d-flex justify-content-center">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckBlock" data-bs-target="#exampleModalToggle" data-bs-toggle="modalBlock">
                  </div>
                </div> --}}
                
                <div class="col-md-6">
                  <label for="" class="form-label">Procedimento</label>
                  <select class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>

                <div class="col-md-2">
                  <label for="start" class="form-label">Hora Inicial</label>
                  <input type="time" class="form-control" name="start" id="start">
                  <div class="input-group-append" id="startButtons" style="display: none;">
                      <button type="button" class="btn btn-secondary btn-sm" id="increaseStartTime">↑</button>
                      <button type="button" class="btn btn-secondary btn-sm" id="decreaseStartTime">↓</button>
                  </div>
                </div>
                
                <div class="col-md-2">
                    <label for="end" class="form-label">Hora Final</label>
                    <input type="time" class="form-control" name="end" id="end">
                    <div class="input-group-append" id="endButtons" style="display: none;">
                        <button type="button" class="btn btn-secondary btn-sm" id="increaseEndTime">↑</button>
                        <button type="button" class="btn btn-secondary btn-sm" id="decreaseEndTime">↓</button>
                    </div>
                </div>

                <div class="form-check form-switch col col-ms-auto text-center">
                  <label class="form-check-label d-block" for="flexSwitchCheckDefault">Repetição</label>
                  <div class="d-flex justify-content-center">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckRepeate" data-bs-target="#exampleModalToggle" data-bs-toggle="modalRepeate">
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="" class="form-label">Convênio do Paciente</label>
                  <select class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
                
                <div class="col-md-6">
                  <label for="" class="form-label">Status</label>
                  <select class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>

                {{-- <div class="col-md-auto">
                    <label for="color" class="form-label">Cor do Evento</label>
                    <input type="color" class="form-control" name="color" id="color">
                </div> --}}

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