<div class="form-group">

    <input type="hidden" class="form-control" name="encomenda_id" id="inputEncomendaID" value="{{old('encomenda_id', ($tshirt->encomenda_id))}}" >

    <input type="hidden" class="form-control" name="estampa_id" id="inputEstampaID" value="{{old('estampa_id', ($tshirt->estampa_id))}}" >

    <input type="hidden" class="form-control" name="cor_codigo" id="inputCorCodigo" value="{{old('cor_codigo', ($tshirt->cor_codigo))}}" >

    <label for="inputTamanho">Tamanho</label>
    <input type="text" class="form-control" name="tamanho" id="inputTamanho" value="{{old('tamanho', $tshirt->tamanho)}}" >
    @error('tamanho')
        <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputQuantidade">Quantidade</label>
    <input type="number" class="form-control" name="quandidade" id="inputQuantidade" value="{{old('quantidade', $tshirt->quantidade)}}" >
    @error('quantidade')
        <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputPrecoUnidade">Preço Unidade</label>
    <input type="text" class="form-control" name="precoUnidade" id="inputPrecoUnidade" value="{{old('precoUnidade', $tshirt->preco_un)}}" disabled >
    @error('preco_un')
        <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputSubtotal">Subtotal</label>
    <input type="number" class="form-control" name="subtotal" id="inputSubtotal" value="{{old('subtotal', $tshirt->subtotal)}}" >
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


