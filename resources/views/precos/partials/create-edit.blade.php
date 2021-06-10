<div class="form-group">
    <label for="inputPrecoUnC">Preço Unitário Catálogo</label>
    <input type="number" step="0.01" min=0 class="form-control" name="preco_un_catalogo" id="inputPrecoUnC" value="{{old('preco_un_catalogo', $preco->preco_un_catalogo)}}" >
    @error('preco_un_catalogo')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputPrecoUnP">Preço Unitário Próprio</label>
    <input type="number" step="0.01" min=0 class="form-control" name="preco_un_proprio" id="inputPrecoUnP" value="{{old('preco_un_proprio', $preco->preco_un_proprio)}}" >
    @error('preco_un_proprio')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputPrecoUnCdesc">Preço Unitário Catálogo com Desconto</label>
    <input type="number" step="0.01" min=0 class="form-control" name="preco_un_catalogo_desconto" id="inputPrecoUnCdesc" value="{{old('preco_un_catalogo_desconto', $preco->preco_un_catalogo_desconto)}}" >
    @error('preco_un_catalogo_desconto')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputPrecoUnC">Preço Unitário Próprio com Desconto</label>
    <input type="number" step="0.01"step="0.01" min=0 class="form-control" name="preco_un_proprio_desconto" id="inputPrecoUnPdesc" value="{{old('preco_un_proprio_desconto', $preco->preco_un_proprio_desconto)}}" >
    @error('preco_un_proprio_desconto')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputPrecoUnC">Quantidade de Desconto</label>
    <input type="number" step="0.01" min=0 class="form-control" name="quantidade_desconto" id="inputQuantDesc" value="{{old('quantidade_desconto', $preco->quantidade_desconto)}}" >
    @error('quantidade_desconto')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>


