<?php

namespace App\Http\Controllers;


use App\Models\Encomenda;
use Illuminate\Http\Request;
use App\Http\Requests\EncomendaPost;

class EncomendaController extends Controller
{
    public function admin(Request $request)
    {
        $selectedID = $request->cliente_id ?? '';
        $qry = Encomenda::query();

        if (auth()->user()->tipo == 'A'){
            $encomendas = $qry->paginate(9);
            return view('encomendas.admin', compact('encomendas'));
        } elseif (auth()->user()->tipo == 'F') {
            $encomendas = $qry->paginate(9);
            return view('encomendas.admin', compact('encomendas', 'selectedID'))->with('estado', $encomendas->estado == 'pendente' || $encomendas->estado == 'fechada');
        } elseif (auth()->user()->tipo == 'C') {
            $encomendas = $qry->paginate(9);
            return view('encomendas.admin', compact('encomendas', 'selectedID'))->with('cliente_id', auth()->user()->id);
        }
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
        //criar encomenda
        $encomenda = new Encomenda;
        $encomenda->fill($request->validated());

        if (auth()->user()->tipo == 'C'){
            $encomenda->cliente_id = auth()->user()->id;
            $encomenda->preco_total = 0;
        }

        $encomenda->save();

        //criar tshirts para cada item do carrinho

        return redirect()->route('admin.encomendas')
            ->with('alert-msg', 'Encomenda nº "' . $encomenda->id . '" foi criada com sucesso!')
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
            ->with('alert-msg', 'Encomenda "' . $encomenda->id . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }
}
