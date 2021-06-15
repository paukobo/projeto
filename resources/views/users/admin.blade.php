@extends('layout_admin')
@section('title', 'Users')
@section('content')
    <div class="row mb-3">
        <div class="col-3">
            @can('create', App\Models\User::class)
                <a href="{{ route('admin.users.create') }}" class="btn btn-success" role="button" aria-pressed="true">
                    Novo User
                </a>
            @endcan
        </div>
        {{-- <div class="col-9">
            <form method="GET" action="{{ route('admin.users') }}" class="form-group">
                <div class="input-group">
                    <select class="custom-select" name="tipo" id="inputTipo" aria-label="Tipo">
                        <option value="" {{ '' == old('tipo', $selectedTipo) ? 'selected' : '' }}>Todos Tipos de Utilizadores</option>
                        @foreach ($tipos as $abr => $nome)
                            <option value={{ $abr }}
                                {{ $abr == old('curso', $selectedTipo) ? 'selected' : '' }}>
                                {{ $nome }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
                    </div>
                </div>
            </form>
        </div> --}}
    </div>

    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Nome</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>
                        <img src="{{ $user->foto_url ? asset('storage/fotos/' . $user->foto_url) : asset('img/default_img.png') }}"
                            alt="Foto do user" class="img-profile rounded-circle" style="width:40px;height:40px">
                    </td>
                    {{-- <td>{{ $user->numero }}</td> --}}
                    <td>{{ $user->name }}</td>
                    {{-- <td>{{ $user->cursoRef->nome }}</td> --}}
                    <td nowrap>
                        @can('view', $user)
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-sm"
                                role="button" aria-pressed="true"><i class="fas fa-eye"></i></a>
                        @else
                            <span class="btn btn-secondary btn-sm disabled"><i class="fas fa-eye"></i></span>
                        @endcan
                        @can('update', $user)
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm"
                                role="button" aria-pressed="true"><i class="fas fa-pen"></i></a>
                        @else
                            <span class="btn btn-secondary btn-sm disabled"><i class="fas fa-pen"></i></span>
                        @endcan
                        @can('block', $user)
                        <form class="d-inline" action="{{ route('admin.users.block', $user) }}" method="PUT">
                            @csrf
                            @if ($user->bloqueado=='0')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-lock"></i>
                                </button>
                            @elseif ($user->bloqueado=='1')
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="fas fa-unlock"></i>
                                </button>
                            @endif
                        </form>
                        @else
                        <span class="btn btn-secondary btn-sm disabled"><i class="fas fa-lock"></i></span>
                        @endcan
                        @can('delete', $user)
                            <form class="d-inline" action="{{ route('admin.users.destroy', $user) }}" method="POST">
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
    {{ $users->withQueryString()->links() }}
@endsection
