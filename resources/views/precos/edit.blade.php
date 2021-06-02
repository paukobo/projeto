@extends('layout_admin')
@section('title','Alterar Preço' )
@section('content')
    <form method="POST" action="{{route('admin.precos.update', $preco) }}" class="form-group">
        @csrf
        @method('PUT')
        @include('precos.partials.create-edit')

        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('admin.precos')}}" class="btn btn-secondary">Cancel</a>
        </div>

    </form>
@endsection
