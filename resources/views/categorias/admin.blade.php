@extends('layout_admin')
@section('title', 'Categorias')
@section('content')
<div class="row mb-3">
    <a href="{{ route('admin.categorias.create') }}" class="btn btn-success" role="button" aria-pressed="true">Nova Categoria</a>
</div>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->nome }}</td>
                    <td nowrap>

                    @can('update', $categoria)
                        <a href="{{ route('admin.categorias.edit', $categoria) }}" class="btn btn-warning btn-sm" role="button" aria-pressed="true">
                            <i class="fas fa-pen"></i>
                        </a>
                    @else
                        <span class="btn btn-secondary btn-sm disabled"><i class="fas fa-pen"></i></span>
                    @endcan

                    @can('delete', $categoria)
                        <form class="d-inline" action="{{ route('admin.categorias.destroy', $categoria) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    @else
                        <span class="btn btn-secondary btn-sm disabled"><i class="fas fa-trash"></i></span>
                    @endcan

            </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categorias->withQueryString()->links() }}
@endsection
