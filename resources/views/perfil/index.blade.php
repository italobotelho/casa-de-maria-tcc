@extends('layouts.app')

@section('content')
<div class="container">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulário para Informações do Perfil -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Informações do Perfil</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('perfil.updateProfile') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Atualizar Informações</button>
            </form>
        </div>
    </div>

    <!-- Formulário para Atualizar Senha -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Atualizar Senha</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('perfil.updatePassword') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="current_password">Senha Atual</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                    @error('current_password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Nova Senha</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirme a Nova Senha</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-primary">Atualizar Senha</button>
            </form>
        </div>
    </div>
</div>
@endsection