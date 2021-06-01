@extends('layout_admin')
@section('title','Alterar Categoria' )
@section('content')
    <form method="POST" action="{{route('admin.categorias.update', $categoria) }}" class="form-group">
        @csrf
        @method('PUT')
        @include('categorias.partials.create-edit')
        @can('update', $categoria)
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('admin.categorias')}}" class="btn btn-secondary">Cancel</a>
        </div>
        @endcan
    </form>
@endsection
