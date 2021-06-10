@extends('layout_admin')
@section('title','Alterar Encomenda' )
@section('content')
    <form method="POST" action="{{route('admin.encomendas.update', $encomenda) }}" class="form-group">
        @csrf
        @method('PUT')
        @include('encomendas.partials.create-edit')

        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('admin.encomendas')}}" class="btn btn-secondary">Cancel</a>
        </div>

    </form>
@endsection
