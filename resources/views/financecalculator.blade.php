@extends('layouts.index')

@section('content')
<style>
.card-header {
    font-weight: bold;
    font-size: 1.2rem;
    border-bottom: 2px solid #ccc;
}

.text-muted {
    font-style: italic;
    color: #6c757d;
}
</style>
<div class="container mt-5">
    <h2 class="text-center">Comprehensive Car Finance Calculator</h2>
    
    <!-- Row 1: Finance Calculator -->
    <div class="row mt-4">
        <!-- Column 1: Finance Form -->
        <div class="col-md-6">
            <form id="financeCalculator" class="bg-light p-4 rounded shadow-sm">
                <h4 class="text-primary">Finance Calculator</h4>
                <div class="form-group">
                    <label for="price">Car Price</label>
                    <input oninput="calculatePayment()" type="number" class="form-control" id="price" name="price" value="100000" required>
                </div>
                <div class="form-group">
                    <label for="deposit">Deposit Amount</label>
                    <input oninput="calculatePayment()" type="number" class="form-control" id="deposit" name="deposit" value="0" required>
                </div>
                <div class="form-group">
                    <label for="tradeInValue">Trade-In Value</label>
                    <input oninput="calculatePayment()" type="number" class="form-control" id="tradeInValue" name="tradeInValue" value="0">
                </div>
                <div class="form-group">
                    <label for="interestRate">Interest Rate (%)</label>
                    <input onchange="calculatePayment()" type="range" class="form-control-range" id="interestRate" name="interestRate" min="9" max="20" value="13.75" oninput="updateInterestRateValue(this.value)">
                    <span id="interestRateValue">15%</span>
                </div>
                <div class="form-group">
                    <label for="loanTerm">Loan Term (months)</label>
                    <input onchange="calculatePayment()" type="range" class="form-control-range" id="loanTerm" name="loanTerm" min="45" max="90" value="72" step="3" oninput="updateLoanTermValue(this.value)">
                    <span id="loanTermValue">60 months</span>
                </div>
                <div class="form-group">
                    <label for="balloonPayment">Balloon Payment (%)</label>
                    <input onchange="calculatePayment()" type="range" class="form-control-range" id="balloonPayment" name="balloonPayment" min="0" max="50" value="0" oninput="updateBalloonPaymentValue(this.value)">
                    <span id="balloonPaymentValue">0%</span>
                </div>
            </form>
        </div>

        <!-- Column 2: Results Section -->
        <div class="col-md-6 card mt-4">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title">Payment Summary</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <table  class="table table-dark table-bordered w-100" style="color:white">
                       <tr> <td>Monthly Payment: </td> <td id="monthlyPayment">R0.00</td></tr>
                       <tr>   <td>Total Loan Value: </td> <td id="totalLoanValue">R0.00</td></tr>
                       <tr>  <td>Total Interest: </td> <td  id="totalInterest">R0.00</td></tr>
                   
                       <tr>  <td>Total Payment: </td> <td  id="totalPayment">R0.00</td></tr>
                       <tr>  <td>Balloon Payment Due: </td> <td id="balloonPaymentDue">R0.00</td></tr>
                       <tr>  <td>Trade-In Value: </td> <td id="tradeInValueCal">R0.00</td></tr>
                    </table>
                </div>
            </div>
            <p class="mt-3 text-muted">
                <strong>Note:</strong> The loan and trade-in calculations provided are estimates. Actual values may vary depending on financial providers. It is advisable to consult financial institutions for precise values. Use the car filter above to find vehicles within the calculated loan range.
            </p>
        </div>
    </div>

  <!-- Graph Section -->
  <div class="row mt-5">
        <div class="col-12">
            <div class="p-4 bg-light rounded shadow-sm">
                <h4>Payment Over Time & Predicted Depreciation</h4>
                <canvas id="paymentGraph" height="100"></canvas>
            </div>
        </div>
    </div>

   
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
function fetchMakes() {
    fetch('/api/makes')
        .then(response => response.json())
        .then(data => {
            let makesSelect = document.getElementById('make');
            data.makes.forEach(make => {
                let option = document.createElement('option');
                option.value = make.id;
                option.text = make.name;
                makesSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching makes:', error));
}

function fetchModels() {
    const makeId = document.getElementById('make').value;
    if (makeId) {
        fetch(`/api/models/${makeId}`)
            .then(response => response.json())
            .then(data => {
                let modelsSelect = document.getElementById('model');
                modelsSelect.innerHTML = '<option value="">Select Model</option>';
                data.models.forEach(model => {
                    let option = document.createElement('option');
                    option.value = model.id;
                    option.text = model.name;
                    modelsSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching models:', error));
    }
}

function fetchVariants() {
    const modelId = document.getElementById('model').value;
    if (modelId) {
        fetch(`/api/variants/${modelId}`)
            .then(response => response.json())
            .then(data => {
                let variantsSelect = document.getElementById('variant');
                variantsSelect.innerHTML = '<option value="">Select Variant</option>';
                data.variants.forEach(variant => {
                    let option = document.createElement('option');
                    option.value = variant.id;
                    option.text = variant.name;
                    variantsSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching variants:', error));
    }
}
function formatToZAR(amount) {
    return new Intl.NumberFormat('en-ZA', { style: 'currency', currency: 'ZAR' }).format(amount);
}
function displayVariantDetails() {
    const variantId = document.getElementById('variant').value;
    if (variantId) {
        fetch(`/api/variant/details/${variantId}`)
            .then(response => response.json())
            .then(data => {
                let content = `
                    <h4>Variant Details:</h4>
                    <p><strong>Price:</strong> R${data.price}</p>
                    <p><strong>Color:</strong> ${data.color}</p>
                    <p><strong>Engine Size:</strong> ${data.engine_size}</p>
                `;
                document.getElementById('dynamicContent').innerHTML = content;
            })
            .catch(error => console.error('Error fetching variant details:', error));
    }
}
function updateInterestRateValue(value) {
    document.getElementById('interestRateValue').innerText = value + '%';
}

function updateLoanTermValue(value) {
    document.getElementById('loanTermValue').innerText = value + ' months';
}

function updateBalloonPaymentValue(value) {
    document.getElementById('balloonPaymentValue').innerText = value + '%';
}
function calculatePayment() {
    const price = parseFloat(document.getElementById('price').value);
    const deposit = parseFloat(document.getElementById('deposit').value);
    const interestRate = parseFloat(document.getElementById('interestRate').value) / 100;
    const loanTerm = parseInt(document.getElementById('loanTerm').value);
    const balloonPayment = parseFloat(document.getElementById('balloonPayment').value) / 100;
    const tradeInAssetValue=parseFloat(document.getElementById('tradeInValue').value);
    // Calculate loan amount (Price - Deposit)
    const loanAmount = price - (deposit + tradeInAssetValue);

    // Balloon payment (based on percentage of loan amount)
    const balloon = loanAmount * balloonPayment;

    // Monthly payment calculation (simplified formula)
    const principal = loanAmount - balloon;
    const monthlyInterestRate = interestRate / 12;
    const monthlyPayment = (principal * monthlyInterestRate) / (1 - Math.pow(1 + monthlyInterestRate, -loanTerm));

    // Total loan value, total interest, and other results
    const totalLoanValue = principal + balloon;
    const totalInterest = (monthlyPayment * loanTerm) - principal;
    const totalPayment = totalLoanValue + totalInterest;

    // Depreciation and Trade-In calculation
    const depreciationRate = 0.15; // Example: 15% annual depreciation
    const depreciationValue = price * Math.pow(1 - depreciationRate, loanTerm / 12);  // Depreciation value after loanTerm years
    const tradeInValue = price * Math.pow(1 - depreciationRate * 0.85, loanTerm / 12); // Adjusted for trade-in prediction (lower depreciation rate)

    // Update the DOM with calculated values
    document.getElementById('monthlyPayment').textContent = `${formatToZAR(monthlyPayment)}`;
    document.getElementById('totalLoanValue').textContent = `${formatToZAR(totalLoanValue)}`;
    document.getElementById('totalInterest').textContent = `${formatToZAR(totalInterest)}`;
    document.getElementById('totalPayment').textContent = `${formatToZAR(totalPayment)}`;
    document.getElementById('balloonPaymentDue').textContent = `${formatToZAR(balloon)}`;
    document.getElementById('tradeInValueCal').textContent = `${formatToZAR(tradeInAssetValue)}`;

    // Update the graph for Payment Over Time & Predicted Depreciation and Trade-In
    setDepreciationAndTradeInGraph(depreciationValue, tradeInValue, monthlyPayment, loanTerm);
}

let chart; // Declare the chart variable in the outer scope

function setDepreciationAndTradeInGraph(depreciationValue, tradeInValue, monthlyPayment, loanTerm) {
    // Data for the graph
    const months = Array.from({ length: loanTerm }, (_, i) => i + 1); // Loan term months
    const depreciationValues = months.map(month => depreciationValue * Math.pow(1 - 0.15, month / 12));
    const tradeInValues = months.map(month => tradeInValue * Math.pow(1 - 0.15 * 0.85, month / 12));

    // Loan repayment over time
    const loanRepaymentValues = months.map((_, i) => monthlyPayment * (i + 1));

    // Create the chart
    const ctx = document.getElementById('paymentGraph').getContext('2d');

    // Destroy the existing chart instance if it exists
    if (chart) {
        chart.destroy();
    }

    // Clear the canvas content
    $("#paymentGraph").html('');

    // Create a new chart instance
    chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Depreciation Value',
                    data: depreciationValues,
                    borderColor: 'red',
                    fill: false
                },
                {
                    label: 'Trade-In Value (Predicted)',
                    data: tradeInValues,
                    borderColor: 'green',
                    fill: false
                },
                {
                    label: 'Loan Repayment Value',
                    data: loanRepaymentValues,
                    borderColor: 'blue',
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Months'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Value (R)'
                    }
                }
            }
        }
    });
}


$(document).ready(function() {
    calculatePayment()
})

</script>
@endsection
