@extends('layout')

@section('cabecalho')
    Episódios 
@endsection

@section('conteudo')
    @include('mensagem', ['mensagem' => $mensagem])
    <form action="/temporadas/{{$temporada}}/episodios/assistir" method="post">
        @csrf
        <ul class="list-group">
            @foreach ($episodios as $episodio)
                <li class="list-group-item d-flex justify-content-between align-center">   
                    Episodio {{$episodio->numero}}
                    @auth
                        <input type="checkbox" name="episodios[]" 
                            value="{{$episodio->id}}"{{$episodio->assistido ? 'checked' : ''}}>    
                    @else
                        <input type="checkbox" disabled name="episodios[]" 
                            value="{{$episodio->id}}"{{$episodio->assistido ? 'checked' : ''}}>
                    @endauth
                </li>
            @endforeach
        </ul>
        @auth
            <button class="btn btn-primary mt-2" >Salvar</button>    
        @endauth
        
    </form>
@endsection