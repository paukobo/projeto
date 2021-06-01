<div class="form-group">
    <label for="inputAbr">Nome</label>
    <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('nome', $categoria->nome)}}" >
    @error('nome')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>


