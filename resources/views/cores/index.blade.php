@extends('layout')

@section('content')

<h2>Cores</h2>
<div class="cursos-area">
    @foreach($cores as $cor)
    <div class="curso">
        <div class="curso-info-area">
            <div class="curso-info">
                <span class="curso-label">Código</span>
                <span class="curso-info-desc">{{$cor->codigo}}</span>
            </div>
            <div class="curso-info">
                <span class="curso-label">Nome</span>
                <span class="curso-info-desc">{{$cor->nome}}</span>
            </div>

        </div>
    </div>
    @endforeach
</div>
@endsection
