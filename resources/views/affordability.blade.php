@extends('layouts.index')

@section('content')
<style type="text/css">
    /* General Styles */
body {
    font-family: 'Roboto', Arial, sans-serif;
    background-color: #f9f9f9;
    color: #333;
    margin: 0;
    padding: 20px;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
}

/* Car Item Card */
.car-item {
    margin-bottom: 20px;
}

.card {
    border: none;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    cursor: pointer;
}

/* Card Image */
.main-image-container {
    position: relative;
    overflow: hidden;
    max-height: 250px;
    height: 250px;
}

.main-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.main-image-container:hover .main-image {
    transform: scale(1.05);
}

.image-count {
    font-size: 12px;
    opacity: 0.8;
}

/* Thumbnails */
.thumbnails .thumbnail-image {
    border: 1px solid #ddd;
    border-radius: 4px;
    object-fit: cover;
    height: 80px !important;
    max-height: 80px !important;
}

.thumbnails .thumbnail-image:hover {
    border-color: #007bff;
    cursor: pointer;
}

/* Card Body */
.card-body {
    padding: 15px;
    background-color: #fff;
}

.card-title {
    font-size: 16px;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
}

.card-title i {
    color: #007bff;
}

.card-text {
    font-size: 14px;
    color: #666;
    margin-bottom: 8px;
}

.card-text i {
    color: #007bff;
    margin-right: 5px;
}

.card-text.text-danger {
    font-size: 15px;
    font-weight: bold;
    color: #e74c3c;
}

.card-text .badge {
    font-size: 12px;
    padding: 4px 8px;
    border-radius: 4px;
}

/* Price Highlight */
.card-title h5 {
    color: #007bff;
    font-weight: bold;
    margin-top: 5px;
    font-size: 14px;
    overflow: hidden;
}



/* Dealer Section */
.card-footer {
    padding: 10px 15px;
    background-color: #f7f7f7;
    border-top: 1px solid #ddd;
}

.dealer-info {
    display: flex;
    align-items: center;
}

.dealer-logo {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid #ddd;
    object-fit: cover;
}

.dealer-details {
    font-size: 12px;
    color: #333;
}

.dealer-details .dealer-name {
    font-weight: bold;
    margin: 0;
    color: #007bff;
}

.dealer-details .dealer-location {
    margin: 0;
    font-size: 11px;
    color: #666;
}

.verified-status {
    font-size: 12px;
    font-weight: bold;
    display: flex;
    align-items: center;
    color: #333;
}

.verified-status .fa-check-circle {
    color: #28a745;
    margin-right: 5px;
}

.verified-status .fa-exclamation-triangle {
    color: #e74c3c;
    margin-right: 5px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .main-image {
        height: 150px;
    }

    .card-body {
        padding: 10px;
    }

    .card-title {
        font-size: 14px;
    }

    .card-text {
        font-size: 12px;
    }
}
/* Pagination Container */
#pagingBtnAffodability .pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 5px;
    margin: 20px 0;
    padding: 0;
    list-style: none;
}

/* Pagination Button Styles */
#pagingBtnAffodability .pagination button {
    display: inline-block;
    min-width: 35px;
    height: 35px;
    line-height: 35px;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f7f7f7;
    color: #333;
    font-size: 14px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}

/* Hover and Active States */
#pagingBtnAffodability .pagination button:hover {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

#pagingBtnAffodability .pagination .active {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

/* Disabled Button Styles */
#pagingBtnAffodability .pagination .disabled {
    background-color: #e9ecef;
    color: #adb5bd;
    cursor: not-allowed;
    border-color: #e9ecef;
}

.affordability-warning-card {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      width: 320px;
      padding: 20px;
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .affordability-warning-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
    }
    .affordability-warning-card p {
      font-size: 16px;
      color: #333;
      margin: 0;
      line-height: 1.5;
    }
    .highlight {
      color: #FF5722; /* Warning color */
      font-weight: bold;
    }
/* Responsive Adjustments */
@media (max-width: 768px) {
    #pagingBtnAffodability .pagination div {
        min-width: 30px;
        height: 30px;
        line-height: 30px;
        font-size: 12px;
    }
}

</style>
<style>
    body{
        background:gainsboro;
    }
    /* ... (Your existing CSS styles) ... */
    #toggleMoreFilters {
            color: white;
            background-color: rgba(128, 128, 128, 0.5);
            border-radius: 15px;
            padding: 10px 20px;
            margin-bottom:15px;
            text-decoration: none;
            
        }
        .more-filters {
            position: fixed;
            top: 0;
            left: -300px; /* Start off-screen */
            width: 300px;
            height: 100%;
            background-color: #f8f9fa;
            overflow-y: auto;
            transition: left 0.3s ease;
            z-index: 1050;
            box-shadow: 2px 0 5px rgba(0,0,0,0.5);
            padding: 20px;
            margin-bottom: 5px;
        }
        .more-filters.show {
            left: 0; /* Slide in */
            color:black;
            display:none;
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(128, 128, 128, 0.5); /* Grey and transparent */
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .category-section {
            margin-bottom: 10px;
        }
        .category-header {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .card {
            margin-bottom: 10px;
        }
    .dropdown-item {
        width: 100%;
    }
    .expand-models-btn {
        background: none;
        border: none;
        padding: 0;
        margin: 0;
    }
 
.advanced-search {
    position: absolute;
    top: 20vh;
    left: 0; 
    background-color: #cccccc;
    padding: 20px;
    color: white;
    z-index: 99;
    border-radius: 10px; 
    width:30%;
}

@media (max-width: 768px) { 
    .section-title{
        text-align: center;
    }
    .advanced-search {
        width: 90%; 
        left: 50%; 
        transform: translateX(-50%); 
        top: 10vh; 
        font: size 0.5em!important;
    }
}

    .jumbotron, 
.advanced-search, 
.car-listing, 
.services, 
.news-reviews, 
.sponsored-cars, 
.latest-cars, 
.make-analysis {
    margin-bottom: 30px; 
}



@media (max-width: 768px) { 
    .advanced-search {
        width: 90%; 
        left: 50%; 
        transform: translateX(-50%); 
        top: 10vh; 
        padding: 10px; 
    }

    .advanced-search .form-row {
        display: flex; 
        flex-wrap: wrap; 
    }

    .advanced-search .form-group.col-md-6 { 
        width: 50%; 
        flex: 0 0 50%; 
        max-width: 50%; 
    }

    .advanced-search h3 {
        font-size: 1.5rem; 
    }

    .advanced-search p {
        font-size: 0.5rem; 
    }
}
/* ... other styles ... */

.pagination-summary {
    font-size: 0.9rem;
    color: #555;
}

.pagination-links .pagination {
    justify-content: center;
    margin: 0;
}

.pagination-links .page-item .page-link {
    color: #0056b3; /* Blue color for links */
    border: 1px solid #ccc;
    transition: background-color 0.3s, color 0.3s;
}

.pagination-links .page-item.active .page-link {
    background-color: #0056b3; /* Active link blue */
    border-color: #0056b3;
    color: #fff;
}

.pagination-links .page-item:hover .page-link {
    background-color: #ff0000; /* Red on hover */
    color: #fff;
}

.pagination-controls {
    font-size: 0.85rem;
    color: #777;
}
.results-info {
    font-family: 'Arial', sans-serif;
    font-size: 14px;
    color: #444; /* Dark grey for professional look */
    background-color: #f8f9fa; /* Light background for subtle contrast */
    border: 1px solid #ddd; /* Soft border for better structure */
    border-radius: 4px; /* Rounded corners */
    padding: 3px 4px; /* Comfortable spacing */
    display: inline-block;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    width: 100%;
    text-align: center;
}

.results-range strong {
    color: #000; /* Highlight key numbers in bold black */
    font-weight: 600; /* Emphasize important numbers */
}


#provinceDropdown{

    overflow: hidden;
}
#MakeDropdown{

overflow: hidden;
}
</style>

<style>
.result-container {
    border-radius: 8px;
    padding: 20px;
    color:rgb(0, 0, 0);
    font-family: Arial, sans-serif;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    line-height: 1.6;
}
.result-container p {
    margin: 10px 0;
    font-size: 16px;
}
.result-container .btn {
    display: inline-block;
    padding: 10px 20px;
    font-size: 14px;
    font-weight: bold;
    text-align: center;
    text-decoration: none;
    color: #ffffff;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.result-container .btn:hover {
    background-color: #0056b3;
}

#termAndConditionAfford{
    font-size: 12px;
    font-style: italic;
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}
</style>

<div class="container my-5" style="background-color: #f8f9fa; padding: 20px; border-radius: 10px;">
    <h2>Affordability Calculator</h2>
    <div class="row">
 <div class="col-md-6">
    <form id="affordability-form">
        <div class="form-group">
            <label for="netIncome">Monthly Income after Tax</label>
            <input type="number" class="form-control" id="netIncome" name="netIncome" required>
        </div>
        <div class="form-group">
            <label for="currentCarPayments">Current Monthly Car Payments</label>
            <input type="number" class="form-control" id="currentCarPayments" name="currentCarPayments" required>
        </div>
        <div class="form-group">
            <label for="otherCreditExpenses">Monthly Expenses for Other Credit</label>
            <input type="number" class="form-control" id="otherCreditExpenses" name="otherCreditExpenses" required>
        </div>
        <div class="form-group">
            <label>Do you know your credit score?</label>
            <div>
                <label for="creditYes">Yes</label>
                <input type="radio" id="creditYes" name="creditOption" value="yes" required>
                <label for="creditNo">No</label>
                <input type="radio" id="creditNo" name="creditOption" value="no" required>
            </div>
        </div>
        <div class="form-group hide" id="creditScoreSection">
            <label for="creditScore">Credit Score</label>
            <input type="range" class="form-control-range" id="creditScore" name="creditScore" min="0" max="1000" step="1" oninput="updateCreditScoreLabel(this.value)">
            <div>
                <span id="creditScoreLabel">500</span>
                <button type="button" class="btn btn-secondary" id="735_btn" onclick="setCreditScore(735)">735</button>
                <button type="button" class="btn btn-secondary" id="740_btn" onclick="setCreditScore(740)">740</button>
                <button type="button" class="btn btn-secondary" id="900_btn" onclick="setCreditScore(900)">900</button>
                <button type="button" class="btn btn-secondary" id="1000_btn" onclick="setCreditScore(1000)">1000</button>
            </div>
        </div>
        <select class="form-control" id="creditManagement" name="creditManagement">
                        <option value="100">I am always up to date with my payments</option>
                        <option value="90">I sometimes miss a payment but catch up immediately</option>
                        <option value="70">I missed a payment once long ago but fixed it</option>
                        <option value="50">I am one month behind with my account</option>
                        <option value="30">I am consistently behind with payments</option>
                    </select>
        <button type="submit" class="btn btn-primary">Calculate</button>
    </form>

</div>

        <div class="col-md-6">
            <div id="affordability-result" class="mt-4"></div>
            <div class="affordability-warning-card">
    <p>Cars you can afford with <span class="highlight">25%</span> of your income</p>
    <p>(Based on <span class="highlight">72 Months</span> loan period and <span class="highlight">14%</span> interest rate)</p>
  </div>        </div>
        
</div>
<div id="pagingBtnAffodability"></div>
<br/>

      <div id="affordable-cars" class="row mb-3"></div>
    <div id="pagingBtnAffodability"></div>
</div>



@endsection

@section('scripts')



<script type="text/javascript">
let seletectedOverallScore=0;
function updateCreditScoreLabel(value) {
    document.getElementById('creditScoreLabel').innerText = value + '%';
    const slider = document.getElementById('creditScore');
    const icon = document.getElementById('creditScoreIcon');
    const sliderWidth = slider.offsetWidth;
    const iconPosition = (value / 100) * sliderWidth;
    icon.style.left = `calc(${iconPosition}px - 10px)`;

    if (value < 33) {
        icon.style.background = 'red';
    } else if (value < 59) {
        icon.style.background = 'blue';
    } else {
        icon.style.background = 'green';
    }
}




function updateCreditScoreLabel(value) {
    document.getElementById('creditScoreLabel').textContent = value;
}

function setCreditScore(value) {
    //document.getElementById('creditScore').value = value;
    //updateCreditScoreLabel(value);
    $(`#${value}_btn`).addClass('btn btn-success');
    $(`#${value}_btn`).siblings().removeClass('btn-success');
    seletectedOverallScore=value;
}
var netIncome=0;
let creditScore=0;
let creditScoreValue=0
var remainingIncome=0;
document.getElementById('affordability-form').addEventListener('submit', function (event) {
    event.preventDefault();
    netIncome = parseFloat(document.getElementById('netIncome').value);
    const currentCarPayments = parseFloat(document.getElementById('currentCarPayments').value);
    const otherCreditExpenses =(parseFloat(document.getElementById('otherCreditExpenses').value))
    var creditManagement=0;
 
    if (document.getElementById('creditYes').checked) {
        creditManagement  = parseFloat(document.getElementById('creditManagement').value)/100;
        creditManagement=creditManagement>1?1:creditManagement;
        if(seletectedOverallScore!=0){
            creditScoreValue = parseFloat(document.getElementById('creditScore').value)/seletectedOverallScore;

        }else{
            alert('Ensure you have selected a total overall score');
            return;
        }

      creditScore=(creditScoreValue + creditManagement)/2

    } else {
         creditScore=parseFloat(document.getElementById('creditManagement').value)/100
         creditScore=creditScore>1?1:creditScore;
          
    }

    const totalExpenses = currentCarPayments + otherCreditExpenses;
     remainingIncome = netIncome - totalExpenses;
    const maxAffordablePayment = remainingIncome * 0.25;

    let affordabilityMessage = '';
    let estimatedCreditRating = '';
    let resultColor = '';

    if (creditScore >= 0.75) {
        affordabilityMessage = 'You have a high chance of qualifying for car finance based on your credit score calculations.';
        estimatedCreditRating = 'Excellent';
        resultColor = 'rgba(0, 128, 0, 0.2)';
    } else if (creditScore >= 0.59) {
        affordabilityMessage = 'You have a moderate chance of qualifying for car finance based on your credit score calculations.';
        estimatedCreditRating = 'Good';
        resultColor = 'rgba(0, 0, 255, 0.2)';
    } else if (creditScore >= 0.40) {
        affordabilityMessage = 'You have a low chance of qualifying for car finance based on your credit score calculations.';
        estimatedCreditRating = 'Acceptable';
        resultColor = 'rgba(255, 165, 0, 0.2)';
    } else {
        affordabilityMessage = 'You might not qualify for car finance. Consider improving your credit score.';
        estimatedCreditRating = 'Subpar';
        resultColor = 'rgba(255, 0, 0, 0.2)';
    }

    document.getElementById('affordability-result').innerHTML = `
        <div class="result-container" style="background-color: ${resultColor};">
            <p>${affordabilityMessage}</p>
            <p>Estimated Credit Rating: ${estimatedCreditRating}</p>
            <p>Remaining Income: ${remainingIncome.toFixed(2)}</p>
            <p>Max Affordable Monthly Payment: ${maxAffordablePayment.toFixed(2)} (25% rule)</p>
                 <p id="termAndConditionAfford"><strong>Terms and Conditions:</strong> The estimates provided are based on a general calculation of affordability and creditworthiness. These results are for informational purposes only and do not guarantee loan approval. The final decision regarding your vehicle financing will be determined by the in-house finance team, which uses its own evaluation criteria. Please note that these estimates have a general accuracy rate of 70%, but actual approval may vary based on your financial profile, credit history, and other factors. Always consult with your financial advisor or lender for precise details.</p>
            <button id="view-all-cars" class="btn btn-secondary mt-3">Show me cars i can afford</button>
        </div> `;
    document.getElementById('view-all-cars').addEventListener('click', function() {
        fetchCars(netIncome, remainingIncome, creditScore, true);
    });
});



function fetchCars(netIncome, remainingIncome, creditScore, viewAll = false, page = 1) {
    $("#car-list-card").html(`
        <div id="affordable-cars" class="row mb-3 bg-red"></div>

    `);

    fetch('{{ route('get.cars.affordability') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            netIncome: netIncome,
            remainingIncome: remainingIncome,
            creditScore: creditScore,
            viewAll: viewAll,
            page: page
        })
    })
    .then(response => response.json())
    .then(data => {
        displayCars(data.affordableCars.data);
        setupPagination(data.affordableCars, 'affordable');

        updateCount(data.affordableCars);
    });
}

function setupPagination(paginationData, currentPage) {
    let paginationHtml = '';
    const totalPages = paginationData.last_page;
    const maxVisibleButtons = 5;

    if (totalPages <= maxVisibleButtons) {
        for (let i = 1; i <= totalPages; i++) {
            paginationHtml += `<button onclick="fetchCars(${netIncome}, ${remainingIncome}, ${creditScore}, ${true}, ${i})">${i}</button>`;
        }
    } else {
        if (currentPage > 1) {
            paginationHtml += `<button onclick="fetchCars(${netIncome}, ${remainingIncome}, ${creditScore}, ${true}, ${currentPage - 1})">Prev</button>`;
        }

        if (currentPage > 3) {
            paginationHtml += `<button onclick="fetchCars(${netIncome}, ${remainingIncome}, ${creditScore}, ${true}, 1)">1</button>`;
            if (currentPage > 4) {
                paginationHtml += `<span>...</span>`;
            }
        }

        for (let i = Math.max(1, currentPage - 2); i <= Math.min(totalPages, currentPage + 2); i++) {
            paginationHtml += `<button onclick="fetchCars(${netIncome}, ${remainingIncome}, ${creditScore}, ${true}, ${i})">${i}</button>`;
        }

        if (currentPage < totalPages - 2) {
            if (currentPage < totalPages - 3) {
                paginationHtml += `<span>...</span>`;
            }
            paginationHtml += `<button onclick="fetchCars(${netIncome}, ${remainingIncome}, ${creditScore}, ${true}, ${totalPages})">${totalPages}</button>`;
        }

        if (currentPage < totalPages) {
            paginationHtml += `<button onclick="fetchCars(${netIncome}, ${remainingIncome}, ${creditScore}, ${true}, ${currentPage + 1})">Next</button>`;
        }
    }

    $(`#pagingBtnAffodability`).html('');  // Remove previous pagination if exists
    $(`#pagingBtnAffodability`).append(`<div class="pagination">${paginationHtml}</div>`);
}

function updateCount(paginationData) {
    const start = (paginationData.current_page - 1) * paginationData.per_page + 1;
    const end = Math.min(paginationData.current_page * paginationData.per_page, paginationData.total);
    const countHtml = `<p>Showing ${start} to ${end} of ${paginationData.total} results</p>`;
    $('#car-list-card').find('.count').remove();  // Remove previous count if exists
    $('#pagingBtnAffodability').append(`<div class="count" style="text-align:center">${countHtml}</div>`);
}



function displayCars(cars) {
    let containerId='';

            containerId = 'affordable-cars';

let carResults = '';

cars.forEach(car => {
    carResults += `
        <div class="col-md-4 car-item">
            <div class="card" onclick="location.href='/cars/${car.vehicle_id}';" style="cursor: pointer;">
                ${car.images && car.images.length > 0 ? `
                <div class="main-image-container position-relative">
                    <img class="card-img-top main-image" src="/storage/${car.images[0].image_url}" alt="${car.make} ${car.model}" style="width: 100%; height: auto;">
                    <span class="image-count position-absolute bottom-0 start-0 bg-dark text-white px-2 py-1" style="bottom: 10px; left: 0;">
                        <i class="fas fa-camera"></i> ${car.images.length}
                    </span>
                </div>
                <div class="row thumbnails">
                    ${car.images.slice(1, 4).map(image => `
                        <div class="col-4">
                            <img src="/storage/${image.image_url}" alt="${car.make} ${car.model}" class="img-thumbnail thumbnail-image" style="width: 100%; height: auto;">
                        </div>
                    `).join('')}
                </div>` : `
                <img src="default-image.jpg" class="card-img-top main-image" alt="Default Image" style="width: 100%; height: auto;">
                `}
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-calendar-alt"></i> ${car.year} &nbsp; 
                        ${car.car_brand.name} ${car.car_model.name} ${car.variant.name}
                    </h5>
                    <h5>
                        <i class="fas fa-tag"></i> Price: R ${car.price}
                    </h5>
                    <p class="card-text">
                        <i class="fas fa-cogs"></i> Transmission: ${car.transmission} &nbsp;
                        <i class="fas fa-tachometer-alt"></i> Mileage: ${car.mileage} km
                    </p>
                    <p class="card-text text-danger">
                        R${calculateMonthlyPayment(car.price)} p/m 
                        <span class="badge" style="background-color: ${car.car_condition === 'used' ? 'red' : 'blue'}; color: white;">
                            ${car.car_condition}
                        </span>
                    </p>
                </div>
                <div class="card-footer">
                    <div class="dealer-info d-flex align-items-center">
                        <img src="/storage/${car.listing.dealer.logo}" alt="${car.listing.dealer.dealership_name}" class="dealer-logo">
                        <div class="dealer-details ms-2">
                            <p class="dealer-name">${car.listing.dealer.dealership_name}</p>
                            <p class="dealer-location">
                                ${car.listing.dealer.city_town}, ${car.listing.dealer.province}
                            </p>
                        </div>
                        <span class="ms-auto verified-status">
                            ${car.listing.dealer.verified === 1 
                                ? '<i class="fas fa-check-circle text-success"></i> Verified' 
                                : '<i class="fas fa-exclamation-triangle text-warning"></i> Not Verified'}
                        </span>
                    </div>
                </div>
            </div>
        </div>`;
});


if (cars.length === 0) {
    carResults += '<p class="row">No cars found.</p>';
}
$(`#${containerId}`).html(carResults);
}

function calculateMonthlyPayment(price) {
    const interestRate = 0.15;
    const financeFeeRate = 0.10;
    const loanTermYears = 5.9;

    const totalPrice = price * (1 + financeFeeRate);
    const monthlyInterestRate = interestRate / 12;
    const numPayments = loanTermYears * 12;
    const monthlyPayment = (totalPrice * monthlyInterestRate) / (1 - Math.pow(1 + monthlyInterestRate, -numPayments));

    return Math.round(monthlyPayment * 100) / 100;
}


</script>

@endsection
