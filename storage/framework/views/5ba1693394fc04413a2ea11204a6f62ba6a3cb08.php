

<?php $__env->startSection('content'); ?>
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
                    <label for="creditScore">Credit Score</label>
                    <div class="slider-container">
                        <input type="range" class="form-control-range" id="creditScore" name="creditScore" min="0" max="100" step="1" oninput="updateCreditScoreLabel(this.value)">
                        <span id="creditScoreLabel">50%</span>
                        <span id="creditScoreIcon" class="slider-icon"></span>
                    </div>
                </div>
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

<style>

.thumbnails {
        display: flex;
        justify-content: center; 
        margin-top: 10px; 
    }

    .thumbnail-image {
       max-height: 59px; 
        object-fit: cover;
        margin: 0 5px; 
        cursor: pointer; 
    }

    .timeline {
        position: relative;
        padding: 20px 0;
        list-style: none;
        text-align: center;
    }

    .timeline:before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 50%;
        margin-left: -1px;
        width: 2px;
        background: #C5C5C5;
    }

    .timeline-item {
        position: relative;
        margin: 20px 0;
    }

    .timeline-item:before,
    .timeline-item:after {
        content: '';
        display: table;
    }

    .timeline-item:after {
        clear: both;
    }

    .timeline-item .timeline-img {
        position: absolute;
        left: 50%;
        width: 100px;
        height: 100px;
        margin-left: -50px;
        border-radius: 50%;
        background: #fff;
        border: 2px solid #C5C5C5;
        overflow: hidden;
    }

    .timeline-item .timeline-img img {
        width: 100%;
        height: auto;
    }

    .timeline-item .timeline-content {
        position: relative;
        width: 45%;
        padding: 20px;
        background: #fff;
        border: 1px solid #C5C5C5;
        border-radius: 5px;
        text-align: left;
    }

    .timeline-item:nth-child(odd) .timeline-content {
        left: 0;
    }

    .timeline-item:nth-child(even) .timeline-content {
        left: 55%;
    }

    .carousel-inner {
    height: 59vh;
    width: 100%;
}
.carousel-item img {
    height: 100%;
    object-fit: cover;
}
.advanced-search {
    position: absolute;
    top: 13vh;
    left: 32.5%; 
    background-color: #c0392b;
    padding: 20px;
    color: white;
    width: 35%; 
    z-index: 99;
    border-radius: 10px; 
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
.news-reviews .card {
    margin-bottom: 20px; 
}
.news-reviews .news-grid {
        margin-top: 20px; 
    }

    .news-reviews .news-item {
        margin-bottom: 20px; 
    }

    @media (min-width: 768px) { 
        .news-reviews .news-grid {
            display: none; 
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


/* ... other styles ... */

@media (max-width: 768px) { 
 

    .news-reviews .news-item .col-4 {
        width: 30%; 
    }

    .news-reviews .news-item .col-8 {
        width: 70%; 
    }
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

.make-analysis {
    margin-top: 30px; 
    margin-bottom: 30px; 
}

@media (max-width: 768px) { 
    .make-analysis canvas {
        width: 100% !important; 
    }
}
.card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .main-image-container {
        position: relative;
        overflow: hidden;
        height: 200px; /* Adjust the height as needed */
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
    }
    .thumbnail-image {
        width: 100%;
        max-height: 59px;
    }

    .slider-container {
        position: relative;
        width: 100%;
    }
    .form-control-range {
        -webkit-appearance: none;
        width: 100%;
        height: 10px;
        background: linear-gradient(to right, red, blue, green);
        outline: none;
        opacity: 0.7;
        transition: opacity .2s;
        border-radius: 5px;
    }
    .form-control-range::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        background: #4CAF50;
        cursor: pointer;
        border-radius: 50%;
    }
    .form-control-range::-moz-range-thumb {
        width: 20px;
        height: 20px;
        background: #4CAF50;
        cursor: pointer;
        border-radius: 50%;
    }
    .slider-icon {
        position: absolute;
        top: -25px;
        left: 50%;
        transform: translateX(-50%);
        width: 20px;
        height: 20px;
        background: #4CAF50;
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
    }
    .result-container {
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 10px;
        font-family: 'Arial', sans-serif;
        color: #333;
    }
    .result-container p {
        margin: 0;
        padding: 5px 0;
    }
    .result-container .btn {
        display: block;
        margin: 10px auto;
    }
    .car-item {
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 15px;
        text-align: center;
        margin: 3px;
        margin-bottom: 20px;


    }
    @media (max-width: 768px) {
        .car-item {
            margin: 3px 0;
        }
    }
    .car-item img {
        max-height: 150px;
        width: auto;
        display: block;
        margin: 0 auto 10px;
    }
    .car-item .thumbnails {
        display: flex;
        flex-wrap: nowrap;
        justify-content: center;
    }
    .car-item .thumbnails img {
        max-height: 50px;
        width: auto;
        margin: 5px;
    }
    @media (min-width: 768px) {
        .car-item {
            flex: 0 0 25%;
            max-width: 25%;
        }
    }
    @media (max-width: 767px) {
        .car-item {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }
    @media (max-width: 575px) {
        .car-item {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    .car-item {
        flex: 1 1 calc(25% - 6px); /* Adjust the width to fit 4 items per row with margin */
        margin: 3px;
        box-sizing: border-box;
    }
    .card {
        margin-bottom: 15px;
    }
    .card-img-top {
        width: 100%;
        height: auto;
    }
    .thumbnails img {
        width: 48px;
        height: 48px;
        margin: 2px;
    }
    #affordable-cars, #risky-cars, #search-results {
        display: flex;
        flex-wrap: wrap;
    }
    @media (max-width: 768px) {
        .car-item {
            flex: 1 1 calc(50% - 6px); /* Adjust the width to fit 2 items per row on smaller screens */
            margin: 3px 0;
        }
    }
    @media (max-width: 576px) {
        .car-item {
            flex: 1 1 100%; /* Full width on extra small screens */
            margin: 3px 0;
        }
    }
</style>



<script type="text/javascript">

function updateCreditScoreLabel(value) {
    document.getElementById('creditScoreLabel').innerText = value + '%';
    const slider = document.getElementById('creditScore');
    const icon = document.getElementById('creditScoreIcon');
    const sliderWidth = slider.offsetWidth;
    const iconPosition = (value / 100) * sliderWidth;
    icon.style.left = `calc(${iconPosition}px - 10px)`;

    if (value < 33) {
        icon.style.background = 'red';
    } else if (value < 66) {
        icon.style.background = 'blue';
    } else {
        icon.style.background = 'green';
    }
}

document.getElementById('affordability-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const netIncome = parseFloat(document.getElementById('netIncome').value);
    const currentCarPayments = parseFloat(document.getElementById('currentCarPayments').value);
    const otherCreditExpenses = parseFloat(document.getElementById('otherCreditExpenses').value);
    const creditScore = parseFloat(document.getElementById('creditScore').value);

    const totalExpenses = currentCarPayments + otherCreditExpenses;
    const remainingIncome = netIncome - totalExpenses;
    const maxAffordablePayment = remainingIncome * 0.25;

    let affordabilityMessage = '';
    let estimatedCreditRating = '';
    let resultColor = '';

    if (creditScore >= 75 && remainingIncome >= 0.75 * netIncome) {
        affordabilityMessage = 'You have a high chance of qualifying for car finance.';
        estimatedCreditRating = 'Excellent';
        resultColor = 'rgba(0, 128, 0, 0.2)'; // Light green
    } else if (creditScore >= 50 && remainingIncome >= 0.50 * netIncome) {
        affordabilityMessage = 'You have a moderate chance of qualifying for car finance.';
        estimatedCreditRating = 'Good';
        resultColor = 'rgba(0, 0, 255, 0.2)'; // Light blue
    } else if (creditScore >= 25 && remainingIncome >= 0.25 * netIncome) {
        affordabilityMessage = 'You have a low chance of qualifying for car finance.';
        estimatedCreditRating = 'Acceptable';
        resultColor = 'rgba(255, 165, 0, 0.2)'; // Light orange
    } else {
        affordabilityMessage = 'You might not qualify for car finance. Consider reducing your expenses.';
        estimatedCreditRating = 'Subpar';
        resultColor = 'rgba(255, 0, 0, 0.2)'; // Light red
    }

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

    document.getElementById('search-cars').addEventListener('click', function() {
        document.getElementById('car-results').innerHTML = `
            <form id="search-form">
                <div class="form-group">
                    <label for="searchQuery">Search for Cars</label>
                    <input type="text" class="form-control" id="searchQuery" name="searchQuery" placeholder="Enter model, variant, or make" required>
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        `;

        document.getElementById('search-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const searchQuery = document.getElementById('searchQuery').value;
            fetchCarsBySearch(searchQuery);
        });
    });

    document.getElementById('view-all-cars').addEventListener('click', function() {
        fetchCars(netIncome, remainingIncome, creditScore, true);
    });
});

function fetchCars(netIncome, remainingIncome, creditScore, viewAll = false) {
    $("#car-list-card").html(`<div id="affordable-cars" class="row mb-3 bg-red"></div>
    <div id="risky-cars" class="row mb-3 bg-red"></div>
    <div id="search-results" class="row mb-3 bg-red">`)
        fetch('<?php echo e(route('get.cars.affordability')); ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
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

    fetch('<?php echo e(route('search.cars')); ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
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
                <div class="main-image-container position-relative">
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
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-calendar-alt"></i> ${car.year} &nbsp; 
                        ${car.make} ${car.model}
                    </h5>
                    <p class="card-text">
                        <i class="fas fa-car"></i> Variant: ${car.variant} &nbsp; 
                        <i class="fas fa-tag"></i> Price: R ${car.price} &nbsp; 
                        <i class="fas fa-tachometer-alt"></i> Mileage: ${car.mileage}
                    </p>
                    <p class="card-text text-danger">
                        R${calculateMonthlyPayment(car.price)} p/m 
                        <span class="badge" style="background-color: ${car.condition === 'used' ? 'red' : 'blue'};">
                            ${car.condition}
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FastFinanceCars\resources\views/affordability.blade.php ENDPATH**/ ?>