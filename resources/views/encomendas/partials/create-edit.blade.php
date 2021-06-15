<div class="form-group">

    @if(auth()->check() && auth()->user()->tipo == 'A')
        <div class="form-group">
            <label for="inputEstado">Estado</label>
            <select class="form-control" name="estado" id="inputEstado">
                <option {{old('estado', $encomenda->estado) == 'paga' ? 'selected' : ''}}>paga</option>
                <option {{old('estado', $encomenda->estado) == 'pendente' ? 'selected' : ''}}>pendente</option>
                <option {{old('estado', $encomenda->estado) == 'anulada' ? 'selected' : ''}}>anulada</option>
                <option {{old('estado', $encomenda->estado) == 'fechada' ? 'selected' : ''}}>fechada</option>
            </select>
            @error('estado')
                <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>
    @endif

    @if(auth()->check() && auth()->user()->tipo == 'F')
        @if ($encomenda->estado == 'paga')
            <div class="form-group">
                <label for="inputEstado">Estado</label>
                <select class="form-control" name="estado" id="inputEstado">
                    <option {{old('estado', $encomenda->estado) == 'paga' ? 'selected' : ''}}>paga</option>
                    <option {{old('estado', $encomenda->estado) == 'fechada' ? 'selected' : ''}}>fechada</option>
                </select>
                @error('estado')
                    <div class="small text-danger">{{$message}}</div>
                @enderror
            </div>
        @endif
        @if ($encomenda->estado == 'pendente')
            <div class="form-group">
                <label for="inputEstado">Estado</label>
                <select class="form-control" name="estado" id="inputEstado">
                    <option {{old('estado', $encomenda->estado) == 'pendente' ? 'selected' : ''}}>pendente</option>
                    <option {{old('estado', $encomenda->estado) == 'paga' ? 'selected' : ''}}>paga</option>
                </select>
                @error('estado')
                    <div class="small text-danger">{{$message}}</div>
                @enderror
            </div>
        @endif
    @endif



    <input type="hidden" class="form-control" name="cliente_id" id="inputClienteID" value="{{old('cliente_id', ($encomenda->cliente_id??auth()->user()->id))}}">

    <label for="inputData">Data Encomenda</label>
    <input type="text" class="form-control" name="data" id="inputData" value="{{old('data', $encomenda->data??date('Y-m-d'))}}">
    @error('data')
    <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputPrecoTotal">Preço Total</label>
    <input type="text" class="form-control" name="precoTotal" id="inputPrecoTotal" value="{{old('precoTotal', $encomenda->preco_total??($precoTotal??0))}}" disabled>
    @error('preco_total')
    <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputNotas">Notas</label>
    <input type="text" class="form-control" name="notas" id="inputNotas" value="{{old('notas', $encomenda->notas)}}">
    @error('notas')
    <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputNIF">NIF</label>
    <input type="text" class="form-control" name="nif" id="inputNIF" value="{{old('nif', $encomenda->nif??auth()->user()->cliente->nif)}}">
    @error('nif')
    <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputEndereco">Endereço</label>
    <input type="text" class="form-control" name="endereco" id="inputEndereco" value="{{old('endereco', $encomenda->endereco??auth()->user()->cliente->endereco)}}">
    @error('endereco')
    <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputTipoPagamento">Tipo de Pagamento</label>
    <input type="text" class="form-control" name="tipo_pagamento" id="inputTipoPagamento" value="{{old('tipo_pagamento', $encomenda->tipo_pagamento??auth()->user()->cliente->tipo_pagamento)}}">
    @error('tipo_pagamento')
    <div class="small text-danger">{{$message}}</div>
    @enderror

    <label for="inputRefPagamento">Referência de Pagamento</label>
    <input type="text" class="form-control" name="ref_pagamento" id="inputRefPagamento" value="{{old('ref_pagamento', $encomenda->ref_pagamento??auth()->user()->cliente->ref_pagamento)}}">
    @error('ref_pagamento')
    <div class="small text-danger">{{$message}}</div>
    @enderror

</div>
