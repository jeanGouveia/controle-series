<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistroController extends Controller
{
    public function create(){
        return view('registro.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $user = User::create($data);

        Auth::login($user);

        return redirect()->route('series.index');
    }

}
