@extends('layout_admin')
@section('title','Alterar Cor' )
@section('content')
    <form method="POST" action="{{route('admin.cores.update', $cor) }}" class="form-group">
        @csrf
        @method('PUT')
        @include('cores.partials.create-edit')

        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('admin.cores')}}" class="btn btn-secondary">Cancel</a>
        </div>

    </form>
@endsection
