<?php

namespace App;

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
    public function add($item, $id)
    {
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->quantTotal++;
        $this->precoTotal += $item->price;
    }
}

/*
public function add($estampa, $cor, $qtd, $tamanho)
{
    $id = $estampa->id . "_" . $cor_codigo . "_" $tamanho;
    $storedItem = ['qtd' => 0, 'cor' => 0,'estampa' => 0,'tamanho' => 0,'qtd' => 0]
    if ($this->items) {
        if (array_key_exists($id, $qtd))
    }

    $storedItem['qtd'] = $qtd;
    ...
}



public function getPrecoUnitario($qtd, $proprio)
{
    $preco = Preco::first();
    if ($qtd < $preco->quantidade_desconto)
}






*/
