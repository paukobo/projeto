<?php

namespace App\Http\Controllers;

use App\Models\Cor;
use App\Models\Tshirt;
use App\Models\Estampa;
use App\Models\Carrinho;
use App\Models\Preco;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;



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

    // public function store_Tshirt(Request $request, Tshirt $tshirt)
    // {
    //     $carrinho = $request->session()->get('carrinho', []);
    //     $qtd = ($carrinho[$tshirt->id]['qtd'] ?? 0) + 1;
    //     $carrinho[$tshirt->id] = [
    //         'id' => $tshirt->id,
    //         'qtd' => $qtd,
    //         'estampa_id' => $tshirt->estampa_id,
    //         'cor_codigo' => $tshirt->cor_codigo,
    //         'tamanho' => $tshirt->tamanho,
    //         'preco_un' => $tshirt->preco_un,
    //     ];
    //     $request->session()->put('carrinho', $carrinho);
    //     return back()
    //         ->with('alert-msg', 'Foi adicionada uma tshirt "' . $tshirt->id . '" ao carrinho! Quantidade de tshirts = ' .  $qtd)
    //         ->with('alert-type', 'success');
    // }

    public function update_Tshirt(Request $request)
    {
        $carrinho = $request->session()->get('carrinho', []);
        // dd($carrinho);
        $key = $request->estampa."_".$request->cor."_".$request->tamanho;
        // dd($key);
        $qtd = $carrinho[$key]['qtd'] ?? 0;
        $qtd += $request->quantidade;
        if ($request->quantidade < 0) {
            $msg = 'Foram removidas ' . $request->quantidade . ' tshirts! Quantidade de inscrições atuais = ' .  $qtd;
        } elseif ($request->quantidade > 0) {
            $msg = 'Foram adicionadas ' . $request->quantidade . ' tshirts! Quantidade de tshirts atuais = ' .  $qtd;
        }
        if ($qtd <= 0) {
            unset($carrinho[$key]);
            $msg = 'Foram removidas todas as tshirts!';
        } else {
            $precos = Preco::first();
            if($qtd > 5){
                $subtotal = ($precos->preco_un_catalogo_desconto * $qtd);
            }else{
                $subtotal = ($precos->preco_un_catalogo * $qtd);
            }
            $carrinho[$key]['qtd'] = $qtd;
            $carrinho[$key]['subtotal'] = $subtotal;
        }
        $request->session()->put('carrinho', $carrinho);
        return back()
            ->with('alert-msg', $msg)
            ->with('alert-type', 'success');
    }


    public function destroy_Tshirt(Request $request)
    {
        $carrinho = $request->session()->get('carrinho', []);
        //dd($carrinho);
        // $key = $carrinho->getKey($item['estampa'],$item['cor'],$item['tamanho']);
        $key = $request->estampa."_".$request->cor."_".$request->tamanho;
        //dd($key);
        if (isset($key, $carrinho)) {
            unset($carrinho[$key]);
            $request->session()->put('carrinho', $carrinho);
            return back()
                ->with('alert-msg', 'Foram removidas todas as tshirts')
                ->with('alert-type', 'success');
        }
        return back()
            ->with('alert-msg', 'A tshirt não existe no carrinho!')
            ->with('alert-type', 'warning');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.encomendas.create');
    }

    public function destroy(Request $request)
    {
        $request->session()->forget('carrinho');
        return back()
            ->with('alert-msg', 'Carrinho foi limpo!')
            ->with('alert-type', 'danger');
    }

    public function adicionarCarrinho(Request $request)
    {
        $estampa = Estampa::findOrFail($request->id);

        $cor = Cor::findOrFail($request->cor);
        $tamanho = $request->tamanho;
        if (!in_array ($tamanho,['XS','S','M','L', 'XL'])){
            return redirect()->back()
            ->with('alert-msg', 'Tamanho invalido!')
            ->with('alert-type', 'danger');
        }

        $qtd = $request->quantidade;
        if($qtd < 1  || $qtd > 99){
            return redirect()->back()
                ->with('alert-msg', 'Quantidade invalida!')
                ->with('alert-type', 'danger');
        }

        $antCarrinho = $request->session()->get('carrinho');
        $carrinho = new Carrinho($antCarrinho);
        $carrinho->add($estampa, $cor, $tamanho, $qtd);
        $request->session()->put('carrinho', $carrinho);
        //dd($request->session()->get('carrinho'));
        return redirect()->back()
            ->with('alert-msg', 'Tshirt adicionada ao carrinho!')
            ->with('alert-type', 'success');
    }
}
