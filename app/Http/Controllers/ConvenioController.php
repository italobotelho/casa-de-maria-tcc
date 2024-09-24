<?php

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

    public function destroy($pk_id_conv)
    {
        $convenio = Convenio::find($pk_id_conv);
        $convenio->delete();
        return redirect()->route('convenios.index')->with('success', 'Convênio excluído com sucesso!');
    }

    public function edit($pk_id_conv)
    {
        $convenio = Convenio::find($pk_id_conv);
        return view('convenios.edit', compact('convenio'));
    }

    public function update(Request $request, $pk_id_conv)
    {
        $convenio = Convenio::where('pk_id_conv', $pk_id_conv)->first();
        $convenio->fill($request->all());
        $convenio->save();
        return redirect()->route('convenios.index')->with('success', 'Convênio atualizado com sucesso!');
    }
}