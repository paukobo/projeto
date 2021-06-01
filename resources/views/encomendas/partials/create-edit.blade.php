<div class="form-group">
    <label for="inputID">ID Encomenda</label>
    <input type="text" class="form-control" name="id" id="inputID" value="{{old('id', $encomenda->id)}}" >
    @error('id')
        <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputEstado">Estado</label>
    <input type="text" class="form-control" name="estado" id="inputEstado" value="{{old('estado', $encomenda->estado)}}" >
    @error('estado')
        <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputClienteID">ID Cliente</label>
    <input type="text" class="form-control" name="id_cliente" id="inputClienteID" value="{{old('id_cliente', $encomenda->cliente_id)}}" >
    @error('cliente_id')
        <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputData">Data Encomenda</label>
    <input type="text" class="form-control" name="data" id="inputData" value="{{old('data', $encomenda->data)}}" >
    @error('data')
        <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputPrecoTotal">Preço Total</label>
    <input type="text" class="form-control" name="precoTotal" id="inputPrecoTotal" value="{{old('precoTotal', $encomenda->preco_total)}}" >
    @error('preco_total')
        <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputNotas">Notas</label>
    <input type="text" class="form-control" name="notas" id="inputNotas" value="{{old('notas', $encomenda->notas)}}" >
    @error('notas')
        <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputNIF">NIF</label>
    <input type="text" class="form-control" name="nif" id="inputNIF" value="{{old('nif', $encomenda->nif)}}" >
    @error('nif')
        <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputEndereco">Endereço</label>
    <input type="text" class="form-control" name="endereco" id="inputEndereco" value="{{old('endereco', $encomenda->endereco)}}" >
    @error('endereco')
        <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputTipoPagamento">Tipo de Pagamento</label>
    <input type="text" class="form-control" name="tipo_pagamento" id="inputTipoPagamento" value="{{old('tipo_pagamento', $encomenda->tipo_pagamento)}}" >
    @error('tipo_pagamento')
        <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputRefPagamento">Referência de Pagamento</label>
    <input type="text" class="form-control" name="ref_pagamento" id="inputRefPagamento" value="{{old('ref_pagamento', $encomenda->ref_pagamento)}}" >
    @error('ref_pagamento')
        <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputURLrecibo">URL Recibo</label>
    <input type="text" class="form-control" name="recibo_url" id="inputURLrecibo" value="{{old('recibo_url', $encomenda->recibo_url)}}" >
    @error('recibo_url')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>


