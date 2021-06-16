@extends('layout_admin')
@section('title','Consultar User' )
@section('content')
    <form method="POST" action="{{route('admin.users', $user) }}" class="form-group" enctype="multipart/form-data">
        @csrf
        @method('GET')
        <div class="form-group">
            <label for="inputNome">Nome</label>
            <input type="text" class="form-control" name="name" disabled id="inputNome" value="{{old('name', $user->name)}}" >
        </div>
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="text" class="form-control" name="email" disabled id="inputEmail" value="{{old('email', $user->email)}}" >
        </div>
        @isset($user->foto_url)
        <img src="{{$user->foto_url ? asset('storage/fotos/' . $user->foto_url) : asset('img/default_img.png') }}"
            alt="Foto do user"  class="img-profile"
            style="max-width:100%">
        @endisset
        <div class="form-group">
            <label for="inputTipo">Função</label>
            @if($user->tipo=='A')
                <input type="text" class="form-control" name="tipo" disabled id="inputTipo" value="{{old('tipo', 'Administrador(a)')}}" >
            @elseif($user->tipo=='F')
                <input type="text" class="form-control" name="tipo" disabled id="inputTipo" value="{{old('tipo', 'Funcionário(a)')}}" >
            @endif
        </div>
        <div class="form-group">
            <label for="inputBloqueado">Estado da Conta</label>
            @if($user->bloqueado=='1')
                <input type="text" class="form-control" name="tipo" disabled id="inputTipo" value="{{old('tipo', 'Bloqueada')}}" >
            @elseif($user->bloqueado=='0')
                <input type="text" class="form-control" name="tipo" disabled id="inputTipo" value="{{old('tipo', 'Desbloqueada')}}" >
            @endif
        </div>
        @can('view',$user)
        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok">Done</button>
            <a href="{{route('admin.users')}}" class="btn btn-secondary">Cancel</a>
        </div>
        @endcan
    </form>
@endsection

