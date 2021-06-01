<div class="form-group">
    <label for="inputAbr">Nome</label>
    <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('nome', $cor->nome)}}" >
    @error('nome')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputCodigoCor">Código Cor</label>
    <input type="text" class="form-control" name="codigo_cor" id="inputCodigoCor" value="{{old('codigo_cor', $cor->cor_codigo)}}" >
    @error('codigo_cor')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

