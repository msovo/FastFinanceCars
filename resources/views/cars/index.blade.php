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


<div class="filter-container">
<div class="advanced-search" >
    <form id="searchForm">
        <div class="form-group">
            <input  type="text" class="form-control" id="keyword" name="keyword" placeholder="Keyword Search (Make, Model, Variant)">
            <div id="search-results" class="dropdown-menu" style="height:50vh;overflow-y:scroll; position:absolute; top:59px;left:0; width:100%;height:240px;">
    <!-- Filtered results will be displayed here -->
    </div>
    <ul id='appendlistofSelcted' style="height:50vh;overflow-y:scroll; position:absolute; top:59px;right:0; width:35%;height:240px;z-index:9999;color:grey;display:none;"></ul>

        </div>
                        <?php
                $provinces = [
                    "Eastern Cape",
                    "Free State",
                    "Gauteng",
                    "KwaZulu-Natal",
                    "Limpopo",
                    "Mpumalanga",
                    "Northern Cape",
                    "North West",
                    "Western Cape"
                ];
                ?>
        <div class="form-row mt-0">
            <div class="form-group col-12 col"> 
                <div class="dropdownP">
                    <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="provinceDropdown" aria-haspopup="true" aria-expanded="false">
                        Select Province(s)
                    </button>
                    <div class="dropdown-menu dropdown-menuProvince" aria-labelledby="provinceDropdown" style="height:50vh;overflow-y:scroll;">
                        <div class="province-checkboxes">
                       
        <?php foreach ($provinces as $province): ?>
            <div class="dropdown-item">
                <div class="form-check d-flex justify-content-between align-items-center">
                    <div>
                        <input onchange='getSelectedCheckFilterOnSearchProvince("<?php echo $province; ?>", "province", "<?php echo $province; ?>", "filter")' class="form-check-input province-checkbox" type="checkbox" name="province[]" id="province-<?php echo str_replace(' ', '-', $province); ?>" value="<?php echo $province; ?>">
                        <label id="province<?php echo str_replace(' ', '', $province); ?>" class="form-check-label" for="province-<?php echo str_replace(' ', '-', $province); ?>">
                            <?php echo $province; ?>
                        </label>
                    </div>
                    <button type="button" onclick="getModelID('<?php echo $province; ?>')" class="btn-sm expand-models-btn collapsed" data-province="<?php echo $province; ?>" data-toggle="collapse" data-target="#models-<?php echo str_replace(' ', '-', $province); ?>">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-12 col"> 
    <div class="dropdownr">
        <button class="btn btn-secondary dropdown-toggle w-100 MakeSearchFilter" type="button" id="makeDropdown"  aria-haspopup="true" aria-expanded="false">Select a Car(s) </button>
        <div class="dropdown-menu dropdown-menuFilter"  aria-labelledby="makeDropdown" style="height:50vh;overflow-y:scroll;">
            @foreach ($carBrands as $make)
                <div class="dropdown-item">
                    <div class="form-check d-flex justify-content-between align-items-center">
                        <div>           
                            <input onchange='getSelectedCheckFilterOnSearch({{$make->id }}, "brand","{{$make->name}}","filter")' class="form-check-input make-checkbox" type="checkbox" name="car_brand_id[]" id="brand-{{ $make->id }}" value="{{ $make->id }}">
                            <label id="brand{{ $make->id }}" class="form-check-label" for="brand-{{ $make->name }}">
                                {{ $make->name }} ( {{ $make->vehicle_count }})
                            </label>
                        </div>
                        <button type="button" onclick="getModelID({{ $make->id }})" class=" btn-sm expand-models-btn collapsed" data-make="{{ $make->id }}" data-toggle="collapse" data-target="#models-{{ $make->id }}">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <div class="collapse" id="models-{{ $make->id }}">
                        <!-- Models will be loaded here -->
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="searchBy" id="searchByPrice" value="price" checked>
                    <label class="form-check-label" for="searchByPrice">
                        Price
                    </label>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="searchBy" id="searchByMonthlyPayment" value="monthlyRepayment">
                    <label class="form-check-label" for="searchByMonthlyPayment">
                        Monthly Repayment
                    </label>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <select onchange=" getFormDataAndSubmit()" class="form-control" id="minYear" name="minYear">
                    <option value="">Select Min Year</option>
                    @for ($year = date('Y'); $year >= 1990; $year--)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group col-md-6">
                <select  onchange=" getFormDataAndSubmit()" class="form-control" id="maxYear" name="maxYear">
                    <option value="">Select Max Year</option>
                    @for ($year = date('Y'); $year >= 1990; $year--)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <select  onchange="getFormDataAndSubmit()"  class="form-control" id="minPrice" name="minPrice">
                    <option value="">Select Min Price</option>
                    <!-- Add price options here -->
                </select>
            </div>
            <div class="form-group col-md-6">
                <select  onchange="getFormDataAndSubmit()" class="form-control" id="maxPrice" name="maxPrice">
                    <option value="">Select Max Price</option>
                    <!-- Add price options here -->
                </select>
            </div>
        </div>

<div class="row">
        <button type="button" d="toggleMoreFilters" class="btn btn-primary col">More Filters</button>
        <button type="button" onclick="resetFormAdvanced()" class="btn btn-secondary col" id="resetFilters">Reset Filters</button>
        </div>
    </form>
</div>
</div>


<div class="container mt-5">




    <div class="row">
        <div class="col-md-3">
          
        </div>

        <div class="col-md-8">

                <div class="row" >
                    <!-- Pagination Summary -->              

                    <div class="col" id="rebindpages">

                        <div class="col-12">
                            <div class="pagination-links d-flex justify-content-center">
                         
                            @include('partials._pagination', ['cars' => $cars])
                            </div>
                        </div>
                        <div class="col-12">
                       <div id="showingresults">
                            <div class="results-info">
                            <span class="results-range">
                            @include('partials._car_count_showing', ['cars' => $cars])
                            </span>
                            </div>
                            </div>
                    </div>

                    </div>


                    <div class="col text-right">
                    <select class="form-control d-inline w-auto" id="sortBy">
                        <option value="price_asc" {{ request('sortBy') == 'price_asc' ? 'selected' : '' }}>Sort by Price (Low to High)</option>
                        <option value="price_desc" {{ request('sortBy') == 'price_desc' ? 'selected' : '' }}>Sort by Price (High to Low)</option>
                        <option value="mileage_asc" {{ request('sortBy') == 'mileage_asc' ? 'selected' : '' }}>Sort by Mileage (Low to High)</option>
                        <option value="mileage_desc" {{ request('sortBy') == 'mileage_desc' ? 'selected' : '' }}>Sort by Mileage (High to Low)</option>
                        <option value="year_asc" {{ request('sortBy') == 'year_asc' ? 'selected' : '' }}>Sort by Year (Low to High)</option>
                        <option value="year_desc" {{ request('sortBy') == 'year_desc' ? 'selected' : '' }}>Sort by Year (High to Low)</option>
                        <option value="sort" {{ request('sortBy') == 'sort' ? 'selected' : '' }}>Newest First</option>

                    </select>
                </div>
    </div>


<div class="car-listing">
    <h2>Search Results</h2>
    @if($cars->isEmpty())
        <p>No cars found matching your criteria.</p>
    @else

    <div class="row">
    @foreach($cars as $car)
        <div class="col-md-12 car-card">
            <div class="card" onclick="location.href='{{ route('cars.show', $car->vehicle_id) }}';" style="cursor: pointer;">
                <div class="love-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="row no-gutters">
                    <div class="col">
                        @if($car->images->isNotEmpty())
                            <div class="main-image-container">
                                <img src="{{ asset('storage/' . $car->images->first()->image_url) }}" class="card-img main-image" alt="{{ $car->make }} {{ $car->model }}">
                                <span class="image-count" style="bottom: 20px; left: 0;">
                                    <i class="fas fa-camera"></i> {{ $car->images->count() }}
                                </span>
                            </div>
                            <div class="row thumbnails">
                        @foreach ($car->images->slice(1, 3) as $image)
                            <div class="col-4">
                                <img src="{{ asset('storage/' . $image->image_url) }}" class="thumbnail-image" alt="{{ $car->make }} {{ $car->model }} thumbnail" style="width: 100%;">
                            </div>
                        @endforeach
                        </div>
                        @else
                            <div class="main-image-container">
                                <img src="{{ asset('storage/images/default-car.jpg') }}" class="card-img main-image" alt="Default Image">
                            </div>
                        @endif
                    </div>
                    <div class="col">
                        <div class="card-body car-details">
                            <h5>
                                <i class="fas fa-calendar-alt"></i> {{ $car->year }} 
                                {{ $car->make }} {{ $car->model }}
                            </h5>
                            <h6 class="price">R{{ number_format($car->price, 2) }}</h6>
                            <div class="specs">
                                <div>
                                    <i class="fas fa-cogs"></i>    <!-- Transmission -->
                                    <span>{{ $car->transmission }}</span>
                                </div>
                            
                                <div>
                                    <i class="fas fa-tachometer-alt"></i>    <!-- Mileage -->
                                    <span>{{ $car->mileage }} km</span>
                                </div>
                                <div>
                                    <i class="fas fa-gas-pump"></i>   <!-- Fuel Type -->
                                    <span>{{ $car->fuel_type }}</span>
                                </div>
                            </div>
                            <p class="card-text text-danger">
                                R{{ number_format(calculateMonthlyPayment($car->price), 2) }} p/m 
                                <span class="badge" style="background-color: {{ $car->car_condition == 'Used' ? 'red' : 'blue' }};color:white;">
                                    {{ ucfirst($car->car_condition) }}
                                </span>
                            </p>
                            @if($car->listing && $car->listing->listing_status == 'active')
                                @if($car->listing->featured)
                                    <div class="ribbon"><span>Featured</span></div>
                                @elseif($car->listing->sponsored)
                                    <div class="ribbon"><span>Sponsored</span></div>
                                @elseif($car->created_at && $car->created_at->diffInDays() <= 7)
                                    <div class="ribbon"><span>Recently Listed</span></div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

     
    @endif
</div>
<div class="row mt-4">
    <div class="col-12">
        <div class="pagination-links d-flex justify-content-center">
        <div id="results-count">
        <div class="results-info">
                            <span class="results-range">
                            @include('partials._car_count_showing', ['cars' => $cars])
                            </span>
                            </div>
</div>
        @include('partials._pagination', ['cars' => $cars])
        </div>
    </div>
</div>
</div>

        <div class="col-md-1">
            <div class="ads">
                <h3>Advertisements</h3>
                <p>Placeholder for Google ads</p>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
function calculateMonthlyPayment(price) {
    var interestRate = 0.15;
    var financeFeeRate = 0.10;
    var loanTermYears = 5.9;

    var totalPrice = price * (1 + financeFeeRate);
    var monthlyInterestRate = interestRate / 12;
    var numPayments = loanTermYears * 12;
    var monthlyPayment = (totalPrice * monthlyInterestRate) / (1 - Math.pow(1 + monthlyInterestRate, -numPayments));

    return monthlyPayment.toFixed(2);
}
</script>
<script>

function updateSearchResults() {
        $.ajax({
            url: '{{ route("cars.search") }}',
            type: 'GET',
            data: urlParams.toString(),
            success: function(response) {  
                $('.car-listing').html(response.html);     
                $('.pagination').html(response.pagination); 
                $("#showingresults").html(response.resultsCount)
                 rebindPaginationLinks(); 
                                                                      
            }
        });
    }

var urlParams=''
$(document).ready(function() {
    // Store the URL parameters in a variable
    urlParams= new URLSearchParams(window.location.search);

    // Function to update the search results
 

    // Event listener for the sort dropdown
    $('#sortBy').change(function() {
        urlParams.set('sortBy', $(this).val());
        updateSearchResults();
    });
  

    // Event listener for the reset button
    $('#resetFilters').click(function() {
        urlParams = new URLSearchParams();
        $('#searchForm')[0].reset();
        updateSearchResults();
    });

    // Event listener for pagination links
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        urlParams.set('page', $(this).attr('href').split('page=')[1]);
        updateSearchResults();
        
    });

  
});



function getFormDataAndSubmit(){
            event.preventDefault();
            var formData = $('#searchForm').serializeArray();
            urlParams = new URLSearchParams();
            $.each(formData, function(index, field) {
                urlParams.append(field.name, field.value);
            });
            updateSearchResults();           
 };

 function  submitFormbasedOnKeywords(event) {
        event.preventDefault(); // Prevent the default form submission

        // Clear previous dynamic inputs
      //  $(".dynamic-input").remove();

        // Iterate through selectedFilters and create inputs
        for (let i = 0; i < selectedFilters.length; i++) {
            let obj = selectedFilters[i];
            let inputName;
            switch (obj.key) {
                case 'brand':
                    inputName = 'car_brand_id[]';
                    break;
                case 'model':
                    inputName = 'car_model_id[]';
                    break;
                case 'variant':
                    inputName = 'car_variant_id[]';
                    break;
                default:
                    continue; // Skip if key is not recognized
            }

            // Create and append the input element
            let input = $('<input>')
                .attr('type', 'hidden')
                .attr('name', inputName)
                .attr('value', obj.id)
                .addClass('dynamic-input'); // Add a class for easy removal

            $(this).append(input);
        }
        getFormDataAndSubmit()
    };

 function rebindPaginationLinks() {
    // Rebind the pagination links
    $('.pagination-links a').each(function() {
        $(this).off('click').on('click', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            urlParams.set('page', page);
            updateSearchResults();
        });
    });

    // Preserve the current active page
    var currentPage = urlParams.get('page') || 1;
    $('.pagination-links a').each(function() {
        if ($(this).text() == currentPage) {
            $(this).parent().addClass('active');
        } else {
            $(this).parent().removeClass('active');
        }
    });
}


</script>

<script>
    $('#toggleMoreFilters').on('click', function(e) {
            e.preventDefault();
            $('.more-filters').toggleClass('show');
        });

        $('#closeFilters').on('click', function(e) {
            e.preventDefault();
            $('.more-filters').removeClass('show');
        });

        // Hide the more-filters div when clicking outside of it
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.more-filters, #toggleMoreFilters').length) {
                $('.more-filters').removeClass('show');
            }
        });
        document.getElementById('resetFilters').addEventListener('click', function() {
        document.getElementById('searchForm').reset();
    
    // Reset dropdowns and other custom elements if necessary
        document.querySelectorAll('#makeDropdown').forEach(function(dropdown) {
        dropdown.innerHTML ='Select a Car(s)';
    });

    document.querySelectorAll('#provinceDropdown').forEach(function(dropdown) {
        dropdown.innerHTML ='Select a Province(s)';
    });
    


    // Collapse any expanded model sections
    document.querySelectorAll('.collapse').forEach(function(collapse) {
        collapse.classList.remove('show');
    });
});

                   
function submitForm(brand) {
            // Create a form element dynamically
            const form = document.createElement('form');
            form.method = 'GET';
            form.action = "{{ route('cars.search') }}";

            // Add a hidden input to the form with the 'make' value
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'car_brand';
            input.value = parseInt(brand);
            input.id = 'brand'

            form.appendChild(input);

            // Add the form to the body and submit it
            document.body.appendChild(form);
            form.submit();
        }

function getModelID(id){

        var model_id = $(this).data('make');
        var modelsContainer = $('#models-' + id);

        // Toggle the collapse
        modelsContainer.collapse('toggle');

        if (modelsContainer.find('.models-list').length === 0) {
            // AJAX call to fetch models

                var modelsArr=@json($Carmodels)
                
                //modelsArr=JSON.parse(modelsArr)
                models=modelsArr.filter(function(model) {
                    return model.car_brand_id === id;
                })

                    var modelsHtml = '<div class="models-list" style="margin-left:10px;">';
                    $.each(models, function(index, model) {
                        modelsHtml += '<div class="form-check d-flex justify-content-between align-items-center">';
                        modelsHtml += '<div>';
                        modelsHtml +=`<input onchange='getSelectedCheckFilterOnSearch(${model.id }, "model","${model.name}","filter")' class="form-check-input" type="checkbox" name="car_model_id[]" id="model-${ model.id }" value="${ model.id }">`;
                        modelsHtml += '<label  class="form-check-label" for="model-' + model.name + '">' + model.name + '(' + model.vehicle_count +')' + '</label>';
                        modelsHtml += '</div>';

                        modelsHtml += '<button type="button" onclick="getVariantID('+ model.id + ')" style="border:none;background:none;" class="expand-variants-btn collapsed" data-make="' + model.id + '" data-model="' + model.id + '" data-toggle="collapse" data-target="#variants-' + model.car_brand_id + '-' + model.id + '">';
                        modelsHtml += '<i class="fas fa-chevron-right"></i>';
                        modelsHtml += '</button>';
                        modelsHtml += '</div>';
                        modelsHtml += '<div class="collapse" id="variants-' + model.id + '-' + model.id + '">';
                        modelsHtml += '</div>';
                    });
                    modelsHtml += '</div>';
                    modelsContainer.html(modelsHtml);
                }
        
        }

function getVariantID(id){

    var variantArr=@json($Carvariants)
                
                //modelsArr=JSON.parse(modelsArr)
                variant=variantArr.filter(function(variant) {
                    return variant.car_model_id === id;
                })


        var make = $(this).data('make');
        var model = $(this).data('model');
        var variantsContainer = $('#variants-' + id + '-' + id);

        // Toggle the collapse
        variantsContainer.collapse('toggle');

        if (variantsContainer.find('.variants-list').length === 0) {
            // AJAX call to fetch variants
      
                    var variantsHtml = '<div class="variants-list" style="margin-left:20px;">';
                    $.each(variant, function(index, variant) {
                        variantsHtml += '<div class="form-check">';
                        variantsHtml += `<input onchange='getSelectedCheckFilterOnSearch(${variant.id }, "variant","${variant.name}","filter")' class="form-check-input" type="checkbox" name="variant_id[]" id="variant-${ variant.id }" value=" ${ variant.id } ">`;
                        variantsHtml += '<label class="form-check-label" for="variant-' + variant.id + '">' + variant.name + ' (' + variant.vehicle_count + ')</label>';
                        variantsHtml += '</div>';
                    });
                    variantsHtml += '</div>';
                    variantsContainer.html(variantsHtml);
                }
}

function populateSelect(elementId, min, max, step) {
            const select = document.getElementById(elementId);
            for (let i = min; i <= max; i += step) {
                const option = document.createElement("option");
                option.value = i;
                option.text = i.toLocaleString();
                select.appendChild(option);
            }
        }
$(document).ready(function() {

        populateSelect("minPrice", 5000, 1500000, 25000);
        populateSelect("maxPrice", 5000, 1500000, 25000);
       /// populateSelect("minMileage", 0, 500000, 5000);
       // populateSelect("maxMileage", 0, 500000, 5000);
    // Handle Make checkbox changes (to show/hide models)

});

</script>
<script>
    // Prevent dropdown from closing when clicking inside the dropdown
    document.querySelector('.dropdown-menuFilter').addEventListener('click', function (event) {
        event.stopPropagation();
    });
    document.querySelector('.dropdown-menuProvince').addEventListener('click', function (event) {
        event.stopPropagation();
    });
    // Close dropdown when clicking outside the dropdown
    document.addEventListener('click', function (event) {
        var dropdown = document.getElementById('makeDropdown');
        var dropdownMenu = document.querySelector('.dropdown-menuFilter');

        if (!dropdown.contains(event.target) && !dropdownMenu.contains(event.target)) {
            $(dropdownMenu).removeClass('show');
            $(dropdown).attr('aria-expanded', 'false');
        }
    });
    document.addEventListener('click', function (event) {
        var dropdown = document.getElementById('provinceDropdown');
        var dropdownMenu = document.querySelector('.dropdown-menuProvince');

        if (!dropdown.contains(event.target) && !dropdownMenu.contains(event.target)) {
            $(dropdownMenu).removeClass('show');
            $(dropdown).attr('aria-expanded', 'false');
        }
    });

    
    document.addEventListener('click', function (event) {
        var dropdown = document.getElementById('search-results');
       // var dropdownMenu = document.querySelector('.dropdown-menu');

        if (!dropdown.contains(event.target)) {
            $(dropdown).removeClass('show');
            $(dropdown).attr('aria-expanded', 'false');
        $("#appendlistofSelcted").hide();
        }
    });
   
    // Toggle dropdown manually
    document.getElementById('makeDropdown').addEventListener('click', function (event) {
        var dropdownMenu = document.querySelector('.dropdown-menuFilter');
        if (dropdownMenu.classList.contains('show')) {
            $(dropdownMenu).removeClass('show');
            $(this).attr('aria-expanded', 'false');
        } else {
            $(dropdownMenu).addClass('show');
            $(this).attr('aria-expanded', 'true');
        }
    });

    document.getElementById('provinceDropdown').addEventListener('click', function (event) {
        var dropdownMenu = document.querySelector('.dropdown-menuProvince');
        if (dropdownMenu.classList.contains('show')) {
            $(dropdownMenu).removeClass('show');
            $(this).attr('aria-expanded', 'false');
        } else {
            $(dropdownMenu).addClass('show');
            $(this).attr('aria-expanded', 'true');
        }
    });
    



    document.getElementById('keyword').addEventListener('input', function() {
    var keyword = this.value.toLowerCase();
    var resultsContainer = document.getElementById('search-results');
    resultsContainer.innerHTML = ''; // Clear previous results
        
    var carBrands=@json($carBrands);
    var carModels=@json($Carmodels);
    var carVariants=@json($Carvariants);

    // Filter car brands
    var filteredBrands = carBrands.filter(function(brand) {
        return brand.name.toLowerCase().includes(keyword);
    });

    // Filter car models
    var filteredModels = carModels.filter(function(model) {
        return model.name.toLowerCase().includes(keyword);
    });

    // Filter variants
    var filteredVariants = carVariants.filter(function(variant) {
        return variant.name.toLowerCase().includes(keyword);
    });

    // Display filtered brands
    filteredBrands.forEach(function(brand) {

        var brandItem = document.createElement('div');
        brandItem.className = 'dropdown-item';
        brandItem.innerHTML = `
            <div class="form-check d-flex justify-content-between align-items-center">
                <div>
                    <input onchange='getSelectedCheckFilterOnSearch(${brand.id}, "brand","${brand.name}")' class="form-check-input make-checkbox" type="checkbox" name="make[]" id="brand-${brand.id}" value="${brand.id}">
                    <label class="form-check-label" for="make-${brand.name}">
                        ${brand.name} (${brand.vehicle_count})
                    </label>
                </div>
            </div>
        `;
        resultsContainer.appendChild(brandItem);
    });

    // Display filtered models
    filteredModels.forEach(function(model) {
        var modelItem = document.createElement('div');
        modelItem.className = 'dropdown-item';
        modelItem.innerHTML = `
            <div class="form-check d-flex justify-content-between align-items-center">
                <div>
                    <input onchange='getSelectedCheckFilterOnSearch(${model.id}, "model","${model.name}")' class="form-check-input" type="checkbox" name="model[]" id="model-${model.id}" value="${model.id}">
                    <label class="form-check-label" for="model-${model.name}">
                        ${model.name} (${model.vehicle_count})
                    </label>
                </div>
            </div>
        `;
        resultsContainer.appendChild(modelItem);
    });

    // Display filtered variants
    filteredVariants.forEach(function(variant) {
        var variantItem = document.createElement('div');
        variantItem.className = 'dropdown-item';
        variantItem.innerHTML = `
            <div class="form-check d-flex justify-content-between align-items-center">
                <div>
                    <input onchange='getSelectedCheckFilterOnSearch(${variant.id}, "variant","${variant.name}")' class="form-check-input" type="checkbox" name="variant[]" id="variant-${variant.id}" value="${variant.id}">
                    <label class="form-check-label" for="variant-${variant.name}">
                        ${variant.name} (${variant.vehicle_count})
                    </label>
                </div>
            </div>
        `;
        resultsContainer.appendChild(variantItem);
    });

    // Show the results container
    resultsContainer.classList.add('show');
    $("#appendlistofSelcted").show();
    
    
});

var selectedFilters=[];
function getSelectedCheckFilterOnSearch(id, typesearch, value,filter=""){
        var getInputToCheckIfChecked=document.getElementById(typesearch + "-" + id);
        if(getInputToCheckIfChecked.checked){
            // Add id to selectedFilters array
            if(selectedFilters.indexOf(id) === -1){ // Check if id is not already in the array
                var obj={}
                obj["key"]=typesearch
                obj["id"]=id
                selectedFilters.push(obj);

                //use this function to clear the button text and set aas per what is selected on the filters
                    $('#makeDropdown').css({
                    'font-size': '15px',
                    'overflow': 'hidden'
                    });
                if(filter=="filter"){
                   var filterdata= $(`#makeDropdown`).text();
                   if(filterdata.includes("Select a Car")){
                        $(`#makeDropdown`).text(''); 
                    $(`#makeDropdown`).text(", "+ value);
                   }else{
                    var filterdata= $(`#makeDropdown`).text(); 
                    $(`#makeDropdown`).text(filterdata + ", " + value);
                   }

                }else{
                    $("#appendlistofSelcted").append( "<li id='"+typesearch+ id +"'>"+ value + "</li>");
                    $("#appendlistofSelcted").show()
                }
             
            }else{
                
            }
        
        }else{
            // Remove id from selectedFilters array
            var selectedid=typesearch + id
            
            var index = -1
           for (let i = 0; i < selectedFilters.length; i++) {
                if (selectedFilters[i].key === typesearch && selectedFilters[i].id === id) {
                    index = i;
                    break;
                }
                }
            if(index!== -1){
                selectedFilters.splice(index, 1);
                if(filter=="filter"){
                    var filterdata= $(`#makeDropdown`).text();
                    var filterdata= filterdata.replace(", " + value, "");
                    $(`#makeDropdown`).val(filterdata);
                    if(filterdata.includes(", ")){
                        $(`#makeDropdown`).text(filterdata.replace(",,", ""));
                    }else{
                        $(`.MakeSearchFilter`).text("Select a Car (s)");
                    }
                }else{
                    $("#"+selectedid).remove();
                }

               
            }
        }
        if(filter=="filter"){
            getFormDataAndSubmit()

        }else{
            submitFormbasedOnKeywords()
            getFormDataAndSubmit()
        }
    }

    function resetFormAdvanced(){
        // Reset selected filters array
        selectedFilters=[];
        $(".dynamic-input").remove();

        // Reset dropdown text
        $('#makeDropdown').text('Select a Car (s)');
        // Reset checkboxes
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false;
        });
        // Reset search input
        $('#keyword').val('');
        // Reset search results
        var resultsContainer = document.getElementById('search-results');
        resultsContainer.innerHTML = '';
        document.getElementById('searchForm').reset();
        $("#appendlistofSelcted").hide();
        $("#appendlistofSelcted").empty();
        
    }

 function  submitFormbasedOnKeywords() {
        //event.preventDefault(); // Prevent the default form submission

        // Clear previous dynamic inputs
        $(".dynamic-input").remove();

        // Iterate through selectedFilters and create inputs
        for (let i = 0; i < selectedFilters.length; i++) {
            let obj = selectedFilters[i];
            let inputName;
            switch (obj.key) {
                case 'brand':
                    inputName = 'car_brand_id[]';
                    break;
                case 'model':
                    inputName = 'car_model_id[]';
                    break;
                case 'variant':
                    inputName = 'car_variant_id[]';
                    break;
                default:
                    continue; // Skip if key is not recognized
            }

            // Create and append the input element
            let input = $('<input>')
                .attr('type', 'hidden')
                .attr('name', inputName)
                .attr('value', obj.id)
                .addClass('dynamic-input'); // Add a class for easy removal

            $("#searchForm").append(input);
        }
        
    };
getSelectedCheckFilterOnSearchProvince
function getSelectedCheckFilterOnSearchProvince(id, typesearch, value,filter=""){
    var id=id.replace(' ','-');
    var getInputToCheckIfChecked=document.getElementById(typesearch + "-" + id);

if(getInputToCheckIfChecked.checked){
    // Add id to selectedFilters array
    if(selectedFilters.indexOf(id) === -1){ // Check if id is not already in the array
        var obj={}
        obj["key"]=typesearch
        obj["id"]=id
        selectedFilters.push(obj);

        //use this function to clear the button text and set aas per what is selected on the filters
            $('#provinceDropdown').css({
            'font-size': '15px',
            'overflow': 'hidden'
            });
        if(filter=="filter"){
           var filterdata= $(`#provinceDropdown`).text();
           if(filterdata.includes("Select a Province(s)")){
                $(`#provinceDropdown`).text(''); 
                $(`#provinceDropdown`).text(", "+ value);
           }else{
            var filterdata= $(`#provinceDropdown`).text(); 
            $(`#provinceDropdown`).text(filterdata + ", " + value);
           }

        }else{
            $("#appendlistofSelcted").append( "<li id='"+typesearch+ id +"'>"+ value + "</li>");
            $("#appendlistofSelcted").show()
        }
     
    }else{
        
    }

}else{
    // Remove id from selectedFilters array
    var selectedid=typesearch + id
    
    var index = -1
   for (let i = 0; i < selectedFilters.length; i++) {
        if (selectedFilters[i].key === typesearch && selectedFilters[i].id === id) {
            index = i;
            break;
        }
        }
    if(index!== -1){
        selectedFilters.splice(index, 1);
        if(filter=="filter"){
            var filterdata= $(`#provinceDropdown`).text();
            var filterdata= filterdata.replace(", " + value, "");
            $(`#provinceDropdown`).val(filterdata);
            if(filterdata.includes(", ")){
                $(`#provinceDropdown`).text(filterdata.replace(",,", ""));
            }else{
                $(`#provinceDropdown`).text("Select a Province(s)");
            }
        }else{
            $("#"+selectedid).remove();
        }

       
    }
}
if(filter=="filter"){
    getFormDataAndSubmit()

}else{
    submitFormbasedOnKeywords()
    getFormDataAndSubmit()
}
}

function resetFormAdvanced(){
// Reset selected filters array
selectedFilters=[];
$(".dynamic-input").remove();

// Reset dropdown text
$('#makeDropdown').text('Select a Car (s)');
// Reset checkboxes
var checkboxes = document.querySelectorAll('input[type="checkbox"]');
checkboxes.forEach(function(checkbox) {
    checkbox.checked = false;
});
// Reset search input
$('#keyword').val('');
// Reset search results
var resultsContainer = document.getElementById('search-results');
resultsContainer.innerHTML = '';
document.getElementById('searchForm').reset();
$("#appendlistofSelcted").hide();
$("#appendlistofSelcted").empty();

}

function  submitFormbasedOnKeywords() {
//event.preventDefault(); // Prevent the default form submission

// Clear previous dynamic inputs
$(".dynamic-input").remove();

// Iterate through selectedFilters and create inputs
for (let i = 0; i < selectedFilters.length; i++) {
    let obj = selectedFilters[i];
    let inputName;
    switch (obj.key) {
        case 'brand':
            inputName = 'car_brand_id[]';
            break;
        case 'model':
            inputName = 'car_model_id[]';
            break;
        case 'variant':
            inputName = 'car_variant_id[]';
            break;
        default:
            continue; // Skip if key is not recognized
    }

    // Create and append the input element
    let input = $('<input>')
        .attr('type', 'hidden')
        .attr('name', inputName)
        .attr('value', obj.id)
        .addClass('dynamic-input'); // Add a class for easy removal

    $("#searchForm").append(input);
}
}


</script>
@endsection
<?php

function calculateMonthlyPayment($price) {
    $interestRate = 0.15; 
    $financeFeeRate = 0.10; 
    $loanTermYears = 5.9; 

    $totalPrice = $price * (1 + $financeFeeRate);
    $monthlyInterestRate = $interestRate / 12;
    $numPayments = $loanTermYears * 12;
    $monthlyPayment = ($totalPrice * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$numPayments));

    return round($monthlyPayment, 2);
}

?>