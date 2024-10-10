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

    <a href="{{ route('convenios.create') }}">Cadastrar Novo Convenio</a>
    
    <h2>CONVÊNIOS</h2>

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
                    <a href="{{ route('convenios.edit', ['pk_id_conv' => $convenio->pk_id_conv]) }}">Editar</a>
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