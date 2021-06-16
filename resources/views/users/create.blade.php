@extends('layout_admin')
@section('title', 'Novo User' )
@section('content')
    <form method="POST" action="{{route('admin.users.store')}}" class="form-group" enctype="multipart/form-data">
        @csrf
        @include('users.partials.create-edit')
        <div class="form-group">
            <label for="inputTipo">Tipo de Utilizador</label>
            <select class="form-control" name="tipo" id="inputTipo">
                <option value="C">Cliente</option>
                <option value="F">Funcionário</option>
                <option value="A">Administrador</option>
            </select>
            @error('tipo')
                <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('admin.users')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
