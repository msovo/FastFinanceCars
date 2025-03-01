class DashboardManager {
    constructor() {
        this.charts = {};
        this.init();
    }

    init() {
        this.initializeDatePicker();
        this.initializeCharts();
        this.initializeDealerTable();
        this.setupEventListeners();
    }

    initializeDatePicker() {
        $('#dateRange').daterangepicker({
            startDate: moment().subtract(29, 'days'),
            endDate: moment(),
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, (start, end) => {
            this.refreshData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
        });
    }

    initializeCharts() {
        // Sales Trend Chart
        this.charts.salesTrend = new Chart(
            document.getElementById('salesTrendChart').getContext('2d'),
            this.getSalesTrendConfig()
        );

        // Market Distribution Chart
        this.charts.marketDistribution = new Chart(
            document.getElementById('marketDistributionChart').getContext('2d'),
            this.getMarketDistributionConfig()
        );

        // Sales Forecast Chart
        this.charts.salesForecast = new Chart(
            document.getElementById('salesForecastChart').getContext('2d'),
            this.getSalesForecastConfig()
        );

        // Price Prediction Chart
        this.charts.pricePrediction = new Chart(
            document.getElementById('pricePredictionChart').getContext('2d'),
            this.getPricePredictionConfig()
        );
    }

    initializeDealerTable() {
        this.dealerTable = $('#dealersTable').DataTable({
            pageLength: 10,
            order: [[6, 'desc']],
            dom: 'Bfrtip',
            buttons: [
                'copy', 
                'csv', 
                'excel', 
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape'
                }, 
                'print'
            ]
        });
    }

    setupEventListeners() {
        $('#refreshData').click(() => this.refreshData());
        $('#exportData').click(() => this.exportData());
        $('#salesTrendPeriod').change((e) => this.updateChartPeriod(e.target.value));
        
        // Dealer contact button handler
        $('.dealer-contact').click((e) => {
            const dealerId = $(e.currentTarget).data('dealer-id');
            this.contactDealer(dealerId);
        });
    }

    refreshData(startDate = null, endDate = null) {
        $.ajax({
            url: '/admin/dashboard/refresh',
            data: { start_date: startDate, end_date: endDate },
            success: (response) => {
                this.updateDashboard(response);
            },
            error: (error) => {
                console.error('Error refreshing dashboard:', error);
                toastr.error('Failed to refresh dashboard data');
            }
        });
    }

    updateDashboard(data) {
        this.updateMetrics(data.platformStats);
        this.updateCharts(data);
        this.updateDealerTable(data.dealerMetrics);
    }

    // Chart configuration methods
    getSalesTrendConfig() {
        return {
            type: 'line',
            data: {
                labels: salesData.labels,
                datasets: [{
                    label: 'Sales',
                    data: salesData.values,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Sales Trend'
                    }
                }
            }
        };
    }

    // Add other chart configurations...
// Continuing from the DashboardManager class...

    // Market Distribution Chart Configuration
    getMarketDistributionConfig() {
        return {
            type: 'doughnut',
            data: {
                labels: marketData.labels,
                datasets: [{
                    data: marketData.values,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right'
                    },
                    title: {
                        display: true,
                        text: 'Market Distribution'
                    }
                }
            }
        };
    }

    // Sales Forecast Chart Configuration
    getSalesForecastConfig() {
        return {
            type: 'line',
            data: {
                labels: forecastData.labels,
                datasets: [{
                    label: 'Actual Sales',
                    data: forecastData.actual,
                    borderColor: 'rgb(75, 192, 192)',
                    fill: false
                }, {
                    label: 'Predicted Sales',
                    data: forecastData.predicted,
                    borderColor: 'rgb(255, 99, 132)',
                    borderDash: [5, 5],
                    fill: false
                }, {
                    label: 'Confidence Interval',
                    data: forecastData.confidence,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'transparent',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Sales Forecast & Predictions'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.parsed.y.toFixed(2);
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Sales'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    }
                }
            }
        };
    }

    // Price Trend Chart Configuration
    getPriceTrendConfig() {
        return {
            type: 'line',
            data: {
                labels: priceData.labels,
                datasets: [{
                    label: 'Average Price',
                    data: priceData.averages,
                    borderColor: 'rgb(75, 192, 192)',
                    fill: false
                }, {
                    label: 'Price Range',
                    data: priceData.ranges,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'transparent',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Price Trends & Analysis'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Price (R)'
                        },
                        ticks: {
                            callback: function(value) {
                                return 'R' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        };
    }

    // Dealer Performance Chart Configuration
    getDealerPerformanceConfig() {
        return {
            type: 'bar',
            data: {
                labels: dealerData.labels,
                datasets: [{
                    label: 'Sales Performance',
                    data: dealerData.performance,
                    backgroundColor: 'rgba(75, 192, 192, 0.8)'
                }, {
                    label: 'Response Rate',
                    data: dealerData.responseRate,
                    backgroundColor: 'rgba(255, 99, 132, 0.8)'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Dealer Performance Metrics'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Performance Score'
                        }
                    }
                }
            }
        };
    }

    // Export Data Implementation
    exportData() {
        const format = $('#exportFormat').val() || 'pdf';
        const dateRange = $('#dateRange').val();
        
        $.ajax({
            url: '/admin/dashboard/export',
            method: 'POST',
            data: {
                format: format,
                dateRange: dateRange,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            xhrFields: {
                responseType: 'blob'
            },
            success: (response) => {
                const url = window.URL.createObjectURL(new Blob([response]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', `dashboard-report-${moment().format('YYYY-MM-DD')}.${format}`);
                document.body.appendChild(link);
                link.click();
                link.remove();
            },
            error: (error) => {
                console.error('Export failed:', error);
                toastr.error('Failed to export dashboard data');
            }
        });
    }

    // Dealer Contact Implementation
    contactDealer(dealerId) {
        // Create modal for dealer contact
        const modal = $(`
            <div class="modal fade" id="contactDealerModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Contact Dealer</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="dealerContactForm">
                                <div class="form-group">
                                    <label>Subject</label>
                                    <input type="text" class="form-control" name="subject" required>
                                </div>
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea class="form-control" name="message" rows="4" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Priority</label>
                                    <select class="form-control" name="priority">
                                        <option value="low">Low</option>
                                        <option value="medium">Medium</option>
                                        <option value="high">High</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="sendMessage">Send Message</button>
                        </div>
                    </div>
                </div>
            </div>
        `);

        // Add modal to body
        $('body').append(modal);

        // Initialize modal
        modal.modal('show');

        // Handle send message
        $('#sendMessage').click(() => {
            const formData = new FormData($('#dealerContactForm')[0]);
            formData.append('dealer_id', dealerId);

            $.ajax({
                url: '/admin/dealers/contact',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: (response) => {
                    toastr.success('Message sent successfully');
                    modal.modal('hide');
                },
                error: (error) => {
                    console.error('Failed to send message:', error);
                    toastr.error('Failed to send message');
                }
            });
        });

        // Clean up modal when closed
        modal.on('hidden.bs.modal', function () {
            modal.remove();
        });
    }

    // Update chart data
    updateChartData(chartId, newData) {
        const chart = this.charts[chartId];
        if (chart) {
            chart.data = newData;
            chart.update();
        }
    }

    // Refresh all charts
    refreshCharts() {
        Object.keys(this.charts).forEach(chartId => {
            this.refreshChartData(chartId);
        });
    }

    // Refresh specific chart data
    refreshChartData(chartId) {
        $.ajax({
            url: `/admin/dashboard/chart-data/${chartId}`,
            success: (response) => {
                this.updateChartData(chartId, response);
            },
            error: (error) => {
                console.error(`Failed to refresh ${chartId} chart:`, error);
                toastr.error(`Failed to update ${chartId} chart`);
            }
        });
    }

}

// Initialize dashboard when document is ready
$(document).ready(() => {
    window.dashboardManager = new DashboardManager();
});