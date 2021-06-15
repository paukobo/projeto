@extends('layout_admin')
@section('title','Alterar Estampa' )
@section('content')
    <form method="POST" action="{{route('admin.catalogo.estampas.update', $estampa) }}" class="form-group" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('catalogo.estampas.partials.create-edit')
        @isset( $estampa->imagem_url)
            <div class="form-group">
                <img src="{{$estampa->cliente_id ? route('imagemEstampa', $estampa) : asset('storage/estampas/' .$estampa->imagem_url)}}" class="card-img-top estampa-img" alt="{{$estampa->nome}}" style="max-width:200px">
            </div>
        @endisset
        {{-- comment
        @can('update', $estampa)--}}
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('admin.catalogo')}}" class="btn btn-secondary">Cancel</a>
        </div>
        {{--@endcan--}}
    </form>
@endsection
