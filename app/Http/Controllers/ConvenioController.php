<?php

// app/Http/Controllers/ConvenioController.php

// app/Http/Controllers/ConvenioController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Convenio;

class ConvenioController extends Controller
{
    public function index()
    {
        $convenios = Convenio::all();
        return view('convenios.index', compact('convenios'));
    }

    public function create()
    {
        return view('convenios.create');
    }

    public function store(Request $request)
    {
        $convenio = new Convenio();
        $convenio->ans_conv = $request->input('ans_conv');
        $convenio->nome_conv = $request->input('nome_conv');
        $convenio->save();

        return redirect()->route('convenios.index')->with('success', 'Convênio cadastrado com sucesso!');
    }
}