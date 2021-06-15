@extends('layout_admin')

@section('content')
<div class="row mb-3">
    <a href="{{ route('admin.catalogo.estampas.create') }}" class="btn btn-success" role="button" aria-pressed="true">Nova Estampa</a>
</div>
<form method="GET" action="{{route('admin.catalogo')}}" class="form-group">
    <label for="inputCategoria">Categoria</label>
    <select class="custom-select" name="categoria" id="inputCategoria" aria-label="Categoria">
        <option value="" {{'' == old('categoria', $categoria) ? 'selected' : ''}}>Todas Categorias</option>
        @foreach ($categorias as $id => $nome)
        <option value={{$id}} {{$id == $categoria ? 'selected' : ''}}>{{$nome}}</option>
        @endforeach
    </select>
    <label for="search">Procurar:</label>
    <input type="text" class="form-control" name="search" id="search" value="{{Request::input('search')}}">
    <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
    </div>
</form>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estampas as $estampa)
                <tr>
                    <td>{{ $estampa->nome }}</td>
                    <td>{{ $estampa->descricao }}</td>
                    <td>@isset($estampa->categoria){{ $estampa->categoria->nome }}@endisset</td>
                    <td nowrap>
                        <a href="{{ route('admin.catalogo.estampas.edit', $estampa) }}" class="btn btn-warning btn-sm" role="button" aria-pressed="true">
                            <i class="fas fa-pen"></i>
                        </a>

                        <form class="d-inline" action="{{ route('admin.catalogo.estampas.destroy', $estampa) }}" method="POST">
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
    {{ $estampas->withQueryString()->links() }}
@endsection
