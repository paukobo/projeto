@extends('layout_admin')
@section('title', 'Detalhes da Encomenda')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID Tshirt</th>
                <th>ID Estampa</th>
                <th>Código Cor</th>
                <th></th>
                <th>Tamanho</th>
                <th>Quantidade</th>
                <th>Preço Unidade</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($encomendas as $encomenda)
                <tr>
                    <td>{{ $encomenda->id }}</td>
                    <td>{{ $encomenda->estampa_id }}</td>
                    <td>#{{ $encomenda->cor_codigo }}</td>
                    <td><span style="height: 20px; width: 20px; background-color: #{{ $encomenda->cor_codigo }}; border-radius: 50%; border: 1px solid black; display: inline-block;"></span></td>
                    <td>{{ $encomenda->tamanho }}</td>
                    <td>{{ $encomenda->quantidade }}</td>
                    <td>{{ $encomenda->preco_un }}</td>
                    <td>{{ $encomenda->subtotal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{route('admin.encomendas')}}" class="btn btn-secondary">Voltar atrás</a>
    {{ $encomendas->withQueryString()->links() }}
@endsection
