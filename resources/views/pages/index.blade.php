@extends('layout1')
@section('styles')
<link href="{{ asset('css/catalogo.css') }}" rel="stylesheet">
@endsection
@section('content')
<h2>Estampas Mais Vendidas!</h2>
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

                    <form method="GET" action="{{route('catalogo.index')}}" class="form-group">
                        <input type="hidden" id="inputCategoria" name="categoria" value="{{$estampa->categoria_id}}">
                        <div class="input-group-append">
                            <button class="btn mr-2 catalogo"  type="submit" style="margin:20%">Mais como esta!</button>
                        </div>
                    </form>
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
    <a href="{{ route('catalogo.index') }}" class="btn btn-outline-secondary catalogo" style="font-size: 50px;display: block; border-radius:20px">Ver Mais</a>
</div>
@endsection
