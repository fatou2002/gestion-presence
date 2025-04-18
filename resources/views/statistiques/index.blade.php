@extends('layouts.app')

@section('title', 'Statistiques')

@section('content')
    <div class="container">
        <h1>📊 Statistiques des présences</h1>
        <form method="GET" action="{{ route('statistiques') }}" class="mb-4">
            <label for="periode" class="form-label">Filtrer par période :</label>
            <select name="periode" id="periode" class="form-select w-auto d-inline-block">
                <option value="">Toutes les périodes</option>
                <option value="semaine" {{ request('periode') === 'semaine' ? 'selected' : '' }}>Cette semaine</option>
                <option value="mois" {{ request('periode') === 'mois' ? 'selected' : '' }}>Ce mois</option>
            </select>
            <button type="submit" class="btn btn-primary ms-2">Filtrer</button>
        </form>
        <hr>

        <h3>1. Nombre de présences par employé</h3>
        <canvas id="barChart"></canvas>

        <h3 class="mt-5">2. Évolution des présences</h3>
        <canvas id="lineChart"></canvas>

        <h3 class="mt-5">3. Taux de présence par service</h3>
        <canvas id="doughnutChart"></canvas>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const barCtx = document.getElementById('barChart');

        const barColors = [
            'rgba(255, 99, 132, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 206, 86, 0.7)',
            'rgba(75, 192, 192, 0.7)',
            'rgba(153, 102, 255, 0.7)',
            'rgba(255, 159, 64, 0.7)',
            'rgba(201, 203, 207, 0.7)',
            'rgba(0, 200, 83, 0.7)',
            'rgba(255, 87, 34, 0.7)',
            'rgba(63, 81, 181, 0.7)'
        ];

        // Gérer le cas où il y a plus d’employés que de couleurs
        const dynamicColors = @json($labels).map((_, i) => barColors[i % barColors.length]);

        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Présences par employé',
                    data: @json($data),
                    backgroundColor: dynamicColors
                }]
            }
        });


        const lineCtx = document.getElementById('lineChart');
        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: @json($dates),
                datasets: [{
                    label: 'Présences par jour',
                    data: @json($evolutionData),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false
                }]
            }
        });

        const doughnutCtx = document.getElementById('doughnutChart');

        const serviceColors = [
            'rgba(255, 99, 132, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 206, 86, 0.7)',
            'rgba(75, 192, 192, 0.7)',
            'rgba(153, 102, 255, 0.7)',
            'rgba(255, 159, 64, 0.7)',
            'rgba(0, 200, 83, 0.7)',
            'rgba(63, 81, 181, 0.7)',
            'rgba(233, 30, 99, 0.7)',
            'rgba(0, 188, 212, 0.7)'
        ];

        // Adapte les couleurs au nombre de services
        const dynamicServiceColors = @json($services).map((_, i) => serviceColors[i % serviceColors.length]);

        new Chart(doughnutCtx, {
            type: 'doughnut',
            data: {
                labels: @json($services),
                datasets: [{
                    label: 'Présences par service',
                    data: @json($presenceParService),
                    backgroundColor: dynamicServiceColors
                }]
            }
        });
    </script>


@endsection
