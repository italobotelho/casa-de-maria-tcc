<!-- Modal -->
<div class="modal fade" id="modalCalendar" tabindex="-1" aria-labelledby="titleModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="titleModal">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div id="message"></div>
          
            <form id="formEvent">
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                      <input type="text" class="form-control" name="title" id="title">
                      <input type="hidden" name="id">
                </div>
                <div class="mb-3">
                    <label for="start" class="form-label">Data/hora Inicial</label>
                    <input type="text" class="form-control date-time" name="start" id="start">
                </div>
                <div class="mb-3">
                    <label for="end" class="form-label">Data/hora Final</label>
                    <input type="text" class="form-control date-time" name="end" id="end">
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label">Cor do Evento</label>
                    <input type="color" class="form-control" name="color" id="color">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descrição</label>
                    <textarea name="description" id="description" cols="40" rows="4"></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger deleteEvent">Excluir</button>
          <button type="button" class="btn btn-primary saveEvent">Salvar</button>
        </div>
      </div>
    </div>
  </div>