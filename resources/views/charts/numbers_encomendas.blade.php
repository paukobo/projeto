@extends('layout_admin')
@section('title', 'Estatísticas - Encomendas')
@section('content')

<p>Número de clientes - {{ $numClientes }}</p>
<p>Número de encomendas - {{ $numEncomendas }}</p>
<p>Média de encomendas por cliente - {{ $mediaEncomendas }}</p>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

@endsection
