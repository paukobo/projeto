<div class="form-group">
    <label for="inputName">Name</label>
    <input type="text" class="form-control" name="name" id="inputName" value="{{old('name', $cliente->user->name)}}" >
    @error('name')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputName">E-mail</label>
    <input type="text" class="form-control" name="email" id="inputEmail" value="{{old('email', $cliente->user->email)}}" >
    @error('email')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputNif">Nif</label>
    <input type="text" class="form-control" name="nif" id="inputNif" value="{{old('nif', $cliente->nif)}}" >
    @error('nif')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputEndereco">Endereço</label>
    <input type="text" class="form-control" name="endereco" id="inputEndereco" value="{{old('endereco', $cliente->endereco)}}" >
    @error('endereco')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputTipoPagam">Tipo de Pagamento (por omissão)</label>
    <select class="form-control" name="tipo_pagamento" id="inputTipoPagam">
        {{-- @foreach ($tipos_pagam as $abr => $nome)
            <option value={{$abr}} {{$abr == old('tipo_pagam', $aluno->tipo_pagam) ? 'selected' : ''}}>{{$nome}}</option>
        @endforeach --}}

        <option value="VISA">VISA</option>
        <option value="MC">MC</option>
        <option value="PAYPAL">PAYPAL</option>
    </select>
    @error('tipo_pagamento')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputRefPagam">Referência de Pagamento (por omissão)</label>
    <input type="text" class="form-control" name="ref_pagamento" id="inputRefPagam" value="{{old('refPagam', $cliente->ref_pagamento)}}" >
    @error('refPagam')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputFoto">Upload da Foto</label>
    <input type="file" class="form-control" name="foto" id="inputFoto">
    @error('foto')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
