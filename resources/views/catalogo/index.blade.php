@extends('layout1')
@section('title','Catalogo Magic Shirts' )
@section('styles')
    <link href="{{ asset('css/catalogo.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="col-9">
        <a href="{{route('admin.catalogo.estampas.create')}}" class="btn mr-2 center catalogo">Criar Estampa</a>
        <form method="GET" action="{{route('catalogo.index')}}" class="form-group">
                <label for="inputCategoria">Categoria</label>
                <select class="custom-select" name="categoria" id="inputCategoria" aria-label="Categoria">
                    <option value="" {{'' == old('categoria', $categoria) ? 'selected' : ''}}>Todas Categorias</option>
                    @foreach ($categorias as $id => $nome)
                    <option value={{$id}} {{$id == $categoria ? 'selected' : ''}}>{{$nome}}</option>
                    @endforeach
                </select>
                <label for="search">Procurar:</label>
                <input type="text" class="form-control" name="search" id="search" value="{{Request::input('search')}}">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary catalogo" type="submit">Filtrar</button>
                </div>
        </form>
    </div>
    <div>
        <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
            <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                @foreach ($estampas as $estampa)
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-header d-flex justify-content-center">
                                <img src="{{$estampa->cliente_id ? route('imagemEstampa', $estampa) : asset('storage/estampas/' .$estampa->imagem_url)}}" class="card-img-top estampa-img" alt="{{$estampa->nome}}">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{$estampa->nome}}</h5>
                                <p class="card-text">{{$estampa->descricao}}</p>
                                <a href="#" class="btn mr-2 center catalogo">Check offer</a>

                                @if ($estampa->cliente)
                                <a href="{{ route('admin.catalogo.estampas.edit', $estampa) }}" class="btn btn-warning btn-sm" role="button" aria-pressed="true">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <form class="d-inline" action="{{ route('admin.catalogo.estampas.destroy', $estampa) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{ $estampas->withQueryString()->links() }}
</div>

@endsection
