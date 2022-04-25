@extends('layout')

@section('cabecalho')
    Séries
@endsection

@section('conteudo')
@if(!empty($mensagem))
<div class="alert alert-success">
    {{$mensagem}}
</div>
 @endif   

    <a href="/series/adicionar" class="btn btn-dark mb-2">Adicionar</a>

    <ul class="list-group">
        @foreach($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center" >{{$serie->nome}} 
                <span class="d-flex">
                    <a href="/series/{{$serie->id}}/temporadas" class="btn btn-info btn-sm mr-1">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>
                    <form method="POST" action="/series/{{$serie->id}}" onsubmit="return confirm('Tem certeza que deseja remover {{addslashes($serie->nome)}}?')">
                        @method('DELETE')
                        @csrf<!-- Geração de um token do laravel para previnir ataques POST -->
                        <button class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                </span>
            </li>
        @endforeach
    </ul>
@endsection
