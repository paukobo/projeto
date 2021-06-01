@extends('layout')

@section('content')

<h2>Cores</h2>
<div class="cursos-area">
    @foreach($encomendas as $encomendas)
    <div class="curso">
        <div class="curso-info-area">
            <div class="curso-info">
                <span class="curso-label">ID</span>
                <span class="curso-info-desc">{{$encomenda->id}}</span>
            </div>

        </div>
    </div>
    @endforeach
</div>
@endsection
