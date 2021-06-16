@extends('layout_admin')
@section('title', 'Nova Estampa' )
@section('content')
    <form method="POST" action="{{route('admin.catalogo.estampas.store')}}" class="form-group" enctype="multipart/form-data">

        @csrf
        @include('catalogo.estampas.partials.create-edit')
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('admin.catalogo')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
