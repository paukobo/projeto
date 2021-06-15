@extends('layout_admin')
@section('title', 'Estatísticas')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Estatísticas Gerais</th>
                <th>Nº Encomendas por Ano</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <a href="{{ route('admin.charts.numbers_encomendas') }}" class="btn btn-primary">IR</a>
                </td>
                <td>
                    <a href="{{ route('admin.charts.index_encomendas') }}" class="btn btn-primary">IR</a>
                </td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
@endsection
