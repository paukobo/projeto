@extends('layout_admin')

@section('content')
    <div class="row mb-3">
        <div class="col-3">
        <a href="#" class="btn btn-success" role="button"
            aria-pressed="true">Nova
            Tshirt</a>
        </div>
        <div class="col-9">
            <form method="GET" action="{{ route('admin.tshirts') }}" class="form-group">
                <div class="input-group">
                    <select class="custom-select" name="tamanho" id="inputTamanho" aria-label="Tamanho">
                        <option value="" {{ '' == old('tamanho', $selectedTamanho) ? 'selected' : '' }}>Todos Tamanhos</option>
                        @foreach ($tshirts as $tam => $tamanho)
                            <option value={{ $tam }}
                                {{ $tam == old('tamanho', $selectedTamanho) ? 'selected' : '' }}>
                                {{ $tamanho }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Tamanho</th>
                <th>Preco por Undidade</th>
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
                    <td>{{ $tshirt->tamanho }}</td>
                    <td>{{ $tshirt->preco_un }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $tshirts->withQueryString()->links() }}
@endsection
