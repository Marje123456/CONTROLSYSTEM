@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h3 class="card-title">Comparativo de Ingresos de Caja</h3>
                </div>
                <div class="card-body">
                    <canvas id="areaChart" style="min-height: 300px; height: 300px; max-height: 350px; width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark">
                    <h3 class="card-title">Auditorías</h3>
                </div>
                <div class="card-body">
                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 300px; width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark">
                    <h3 class="card-title">Cierres de Caja</h3>
                </div>
                <div class="card-body">
                    <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 300px; width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/custom-adminlte.css') }}">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // Bar Chart
    const ctxBar = document.getElementById('barChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
            datasets: [{
                label: 'Ventas',
                data: [120, 190, 300, 250, 220, 320],
                backgroundColor: '#ffd900',
                borderColor: '#ffee00',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Pie Chart
    const ctxPie = document.getElementById('pieChart').getContext('2d');
    new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            labels: ['Cierres de Caja', 'Auditorías'],
            datasets: [{
                data: [300, 50, 100],
                backgroundColor: [
                    '#ffd900',
                    '#222',
                    '#ffee00'
                ],
                borderColor: '#111',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: { color: '#fff' }
                }
            }
        }
    });

    // Area/Line Chart más compleja
    const ctxArea = document.getElementById('areaChart').getContext('2d');
    new Chart(ctxArea, {
        type: 'line',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto'],
            datasets: [
                {
                    label: 'Ingresos',
                    data: [500, 700, 800, 650, 900, 1200, 1100, 1300],
                    fill: true,
                    backgroundColor: 'rgba(255, 217, 0, 0.2)',
                    borderColor: '#ffd900',
                    tension: 0.4,
                    pointBackgroundColor: '#ffd900',
                    pointBorderColor: '#fff',
                },
                {
                    label: 'Egresos',
                    data: [300, 400, 500, 450, 600, 700, 800, 850],
                    fill: true,
                    backgroundColor: 'rgba(34,34,34,0.2)',
                    borderColor: '#222',
                    tension: 0.4,
                    pointBackgroundColor: '#222',
                    pointBorderColor: '#fff',
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: { color: '#fff' }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            },
            scales: {
                x: {
                    ticks: { color: '#fff' },
                    grid: { color: 'rgba(255,255,255,0.1)' }
                },
                y: {
                    ticks: { color: '#fff' },
                    grid: { color: 'rgba(255,255,255,0.1)' },
                    beginAtZero: true
                }
            }
        }
    });
    </script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop