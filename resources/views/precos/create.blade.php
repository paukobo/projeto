@extends('layout_admin')
@section('title', 'Novo Preço' )
@section('content')
    <form method="POST" action="{{route('admin.precos.store')}}" class="form-group">
        @csrf
        @include('precos.partials.create-edit')
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('admin.categorias')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
