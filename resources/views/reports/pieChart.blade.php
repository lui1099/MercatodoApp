@extends('layouts.app')

@section('content')

<div class="container" style="text-align: center">
    <h1>{{ trans('pieChart.titles.salesRepCat') }}</h1>
    <h3>{{ trans('pieChart.titles.from') }} {{ $from }}</h3>
    <h3>{{ trans('pieChart.titles.to') }}{{ $to }}</h3>
</div>
<div class="container" style="width: 400px; height: 400px; text-align-all: center; display: block; margin: 0 auto; margin-top: 50px">
    <canvas class="align-content-center" id="myChart" width="200" height="200"></canvas>
</div>
<div class="container" style="margin-top: 50px">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">{{ trans('pieChart.tableHeaders.id') }}</th>
            <th scope="col">{{ trans('pieChart.tableHeaders.food') }}</th>
            <th scope="col">{{ trans('pieChart.tableHeaders.health&pc') }}</th>
            <th scope="col">{{ trans('pieChart.tableHeaders.cleaning') }}</th>
            <th scope="col">{{ trans('pieChart.tableHeaders.total') }}</th>
            <th scope="col">{{ trans('pieChart.tableHeaders.created') }}</th>
            <th scope="col">{{ trans('pieChart.tableHeaders.reference') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->food }}</td>
                <td>{{ $order->healthpc }}</td>
                <td>{{ $order->cleaning }}</td>
                <td>{{ $order->total }}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->reference }}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                'Food',
                'Health & PC',
                'Cleaning'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: <?php echo json_encode($data); ?>,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        },
        options: {
            scales: {

            }
        }
    });
</script>
<script>
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>

@endsection




