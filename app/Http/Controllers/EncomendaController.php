<?php

namespace App\Http\Controllers;


use App\Models\Cor;
use App\Models\Tshirt;
use App\Models\Estampa;
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
        $searchEstado = $request->searchEstado ?? '';
        $searchCliente = $request->searchCliente ?? '';
        $searchData = $request->searchData ?? '';

        $qry = Encomenda::query();

        if (auth()->check() && auth()->user()->tipo == 'C') {

            $qry = $qry->where('cliente_id', auth()->user()->id)->orwhere('cliente_id', null);

            if ($encomenda) {
                $qry =  $qry->where([['cliente_id', $encomenda]]);
            }

            $encomendas = $qry->paginate(10);

            return view('encomendas.admin', compact('encomendas', 'encomenda'));
        }

        if (auth()->check() && auth()->user()->tipo == 'A') {

            if ($searchEstado) {
                $qry = $qry->where('estado', 'like', $searchEstado)->orwhere('estado', 'like', $searchEstado);
            }

            if ($searchCliente) {
                $qry = $qry->where('cliente_id', 'like', $searchCliente)->orwhere('cliente_id', 'like', $searchCliente);
            }

            if ($searchData) {
                $qry = $qry->where('data', 'like', $searchData)->orwhere('data', 'like', $searchData);
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

    public function verTshirtsEncomendas(Encomenda $encomenda)
    {
        $qry = Tshirt::query();

        $qry = $qry->where('encomenda_id', $encomenda->id);

        $encomendas = $qry->paginate(10);

        return view('encomendas.verTshirtsEncomenda', compact('encomendas', 'encomenda'));

    }

    public function create(Request $request)
    {

        $carrinho = $request->session()->get('carrinho');
        //dd($carrinho);

        if ($carrinho == null) {
            return redirect()->route('carrinho.index')
                ->with('alert-msg', 'A encomenda não foi criada pois o carrinho está vazio!')
                ->with('alert-type', 'danger');
        }


        if (auth()->check() && auth()->user()->tipo == 'C') {
            $encomenda = new Encomenda();

            $encomenda->cliente_id = auth()->user()->id;
            $encomenda->preco_total += $carrinho->precoTotal;
            return view('encomendas.create', compact('encomenda'));
        }
        else if ((auth()->check() && auth()->user()->tipo == 'A') || (auth()->check() && auth()->user()->tipo == 'F')){
            return redirect()->route('carrinho.index')
                ->with('alert-msg', 'Não foram criadas encomendas pois o seu user não é cliente!')
                ->with('alert-type', 'danger');
        }
    }


    public function store(EncomendaPost $request)
    {
        $carrinho = session('carrinho', null);
        //dd($carrinho);

        if ($carrinho == null) {
            return redirect()->route('carrinho.index')
                ->with('alert-msg', 'Não foram criadas encomendas pois o carrinho está vazio!')
                ->with('alert-type', 'danger');
        }

        //criar encomenda
        $encomenda = new Encomenda();
        $encomenda->fill($request->validated());




        //criar tshirts através do carrinho

        if (auth()->user()->tipo == 'C') {
            $encomenda->cliente_id = auth()->user()->id;
            $encomenda->preco_total += $carrinho->precoTotal;
            $encomenda->save();
            foreach ($carrinho->items as $cart) {
                $tshirt = new Tshirt();
                $tshirt->encomenda_id = $encomenda->id;

                $tshirt->estampa_id = Estampa::query()->where('id', $cart['estampa'])->first()->id;
                $tshirt->cor_codigo = Cor::query()->where('codigo', $cart['cor'])->first()->codigo;

                $tshirt->tamanho = $cart['tamanho'];
                $tshirt->quantidade = $cart['qtd'];
                $tshirt->preco_un = $cart['preco_un'];
                $tshirt->subtotal = $cart['subtotal'];

                $tshirt->save();
            }
        }

        $request->session()->forget('carrinho');
        return redirect()->route('admin.encomendas')
            ->with('alert-msg', 'Encomenda nº "' . $encomenda->id . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }


    public function edit(Encomenda $encomenda)
    {
        return view('encomendas.edit', compact('encomenda'));
    }


    public function update(EncomendaPost $request, Encomenda $encomenda)
    {
        $encomenda->fill($request->validated());
        $encomenda->save();
        return redirect()->route('admin.encomendas')
            ->with('alert-msg', 'Encomenda "' . $encomenda->id . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }
}
