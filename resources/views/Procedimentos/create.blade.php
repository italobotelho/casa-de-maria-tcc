@extends('Layout/configuracoes')

@section('nav-procedimentos')
<li class="nav-item">
    <a class="nav-link" aria-current="page" href="gerais">Gerais</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="procedimentos">Procedimentos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" aria-current="page" href="convenios">Convênios</a>
  </li>
@endsection

@section('main-configuracoes')
    <!-- resources/views/procedimentos/create.blade.php -->

    <div class="">
        <h1>Cadastrar Novo Procedimento</h1>

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

        <button type="button" class="close-popup">Fechar</button>
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
