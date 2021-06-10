<?php

namespace App;

use App\Models\Preco;

class Carrinho
{
    public $items = null;
    public $quantTotal = 0;
    public $precoTotal = 0;

    // reconstroi o carrinho antigo baseando se num carrinho antigo (caso algo se perca)
    public function __construct($oldCart)
    {
        if  ($oldCart){
            $this->items = $oldCart->items;
            $this->quantTotal = $oldCart->quantTotal;
            $this->precoTotal = $oldCart->precoTotal;
        }
    }

    // adicionar um item novo (está constantemente a dar overwrite pq
    // só quero guardar cada produto 1 vez (só preciso da informação 1 vez))
    public function add($estampa, $cor, $tamanho, $qtd)
    {
        $id = $estampa->id . '_' . $cor->codigo . '_' . $tamanho;
        $storedItem = ['qtd' => 0, 'preco_un' => 0 , 'cor' => $cor, 'estampa' => $estampa, 'subtotal' => 0, 'tamanho' => $tamanho];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $this->quantTotal-= $storedItem['qtd'];
        $this->precoTotal -=  $storedItem['subtotal'];
        $storedItem['qtd'] += $qtd;
        $storedItem['preco_un'] = $this->getPreco($qtd, $estampa->cliente_id != null);
        $storedItem['subtotal'] = $storedItem['preco_un'] * $qtd;
        $this->items[$id] = $storedItem;
        $this->quantTotal+=$qtd;
        $this->precoTotal +=  $storedItem['subtotal'];
    }

    public function getPreco($qty, $cliente){

        $preco = Preco::first();
        if ($qty < $preco->quantidade_desconto){
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
