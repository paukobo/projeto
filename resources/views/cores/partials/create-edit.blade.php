<div class="form-group">
    <label for="inputNome">Nome</label>
    <input type="text" class="form-control" name="nome" id="inputNome" value="{{ old('nome', $cor->nome) }}" >
    @error('nome')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputCod">Código</label>
    <input type="text" class="form-control" name="codigo" id="inputCod" value="{{ old('codigo', $cor->codigo) }}" >
    @error('codigo')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
