{{-- resources/views/convenios/index.blade.php --}}

@extends('Layout/configuracoes')

@section('nav-convenios')
<li class="nav-item">
    <a class="nav-link " aria-current="page" href="gerais">Gerais</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" aria-current="page" href="procedimentos">Procedimentos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="convenios">Convênios</a>
  </li>
    
@endsection

@section('main-configuracoes')
<style>

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
    .modal-content {
        padding: 20px;
        background-color: white;
        border-radius: 5px;
        border: 2px solid #ddd;
    }
    
    button{
      background-color:#795127;
      border-radius: 13px;
      font-size:20px;
      font-weight: 200;
      border:2px;
      border-color:#653C11;
      margin:10px;
      color: white;
    }

    .cad{
        font-size:20px;
        position:relative;
        float: right;
        margin:10px;
        padding:15px;
    }
    /* Estilos para a tabela */
    table {
       
        width: 100%;
        border-collapse: collapse; /* Remove espaços entre células */
        margin-top: 20px;
    }

    th, td {
        font-size:20px;
        padding: 12px;
        text-align: left;
        
    }

    th {
        background-color: #795127; /* Cor do cabeçalho */
        color: white; /* Texto do cabeçalho em branco */
    }

    /* Linhas alternadas da tabela */
    tbody tr:nth-child(odd) {
        background-color: #f9f9f9; /* Cor para linhas ímpares */
    }

    tbody tr:nth-child(even) {
        background-color: #ffffff; /* Cor para linhas pares */
    }

  

</style>
<br>
    <a class="cad" type="button" href="{{ route('convenios.create') }}">Cadastrar Novo Convenio</a>
    
    <h2>CONVÊNIOS</h2>
    <div class="modal-content">
    <table>
        <thead>
            <tr>
                <th>Nome do Convenio</th>
                <th>ANS Convenio</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($convenios as $convenio)
            <tr>
                <td>{{ $convenio->nome_conv }}</td>
                <td>{{ $convenio->ans_conv }}</td>
                <td>
                    <a  href="{{ route('convenios.edit', ['pk_id_conv' => $convenio->pk_id_conv]) }}">
                    <img src="img/edit.png" alt="Descrição da imagem">
                    </a>
                    <form action="{{ route('convenios.destroy', ['pk_id_conv' => $convenio->pk_id_conv]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection