<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?php echo e(url('/')); ?>">Fast Finance Cars</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <!-- Existing nav items -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="buyCarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Buy a Car
                </a>
                <div class="dropdown-menu" aria-labelledby="buyCarDropdown">
                    <a class="dropdown-item" href="#">New Cars</a>
                    <a class="dropdown-item" href="#">Used Cars</a>
                    <a class="dropdown-item" href="#">Certified Pre-Owned</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="sellCarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sell my Car
                    </a>
                    <div class="dropdown-menu" aria-labelledby="sellCarDropdown">
                        <a class="dropdown-item" href="#">Sell Privately</a>
                        <a class="dropdown-item" href="#">Trade-In</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="valueCarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Value my Car
                    </a>
                    <div class="dropdown-menu" aria-labelledby="valueCarDropdown">
                        <a class="dropdown-item" href="#">Car Valuation</a>
                        <a class="dropdown-item" href="#">Get an Offer</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Car Subscriptions</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="newsReviewsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        News & Reviews
                    </a>
                    <div class="dropdown-menu" aria-labelledby="newsReviewsDropdown">
                        <a class="dropdown-item" href="#">Latest News</a>
                        <a class="dropdown-item" href="#">Car Reviews</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="toolsServicesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tools & Services
                    </a>
                    <div class="dropdown-menu" aria-labelledby="toolsServicesDropdown">
                        <a class="dropdown-item" href="#" onclick="openModal()">Loan Calculator</a>
                        <a class="dropdown-item" href="#">Insurance Quotes</a>
                    </div>
                </li>
               
        </ul>
        <ul class="navbar-nav ml-auto">
            <?php if(auth()->guard()->guest()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('login')); ?>">Sign In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('signup')); ?>">Sign Up</a>
                </li>
            <?php else: ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="right:0!important">
                        <img src="<?php echo e(asset('storage/'. Auth::user()->profile_image)); ?>" class="rounded-circle" alt="Profile Image" width="30" height="30">

                        <?php echo e(Auth::user()->name); ?>

                    </a>
                    <div class="dropdown-menu" aria-labelledby="accountDropdown">
                        <a class="dropdown-item" href="<?php echo e(route('user.profile')); ?>">My Profile</a>
                        <a class="dropdown-item" href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
                        <?php if(Auth::user()->user_type == 'dealer'): ?>
                            <a class="dropdown-item" href="<?php echo e(route('dealer.dashboard')); ?>">Manage Dealership</a>
                        <?php elseif(Auth::user()->user_type == 'seller'): ?>
                            <a class="dropdown-item" href="<?php echo e(route('seller.listings')); ?>">Manage Your Listings</a>
                        <?php endif; ?>
                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<?php /**PATH C:\xampp\htdocs\FastFinanceCars\resources\views/partials/navbar.blade.php ENDPATH**/ ?>