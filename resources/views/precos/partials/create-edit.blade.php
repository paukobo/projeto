<div class="form-group">
    <label for="inputAbr">Valor</label>
    <input type="text" class="form-control" name="id" id="inputValor" value="{{old('id', $preco->id)}}" >
    @error('id')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>


