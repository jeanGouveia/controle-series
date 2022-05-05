@extends('layout')

@section('cabecalho')
    Registrar-se 
@endsection

@section('conteudo')
    @include('erros',['errors', $errors])
    <form method="POST">
        @csrf
        <div>
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" required class="form-control">
        </div>
        <div>
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" required class="form-control">
        </div>
        <div>
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" required min="1" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary mt-3">
            Entrar
        </button>
    </form>
@endsection