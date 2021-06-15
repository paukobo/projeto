<?php

namespace App\Models;

use App\Models\Preco;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Type\Integer;

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
        $key = (string)$estampa->id.'_'.(string)$cor->codigo.'_'.(string)$tamanho;
        $storedItem = ['qtd' => 0, 'preco_un' => 0 , 'cor' => $cor->codigo, 'estampa' => $estampa->id, 'subtotal' => 0, 'tamanho' => $tamanho];
        if ($this->items) {
            if (array_key_exists($key, $this->items)) {
                $storedItem = $this->items[$key];

            }
        }
        $this->quantTotal -= $storedItem['qtd'];
        $this->precoTotal -=  $storedItem['subtotal'];
        $storedItem['qtd'] += $qtd;
        $storedItem['preco_un'] = $this->getPreco($qtd, $estampa->cliente_id != null);
        $storedItem['subtotal'] = $storedItem['preco_un'] * $qtd;
        $this->items[$key] = $storedItem;
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
