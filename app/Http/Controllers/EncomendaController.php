<?php

namespace App\Http\Controllers;


use App\Models\Tshirt;
use App\Models\Carrinho;
use App\Models\Encomenda;
use Illuminate\Http\Request;
use App\Http\Requests\TshirtPost;
use App\Http\Requests\EncomendaPost;

class EncomendaController extends Controller
{
    public function admin(Request $request)
    {
        $encomenda = $request->cliente_id ?? '';
        $estado = $request->estado ?? '';
        $search = $request->search ?? '';

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

            if($search){
                $qry = $qry->where('id','like', $search)->orwhere('id','like', $search);
            }

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
    public function create(Request $request)
    {

        $carrinho = $request->session()->get('carrinho', []);

        if ($carrinho == null) {
            return redirect()->route('carrinho.index')
            ->with('alert-msg', 'A encomenda não foi criada pois o carrinho está vazio!')
            ->with('alert-type', 'danger');
        }

        $encomenda = new Encomenda;

        if (auth()->user()->tipo == 'C'){
            $encomenda->cliente_id = auth()->user()->id;

            foreach ($carrinho as $cart) {
                $encomenda->preco_total += ($cart['qtd'] * $cart['preco_un']);
            }

        }


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
        $carrinho = session('carrinho', null);

        if ($carrinho == null) {
            return redirect()->route('carrinho.index')
            ->with('alert-msg', 'Não foram criadas encomendas pois o carrinho está vazio!')
            ->with('alert-type', 'danger');
        }

        //criar encomenda
        $encomenda = new Encomenda;
        $encomenda->fill($request->validated());

        if (auth()->user()->tipo == 'C'){
            $encomenda->cliente_id = auth()->user()->id;

            foreach ($carrinho as $cart) {
                $encomenda->preco_total += ($cart['qtd'] * $cart['preco_un']);
            }
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

    public function updateEstado(EncomendaPost $request, Encomenda $encomenda)
    {
        $encomenda->fill($request->validated());
        if (auth()->check() && auth()->user()->tipo == 'F'){
            if ($encomenda->estado == 'paga'){
                $encomenda->estado = 'fechada';
            }

            if ($encomenda->estado == 'pendente'){
                $encomenda->estado = 'paga';
            }
        }

        $encomenda->save();
        return redirect()->route('admin.encomendas')
            ->with('alert-msg', 'Estado da Encomenda nº "' . $encomenda->id . '" foi alterado com sucesso para "' . $encomenda->estado . "'!'")
            ->with('alert-type', 'success');
    }
}
