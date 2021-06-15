@extends('layout')

@section('content')

<h2>Funcionarios</h2>
<form class="disc-search" action="#" method="GET">
    <div class="search-item">
        <label for="idDisc">Disc:</label>
        <select name="disc" id="idDisc">
        {{-- @foreach ($listaDisciplinas as $disc)
            <option value="{{$disc->id}}" {{$disciplina->id == $disc->id ? 'selected' : ''}}>
                {{$disc->curso}} - {{$disc->nome}}
            </option>
        @endforeach --}}
        </select>
    </div>
    <div class="search-item">
        <button type="submit" class="bt" id="btn-filter">Filtrar</button>
    </div>
</form>
<div class="funcionarios-area">
    @foreach($funcionarios as $funcionario)
    <div class="funcionario">
        <div class="funcionario-imagem">
            <img src="{{$funcionario->user->foto_url ?
                        asset('storage/fotos/' . $funcionario->user->foto_url) :
                        asset('img/default_img.png') }}" alt="Imagem do funcionario">
        </div>
        <div class="funcionario-info-area">
        <div class="funcionario-name">{{$funcionario->user->name}}</div>
            {{-- <div class="funcionario-dep">{{$funcionario->departamentoRef->nome}}</div> --}}
            <div class="funcionario-info">
                <span class="funcionario-label"><i class="fas fa-envelope"></i></span>
                <span class="funcionario-info-desc"><a href="mailto:{{$funcionario->user->email}}">{{$funcionario->user->email}}</a>
                </span>
            </div>
            {{-- <div class="funcionario-info">
                <span class="funcionario-label"><i class="fas fa-map-marker-alt"></i></span>
                <span class="funcionario-info-desc">{{$funcionario->gabinete}}</span>
            </div>
            <div class="funcionario-info">
                <span class="funcionario-label"><i class="fas fa-phone"></i></span>
                <span class="funcionario-info-desc">{{$funcionario->extensao}}</span>
            </div>
            <div class="funcionario-info">
                <span class="funcionario-label"><i class="fas fa-archive"></i></span>
                <span class="funcionario-info-desc">{{$funcionario->cacifo}}</span>
            </div> --}}
        </div>
    </div>
    @endforeach
</div>
@endsection
