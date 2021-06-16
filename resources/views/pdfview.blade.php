    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
        <h2 class="text-center text-dark">Recibo</h2>
        <div class="col-md-5">
            <p>{{ $user->name }}</p>
            <p>{{ $user->cliente->nif }}</p>
            <p>{{ $user->cliente->endereco }}</p>
            <p>{{ $user->cliente->tipo_pagamento }}</p>
            <p>{{ $user->cliente->ref_pagamento }}</p>
        </div>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Tamanho</th>
                        <th>Preço Unitário</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($tshirts as $tshirt => $item)
                        <tr>
                            <td>{{ ++$tshirt }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->tamanho }}</td>
                            <td>{{ $item->name }}</td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
