@extends('layouts.index')

@section('content')
<div id="financeModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3>Finance Calculator</h3>
            <form id="financeCalculator" class="p-4">
                <div class="form-group">
                    <label for="price">Car Price</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
                <div class="form-group">
                    <label for="deposit">Deposit Amount</label>
                    <input type="number" class="form-control" id="deposit" name="deposit" value="0" required>
                </div>
                <div class="form-group">
                    <label for="interestRate">Interest Rate (%)</label>
                    <input type="range" class="form-control-range" id="interestRate" name="interestRate" min="9" max="20" value="15" oninput="updateInterestRateValue(this.value)">
                    <span id="interestRateValue">15%</span>
                </div>
                <div class="form-group">
                    <label for="loanTerm">Loan Term (months)</label>
                    <input type="range" class="form-control-range" id="loanTerm" name="loanTerm" min="45" max="90" value="60" step="3" oninput="updateLoanTermValue(this.value)">
                    <span id="loanTermValue">60 months</span>
                </div>
                <div class="form-group">
                    <label for="balloonPayment">Balloon Payment (%)</label>
                    <input type="range" class="form-control-range" id="balloonPayment" name="balloonPayment" min="0" max="50" value="0" oninput="updateBalloonPaymentValue(this.value)">
                    <span id="balloonPaymentValue">0%</span>
                </div>
                <button type="button" class="btn btn-primary" onclick="calculatePayment()">Calculate</button>
            </form>
            <div id="monthlyPayment" class="mt-3"></div>
            <div id="balloonPaymentInfo" class="mt-3"></div>
        </div>
    </div>
<script>
Finance calculator functions
        function openModal() {
            document.getElementById('financeModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('financeModal').style.display = "none";
        }

        function updateInterestRateValue(value) {
            document.getElementById('interestRateValue').innerText = `${value}%`;
        }

        function updateLoanTermValue(value) {
            document.getElementById('loanTermValue').innerText = `${value} months`;
        }

        function updateBalloonPaymentValue(value) {
            document.getElementById('balloonPaymentValue').innerText = `${value}%`;
        }

        function calculatePayment() {
            const price = parseFloat(document.getElementById('price').value);
            const deposit = parseFloat(document.getElementById('deposit').value);
            const interestRate = parseFloat(document.getElementById('interestRate').value) / 100 / 12;
            const loanTerm = parseInt(document.getElementById('loanTerm').value);
            const balloonPayment = parseFloat(document.getElementById('balloonPayment').value) / 100;

            const financeFeeRate = 0.15; // 15% finance fees
            const loanAmount = (price * (1 + financeFeeRate)) - deposit;
            const balloonAmount = price * balloonPayment;
            const monthlyPayment = (loanAmount * interestRate) / (1 - Math.pow(1 + interestRate, -loanTerm)) + (balloonAmount / loanTerm);

            document.getElementById('monthlyPayment').innerText = `Monthly Payment: R${monthlyPayment.toFixed(2)}`;
            document.getElementById('balloonPaymentInfo').innerText = `Balloon Payment Due at End: R${balloonAmount.toFixed(2)}`;
            }

            // Navbar collapse on load
            document.addEventListener('DOMContentLoaded', function() {
            var navbarCollapse = document.querySelector('.navbar-collapse');
            if (navbarCollapse) { // Check if navbarCollapse exists
                navbarCollapse.classList.remove('show');
            }
            });
<script>