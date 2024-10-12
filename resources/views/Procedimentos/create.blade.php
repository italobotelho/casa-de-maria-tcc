<!-- resources/views/procedimentos/create.blade.php -->
@extends('layouts.app-navbar-configuracoes')

@section('content')
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Cadastrar Novo Procedimento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form method="POST" action="{{ route('procedimentos.store') }}">
            @csrf

            <div>
                <label for="nome_proc">Nome do Procedimento:</label>
                <input type="text" id="nome_proc" name="nome_proc" required maxlength="50" required>
            </div>
            
            <div>
                <label for="descricao_proc">Descrição do Procedimento:</label>
                <textarea id="descricao_proc" name="descricao_proc" required maxlength="100" required></textarea>
            </div>
            
            <div>
                <label for="tempo_proc">Tempo do Procedimento:</label>
                <input type="time" id="tempo_proc" name="tempo_proc" required>
            </div>
            
            <!-- resources/views/procedimentos/create.blade.php -->

            <div>
                <label for="fk_crm_med">Médico:</label>
                <select multiple id="fk_crm_med" name="fk_crm_med[]" required>
                    @foreach($medicos as $medico)
                        <option value="{{ $medico->pk_crm_med }}">{{ $medico->nome_med }}</option>
                    @endforeach
                  </select>
            </div>
            
            <button type="submit">Cadastrar</button>
        </form>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Salvar</button>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#mySelect').multiselect({
        multiple: true,
        selectAll: true
        });
    });
</script>
@endsection
