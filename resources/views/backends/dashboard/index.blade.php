@extends('layouts.app')
@section('contents')
    @include('message.message')
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-6">
                <canvas id="myChart1"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Script jquery -->
    <script src="{{asset('jquery/jquery.js')}}" type="text/javascript"></script>
    <!-- HTML -->
    <script src="{{asset('chart//Chart.min.js')}}"></script>
    <script>
        var ctx = document.getElementById('myChart1').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: ["{{$days[0]}}", "{{$days[1]}}", "{{$days[2]}}", "{{$days[3]}}", "{{$days[4]}}", "{{$days[5]}}", "{{$days[6]}}", "{{$days[7]}}"],
                datasets: [{
                    label: "Views post per 7 day",
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [{{$views[0]}}, {{$views[1]}}, {{$views[2]}}, {{$views[3]}}, {{$views[4]}}, {{$views[5]}}, {{$views[6]}}, {{$views[7]}}],
                }]
            },

            // Configuration options go here
            options: {}
        });
        var ctx = document.getElementById('myChart2').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: ["{{$days[0]}}", "{{$days[1]}}", "{{$days[2]}}", "{{$days[3]}}", "{{$days[4]}}", "{{$days[5]}}", "{{$days[6]}}", "{{$days[7]}}"],
                datasets: [{
                    label: "Picture update",
                    backgroundColor: ['rgb(255, 0, 132)',
                        'rgb(255, 99, 0)',
                        'rgb(0, 99, 132)',
                        'rgb(200, 99, 132)',
                        'rgb(200, 0, 132)',
                        'rgb(200, 99, 0)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 200, 200)'],
                    borderColor: 'rgb(255, 99, 132)',
                    data: [{{$pictures[$days[0]]}}, {{$pictures[$days[1]]}}, {{$pictures[$days[2]]}}, {{$pictures[$days[3]]}}, {{$pictures[$days[4]]}}, {{$pictures[$days[5]]}}, {{$pictures[$days[6]]}}, {{$pictures[$days[7]]}}],
                }]
            },

            // Configuration options go here
            options: {}
        });
    </script>
@endsection
