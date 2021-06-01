@extends('layout_admin')
@section('title','Alterar Cor' )
@section('content')
    <form method="POST" action="{{route('admin.cores.update', $cor) }}" class="form-group">
        @csrf
        @method('PUT')
        @include('cores.partials.create-edit')
        @can('update', $cor)
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('admin.cores')}}" class="btn btn-secondary">Cancel</a>
        </div>
        @endcan
    </form>
@endsection
