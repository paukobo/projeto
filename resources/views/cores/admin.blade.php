@extends('layout_admin')
@section('title', 'Cores')
@section('content')
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
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
