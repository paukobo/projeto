@extends('layout')

@section('content')

<h2>Preços</h2>
<div class="cursos-area">
    @foreach($precos as $preco)
    <div class="curso">
        <div class="curso-info-area">
            <div class="curso-info">
                <span class="curso-label">ID</span>
                <span class="curso-info-desc">{{$preco->id}}</span>
            </div>

        </div>
    </div>
    @endforeach
</div>
@endsection
