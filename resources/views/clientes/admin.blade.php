@extends('layout_admin')
@section('title', 'Dashboard')
@section('content')
    <div class="row mb-3">
        <div class="col-9">
            {{-- <form method="GET" action="{{ route('admin.clientes') }}" class="form-group">
                <div class="input-group">
                    <select class="custom-select" name="curso" id="inputCurso" aria-label="Curso">
                        <option value="" {{ '' == old('curso', $selectedCurso) ? 'selected' : '' }}>Todos Cursos</option>
                        @foreach ($cursos as $abr => $nome)
                            <option value={{ $abr }}
                                {{ $abr == old('curso', $selectedCurso) ? 'selected' : '' }}>
                                {{ $nome }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
                    </div>
                </div>
            </form> --}}
        </div>
    </div>
@endsection
