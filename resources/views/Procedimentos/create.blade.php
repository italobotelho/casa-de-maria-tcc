<!-- Modal -->
<div class="modal fade" id="ProcedimentoModal" tabindex="-1" aria-labelledby="procedimentoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="procedimentoModalLabel">Cadastro de Procedimento</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('procedimentos.store')}}" method="post">
            @csrf
            <label for="inputNomeProcedimento" class="form-label">Procedimento</label>
            <input type="text" class="form-control" id="nome_proc" name="nome_proc" required>

            <label for="inputDescricaoProcedimento" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="descricao_proc" name="descricao_proc" required>

            <label for="inputDuracaoProcedimento" class="form-label">Duração Média</label>
            <input type="time" class="form-control" id="tempo_proc" name="tempo_proc" step="60" required>

            <label for="inputProfissionaisProcedimento" class="form-label">Profissionais que atendem</label>
            <select class="form-control" id="fk_crm_med" name="fk_crm_med" required>
              <option value="">Selecione um médico</option>
              @foreach($medicos as $medico)
                  <option value="{{ $medico->pk_id_med }}">{{ $medico->nome_med }}</option>
              @endforeach
          </select>

            </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
        </div>
      </div>
    </div>
  </div>