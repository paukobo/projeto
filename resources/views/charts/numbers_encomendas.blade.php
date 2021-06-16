@extends('layout_admin')
@section('title', 'Estatísticas - Encomendas')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="panel panel-default">
                <div class="panel-heading">Ganhos por cada mês do ano</div>
                <div class="panel-body">
                    <canvas id="canvasEstatisticasGerais" height="280" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<p>Número de clientes - {{ $numClientes }}</p>
<p>Número de encomendas - {{ $numEncomendas }}</p>
<p>Média de encomendas por cliente - {{ $mediaEncomendas }}</p>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<script>
    var year = <?php echo $year; ?>;
    var encomendas = <?php echo $encomendas; ?>;

    var lineChartData = {
        name: 'ainda nao sei',
        labels: year,
        datasets: [{
            label: 'Nº Encomendas',
            backgroundColor: getRandomColorHex(),
            data: encomendas,
            fill: false,
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvasEstatisticasGerais").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'line',
            data: lineChartData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Chart.js Line Chart'
                    }
                }
            },
        });
    };

    function getRandomColorHex() {
        var hex = "0123456789ABCDEF",
            color = "#";
        for (var i = 1; i <= 6; i++) {
            color += hex[Math.floor(Math.random() * 16)];
        }
        return color;
    }
</script>
@endsection
