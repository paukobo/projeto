@extends('layout_admin')
@section('content')
<h1>TESTE CARRINHO</h1>

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
        <p style="float:right;">
            Preço Total:

        </p>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Quantidade</th>
                <th>ID</th>
                <th>ID Encomenda</th>
                <th>ID Estampa</th>
                <th>Cor Código</th>
                <th>Preço Unidade</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carrinho as $row)
            <tr>
                <td>{{ $row['qtd'] }} </td>
                <td>{{ $row['id'] }} </td>
                <td>{{ $row['encomenda_id'] }} </td>
                <td>{{ $row['estampa_id'] }} </td>
                <td>{{ $row['cor_codigo'] }} </td>
                <td>{{ $row['preco_un'] }}</td>

                <td>
                    <form action="{{route('carrinho.update_Tshirt', $row['id'])}}" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="quantidade" value="1">
                        <input type="submit" class="btn btn-info" value="Increment">
                    </form>
                </td>
                <td>
                    <form action="{{route('carrinho.update_Tshirt', $row['id'])}}" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="quantidade" value="-1">
                        <input type="submit" class="btn btn-info" value="Decrement">
                    </form>
                </td>
                <td>
                    <form action="{{route('carrinho.destroy_Tshirt', $row['id'])}}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="submit" class="btn btn-danger" value="Remove">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
