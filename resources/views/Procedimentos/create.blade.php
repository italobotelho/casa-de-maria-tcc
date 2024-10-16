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

    <style>

.modal-content {
    padding: 20px;
    background-color: white;
    border-radius: 5px;
    border: 1px solid #ddd;

}

/* Inputs de formulário */
input[type="text"], textarea, select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 10px;
}

/* Ajuste da barra de navegação */
.nav-item a {
    color: #333;
    text-decoration: none;
    padding: 10px 15px;
    display: block;
    text-transform: uppercase;
}

.nav-item a.active {
    border-bottom: 2px solid #f0ad4e;
    color: #f0ad4e;
}

.nav-item a:hover {
    color: #ec971f;
}

button{
      background-color:#EABF8A;
      border-radius: 13px;
      font-size:20px;
      font-weight: 200;
      border:2px;
      border-color:#653C11;
      margin:15px;
      padding:10px;
      margin:10px;
    }

    .save{
        background-color:#EABF8A;
        border:3px;
        margin:10px;
    }
    .close{
        background-color:#808080;
        border:3px;
        margin:10px;
    }
    </style>

<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Cadastrar Novo Procedimento</h5>
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
        <button type="button" class="close" data-dismiss="modal">Fechar</button>
        <button type="button" class="save">Salvar</button>
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
