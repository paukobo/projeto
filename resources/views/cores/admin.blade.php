@extends('layout_admin')
@section('title', 'Cores')
@section('content')
    <div class="row mb-3">

            <a href="{{ route('admin.cores.create') }}" class="btn btn-success" role="button" aria-pressed="true">Nova Cor</a>
    </div>
<table class="table">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cores as $cor)
        <tr>
            <td>{{ $cor->codigo }}</td>
            <td>{{ $cor->nome }}</td>
            <td nowrap>
                    <a href="{{ route('admin.cores.edit', $cor) }}" class="btn btn-warning btn-sm" role="button" aria-pressed="true">
                        <i class="fas fa-pen"></i>
                    </a>

                    <form class="d-inline" action="{{ route('admin.cores.destroy', $cor) }}" method="POST">
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
{{ $cores->withQueryString()->links() }}
@endsection
