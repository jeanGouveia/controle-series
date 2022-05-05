<?php

namespace App\Http\Controllers;

use App\Serie;
use Illuminate\Http\Request;
use App\Services\CriadorDeSerie;
use App\Http\Requests\SeriesFormRequest;
use App\Services\RemovedorDeSerie;

class SeriesController extends Controller
{
    public function index(Request $request){
        $series = Serie::query()
            ->orderBy('nome')
            ->get();
            $mensagem = $request->session()->get('mensagem');
    
        return view('series.index', compact('series', 'mensagem'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(
        SeriesFormRequest $request, 
        CriadorDeSerie $criadorDeSerie)
    {
        $serie = $criadorDeSerie->criarSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->ep_por_temporada
        );
        $request->session()
            ->flash(
                'mensagem',
                "Série {$serie->nome} e suas temporadas e episódios criados com sucesso!"
            );

        return redirect()->route('series.index');
    }

    public function destroy(
        Request $request,
        RemovedorDeSerie $removedorDeSerie)
    {
        $nomeSerie = $removedorDeSerie->excluirSerie($request->id);
        $request->session()
            ->flash(
                'mensagem',
                "Série $nomeSerie removida com sucesso!"
            );

        return redirect()->route('series.index');
    }

    public function editaNome(int $id, Request $request)
    {
        $serie = Serie::find($id);
        $novoNome = $request->nome;
        $serie->nome = $novoNome;
        $serie->save();
    }
}