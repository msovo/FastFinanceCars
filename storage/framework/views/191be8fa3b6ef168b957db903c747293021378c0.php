

<?php $__env->startSection('content'); ?>
<style type="text/css">
    body{
        background:gainsboro;
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
    .carousel-thumbnails {
        display: flex;
        overflow-x: auto;
        margin-top: 10px;
    }
    .carousel-thumbnails img {
        max-height: 150px;
        cursor: pointer;
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
    .car-details ul {
        list-style: none;
        padding: 0;
    }
    .car-details ul li {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
    }
    .car-details .specs {
        display: flex;
        flex-wrap: wrap;
    }
    .car-details .specs div {
        flex: 1 1 33%;
        display: flex;
        align-items: center;
    }
    .car-details .specs div i {
        margin-right: 5px;
    }
    .car-details .features {
        display: flex;
        flex-wrap: wrap;
    }
    .car-details .features li {
        flex: 1 1 33%;
        display: flex;
        align-items: center;
    }
    .car-details .features li i {
        margin-right: 5px;
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
        height: auto;
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
.cardimg {
    height: 300px;
    overflow: hidden;
}

.main-image {
    width: 100%;
    height: auto;
}

.additional-images {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    margin-top: 10px;
    height: 100px;
    overflow: hidden;

}

.thumbnail-img {
    cursor: pointer;
    margin-bottom: 5px;
    max-height: 100px; /* Ensure thumbnails do not exceed a certain height */
    object-fit: cover; /* Ensure thumbnails fit within the specified height */
}

.card-body {
    background-color: white; /* Remove red background */
}

.card-text strong {
    color: red;
}


#financeCalculator {
      background-color: #ffffff;
      padding: 20px;
      border: 1px solid #dee2e6;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    #financeCalculator .form-group {
      margin-bottom: 15px;
    }

    #financeCalculator .form-group label {
      color: #495057;
      font-weight: bold;
    }

    #financeCalculator .form-control,
    #financeCalculator .form-control-range {
      border: 1px solid #ced4da;
      border-radius: 0.25rem;
    }

    #financeCalculator .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
      color: #fff;
      font-weight: bold;
    }

    #paymentInfo {
      background-color: #ffffff;
      border: 1px solid #dee2e6;
      border-radius: 8px;
      padding: 20px;
      margin-top: 30px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    #paymentInfo h3 {
      text-align: center;
      margin-bottom: 20px;
    }

    .output-row {
      display: flex;
      justify-content: space-between;
      padding: 10px 0;
      border-bottom: 1px solid #dee2e6;
    }

    .output-row:last-child {
      border-bottom: none;
    }

    .output-row span {
      font-weight: bold;
    }

    .disclaimer {
      font-size: 12px;
      color: #6c757d;
      margin-top: 20px;
      text-align: center;
    }
.car-details-mobile{
    display: none;
}
@media (max-width: 768px) { 
    .section-title{
        text-align: center;
    }
    .car-details-mobile{
    display: block;
}
    .car-details-pc{
        display: none;
    }

    .social-share {
      display: flex;
      gap: 15px;
      justify-content: center;
      margin: 20px;
    }
    .social-share a {
      text-decoration: none;
      color: white;
      padding: 12px;
      border-radius: 50%;
      display: inline-flex;
      justify-content: center;
      align-items: center;
      width: 50px;
      height: 50px;
      transition: transform 0.2s ease, background-color 0.3s ease;
    }
    .social-share a:hover {
      transform: scale(1.1);
    }
    .social-share .whatsapp { background-color: #25D366; padding:4px; }
    .social-share .facebook { background-color: #3b5998; padding:4px ;}
    .social-share .x { background-color: #1da1f2; }
    .social-share .instagram { background: linear-gradient(45deg, #f58529, #dd2a7b, #8134af, #515bd4);padding:4px ; }
  
}
#paymentInfo {
      background-color: #ffffff;
      border: 1px solid #dee2e6;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      width: 300px;
      margin: auto;
    }
    #paymentInfo h3 {
      text-align: center;
      color: #343a40;
    }
    .output-row {
      display: flex;
      justify-content: space-between;
      padding: 10px 0;
      font-size: 16px;
      border-bottom: 1px solid #dee2e6;
    }
    .output-row:last-child {
      border-bottom: none;
    }
    .disclaimer {
      font-size: 12px;
      color: #6c757d;
      margin-top: 20px;
    }

    .recently-viewed-scroll {
    display: flex;
    overflow-x: auto;
    gap: 16px;
    padding: 10px;
    scroll-behavior: smooth;
}

.recently-viewed-scroll::-webkit-scrollbar {
    height: 5px;
    background: transparent;
}

.recently-viewed-scroll::-webkit-scrollbar-thumb {
    background: rgba(0, 0, 0, 0.5);
    border-radius: 10px;
}

.car-card {
    flex: 0 0 auto;
    width: 200px;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.car-card .image-container {
    width: 100%;
    height: 120px;
    overflow: hidden;
}

.car-card .image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.car-card .details {
    padding: 10px;
}

.car-card .details h5 {
    font-size: 14px;
    margin: 0 0 5px;
}

.car-card .details p {
    font-size: 12px;
    margin: 0;
    color: #555;
}
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
    font-family: Arial, sans-serif;
}

.page-item {
    margin: 0 5px;
}

.page-item a,
.page-item span {
    display: inline-block;
    padding: 10px 15px;
    text-decoration: none;
    border: 1px solid #ddd;
    border-radius: 4px;
    color: #007bff;
    transition: all 0.2s ease;
}

.page-item.active span {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

.page-item a:hover {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

.page-item.disabled span {
    color: #ccc;
    pointer-events: none;
}

</style>
<div class="container mt-5">
    <div class="card row">
    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>
    </div>

    <div class="row">
    <div class="col-md-8">
        <h4>
            <i class="fas fa-calendar-alt"></i> <?php echo e($car->year); ?> &nbsp; 
            <?php echo e($car->make); ?> <?php echo e($car->model); ?> <?php echo e($car->variant); ?>

        </h4>
        <h5 class="price">
             R<?php echo e(number_format($car->price, 2)); ?> &nbsp;
            <span class="text-danger">R<?php echo e(number_format(calculateMonthlyPayment($car->price), 2)); ?> p/m</span>
        </h5>
        <div id="imageSlider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php $__currentLoopData = $car->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="carousel-item <?php echo e($loop->first ? 'active' : ''); ?>">
                        <img src="<?php echo e(asset('storage/' . $image->image_url)); ?>" class="d-block w-100" alt="...">
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <a class="carousel-control-prev" href="#imageSlider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#imageSlider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="carousel-thumbnails mt-3">
            <?php $__currentLoopData = $car->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <img src="<?php echo e(asset('storage/' . $image->image_url)); ?>" class="img-thumbnail clickable-image" data-target="#imageSlider" data-slide-to="<?php echo e($loop->index); ?>" alt="...">
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

 
    <div class="col-md-4">
    <h3>Interested in this car?</h3>
    <form action="<?php echo e(route('inquiries.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php if(auth()->guard()->guest()): ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
        <?php else: ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo e(Auth::user()->username); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo e(Auth::user()->email); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo e(Auth::user()->phone); ?>" readonly>
            </div>
            <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->user_id); ?>">
        <?php endif; ?>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" id="message" name="message" rows="3" required>Hi. I am contacting you regarding this vehicle, I would like to know more about the process.</textarea>
        </div>
        <input type="hidden" name="listing_id" value="<?php echo e($listing_id); ?>">
        <div class="row form-group">
           <div class="col"> <label class="col-sm-2 control-label">Subscribe</label></div>
           <div class="col"> <label for="car-alert">Car alert</label>
            <input type="checkbox" name="car-alert" id="car-alert"/></div>
            <div class="col"> <label for="car-news">Car News</label>
            <input type="checkbox" name="car-news" id="car-news"/>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Submit Inquiry</button>
        <br/>
        <button type="button" class="btn btn-outline-success  w-100"> WhatsApp Dealer</button>
        <p>By submiting your contact to the dealer you accept our terms and conditions and policy rules</p>

    </form>
    <div class="row" style="text-align:center">
    <div class="col" style="text-align:right;">Share</div>
     <div class="social-share col" style="text-align:left">
    <a class="whatsapp" href="https://api.whatsapp.com/send?text=Check%20this%20out, affordable cars available :%20" target="_blank">
      <i class="fab fa-whatsapp btn-outline-success" style="font-size:22px;" ></i>
    </a>
    <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=" target="_blank">
      <i class="fab fa-facebook-f btn-outline-primary" style="font-size:22px;" ></i>
    </a>
    <a class="x" href="https://twitter.com/intent/tweet?url=" target="_blank">
      <i class="fab fa-x-twitter btn-outline-dark" style="font-size:22px;"></i>
    </a>
    <a class="instagram" href="https://www.instagram.com/" target="_blank">
      <i class="fab fa-instagram btn-outline-danger" style="font-size:22px;"></i>
    </a>
  </div>
  </div>
</div>
    <div class="col-md-4 car-details-mobile">
        <div class="car-details">
            <div class="specs">
                <div>
                    <i class="fas fa-tachometer-alt"></i> <?php echo e($car->mileage); ?> km
                </div>
                <div>
                    <i class="fas fa-cogs"></i> <?php echo e($car->transmission); ?>

                </div>
                <div>
                    <i class="fas fa-gas-pump"></i> <?php echo e($car->fuel_type); ?>

                </div>
                <div>
                    <i class="fas fa-palette"></i> <?php echo e($car->color); ?>

                </div>
                <div>
                    <i class="fas fa-car"></i> <?php echo e(ucfirst($car->condition)); ?>

                </div>
                <div>
                    <i class="fas fa-car-side"></i> <?php echo e($car->body_type); ?>

                </div>
                <div>
                    <i class="fas fa-cube"></i> <?php echo e($car->engine_size); ?>

                </div>
            </div>
            <div class="description mt-3">
                <h6><i class="fas fa-info-circle"></i> Description</h6>
                <p><?php echo e($car->description); ?></p>
            </div>
            <h6><i class="fas fa-list"></i> Features</h6>
            <div class="features mt-3">
                <ul class="features">
                    <?php $__currentLoopData = $car->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <i class="fas fa-check"></i> <?php echo e($feature->feature); ?>

                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="col-md-10 car-details-pc">
        <div class="car-details">
            <div class="specs">
                <div>
                    <i class="fas fa-tachometer-alt"></i> <?php echo e($car->mileage); ?> km
                </div>
                <div>
                    <i class="fas fa-cogs"></i> <?php echo e($car->transmission); ?>

                </div>
                <div>
                    <i class="fas fa-gas-pump"></i> <?php echo e($car->fuel_type); ?>

                </div>
                <div>
                    <i class="fas fa-palette"></i> <?php echo e($car->color); ?>

                </div>
                <div>
                    <i class="fas fa-car"></i> <?php echo e(ucfirst($car->condition)); ?>

                </div>
                <div>
                    <i class="fas fa-car-side"></i> <?php echo e($car->body_type); ?>

                </div>
                <div>
                    <i class="fas fa-cube"></i> <?php echo e($car->engine_size); ?>

                </div>
            </div>
            <div class="description mt-3">
                <h6><i class="fas fa-info-circle"></i> Description</h6>
                <p><?php echo e($car->description); ?></p>
            </div>
            <h6><i class="fas fa-list"></i> Features</h6>
            <div class="features mt-3">
                <ul class="features">
                    <?php $__currentLoopData = $car->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <i class="fas fa-check"></i> <?php echo e($feature->feature); ?>

                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>


    <div class="mt-5">
      <h3>Finance Calculator</h3>
      <div class="row">
        <div class="col-md-6">
          <form id="financeCalculator">
            <div class="form-group">
              <label for="price">Car Price</label>
              <input type="number" class="form-control" id="price" name="price" value="250000" required>
            </div>
            <div class="form-group">
              <label for="deposit">Deposit Amount</label>
              <input type="number" class="form-control" id="deposit" name="deposit" value="0" required>
            </div>
            <div class="form-group">
              <label for="tradeInValue">Less Trade-In Value</label>
              <input type="number" class="form-control" id="tradeInValue" name="tradeInValue" value="0" required>
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
        </div>

        <div class="col-md-6">
          <div id="paymentInfo">
            <h3>Payment Summary</h3>
            <div class="output-row">
              <span>Monthly Payment:</span> <span id="monthlyPayment">R0.00</span>
            </div>
            <div class="output-row">
              <span>Total Loan Value:</span> <span id="totalLoanValue">R0.00</span>
            </div>
            <div class="output-row">
              <span>Total Interest:</span> <span id="totalInterest">R0.00</span>
            </div>
            <div class="output-row">
              <span>Total Payment:</span> <span id="totalPayment">R0.00</span>
            </div>
            <div class="output-row">
              <span>Balloon Payment Due:</span> <span id="balloonPaymentInfo">R0.00</span>
            </div>
            <p class="disclaimer">
              * Please note that these calculations are estimates only and should be confirmed with your finance provider. They do not include license and registration fees, finance provider fees, or any other associated administrative fees. Car finance is subject to bank approval with an accredited finance provider.
            </p>
          </div>
        </div>
      </div>
    </div>
 
    </div>


<div class="container mt-5">
    <div class="row">
        <!-- Left Sidebar for Search, Sort, and Filter -->
        <div class="col-md-3">
            <!-- Search, Sort, and Filter Form -->
            <div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h5>Search & Filter</h5>
    </div>
    <div class="card-body">
        <!-- Search Form -->
        <form id="searchForm">
            <div class="form-group">
                <label for="search">Search</label>
                <input type="text" class="form-control" id="search" name="search" placeholder="Search...">
            </div>
            <div class="form-group">
                <label for="sort">Sort By</label>
                <select class="form-control" id="sort" name="sort">
                    <option value="date_d">Date Descending</option>
                    <option value="date_a">Date Ascending</option>
                    <option value="price_d">Price Descending</option>
                    <option value="price_a">Price Ascending</option>
                </select>
            </div>
            <div class="form-group">
                <label for="filter">Filter</label>
                <select class="form-control" id="filter" name="filter">
                    <option value="featured">Featured</option>
                    <option value="sponsored">Sponsored</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Apply</button>
        </form>
    </div>
</div>

        </div>

        <!-- Main Content Area -->
        <div class="col-md-9">
    <div class="mt-5" id="sponsored-cars-section">
        <h3>Featured and Sponsored Cars</h3>
        <div class="row">
            <?php $__currentLoopData = $featuredCars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <div class="card" onclick="location.href='<?php echo e(route('cars.show', $listing->vehicle->vehicle_id)); ?>';" style="cursor: pointer;">
                        <?php if($listing->vehicle->images->isNotEmpty()): ?>
                            <div class="main-image-container">
                                <img src="<?php echo e(asset('storage/' . $listing->vehicle->images->first()->image_url)); ?>" class="card-img-top main-image" alt="<?php echo e($listing->vehicle->make); ?> <?php echo e($listing->vehicle->model); ?>">
                                <span class="image-count">
                                    <i class="fas fa-camera"></i> <?php echo e($listing->vehicle->images->count()); ?>

                                </span>
                            </div>
                        <?php else: ?>
                            <div class="main-image-container">
                                <img src="default-image.jpg" class="card-img-top main-image" alt="Default Image">
                            </div>
                        <?php endif; ?>
                        <div class="row thumbnails">
                            <?php $__currentLoopData = $listing->vehicle->images->slice(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-4">
                                    <img src="<?php echo e(asset('storage/' . $image->image_url)); ?>" class="img-thumbnail thumbnail-image" alt="<?php echo e($listing->vehicle->make); ?> <?php echo e($listing->vehicle->model); ?>">
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-calendar-alt"></i> <?php echo e($listing->vehicle->year); ?> &nbsp; 
                                <?php echo e($listing->vehicle->make); ?> <?php echo e($listing->vehicle->model); ?>

                            </h5>
                            <p class="card-text">
                                <i class="fas fa-money-bill-wave"></i> R<?php echo e(number_format($listing->vehicle->price, 2)); ?> &nbsp;
                            </p>
                            <p class="card-text text-danger">
                                R<?php echo e(calculateMonthlyPayment($listing->vehicle->price)); ?> p/m 
                                <span class="badge" style="background-color: <?php echo e($listing->vehicle->condition == 'used' ? 'red' : 'blue'); ?>;">
                                    <?php echo e(ucfirst($listing->vehicle->condition)); ?>

                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $sponsoredCars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <div class="card" onclick="location.href='<?php echo e(route('cars.show', $listing->vehicle->vehicle_id)); ?>';" style="cursor: pointer;">
                        <?php if($listing->vehicle->images->isNotEmpty()): ?>
                            <div class="main-image-container">
                                <img src="<?php echo e(asset('storage/' . $listing->vehicle->images->first()->image_url)); ?>" class="card-img-top main-image" alt="<?php echo e($listing->vehicle->make); ?> <?php echo e($listing->vehicle->model); ?>">
                                <span class="image-count">
                                    <i class="fas fa-camera"></i> <?php echo e($listing->vehicle->images->count()); ?>

                                </span>
                            </div>
                        <?php else: ?>
                            <div class="main-image-container">
                                <img src="default-image.jpg" class="card-img-top main-image" alt="Default Image">
                            </div>
                        <?php endif; ?>
                        <div class="row thumbnails">
                            <?php $__currentLoopData = $listing->vehicle->images->slice(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-4">
                                    <img src="<?php echo e(asset('storage/' . $image->image_url)); ?>" class="img-thumbnail thumbnail-image" alt="<?php echo e($listing->vehicle->make); ?> <?php echo e($listing->vehicle->model); ?>">
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-calendar-alt"></i> <?php echo e($listing->vehicle->year); ?> &nbsp; 
                                <?php echo e($listing->vehicle->make); ?> <?php echo e($listing->vehicle->model); ?>

                            </h5>
                            <p class="card-text">
                                <i class="fas fa-money-bill-wave"></i> R<?php echo e(number_format($listing->vehicle->price, 2)); ?> &nbsp;
                            </p>
                            <p class="card-text text-danger">
                                R<?php echo e(calculateMonthlyPayment($listing->vehicle->price)); ?> p/m 
                                <span class="badge" style="background-color: <?php echo e($listing->vehicle->car_condition == 'used' ? 'red' : 'blue'); ?>;">
                                    <?php echo e(ucfirst($listing->vehicle->car_condition)); ?>

                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="pagination-wrapper">
    <?php echo e($sponsoredCars->links('pagination::bootstrap-4')); ?>

</div>
<p class="text-muted" style="text-align:center">
    Showing <?php echo e($sponsoredCars->firstItem()); ?> to <?php echo e($sponsoredCars->lastItem()); ?> of <?php echo e($sponsoredCars->total()); ?> results
</p>
    </div>

    <div class="recently-viewed mt-5">
    <h3>Recently Viewed</h3>
    <div id="recently-viewed-container" class="recently-viewed-scroll">
        <!-- JavaScript will populate cars here -->
    </div>
</div>

<?php if($news && $news->count() > 0): ?>
    <div class="mt-5">
        <h3>Related News</h3>
        <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(isset($article->id, $article->title, $article->content, $article->published_at)): ?> <!-- Ensure data exists -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e($article->title); ?></h5>
                        <p class="card-text"><?php echo e(Str::limit($article->content, 150)); ?></p>
                        <p class="card-text">
                            <small class="text-muted">Published on <?php echo e($article->published_at); ?></small>
                        </p>
                        <a href="<?php echo e(route('news.show', $article->id)); ?>" class="btn btn-primary">Read More</a>
                    </div>
                    <div class="card-footer">
                        <h6>Comments</h6>
                        <?php if($article->comments && $article->comments->count() > 0): ?>
                            <?php $__currentLoopData = $article->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($comment->user->name, $comment->content)): ?>
                                    <p><strong><?php echo e($comment->user->name); ?>:</strong> <?php echo e($comment->content); ?></p>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <p>No comments available.</p>
                        <?php endif; ?>
                        <h6>
                            Average Rating: 
                            <?php echo e($article->ratings->count() > 0 ? round($article->ratings->avg('rating'), 1) : 'No ratings yet'); ?>

                        </h6>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
   
</div>

</div>

            <!-- Inquiry Form -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
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
      const tradeInValue = parseFloat(document.getElementById('tradeInValue').value);
      const interestRate = parseFloat(document.getElementById('interestRate').value) / 100 / 12;
      const loanTerm = parseInt(document.getElementById('loanTerm').value);
      const balloonPayment = parseFloat(document.getElementById('balloonPayment').value) / 100;

      const adjustedPrice = price - tradeInValue - deposit;
      const balloonAmount = adjustedPrice * balloonPayment;
      const loanAmount = adjustedPrice - balloonAmount;
      const monthlyPayment = (loanAmount * interestRate) / (1 - Math.pow(1 + interestRate, -loanTerm));
      const totalLoanValue = monthlyPayment * loanTerm;
      const totalInterest = totalLoanValue - loanAmount;
      const totalPayment = totalLoanValue + balloonAmount;

      document.getElementById('monthlyPayment').innerText = `R${monthlyPayment.toFixed(2)}`;
      document.getElementById('totalLoanValue').innerText = `R${totalLoanValue.toFixed(2)}`;
      document.getElementById('totalInterest').innerText = `R${totalInterest.toFixed(2)}`;
      document.getElementById('totalPayment').innerText = `R${totalPayment.toFixed(2)}`;
      document.getElementById('balloonPaymentInfo').innerText = `R${balloonAmount.toFixed(2)}`;
    }

</script>



<script>
$(document).ready(function() {
    $('.clickable-image').on('click', function() {
        const slideTo = $(this).data('slide-to');
        $('#imageSlider').carousel(slideTo);
    });
    document.querySelectorAll('.thumbnail-img').forEach(thumbnail => {
    thumbnail.addEventListener('click', function() {
        const mainImage = this.closest('.card').querySelector('.main-image');
        mainImage.src = this.src;
    });

  
   
});

var car = {
    vehicle_id: "<?php echo e($car->vehicle_id); ?>", // Assuming you have a car ID
        mileage: "<?php echo e($car->mileage); ?>",
        transmission: "<?php echo e($car->transmission); ?>",
        fuel_type: "<?php echo e($car->fuel_type); ?>",
        color: "<?php echo e($car->color); ?>",
        condition: "<?php echo e(ucfirst($car->car_condition)); ?>",
        body_type: "<?php echo e($car->body_type); ?>",
        engine_size: "<?php echo e($car->engine_size); ?>",
        description: "<?php echo e($car->description); ?>",
        price: parseInt( "<?php echo e($car->price); ?>"),
        year: "<?php echo e($car->year); ?>",
        make: "<?php echo e($car->make); ?>",
        model: "<?php echo e($car->model); ?>",
        variant: "<?php echo e($car->variant); ?>",
        images: <?php echo json_encode($car->images->map(function($image) { return ['url' => asset('storage/' . $image->image_url)]; }), 15, 512) ?>
    };

    appendCarToCookie(car);

    calculatePayment()
});

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}
function appendCarToCookie(car) {
    var cars = getCookie("recentlyViewedCars");
    if (cars) {
        cars = JSON.parse(cars);
    } else {
        cars = [];
    }

    // Check if the car already exists in the array
    var carExists = cars.some(function(existingCar) {
        return existingCar.vehicle_id === car.vehicle_id;
    });

    if (!carExists) {
        cars.push(car);
        setCookie("recentlyViewedCars", JSON.stringify(cars), 7); // Store for 7 days
    } else {
        
    }
}

 const currentURL = encodeURIComponent(window.location.href);
    document.querySelectorAll('.social-share a').forEach(link => {
      const href = link.getAttribute('href');
      if (href.includes("?")) {
        link.setAttribute('href', `${href}${currentURL}`);
      }
    });
    const recentlyViewedCarsJSON = getCookie('recentlyViewedCars');
const recentlyViewedCars = recentlyViewedCarsJSON ? JSON.parse(recentlyViewedCarsJSON) : [];

// Function to render the recently viewed cars
function renderRecentlyViewedCars(cars) {
    const container = document.getElementById('recently-viewed-container');
    container.innerHTML = ''; // Clear any existing content

    cars.forEach(car => {
        const carCard = `
            <div class="car-card" onclick="location.href='/cars/${car.vehicle_id}'" style="cursor: pointer;">
                <div class="image-container">
                    <img src="${car.images[0].url}" alt="${car.make} ${car.model}" class="main-image">
                </div>
                <div class="details">
                    <h5>${car.year} ${car.make} ${car.model}</h5>
                    <p>Price: R${Number(car.price).toLocaleString()}</p>
                </div>
            </div>
        `;
        container.innerHTML += carCard;
    });
}

// Call the function to render cars
if (recentlyViewedCars.length > 0) {
    renderRecentlyViewedCars(recentlyViewedCars);
}

    .recently-viewed .d-flex {
    -ms-overflow-style: none; /* Internet Explorer 10+ */
    scrollbar-width: none; /* Firefox */
}

.recently-viewed .d-flex::-webkit-scrollbar {
    display: none; /* Chrome, Safari, and Opera */
}
document.addEventListener('DOMContentLoaded', function () {
    // Smooth scrolling to the target section if there's a hash in the URL
    const hash = window.location.hash;
    if (hash) {
        const targetElement = document.querySelector(hash);
        if (targetElement) {
            targetElement.scrollIntoView({ behavior: 'smooth' });
        }
    }

    // Append the hash to pagination links dynamically
    const paginationLinks = document.querySelectorAll('.pagination a');
    paginationLinks.forEach(link => {
        // Avoid duplicating the hash
        if (!link.href.includes('#sponsored-cars-section')) {
            link.href += '#sponsored-cars-section';
        }
    });
});

</script>

<?php $__env->stopSection(); ?>

<?php
function calculateMonthlyPayment($price) {
    $interestRate = 0.15; // 15% annual interest rate
    $financeFeeRate = 0.10; // 15% finance fees and services
    $loanTermYears = 5.9; // Loan term in years

    // Add finance fees to the price
    $totalPrice = $price * (1 + $financeFeeRate);

    // Calculate monthly interest rate
    $monthlyInterestRate = $interestRate / 12;

    // Calculate number of payments
    $numPayments = $loanTermYears * 12;

    // Calculate monthly payment using the formula for an installment loan
    $monthlyPayment = ($totalPrice * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$numPayments));

    return round($monthlyPayment, 2);
}
?>
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FastFinanceCars\resources\views/cars/show.blade.php ENDPATH**/ ?>