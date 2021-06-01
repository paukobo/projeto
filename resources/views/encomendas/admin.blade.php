@extends('layout_admin')
@section('title', 'Categorias')
@section('content')
<div class="row mb-3">
    <a href="{{ route('admin.encomendas.create') }}" class="btn btn-success" role="button" aria-pressed="true">Nova Encomenda</a>
</div>
    <table class="table">
        <thead>
            <tr>
                <th>ID Encomenda</th>
                <th>Estado</th>
                <th>ID Cliente</th>
                <th>Data Encomenda</th>
                <th>Preço Total</th>
                <th>Notas</th>
                <th>NIF</th>
                <th>Endereço</th>
                <th>Tipo de Pagamento</th>
                <th>Referência de Pagamento</th>
                <th>URL Recibo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($encomendas as $encomenda)
                <tr>
                    <td>{{ $encomenda->id }}</td>
                    <td>{{ $encomenda->estado }}</td>
                    <td>{{ $encomenda->cliente_id }}</td>
                    <td>{{ $encomenda->data }}</td>
                    <td>{{ $encomenda->preco_total }}</td>
                    <td>{{ $encomenda->notas }}</td>
                    <td>{{ $encomenda->nif }}</td>
                    <td>{{ $encomenda->endereco }}</td>
                    <td>{{ $encomenda->tipo_pagamento }}</td>
                    <td>{{ $encomenda->ref_pagamento }}</td>
                    <td>{{ $encomenda->recibo_url }}</td>

                    <td nowrap>

                    <a href="{{ route('admin.encomendas.edit', $encomenda) }}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">
                        <i class="fas fa-eye"></i>
                    </a>



                    <a href="{{ route('admin.encomendas.edit', $encomenda) }}" class="btn btn-warning btn-sm" role="button" aria-pressed="true">
                        <i class="fas fa-pen"></i>
                    </a>



                    <form class="d-inline" action="{{ route('admin.encomendas.destroy', $encomenda) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>

            </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $encomendas->withQueryString()->links() }}
@endsection
