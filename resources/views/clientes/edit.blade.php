@extends('layout_admin')
@section('title','Dados Cliente')
@section('content')
    <form method="POST" action="{{route('admin.clientes.update', $cliente) }}" class="form-group" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$cliente->id}}">

        @include('clientes.partials.create-edit')

        @isset($cliente->user->foto_url)
            <div class="form-group">
                <img src="{{$cliente->user->foto_url ? asset('storage/fotos/' . $cliente->user->foto_url) : asset('img/default_img.png') }}"
                     alt="Foto do docente"  class="img-profile"
                     style="max-width:100%">
            </div>
        @endisset
        @can('update',$cliente)
        <div class="form-group text-right">
            @isset($cliente->user->foto_url)
                <button type="submit" class="btn btn-danger" name="deletefoto" form="form_delete_photo">Apagar Foto</button>
            @endisset
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <button type="submit" class="btn btn-primary" name="verifyEmail" form="form_verification_email">Send Verification Email</button>
            <a href="{{route('admin.clientes')}}" class="btn btn-secondary">Cancel</a>
        </div>
        @endcan
    </form>
    <form id="form_delete_photo" action="{{route('admin.clientes.foto.destroy', $cliente)}}" method="POST">
        @csrf
        @method('DELETE')
    </form>
    <form id="form_verification_email" action="{{route('admin.clientes.sendVerificationEmail', $cliente)}}" method="POST">
        @csrf
    </form>
@endsection
