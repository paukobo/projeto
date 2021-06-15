<?php

namespace App\Models;

use App\Models\Preco;
use Illuminate\Database\Eloquent\Model;

class Carrinho
{
    public $items;
    public $quantTotal = 0;
    public $precoTotal = 0;

    public function __construct($antCarrinho){
        if ($antCarrinho) {
            $this->items = $antCarrinho->items;
            $this->quantTotal = $antCarrinho->quantTotal;
            $this->precoTotal = $antCarrinho->precoTotal;
        }
    }


    //adicionar um item novo (está constantemente a dar overwrite pq
    //só quero guardar cada produto 1 vez (só preciso da informação 1 vez))
    public function add($estampa, $cor, $tamanho, $qtd)
    {
        $id = $estampa->id . '_' . $cor->codigo . '_' . $tamanho;
        $storedItem = ['qtd' => 0, 'preco_un' => 0 , 'cor' => $cor, 'estampa' => $estampa, 'subtotal' => 0, 'tamanho' => $tamanho];
        dd($storedItem);
        if ($this->items) {
            if (array_key_exists($estampa, $cor, $tamanho, $qtd, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $this->quantTotal-= $storedItem['qtd'];
        $this->precoTotal -=  $storedItem['subtotal'];
        $storedItem['qtd'] += $qtd;
        $storedItem['preco_un'] = $this->getPreco($qtd, $estampa->cliente_id != null);
        $storedItem['subtotal'] = $storedItem['preco_un'] * $qtd;
        $this->items[$id] = $storedItem;
        $this->quantTotal += $qtd;
        $this->precoTotal +=  $storedItem['subtotal'];
    }

    public function getPreco($qtd, $cliente){

        $preco = Preco::first();
        if ($qtd < $preco->quantidade_desconto){
            if ($cliente){
                return $preco->preco_un_proprio;
            }
            return $preco->preco_un_catalogo;
        }
        if ($cliente){
            return $preco->preco_un_proprio_desconto;
        }
        return $preco->preco_un_catalogo_desconto;
    }
}
