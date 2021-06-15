@extends('layout_admin')
@section('title','Alterar Tshirt' )
@section('content')
    <form method="POST" action="{{route('admin.tshirts.update', $tshirt) }}" class="form-group">
        @csrf
        @method('PUT')
        @include('tshirts.partials.create-edit')

        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('admin.tshirts')}}" class="btn btn-secondary">Cancel</a>
        </div>

    </form>
@endsection
