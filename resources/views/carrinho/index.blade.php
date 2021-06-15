@extends('layout_cart')
@section('content')
<h1>Carrinho de Compras</h1>

<hr>
<div>
    <p>
    <form action="{{ route('carrinho.destroy') }}" method="POST">
        @csrf
        @method("DELETE")
        <input type="submit" class="btn btn-danger" value="Apagar carrinho">
    </form>
    </p>
    <p>
    <form action="{{ route('carrinho.store') }}" method="POST">
        @csrf
        <input type="submit" class="btn btn-success" value="Confirmar carrinho">
    </form>
    </p>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Quantidade</th>
            <th>ID Estampa</th>
            <th>Cor Código</th>
            <th>Preço Unidade</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($carrinho->items as $cart)
        <tr>
            <td>{{ $cart['qtd'] }} </td>
            <td>{{ $cart['estampa'] }} </td>
            <td>{{ $cart['cor'] }} </td>
            <td>{{ $cart['preco_un'] }} </td>
            <td>{{ $cart['preco_un'] * $cart['qtd'] }} </td>

            {{--
            <td>
                <form action="{{route('carrinho.update_Tshirt', $cart['id'])}}" method="POST">
                    @csrf
                    @method('put')
                    <input type="hidden" name="quantidade" value="1">
                    <input type="submit" class="btn btn-info" value="+">
                </form>
            </td>
            <td>
                <form action="{{route('carrinho.update_Tshirt', $cart['id'])}}" method="POST">
                    @csrf
                    @method('put')
                    <input type="hidden" name="quantidade" value="-1">
                    <input type="submit" class="btn btn-info" value="-">
                </form>
            </td>
            <td>
                <form action="{{route('carrinho.destroy_Tshirt', $cart['id'])}}" method="POST">
                    @csrf
                    @method('delete')
                    <input type="submit" class="btn btn-danger" value="Remove">
                </form>
            </td>--}}
        </tr>
        @endforeach
    </tbody>
</table>

<div>Preço Total: <?php echo $carrinho->precoTotal ?> €</div>
@endsection
