<div class="form-group">
    <label for="inputNome">Nome</label>
    <input type="text" class="form-control" name="name" id="inputNome" value="{{old('name', $user->name)}}" >
    @error('name')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputEmail">Email</label>
    <input type="text" class="form-control" name="email" id="inputEmail" value="{{old('email', $user->email)}}" >
    @error('email')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputFoto">Upload da Foto</label>
    <input type="file" class="form-control" name="foto" id="inputFoto">
    @error('foto')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
@isset($user->foto_url)
    <div class="form-group">
        <img src="{{$user->foto_url ? asset('storage/fotos/' . $user->foto_url) : asset('img/default_img.png') }}"
            alt="Foto do docente"  class="img-profile"
            style="max-width:100%">
    </div>
@endisset
<div class="form-group">
    <label for="inputTipo">Tipo de Utilizador</label>
    <select class="form-control" name="tipo" id="inputTipo">
        @if($user->tipo=='A')
            <option value="A">Administrador</option>
            <option value="F">Funcionário</option>
        @elseif($user->tipo=='F')
            <option value="F">Funcionário</option>
            <option value="A">Administrador</option>
        @endif
    </select>
    @error('tipo')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
