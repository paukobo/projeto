<?php

namespace App\Http\Controllers;

use App\Models\Tshirt;
use Illuminate\Http\Request;


class CarrinhoController extends Controller
{

    public function admin(Request $request)
    {
        return view('carrinho.admin')
            ->with('pageTitle', 'Carrinho de compras')
            ->with('carrinho', session('carrinho') ?? []);
    }

    public function index(Request $request)
    {
        return view('carrinho.index')
            ->with('pageTitle', 'Carrinho de compras')
            ->with('carrinho', session('carrinho') ?? []);
    }

    public function store_Tshirt(Request $request, Tshirt $tshirt)
    {
        $carrinho = $request->session()->get('carrinho', []);
        $qtd = ($carrinho[$tshirt->id]['qtd'] ?? 0) + 1;
        $carrinho[$tshirt->id] = [
            'id' => $tshirt->id,
            'qtd' => $qtd,
            'encomenda_id' => $tshirt->encomenda_id,
            'estampa_id' => $tshirt->estampa_id,
            'cor_codigo' => $tshirt->cor_codigo,
            'preco_un' => $tshirt->preco_un,
            'preco_total' => $tshirt->preco_un * $qtd,
        ];
        $request->session()->put('carrinho', $carrinho);
        return back()
            ->with('alert-msg', 'Foi adicionada uma tshirt "' . $tshirt->id . '" ao carrinho! Quantidade de tshirts = ' .  $qtd)
            ->with('alert-type', 'success');
    }

    public function update_Tshirt(Request $request, Tshirt $tshirt)
    {
        $carrinho = $request->session()->get('carrinho', []);
        $qtd = $carrinho[$tshirt->id]['qtd'] ?? 0;
        $qtd += $request->quantidade;
        if ($request->quantidade < 0) {
            $msg = 'Foram removidas ' . -$request->quantidade . ' tshirts "' . $tshirt->id . '"! Quantidade de tshirts atuais = ' .  $qtd;
        } elseif ($request->quantidade > 0) {
            $msg = 'Foram adicionadas ' . $request->quantidade . ' tshirts "' . $tshirt->id . '"! Quantidade de tshirts atuais = ' .  $qtd;
        }
        if ($qtd <= 0) {
            unset($carrinho[$tshirt->id]);
            $msg = 'Foram removidas todas as tshirts "' . $tshirt->id . '"';
        } else {
            $carrinho[$tshirt->id] = [
                'id' => $tshirt->id,
                'qtd' => $qtd,
                'encomenda_id' => $tshirt->encomenda_id,
                'estampa_id' => $tshirt->estampa_id,
                'cor_codigo' => $tshirt->cor_codigo,
                'preco_un' => $tshirt->preco_un,
                'preco_total' => $tshirt->preco_un * $qtd,
            ];
        }
        $request->session()->put('carrinho', $carrinho);
        return back()
            ->with('alert-msg', $msg)
            ->with('alert-type', 'success');
    }

    public function destroy_Tshirt(Request $request, Tshirt $tshirt)
    {
        $carrinho = $request->session()->get('carrinho', []);
        if (array_key_exists($tshirt->id, $carrinho)) {
            unset($carrinho[$tshirt->id]);
            $request->session()->put('carrinho', $carrinho);
            return back()
                ->with('alert-msg', 'Foram removidas todas as tshirts "' . $tshirt->id . '"')
                ->with('alert-type', 'success');
        }
        return back()
            ->with('alert-msg', 'A tshirt "' . $tshirt->id . '" já não estava no carrinho!')
            ->with('alert-type', 'warning');
    }

    public function store(Request $request)
    {
        dd(
            'Place code to store the shopping cart / transform the cart into a sale',
            $request->session()->get('carrinho')
        );
    }

    public function destroy(Request $request)
    {
        $request->session()->forget('carrinho');
        return back()
            ->with('alert-msg', 'Carrinho foi limpo!')
            ->with('alert-type', 'danger');
    }
}


/*
public function adicionarCarrinho(Request $request)
{
    $estampa = Estampa::find($request->id);
    $cor = Cor::find($request->cor);
    $antCarrinho = session('carrinho', null);
    $carrinho = new Carrinho($antCarrinho);
    $carrinho->add(estampa, cor, )
    session(['carrinho' => carrinho]);
}




*/
