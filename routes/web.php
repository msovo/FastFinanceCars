<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ListingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ServiceProviderController;
use App\Http\Controllers\Admin\ToolController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\Admin\NewsCategoryController;
use App\Http\Controllers\PublicNewsController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ChatMessageController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('index'); // Ensure 'index' matches the name of your Blade template
})->name('home');



Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup.form');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [AuthController::class, 'verify'])->name('verification.verify');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
});


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/user/{id}', [AuthController::class, 'show'])->name('user.profile');
    Route::put('/user/{id}', [AuthController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [AuthController::class, 'destroy'])->name('user.destroy');
});

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/resend', [AuthController::class, 'resendVerificationEmail'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.resend');
    Route::post('/email/resend', [AuthController::class, 'resendVerificationEmail'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.resend');


    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [UserProfileController::class, 'showProfile'])->name('user.profile');
        Route::put('/profile/update', [UserProfileController::class, 'updateProfile'])->name('user.update');
        Route::delete('/profile/delete', [UserProfileController::class, 'deleteProfile'])->name('user.delete');
        Route::post('/profile/change-password', [UserProfileController::class, 'changePassword'])->name('user.change-password');
    });

    Route::prefix('admin')->group(function () {
        Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminController::class, 'login']);
        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
            Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    
            Route::resource('users', UserController::class, ['as' => 'admin']);
            Route::resource('listings', ListingController::class, ['as' => 'admin']);
            Route::resource('categories', CategoryController::class, ['as' => 'admin']);
            Route::resource('vehicles', VehicleController::class, ['as' => 'admin']);
            Route::resource('news', NewsController::class, ['as' => 'admin']);
            Route::resource('reviews', ReviewController::class, ['as' => 'admin']);
            Route::resource('serviceproviders', ServiceProviderController::class, ['as' => 'admin']);
            Route::resource('tools', ToolController::class, ['as' => 'admin']);
            Route::resource('transactions', TransactionController::class, ['as' => 'admin']);
            Route::get('reports', [ReportController::class, 'index'])->name('admin.reports.index');
            Route::get('reports/analytics', [ReportController::class, 'analytics'])->name('admin.reports.analytics');
            Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');

            Route::get('/load-content/{parameter}', [AdminController::class, 'loadContent']);
            Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
            Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
            
       
        });
    });

/*     Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('vehicles', VehicleController::class);
    }); */

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
        Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
        Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
        Route::get('admin/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('admin.vehicles.edit');

    });



    Route::prefix('admin')->group(function () {
        Route::get('vehicles/{id}/edit', [VehicleController::class, 'edit'])->name('admin.vehicles.edit');
        Route::put('vehicles/{id}', [VehicleController::class, 'update'])->name('admin.vehicles.update');
    });
    

    Route::prefix('admin')->group(function () {
        Route::get('vehicles/{id}/edit', [VehicleController::class, 'edit'])->name('admin.vehicles.edit');
        Route::put('vehicles/{id}', [VehicleController::class, 'update'])->name('admin.vehicles.update');
        Route::post('vehicles/{id}/add-features', [VehicleController::class, 'addFeatures'])->name('admin.vehicles.addFeatures');
        Route::post('vehicles/{id}/list', [VehicleController::class, 'listVehicle'])->name('admin.vehicles.list');
        Route::post('vehicles/{id}/unlist', [VehicleController::class, 'unlistVehicle'])->name('admin.vehicles.unlist');
        Route::post('vehicles/{id}/sold', [VehicleController::class, 'markAsSold'])->name('admin.vehicles.sold');
        Route::get('vehicles/{id}/is-listed', [VehicleController::class, 'isListed'])->name('admin.vehicles.isListed');

        Route::post('/admin/vehicles/{id}/list', [VehicleController::class, 'listVehicle'])->name('admin.vehicles.list');
Route::post('/admin/vehicles/{id}/unlist', [VehicleController::class, 'unlistVehicle'])->name('admin.vehicles.unlist');

    });
    
    // routes/web.php
// routes/web.php
Route::get('/admin/load-vehicle-form', [AdminController::class, 'loadVehicleForm']);
// routes/web.php
Route::resource('admin/categories', CategoryController::class, ['as' => 'admin']);
Route::get('vehicles/{id}/edit', [VehicleController::class, 'edit'])->name('admin.vehicles.edit');
Route::put('vehicles/{id}', [VehicleController::class, 'update'])->name('admin.vehicles.update');


Route::get('/get-models', [CarController::class, 'getModels'])->name('get.models');
Route::get('/get-variants', [CarController::class, 'getVariants'])->name('get.variants');


Route::get('/cars/search', [CarController::class, 'search'])->name('cars.search');

Route::get('/', [CarController::class, 'index'])->name('home');
Route::get('cars', [CarController::class, 'list'])->name('cars.index');
Route::get('cars/{id}', [CarController::class, 'show'])->name('cars.show');
Route::post('/cars/view', [CarController::class, 'view'])->name('cars.view');

Route::post('inquiries', [InquiryController::class, 'store'])->name('inquiries.store');

Route::post('/leads/{id}/approve', [InquiryController::class, 'approve'])->name('leads.approve');
Route::post('/leads/{id}/decline', [InquiryController::class, 'decline'])->name('leads.decline');

// routes/web.php



// routes/web.php


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('news', NewsController::class);
    Route::resource('newsCategory', NewsCategoryController::class);
    Route::post('news/{news}/addImage', [NewsController::class, 'addImage'])->name('news.addImage');

});

// routes/web.php


// routes/web.php


Route::get('/news', [PublicNewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [PublicNewsController::class, 'show'])->name('news.show');

Route::get('/newssearch', [PublicNewsController::class, 'search'])->name('newssearch');

Route::post('/news/{news}/comment', [PublicNewsController::class, 'storeComment'])->name('news.comment');
Route::post('/news/{news}/rate', [PublicNewsController::class, 'storeRating'])->name('news.rate');
Route::post('/poll/{pollOption}/vote', [PublicNewsController::class, 'storePollVote'])->name('poll.vote');

Route::post('/listings/{listingId}/comments', [CarController::class, 'storeComment'])->name('comments.store');
Route::post('/listings/{listingId}/ratings', [CarController::class, 'storeRating'])->name('ratings.store');




Route::get('/affordability', [CarController::class, 'affordability'])->name('affordability');
Route::post('/calculate-affordability', [CarController::class, 'calculateAffordability'])->name('calculate.affordability');
Route::post('/get-cars-based-on-affordability', [CarController::class, 'getCarsBasedOnAffordability'])->name('get.cars.affordability');
Route::post('/search-cars', [CarController::class, 'searchCars'])->name('search.cars');


Route::middleware(['auth', 'user_type:dealer'])->group(function () {
    Route::get('/dealer/dashboard', [DealerController::class, 'dashboard'])->name('dealer.dashboard');
});

Route::middleware(['auth', 'user_type:seller'])->group(function () {
    Route::get('/seller/listings', [SellerController::class, 'listings'])->name('seller.listings');
});

Route::middleware(['auth', 'user_type:dealer'])->group(function () {
    Route::get('/dealer/dashboard', [DealerController::class, 'dashboard'])->name('dealer.dashboard');
    Route::get('/dealer/manage-sales', [DealerController::class, 'manageSales'])->name('dealer.manage.sales');
    Route::get('/dealer/manage-leads', [DealerController::class, 'manageLeads'])->name('dealer.manage.leads');
    Route::get('/dealer/add-cars', [DealerController::class, 'addCars'])->name('dealer.add.cars');
    Route::post('/dealer/store-car', [DealerController::class, 'storeCar'])->name('dealer.store.car');
    Route::get('/dealer/manage-listings', [DealerController::class, 'manageListings'])->name('dealer.manage.listings');
    Route::get('/dealer/news-management', [DealerController::class, 'newsManagement'])->name('dealer.news.management');
    Route::post('/dealer/store-news', [DealerController::class, 'storeNews'])->name('dealer.store.news');
    Route::get('/dealer/manage-dealership', [DealerController::class, 'manageDealership'])->name('dealer.manage.dealership');
    Route::post('/dealer/update-dealership', [DealerController::class, 'updateDealership'])->name('dealer.update.dealership');
    Route::get('/dealer/add_car_images', [DealerController::class, 'addCarImages'])->name('dealer.add_car_images');
Route::post('/dealer/add_car_images', [DealerController::class, 'storeCarImages'])->name('dealer.store_car_images');
Route::put('/vehicles/{id}/unlist', [DealerController::class, 'unlistVehicle'])->name('dealer.vehicles.unlist');
Route::put('/vehicles/{id}/list', [DealerController::class, 'listVehicle'])->name('dealer.vehicles.list');

Route::get('/dealer/dealership/create', [DealerController::class, 'createDealership'])->name('dealer.dealership.create');
Route::post('/dealer/dealership', [DealerController::class, 'storeDealership'])->name('dealer.dealership.store');
Route::get('/dealer/dealership/edit', [DealerController::class, 'editDealership'])->name('dealer.dealership.edit'); // New route for editing
Route::get('/view-vehicles/{id}', [DealerController::class, 'viewVehicle'])->name('dealer.vehicles.view');

    Route::get('/manage-vehicles', [DealerController::class, 'manageVehicles'])->name('vehicles.manage');
    Route::get('/vehicles/{id}/edit', [DealerController::class, 'editVehicle'])->name('dealer.vehicles.edit');
    Route::put('/vehicles/{id}', [DealerController::class, 'updateVehicle'])->name('dealer.vehicles.update');
    Route::post('/vehicles/{id}/images', [DealerController::class, 'addVehicleImages'])->name('dealer.vehicles.images.add');
    Route::post('/vehicles/{id}/features', [DealerController::class, 'addVehicleFeatures'])->name('dealer.vehicles.features.add');
    Route::delete('/vehicles/{id}', [DealerController::class, 'destroyVehicle'])->name('dealer.vehicles.destroy');
    Route::post('/vehicles/{id}/sponsor', [DealerController::class, 'sponsorVehicle'])->name('dealer.vehicles.sponsor');
    Route::post('/vehicles/{id}/feature', [DealerController::class, 'featureVehicle'])->name('dealer.vehicles.feature');

    Route::get('/dealer/news/{id}/edit', [DealerController::class, 'editNews'])->name('dealer.news.edit');
Route::put('/dealer/news/{id}', [DealerController::class, 'updateNews'])->name('dealer.news.update');
Route::delete('/dealer/news/{id}', [DealerController::class, 'destroyNews'])->name('dealer.news.destroy');
// ... other routes ...

Route::post('/dealer/news/{id}/poll', [DealerController::class, 'addNewsPoll'])->name('dealer.news.poll.add');
Route::post('/dealer/news/{id}/comment', [DealerController::class, 'addNewsComment'])->name('dealer.news.comment.add');
Route::post('/dealer/news/{id}/images', [DealerController::class, 'addNewsImages'])->name('dealer.news.images.add');
});


Route::middleware(['auth', 'user_type:seller'])->group(function () {
    Route::get('/seller/dashboard', [SellerController::class, 'dashboard'])->name('seller.dashboard');
    Route::get('/seller/manage-sales', [SellerController::class, 'manageSales'])->name('manage.sales');
    Route::get('/seller/manage-leads', [SellerController::class, 'manageLeads'])->name('manage.leads');
    Route::get('/seller/add-cars', [SellerController::class, 'addCars'])->name('add.cars');
    Route::post('/seller/store-car', [SellerController::class, 'storeCar'])->name('store.car');
    Route::get('/seller/manage-listings', [SellerController::class, 'manageListings'])->name('manage.listings');
    Route::get('/seller/news-management', [SellerController::class, 'newsManagement'])->name('news.management');
    Route::post('/seller/store-news', [SellerController::class, 'storeNews'])->name('store.news');
});

Route::get('/products', function () {
    return view('products');
})->name('products');

Route::get('/models/{make_id}', [CarController::class, 'CargetModels']);
Route::get('/variants/{model_id}', [CarController::class, 'CargetVariants']);
Route::get('/financeCalculator', [CarController::class, 'getMakes'])->name('financeCalculator');

Route::get('/finance', function () {
    return view('finance');
})->name('finance');


Route::get('/finance/calculator', [CarController::class, 'showFinanceCalculator'])->name('finance.calculator');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/privateSellerGuide', function () {
    return view('privateSellerGuide');
})->name('privateSellerGuide');

Route::get('/DealerSellerGuide', function () {
    return view('DealerSellerGuide');
})->name('DealerSellerGuide');


Route::middleware(['auth'])->group(function () {
    Route::get('/chat-messages', [ChatMessageController::class, 'index']);
    Route::post('/chat-messages', [ChatMessageController::class, 'store']);
});

Route::get('/guest-chat-messages', [ChatMessageController::class, 'index']);
Route::post('/guest-chat-messages', [ChatMessageController::class, 'store']);

Route::post('/registerguest', [ChatMessageController::class, 'register'])->name('registerguest');

Route::get('dealerships.index', [CarController::class, 'showDealerships'])->name('dealerships.index');
Route::get('/dealerships.show/{id}', [CarController::class, 'showDealership'])->name('dealerships.show');
Route::get('dealerships.search', [CarController::class, 'searchDealer'])->name('dealerships.search');
