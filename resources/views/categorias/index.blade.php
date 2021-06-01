@extends('layout')

@section('content')

<h2>Cores</h2>
<div class="cursos-area">
    @foreach($categorias as $categoria)
    <div class="curso">
        <div class="curso-info-area">
            <div class="curso-info">
                <span class="curso-label">Nome</span>
                <span class="curso-info-desc">{{$categoria->nome}}</span>
            </div>

        </div>
    </div>
    @endforeach
</div>
@endsection
