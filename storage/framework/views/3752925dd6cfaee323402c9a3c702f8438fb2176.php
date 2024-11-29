

<?php $__env->startSection('title', 'Dealer Dashboard'); ?>

<?php $__env->startSection('content'); ?>
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
        <h5 class="card-title"><?php echo e($totalLeads); ?></h5>
        <p class="card-text">Number of leads received.</p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card text-white bg-success mb-3">
      <div class="card-header">Total Listings</div>
      <div class="card-body">
        <h5 class="card-title"><?php echo e($totalListings); ?></h5>
        <p class="card-text">Number of car listings.</p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card text-white bg-warning mb-3">
      <div class="card-header">Total Sales</div>
      <div class="card-body">
        <h5 class="card-title"><?php echo e($totalSales); ?></h5>
        <p class="card-text">Number of cars sold.</p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card text-white bg-danger mb-3">
      <div class="card-header">Average Price</div>
      <div class="card-body">
        <h5 class="card-title">R<?php echo e(number_format($averagePrice, 2)); ?></h5> 
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
<?php if($hasData): ?>
<div class="card">
  <div class="card-header">Listings Distribution by Category</div>
  <div class="card-body">
    <table id="listingsTable" class="table">
      <thead>
        <tr>
          <th>Make</th>
          <?php $__currentLoopData = $categoryTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <th colspan="<?php echo e(count($categoryData[$makes[0]][$type] ?? [])); ?>"><?php echo e($type); ?></th>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        <tr>
          <th></th>
          <?php $__currentLoopData = $categoryTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if(isset($categoryData[$makes[0]][$type])): ?>
            <?php $__currentLoopData = $categoryData[$makes[0]][$type]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <th><?php echo e($category->category_name); ?></th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $makes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td>
            <span class="collapse-icon" data-make="<?php echo e($make); ?>">▶</span> <?php echo e($make); ?>

          </td>
          <?php $__currentLoopData = $categoryTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if(isset($categoryData[$make][$type])): ?>
            <?php $__currentLoopData = $categoryData[$make][$type]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td><?php echo e($category->count); ?></td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        <tr class="child-row" id="model-list-<?php echo e($make); ?>" style="display: none;">
          <td colspan="<?php echo e(count($categoryTypes) * count($categoryData[$makes[0]][$type] ?? [])); ?>">
            <table class="table">
              <thead>
                <tr>
                  <th>Model</th>
                  <th>Count</th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $modelsData[$make]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td>
                    <span class="collapse-icon" data-model="<?php echo e($model->model); ?>">▶</span> <?php echo e($model->model); ?>

                  </td>
                  <td><?php echo e($model->count); ?></td>
                </tr>
                <tr class="model-row" id="car-list-<?php echo e($model->model); ?>" style="display: none;">
                  <td colspan="2">
                    <ul>
                      <li>Car details for <?php echo e($model->model); ?> <button class="btn btn-sm btn-link">View</button></li>
                    </ul>
                  </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
  </div>
</div>
<?php else: ?>
<p>No data available to display the table.</p>
<?php endif; ?>

<?php $__currentLoopData = $makes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="card chart-container">
    <div class="card-header"><?php echo e($make); ?> Analysis</div>
    <div class="card-body">
        <div class="row"> 
            <?php $__currentLoopData = $categoryTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 chart-card"> 
                    <canvas id="chart-<?php echo e($make); ?>-<?php echo e($type); ?>"></canvas>
                </div>
                <?php if($loop->iteration % 3 == 0): ?> 
                    </div><div class="row"> 
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div> 
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // 1. Bar graph for cars per make with sales line
  var makeCtx = document.getElementById('makeChart').getContext('2d');
  var makeChart = new Chart(makeCtx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($makeLabels, 15, 512) ?>,
      datasets: [{
          label: 'Total Listings',
          data: (<?php echo json_encode($totalListingsData, 15, 512) ?>),
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        },
        {
          label: 'Total Sales',
          data: (<?php echo json_encode($totalSalesData, 15, 512) ?>),
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
      labels: <?php echo json_encode($leadStatusLabels, 15, 512) ?>,
      datasets: [{
        label: 'Leads Count',
        data: (<?php echo json_encode($leadStatusCounts, 15, 512) ?>),
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

  <?php $__currentLoopData = $makes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php $__currentLoopData = $categoryTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  var ctx = document.getElementById('chart-<?php echo e($make); ?>-<?php echo e($type); ?>').getContext('2d');
  var chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($categoryData[$make][$type]->pluck('category_name'), 15, 512) ?>,
      datasets:[{
        label: '<?php echo e($type); ?> Count',
        data: (<?php echo json_encode($categoryData[$make][$type]->pluck('count'), 15, 512) ?>),
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
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

// 3. Pie chart for potential gains
var gainsCtx = document.getElementById('gainsChart').getContext('2d');
var gainsChart = new Chart(gainsCtx, {
    type: 'pie',
    data: {
        labels: ['Sold (R' + <?php echo json_encode($totalSold, 15, 512) ?> + ')', 'Active (R' + <?php echo json_encode($totalActive, 15, 512) ?> + ')'],
        datasets: [{
            label: 'Potential Gains',
            data: [<?php echo json_encode($totalSold, 15, 512) ?>, <?php echo json_encode($totalActive, 15, 512) ?>],
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
        labels: <?php echo json_encode($monthlyLabels, 15, 512) ?>,
        datasets: [{
            label: 'Cars Added',
            data: <?php echo json_encode($monthlyCarCounts, 15, 512) ?>,
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dealer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FastFinanceCars\resources\views/dealer/dashboard.blade.php ENDPATH**/ ?>