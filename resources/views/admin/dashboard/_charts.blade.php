<div class="row mb-4">
    <!-- Sales Trend Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Sales Trends</h6>
                <div class="chart-period-selector">
                    <select class="form-control form-control-sm" id="salesTrendPeriod">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                    </select>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="salesTrendChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Market Distribution Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Market Distribution</h6>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="marketDistributionChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Predictive Analytics Charts -->
<div class="row mb-4">
    <div class="col-xl-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Sales Forecast</h6>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="salesForecastChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Price Trends & Predictions</h6>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="pricePredictionChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>