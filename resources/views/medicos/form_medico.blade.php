@extends('layouts.app')

@section('title', 'PROFISSIONAL')

@section('content')
    <div class="container">
        <h1>CADASTRE UM NOVO MEDICO</h1>

        <form action="{{ route('medico.store') }}" method="POST">
            @csrf

            <!-- Nome -->
            <div class="form-group">
                <label for="nome_med">Nome:</label>
                <input  maxlength="50" type="text" class="form-control" id="nome_med" name="nome_med"
                    value="{{ old('nome_med') }}" required>
            </div>

        <!-- Telefone -->
            <div class="form-group">
                <label for="telefone_med">Telefone:</label>
                <input maxlength="15" type="text" class="form-control" id="telefone_med" name="telefone_med"
                    value="{{ old('telefone_med') }}" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email_med">Email:</label>
                <input maxlength="255"  type="email" class="form-control" id="email_med" name="email_med"
                    value="{{ old('email_med') }}" required>
            </div>

            <!-- UF -->
            <div class="form-group">
                <label for="uf_med">UF:</label>
                <input maxlength="2"  type="text" class="form-control" id="uf_med" name="uf_med"
                    value="{{ old('uf_med') }}" required>
            </div>

            <!-- ESPECIALIDADE -->
            <div class="form-group">
                <label for="especialidade1_med">1° Especialidade:</label>
                <input maxlength="40"  type="text" class="form-control" id="especialidade1_med" name="especialidade1_med" value="{{ old('especialidade1_med') }}"
                    required>
            </div>

            <!-- ESPECIALIDADE -->
            <div>
                <label for="especialidade2_med">2° Especialidade:</label>
                <input maxlength="40"  type="text" name="especialidade2_med" id="especialidade2_med"
                    value="{{ old('especialidade2_med') }}" required>
            </div>
            {{-- crm --}}
            <div>
                <label for="pk_crm_med">CRM:</label>
                <input maxlength="6"  type="text" name="pk_crm_med" id="pk_crm_med"
                    value="{{ old('pk_crm_med') }}" required>
            </div>



            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            <br>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Cadastrar Medico</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
    <script src="js/phone-format.js"></script>
   
</body>
</html>
@endsection