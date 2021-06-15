@extends('layout_admin')
@section('content')
<div class="row mb-3">
    <div class="col-3">
        <a href="#" class="btn btn-success" role="button" aria-pressed="true">Nova Tshirt</a>
    </div>
    <div class="col-9">
        <form method="GET" action="{{ route('admin.tshirts') }}" class="form-group">
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
                    <button class="btn btn-outline-secondary">Reset<a href="{{route('admin.tshirts')}}"></a></button>
                </div>
            </div>
        </form>
    </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID Tshirt</th>
            <th>ID Estampa</th>
            <th>Código Cor</th>
            <th></th>
            <th>Tamanho</th>
            <th>Preco por Unidade</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tshirts as $tshirt)
        <tr>
            <td>
                <form action="{{ route('carrinho.store_Tshirt', $tshirt) }}" method="POST">
                    @csrf
                    <input type="submit" class="btn btn-success" value="Add">
                </form>
            </td>
            <td>{{ $tshirt->id }}</td>
            <td>{{ $tshirt->estampa_id }}</td>
            <td>#{{ $tshirt->cor_codigo }}</td>
            <td><span style="height: 20px; width: 20px; background-color: #{{ $tshirt->cor_codigo }}; border-radius: 50%; border: 1px solid black; display: inline-block;"></span></td>
            <td>{{ $tshirt->tamanho }}</td>
            <td>{{ $tshirt->preco_un }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $tshirts->withQueryString()->links() }}
@endsection
