@extends('layout_admin')
@section('title', 'Tshirts')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Tamanho</th>
                <th>Quantidade</th>
                <th>Preço por Unidade</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tshirts as $tshirt)
                <tr>
                    <td>
                        <form action="{{ route('carrinho.store_Tshirt', $tshirt) }}" method="POST">
                            @csrf
                            <input type="submit" class="btn btn-success" value="Add to Cart">
                        </form>
                    </td>
                    <td>{{ $tshirt->tamanho }}</td>
                    <td>{{ $tshirt->quantidade }}</td>
                    <td>{{ $tshirt->preco_un }}</td>
            @endforeach
        </tbody>
    </table>
@endsection
