<div class="form-group"></div>

    <label for="inputQuantidade">Quantidade</label>
    <input type="number" class="form-control" name="quantidade" id="inputQuantidade" value="{{old('quantidade', $tshirt->quantidade??1)}}" >
    @error('quantidade')
        <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputTamanho">Tamanho</label>
    <input type="text" class="form-control" name="tamanho" id="inputTamanho" value="{{old('tamanho', $tshirt->tamanho??'S')}}" >
    @error('tamanho')
        <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputCor">Cor</label>
    <input type="text" class="form-control" name="cor_codigo" id="inputCor" value="{{old('cor_codigo', $tshirt->cor_codigo??'000000')}}" >
    @error('cor_codigo')
        <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputPrecoUnidade">Preço Unidade</label>
    <input type="number" class="form-control" name="preco_un" id="inputPrecoUnidade" value="{{old('preco_un', $tshirt->preco_un??'10')}}" >
    @error('preco_un')
        <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputSubtotal">Subtotal</label>
    <input type="number" class="form-control" name="subtotal" id="inputSubtotal" value="{{old('subtotal', ($tshirt->preco_un * $tshirt->quantidade))}}" disabled>
    @error('subtotal')
        <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputEndereco">Endereço</label>
    <input type="text" class="form-control" name="endereco" id="inputEndereco" value="{{old('endereco', $encomenda->endereco??auth()->user()->cliente->endereco)}}" >
    @error('endereco')
        <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputTipoPagamento">Tipo de Pagamento</label>
    <input type="text" class="form-control" name="tipo_pagamento" id="inputTipoPagamento" value="{{old('tipo_pagamento', $encomenda->tipo_pagamento??auth()->user()->cliente->tipo_pagamento)}}" >
    @error('tipo_pagamento')
        <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputRefPagamento">Referência de Pagamento</label>
    <input type="text" class="form-control" name="ref_pagamento" id="inputRefPagamento" value="{{old('ref_pagamento', $encomenda->ref_pagamento??auth()->user()->cliente->ref_pagamento)}}" >
    @error('ref_pagamento')
        <div class="small text-danger">{{$message}}</div>
    @enderror

</div>


