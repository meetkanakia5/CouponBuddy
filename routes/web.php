<?php

use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AdminLoginController;

use App\Http\Controllers\AdminControllers\DashBoardController;
use App\Http\Controllers\AdminControllers\CategoryController;
use App\Http\Controllers\AdminControllers\SubCategoryController;
use App\Http\Controllers\AdminControllers\CouponsController;
use App\Http\Controllers\AdminControllers\AjaxController;
use App\Http\Controllers\AdminControllers\AdminController;
use App\Http\Controllers\AdminControllers\UserController;
use App\Http\Controllers\AdminControllers\EstablishmentController;

use App\Http\Controllers\FrontEndControllers\IndexController;
use App\Http\Controllers\FrontEndControllers\CheckoutController;

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

Route::get('/', [IndexController::class, 'index'])->name('homepage');

Route::get('/dashboard', function () {
    //return view('dashboard');
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

/* Verification email */
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

/* Verify btn inside email temaplte */
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    //return redirect('/dashboard');
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

/* Resend Email */
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


/* // Only verified users may access this route... */
Route::get('/profile', function () {
    
})->middleware('verified');


Route::post('/add-to-cart', [IndexController::class,'addToCart'])->name('add-to-cart');
Route::get('/show-coupon/{id}', [IndexController::class,'showCoupon'])->name('show-coupon');
Route::post('/delete-coupon', [IndexController::class,'deleteCoupon'])->name('delete-coupon');
Route::get('/checkout', [CheckoutController::class,'checkOut'])->name('checkout');
Route::get('/get-checkout', [CheckoutController::class,'getCheckOut'])->name('get-checkout');

/* Admin */
Route::get('/login/admin', [AdminLoginController::class, 'showAdminLoginForm'])->name('login.admin');
Route::post('/login/admin', [AdminLoginController::class,'adminLogin'])->name('login.admin');
Route::get('/logout/admin', [AdminLoginController::class,'logout'])->name('logout.admin');

Route::name('admin.')->prefix('admin')->middleware('auth:admin')->group(function () {   
    
    /* Ajax Controllers */

        /* Get Sub-Categories */
        Route::post('/get-sub-categories', [AjaxController::class, 'getSubCategories'])->name('get-sub-categories');

        /* Getting Establishments eg: Harveys, Nike etc */
        Route::post('/get-establishments', [AjaxController::class, 'getEstablishments'])->name('get-establishments');

        /* Delete Directions */
        Route::post('/delete-directon', [AjaxController::class, 'deleteDirection'])->name('delete-directon');

    /* End */

    /* Dashboard */
    Route::get('dashboard', [DashBoardController::class,'index'])->name('dashboard');

    /* Admin Controller*/
    Route::resource('admins', AdminController::class);

    /* User Controller */
    Route::resource('users', UserController::class);
    
    /* Categories */
    Route::resource('categories', CategoryController::class);
    // Route::get('/categories-delete/{category_id}', [CategoryController::class, 'destroy'])->name('categories-delete');

    /* Sub-Categories */
    Route::resource('sub-categories', SubCategoryController::class);
    Route::get('/sub-categories-delete/{sub_category_id}', [SubCategoryController::class, 'destroy'])->name('sub-categories-delete');

    Route::post('/scd-delete', [SubCategoryController::class, 'deleteSubCategoryDirection'])->name('scd-delete');

    /* Establishment */
    Route::resource('establishments', EstablishmentController::class);
    Route::get('/establishments-delete/{establishment_id}', [EstablishmentController::class, 'destroy'])->name('establishments-delete');

    /* Coupon */
    Route::resource('coupons', CouponsController::class);
    Route::get('/coupon-delete/{coupon_id}', [CouponsController::class, 'destroy'])->name('coupon-delete');

});
