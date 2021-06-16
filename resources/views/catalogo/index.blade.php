@extends('layout1')
@section('title','Catalogo Magic Shirts' )
@section('styles')
<link href="{{ asset('css/catalogo.css') }}" rel="stylesheet">
@endsection
@section('content')
@if (session('alert-msg'))
@include('partials.message')
@endif
@if ($errors->any())
@include('partials.errors-message')
@endif
<div id="overlay" class="tshirt-preview">
    <script src="{{asset('js/fabric.min.js')}}"></script>
    <div class="preview-body">
        <div class="preview-area">
            <div id="tshirt-div">
                <img id="tshirt-backgroundpicture" src="{{asset('storage/tshirt_base/transparent_tshirt.png')}}"/>
                <div id="drawingArea" class="drawing-area">
                    <div class="canvas-container">
                        <canvas id="tshirt-canvas" width="200" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="preview-options">
            <h3 id="estampaNome"></h3>
            <form method="POST" action="{{ route('carrinho.adicionarCarrinho') }}" class="form-group">
                @csrf
                <input type="hidden" id="inputId" name="id">
                <label for="inputQuantidade">Quantidade:</label>
                <input type="number" id="inputQuantidade" name="quantidade" min="1" max="99" value="1">
                <br>
                <label for="inputCor">Cor:</label>
                <select class="custom-select" name="cor" id="inputCor" aria-label="Cor">
                    @foreach ($cores as $nome => $codigo)
                        <option value={{$codigo}}>{{$nome}}</option>
                    @endforeach
                </select>
                <br>
                <label for="inputTamanho">Tamanho:</label>
                <select class="custom-select" name="tamanho" id="inputTamanho" aria-label="Tamanho">
                    @foreach ($tamanho as $tam)
                    <option value={{$tam}}>{{$tam}}</option>
                    @endforeach
                </select>
                <div class="input-group-append" style="padding-top: 15px">
                    <button type="submit" class="btn btn-outline-secondary catalogo" name="ok">Adicionar ao Carrinho</button>
                </div>
            </form>
        </div>
    </div>
    <div class="preview-background" onclick="off()"></div>
</div>

<div class="col-9">
    <form method="GET" action="{{route('catalogo.index')}}" class="form-group">
        <label for="inputCategoria">Categoria:</label>
        <select class="custom-select" name="categoria" id="inputCategoria" aria-label="Categoria">
            <option value="" {{'' == old('categoria', $categoria) ? 'selected' : ''}}>Todas Categorias</option>
            @foreach ($categorias as $id => $nome)
            <option value={{$id}} {{$id == $categoria ? 'selected' : ''}}>{{$nome}}</option>
            @endforeach
        </select>

        <label for="search">Procurar:</label>
        <input type="text" class="form-control" name="search" id="search" value="{{Request::input('search')}}">
        <br>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary catalogo" type="submit" style="z-index: 0">Filtrar</button>
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
                        <img id="{{$estampa->id}}"src="{{$estampa->cliente_id ? route('imagemEstampa', $estampa) : asset('storage/estampas/' .$estampa->imagem_url)}}" class="card-img-top estampa-img" alt="{{$estampa->nome}}">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$estampa->nome}}</h5>
                        <p class="card-text">{{$estampa->descricao}}</p>
                        <button href="" class="btn mr-2 center catalogo" onclick="on({{$estampa->id}})">Check offer</button>

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


<script src="{{asset('js/catalogo.js')}}"></script>
@endsection
