<?php

namespace App\Http\Controllers;


use App\Models\Encomenda;
use Illuminate\Http\Request;
use App\Http\Requests\EncomendaPost;

class EncomendaController extends Controller
{
    public function admin(Request $request)
    {
        $encomenda = $request->cliente_id ?? '';
        $estado = $request->estado ?? '';
        $qry = Encomenda::query();

        if(auth()->check() && auth()->user()->tipo == 'C'){

            $qry = $qry->where('cliente_id', auth()->user()->id)->orwhere('cliente_id', null);

            if($encomenda){
                $qry =  $qry->where([['cliente_id', $encomenda]]);
            }

            $encomendas = $qry->paginate(10);

            return view('encomendas.admin', compact('encomendas', 'encomenda'));
        }

        if (auth()->check() && auth()->user()->tipo == 'A') {

            $encomendas = $qry->paginate(10);
            return view('encomendas.admin', compact('encomendas', 'encomenda'));
        }

        if (auth()->check() && auth()->user()->tipo == 'F') {

            $qry = $qry->where('estado', 'pendente')->orwhere('estado', 'paga');

            if ($estado) {
                $qry =  $qry->where([['estado', $estado]]);
            }

            $encomendas = $qry->paginate(10);

            return view('encomendas.admin', compact('encomendas', 'estado'));
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
            $encomenda->preco_total = 10;
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
     * @param  \App\Models\Encomenda  $encomenda
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
