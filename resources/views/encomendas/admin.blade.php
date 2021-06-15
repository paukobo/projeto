@extends('layout_admin')
@section('title', 'Encomendas')
@section('content')
    @if(auth()->check() && auth()->user()->tipo == 'A')
        <div class="col-9">
            <form method="GET" action="{{ route('admin.encomendas') }}" class="form-group">
                <div class="input-group">
                    <label for="search">PROCURAR:</label>
                    &nbsp;
                    <input type="number" min="1" class="form-control" name="search" id="search">
                    &nbsp;
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
                    </div>
                    &nbsp;
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary">Reset<a href="{{route('admin.encomendas')}}"></a></button>
                    </div>
                </div>
            </form>
        </div>
    @endif
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
                        @can('view', $encomenda)
                            <a href="#" class="btn btn-primary btn-sm" role="button" aria-pressed="true">
                                <i class="fas fa-tshirt"></i>
                            </a>
                        @else
                            <span class="btn btn-secondary btn-sm disabled"><i class="fas fa-tshirt"></i></span>
                        @endcan

                        @can('update', $encomenda)
                            <a href="{{ route('admin.encomendas.edit', $encomenda) }}" class="btn btn-warning btn-sm" role="button" aria-pressed="true">
                                <i class="fas fa-pen"></i>
                            </a>
                        @else
                            <span class="btn btn-secondary btn-sm disabled"><i class="fas fa-pen"></i></span>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $encomendas->withQueryString()->links() }}
@endsection
