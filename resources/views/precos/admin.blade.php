@extends('layout_admin')
@section('title', 'Preços')
@section('content')

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Preço Unitário Catálogo</th>
                <th>Preço Unitário Próprio</th>
                <th>Preço Unitário Catálogo com Desconto</th>
                <th>Preço Unitário Próprio com Desconto</th>
                <th>Quantidade de Desconto</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($precos as $preco)
                <tr>
                    <td>{{ $preco->id }}</td>
                    <td>{{ $preco->preco_un_catalogo }}</td>
                    <td>{{ $preco->preco_un_proprio }}</td>
                    <td>{{ $preco->preco_un_catalogo_desconto }}</td>
                    <td>{{ $preco->preco_un_proprio_desconto }}</td>
                    <td>{{ $preco->quantidade_desconto }}%</td>
                    <td nowrap>

                    <a href="{{ route('admin.precos.edit', $preco) }}" class="btn btn-warning btn-sm" role="button" aria-pressed="true">
                        <i class="fas fa-pen"></i>
                    </a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $precos->withQueryString()->links() }}
@endsection
