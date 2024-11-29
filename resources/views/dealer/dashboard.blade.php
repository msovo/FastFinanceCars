@extends('layouts.dealer')

@section('title', 'Dealer Dashboard')

@section('content')
<!DOCTYPE html>
<html>
<head>
  <title>Dealer Dashboard</title>
  <style>
 
    .collapse-icon {
      cursor: pointer;
    }

    .chart-container {
    display: flex;
    flex-direction: column; 
}

.chart-card {
    width: 100%; 
    margin-bottom: 20px;
}

@media (min-width: 768px) { 
    .chart-card {
        width: calc(33.33% - 20px); 
    }
}
  </style>
</head>
<body>

<h1>Dealer Dashboard</h1>

<div class="row mb-4">
  <div class="col-md-12">
    <form id="filterForm">
      <div class="form-group">
        <label for="filterDate">Filter by Date:</label>
        <input type="date" id="filterDate" name="date" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary">Apply Filter</button>
    </form>
  </div>
</div>

<div class="row mb-4">
  <div class="col-md-3">
    <div class="card text-white bg-primary mb-3">
      <div class="card-header">Total Leads</div>
      <div class="card-body">
        <h5 class="card-title">{{ $totalLeads }}</h5>
        <p class="card-text">Number of leads received.</p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card text-white bg-success mb-3">
      <div class="card-header">Total Listings</div>
      <div class="card-body">
        <h5 class="card-title">{{ $totalListings }}</h5>
        <p class="card-text">Number of car listings.</p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card text-white bg-warning mb-3">
      <div class="card-header">Total Sales</div>
      <div class="card-body">
        <h5 class="card-title">{{ $totalSales }}</h5>
        <p class="card-text">Number of cars sold.</p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card text-white bg-danger mb-3">
      <div class="card-header">Average Price</div>
      <div class="card-body">
        <h5 class="card-title">R{{ number_format($averagePrice, 2) }}</h5> 
        <p class="card-text">Average price of listed cars.</p>
      </div>
    </div>
  </div>
</div>

<div class="row mb-4">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">Cars per Make with Sales</div>
      <div class="card-body">
        <canvas id="makeChart"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">Leads by Status</div>
      <div class="card-body">
        <canvas id="leadsStatusChart"></canvas>
      </div>
    </div>
  </div>
</div>
<div class="row mb-4"> 
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Potential Gains</div>
            <div class="card-body">
                <canvas id="gainsChart"></canvas> 
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Cars Added Month on Month</div>
            <div class="card-body">
                <canvas id="monthlyCarsChart"></canvas> 
            </div>
        </div>
    </div>
</div>
@if ($hasData)
<div class="card">
  <div class="card-header">Listings Distribution by Category</div>
  <div class="card-body">
    <table id="listingsTable" class="table">
      <thead>
        <tr>
          <th>Make</th>
          @foreach ($categoryTypes as $type)
          <th colspan="{{ count($categoryData[$makes[0]][$type] ?? []) }}">{{ $type }}</th>
          @endforeach
        </tr>
        <tr>
          <th></th>
          @foreach ($categoryTypes as $type)
          @if(isset($categoryData[$makes[0]][$type]))
            @foreach ($categoryData[$makes[0]][$type] as $category)
            <th>{{ $category->category_name }}</th>
            @endforeach
          @endif
          @endforeach
        </tr>
      </thead>
      <tbody>
        @foreach ($makes as $make)
        <tr>
          <td>
            <span class="collapse-icon" data-make="{{ $make }}">▶</span> {{ $make }}
          </td>
          @foreach ($categoryTypes as $type)
          @if(isset($categoryData[$make][$type]))
            @foreach ($categoryData[$make][$type] as $category)
            <td>{{ $category->count }}</td>
            @endforeach
          @endif
          @endforeach
        </tr>
        <tr class="child-row" id="model-list-{{ $make }}" style="display: none;">
          <td colspan="{{ count($categoryTypes) * count($categoryData[$makes[0]][$type] ?? []) }}">
            <table class="table">
              <thead>
                <tr>
                  <th>Model</th>
                  <th>Count</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($modelsData[$make] as $model)
                <tr>
                  <td>
                    <span class="collapse-icon" data-model="{{ $model->model }}">▶</span> {{ $model->model }}
                  </td>
                  <td>{{ $model->count }}</td>
                </tr>
                <tr class="model-row" id="car-list-{{ $model->model }}" style="display: none;">
                  <td colspan="2">
                    <ul>
                      <li>Car details for {{ $model->model }} <button class="btn btn-sm btn-link">View</button></li>
                    </ul>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@else
<p>No data available to display the table.</p>
@endif

@foreach ($makes as $make)
<div class="card chart-container">
    <div class="card-header">{{ $make }} Analysis</div>
    <div class="card-body">
        <div class="row"> 
            @foreach ($categoryTypes as $type)
                <div class="col-md-4 chart-card"> 
                    <canvas id="chart-{{ $make }}-{{ $type }}"></canvas>
                </div>
                @if ($loop->iteration % 3 == 0) 
                    </div><div class="row"> 
                @endif
            @endforeach
        </div> 
    </div>
</div>
@endforeach

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // 1. Bar graph for cars per make with sales line
  var makeCtx = document.getElementById('makeChart').getContext('2d');
  var makeChart = new Chart(makeCtx, {
    type: 'bar',
    data: {
      labels: @json($makeLabels),
      datasets: [{
          label: 'Total Listings',
          data: (@json($totalListingsData)),
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        },
        {
          label: 'Total Sales',
          data: (@json($totalSalesData)),
          type: 'line',
          fill: false,
          borderColor: 'rgba(255, 99, 132, 1)',
          tension: 0.4
        }
      ]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  // 2. Bar graph for lead statuses
  var leadsStatusCtx = document.getElementById('leadsStatusChart').getContext('2d');
  var leadsStatusChart = new Chart(leadsStatusCtx, {
    type: 'bar',
    data: {
      labels: @json($leadStatusLabels),
      datasets: [{
        label: 'Leads Count',
        data: (@json($leadStatusCounts)),
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  @foreach ($makes as $make)
  @foreach ($categoryTypes as $type)
  var ctx = document.getElementById('chart-{{ $make }}-{{ $type }}').getContext('2d');
  var chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: @json($categoryData[$make][$type]->pluck('category_name')),
      datasets:[{
        label: '{{ $type }} Count',
        data: (@json($categoryData[$make][$type]->pluck('count'))),
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
  @endforeach
  @endforeach

// 3. Pie chart for potential gains
var gainsCtx = document.getElementById('gainsChart').getContext('2d');
var gainsChart = new Chart(gainsCtx, {
    type: 'pie',
    data: {
        labels: ['Sold (R' + @json($totalSold) + ')', 'Active (R' + @json($totalActive) + ')'],
        datasets: [{
            label: 'Potential Gains',
            data: [@json($totalSold), @json($totalActive)],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true, // Make the chart responsive
        plugins: {
            title: {  // Add a title to the chart
                display: true,
                text: 'Potential Gains'
            }
        }
    }
});

// 4. Line graph for cars added month on month
var monthlyCarsCtx = document.getElementById('monthlyCarsChart').getContext('2d');
var monthlyCarsChart = new Chart(monthlyCarsCtx, {
    type: 'line',
    data: {
        labels: @json($monthlyLabels),
        datasets: [{
            label: 'Cars Added',
            data: @json($monthlyCarCounts),
            backgroundColor: 'rgba(255, 206, 86, 0.2)',
            borderColor: 'rgba(255, 206, 86, 1)',
            borderWidth: 1,
            fill: false
        }]
    },
    options: {
        responsive: true, // Make the chart responsive
        plugins: {
            title: {  // Add a title to the chart
                display: true,
                text: 'Cars Added Month on Month'
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                title: { // Add a label to the y-axis
                    display: true,
                    text: 'Number of Cars'
                }
            },
            x: {
                title: { // Add a label to the x-axis
                    display: true,
                    text: 'Month'
                }
            }
        }
    }
});


  document.querySelectorAll('.collapse-icon').forEach(icon => {
    icon.addEventListener('click', function() {
      const make = this.dataset.make;
      const model = this.dataset.model;
      if (make) {
        const row = document.querySelector(`#model-list-${make}`);
        row.style.display = row.style.display === 'none' ? '' : 'none';
        this.innerHTML = this.innerHTML === '&#9654;' ? '&#9660;' : '&#9654;';
      } else if (model) {
        const row = document.querySelector(`#car-list-${model}`);
        row.style.display = row.style.display === 'none' ? '' : 'none';
        this.innerHTML = this.innerHTML === '&#9654;' ? '&#9660;' : '&#9654;';
      }
    });
  });
</script>

@endsection
