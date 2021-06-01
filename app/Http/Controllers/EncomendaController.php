<?php

namespace App\Http\Controllers;


use App\Models\Encomenda;
use Illuminate\Http\Request;
use App\Http\Requests\EncomendaPost;

class EncomendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $encomendas = Encomenda::all();
        return view('categorias.index', compact('categorias'));
    }

    public function admin(Request $request)
    {
        $selectedNome = $request->nome ?? '';
        $qry = Encomenda::query();
        if ($selectedNome) {
            $qry->where('nome', $selectedNome);
        }
        $encomendas = $qry->paginate(7);
        return view('encomendas.admin', compact('encomendas', 'selectedNome'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $encomenda = new Encomenda();
        return view('encomendas.create', compact('encomenda'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EncomendaPost $request)
    {
        $encomenda = new Encomenda();
        $encomenda->fill($request->validated());
        $encomenda->save();
        return redirect()->route('admin.encomendas')
            ->with('alert-msg', 'Encomenda "' . $encomenda->nome . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Encomenda $encomenda)
    {
        return view('encomendas.edit', compact('encomenda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Encomenda  $encomenda
     * @return \Illuminate\Http\Response
     */
    public function update(EncomendaPost $request, Encomenda $encomenda)
    {
        $encomenda->fill($request->validated());
        $encomenda->save();
        return redirect()->route('admin.encomendas')
            ->with('alert-msg', 'Encomenda "' . $encomenda->nome . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Encomenda $encomenda)
    {
        $oldName = $encomenda->nome;

        $encomenda->delete();
        return redirect()->route('admin.encomendas')
            ->with('alert-msg', 'Encomenda "' . $oldName . '" foi apagada com sucesso!')
            ->with('alert-type', 'success');
    }
}
