@extends('layout_admin')
@section('title','Alterar User' )
@section('content')
    <form method="POST" action="{{route('admin.users.update', $user) }}" class="form-group" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$user->id}}">
        @include('users.partials.create-edit')

        @isset($user->user->url_foto)
            <div class="form-group">
                <img src="{{$user->user->url_foto ? asset('storage/fotos/' . $user->user->url_foto) : asset('img/default_img.png') }}"
                     alt="Foto do docente"  class="img-profile"
                     style="max-width:100%">
            </div>
        @endisset
        @can('update',$user)
        <div class="form-group text-right">
            @isset($user->user->url_foto)
                <button type="submit" class="btn btn-danger" name="deletefoto" form="form_delete_photo">Apagar Foto</button>
            @endisset
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <button type="submit" class="btn btn-primary" name="verifyEmail" form="form_verification_email">Send Verification Email</button>
            <a href="{{route('admin.users')}}" class="btn btn-secondary">Cancel</a>
        </div>
        @endcan
    </form>
    <form id="form_delete_photo" action="{{route('admin.users.foto.destroy', $user)}}" method="POST">
        @csrf
        @method('DELETE')
    </form>
    <form id="form_verification_email" action="{{route('admin.users.sendVerificationEmail', $user)}}" method="POST">
        @csrf
    </form>
@endsection
