<div class="form-group">
    <label for="inputNome">Nome</label>
    <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('nome', $estampa->nome)}}" >
    @error('nome')
        <div class="small text-danger">{{$message}}</div>
    @enderror

</div>

<div class="form-group">
    <label for="inputDescricao">Descrição</label>
    <input type="text" class="form-control" name="descricao" id="inputDescricao" value="{{old('descricao', $estampa->descricao)}}" >
    @error('descricao')
        <div class="small text-danger">{{$message}}</div>
    @enderror

</div>

<div class="form-group">
    @if (auth()->user()->tipo == 'A')
    <label for="inputCategoria">Categoria</label>
    <select class="custom-select" name="categoria_id" id="inputCategoria" aria-label="Categoria">
        <option value="" @isset($categoria){{'' == old('categoria', $categoria) ? 'selected' : ''}}@endisset>Sem Categoria</option>
        @foreach ($categorias as $id => $nome)
            <option value={{$id}} {{$id == $estampa->categoria_id ? 'selected' : ' '}}>{{$nome}}</option>
        @endforeach
    </select>
    @endif

</div>

<div class="form-group">
    <label for="inputImg">Upload da imagem</label>
    <input type="file" class="form-control" name="imagem_url" id="inputImg" >
    @error('imagem_url')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>


