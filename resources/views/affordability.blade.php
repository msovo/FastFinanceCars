@extends('layouts.index')

@section('content')
<style>
    .card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .main-image-container {
        position: relative;
        overflow: hidden;
        max-height: 300px; /* Adjust the height as needed */
    }
    .main-image-container img {
        width: 100%;
        height: auto;
    }
    .card-body {
        flex: 1;
    }
    .thumbnails {
        margin-top: 10px;
        max-height: 80px;
        overflow: hidden;
    }
    .thumbnail-image {
        width: 100%;
        max-height: auto;
    }
    .image-count {
        position: absolute;
        bottom: 20px; /* Adjusted to be 20px from the bottom */
        left: 0;
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 5px;
        border-radius: 3px;
    }



    .car-listing {
        margin-top: 20px;
    }
    .car-card {
        margin-bottom: 20px;
        position: relative;
    }
    .ribbon {
        position: absolute;
        top: 23px;
        right: -5px;
        z-index: 1;
        overflow: hidden;
        width: 75px;
        height: 75px;
        text-align: right;
    }
    .ribbon span {
        font-size: 10px;
        font-weight: bold;
        color: #FFF;
        text-transform: uppercase;
        text-align: center;
        line-height: 20px;
        width: 100px;
        display: block;
        background: #79A70A;
        background: linear-gradient(#2989d8 0%, #1e5799 100%);
        box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
        position: absolute;
        top: 19px;
        left: -21px;
    }
    .ribbon span::before {
        content: "";
        position: absolute;
        left: 0px;
        top: 100%;
        z-index: -1;
        border-left: 3px solid #1e5799;
        border-right: 3px solid transparent;
        border-bottom: 3px solid transparent;
        border-top: 3px solid #1e5799;
    }
    .ribbon span::after {
        content: "";
        position: absolute;
        right: 0px;
        top: 100%;
        z-index: -1;
        border-left: 3px solid transparent;
        border-right: 3px solid #1e5799;
        border-bottom: 3px solid transparent;
        border-top: 3px solid #1e5799;
    }
    .ads {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
        margin-top: 20px;
    }
    .filter-section h3 {
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }
    .filter-section .filter-item {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
    }
    .filter-section .filter-item img {
        width: 24px;
        height: 24px;
        margin-right: 0.5rem;
    }
    .filter-section .filter-item label {
        margin: 0;
    }
    .car-details h5 {
        margin-bottom: 0.5rem;
    }
    .car-details .price {
        color: red;
        font-weight: bold;
    }
    .car-details .specs {
        display: flex;
        justify-content: space-between;
    }
    .car-details .specs div {
        display: flex;
        align-items: center;
    }
    .car-details .specs img {
        width: 16px;
        height: 16px;
        margin-right: 0.25rem;
    }
    .love-icon {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 24px;
        color: red;
        cursor: pointer;
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
                <button type="button" class="btn btn-secondary" onclick="setCreditScore(735)">735</button>
                <button type="button" class="btn btn-secondary" onclick="setCreditScore(740)">740</button>
                <button type="button" class="btn btn-secondary" onclick="setCreditScore(900)">900</button>
                <button type="button" class="btn btn-secondary" onclick="setCreditScore(1000)">1000</button>
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
            <div id="car-results" class="mt-4"></div>
        </div>
</div>
    <di id="car-list-card" >
    <div id="affordable-cars" class="row mb-3"></div>
    <div id="risky-cars" class="row mb-3 "></div>
    <div id="search-results" class="row mb-3"></div>
</div>
</div>

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

document.getElementById('creditYes').addEventListener('change', function () {
    document.getElementById('creditScoreSection').classList.remove('hide');
    document.getElementById('creditQuestions').classList.add('hide');
});

document.getElementById('creditNo').addEventListener('change', function () {
    document.getElementById('creditScoreSection').classList.add('hide');
    document.getElementById('creditQuestions').classList.remove('hide');
});

function updateCreditScoreLabel(value) {
    document.getElementById('creditScoreLabel').textContent = value;
}

function setCreditScore(value) {
    //document.getElementById('creditScore').value = value;
    //updateCreditScoreLabel(value);
    seletectedOverallScore=value;
}

document.getElementById('affordability-form').addEventListener('submit', function (event) {
    event.preventDefault();
    const netIncome = parseFloat(document.getElementById('netIncome').value);
    const currentCarPayments = parseFloat(document.getElementById('currentCarPayments').value);
    const otherCreditExpenses =(parseFloat(document.getElementById('otherCreditExpenses').value))

    let creditScore=0;
    let creditScoreValue=0
    if (document.getElementById('creditYes').checked) {
        const creditManagement = (document.getElementById('creditManagement').value)/100;
        
        if(seletectedOverallScore!=0){
            creditScoreValue += parseFloat(document.getElementById('creditScore').value)/seletectedOverallScore;

        }else{
            alert('Ensure you have selected a total overall score');
        }

        alert(creditScore=(creditScoreValue + creditManagement)/2)

    } else {
        const creditScore = (document.getElementById('creditManagement').value)/100;

    }

    const totalExpenses = currentCarPayments + otherCreditExpenses;
    const remainingIncome = netIncome - totalExpenses;
    const maxAffordablePayment = remainingIncome * 0.25;

    let affordabilityMessage = '';
    let estimatedCreditRating = '';
    let resultColor = '';

    if (creditScore >= 0.75) {
        affordabilityMessage = 'You have a high chance of qualifying for car finance.';
        estimatedCreditRating = 'Excellent';
        resultColor = 'rgba(0, 128, 0, 0.2)';
    } else if (creditScore >= 0.59) {
        affordabilityMessage = 'You have a moderate chance of qualifying for car finance.';
        estimatedCreditRating = 'Good';
        resultColor = 'rgba(0, 0, 255, 0.2)';
    } else if (creditScore >= 0.40) {
        affordabilityMessage = 'You have a low chance of qualifying for car finance.';
        estimatedCreditRating = 'Acceptable';
        resultColor = 'rgba(255, 165, 0, 0.2)';
    } else {
        affordabilityMessage = 'You might not qualify for car finance. Consider reducing your expenses.';
        estimatedCreditRating = 'Subpar';
        resultColor = 'rgba(255, 0, 0, 0.2)';
    }

    document.getElementById('affordability-result').innerHTML = `
        <div class="result-container" style="background-color: ${resultColor}; padding: 15px; border-radius: 10px;">
            <p>${affordabilityMessage}</p>
            <p>Estimated Credit Rating: ${estimatedCreditRating}</p>
            <p>Remaining Income: ${remainingIncome.toFixed(2)}</p>
            <p>Max Affordable Monthly Payment: ${maxAffordablePayment.toFixed(2)}</p>
            <button id="view-all-cars" class="btn btn-secondary mt-3">View All Qualifying Cars</button>
        </div>
    `;

    document.getElementById('affordability-result').innerHTML = `
        <div class="result-container" style="background-color: ${resultColor};">
            <p>${affordabilityMessage}</p>
            <p>Estimated Credit Rating: ${estimatedCreditRating}</p>
            <p>Remaining Income: ${remainingIncome.toFixed(2)}</p>
            <p>Max Affordable Monthly Payment: ${maxAffordablePayment.toFixed(2)}</p>
            <button id="search-cars" class="btn btn-primary mt-3">Search Cars</button>
            <button id="view-all-cars" class="btn btn-secondary mt-3">View All Qualifying Cars</button>
        </div>
    `;
    document.getElementById('view-all-cars').addEventListener('click', function() {
        fetchCars(netIncome, remainingIncome, creditScore, true);
    });
});



function fetchCars(netIncome, remainingIncome, creditScore, viewAll = false) {
    $("#car-list-card").html(`<div id="affordable-cars" class="row mb-3 bg-red"></div>
    <div id="risky-cars" class="row mb-3 bg-red"></div>
    <div id="search-results" class="row mb-3 bg-red">`)
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
            viewAll: viewAll
        })
    })
    .then(response => response.json())
    .then(data => {
        displayCars(data.affordableCars, 'Affordable Cars (within 25% of your income)',"Affordable");
        displayCars(data.riskyCars, 'Risky Cars (25% to 50% of your income)',"Risky");
    });
}

function fetchCarsBySearch(searchQuery) {
    $("#car-list-card").html(`<div id="affordable-cars" class="row mb-3 bg-red"></div>
    <div id="risky-cars" class="row mb-3 bg-red"></div>
    <div id="search-results" class="row mb-3 bg-red">`)

    fetch('{{ route('search.cars') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            searchQuery: searchQuery
        })
    })
    .then(response => response.json())
    .then(data => {
        displayCars(data, 'Search Results',"Search");
    });
}

function displayCars(cars, title,type) {
    let containerId='';
    switch (type) {
        case 'Affordable':
            containerId = 'affordable-cars';
            break;
        case 'Risky':
            containerId = 'risky-cars';
            break;
        case 'Search':
            containerId = 'search-results';
            break;
        default:
            console.error('Unknown type:', type);
            return;
    }


    $(`#${containerId}`).before(`<div class="row"><h3 style="color: red; text-decoration: underline;">${title}</h3></div>`);

let carResults = '';

cars.forEach(car => {
    carResults += `
            <div class="col-md-4 car-item">
                <div class="card" onclick="location.href='/cars/${car.vehicle_id}';" style="cursor: pointer;">
                    ${car.images && car.images.length > 0 ? `
                    <div class="main-image-container position-relative" style="max-height: 250px;">
                        <img class="card-img-top main-image" src="/storage/${car.images[0].image_url}" alt="${car.make} ${car.model}" style="width: 100%; height: auto;">
                        <span class="image-count position-absolute bottom-0 start-0 bg-dark text-white px-2 py-1" style="bottom: 20px; left: 0;">
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
                            ${car.make} ${car.model}
                        </h5>
                        <p class="card-text">
                            <i class="fas fa-car"></i> Variant: ${car.variant} &nbsp; 
                            <i class="fas fa-tag"></i> Price: R ${car.price} &nbsp; 
                            <i class="fas fa-tachometer-alt"></i> Mileage: ${car.mileage} km
                        </p>
                        <p class="card-text text-danger">
                            R${calculateMonthlyPayment(car.price)} p/m 
                            <span class="badge" style="background-color: ${car.car_condition === 'used' ? 'red' : 'blue'}; color: white;">
                                ${car.car_condition}
                            </span>
                        </p>
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
