<?php

use App\Model\City;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Imports\CategoryImport;
use App\Imports\MainCategoryImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;

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

// Admin Auth Route
Route::group(['prefix' => 'admin'], function () {
    Auth::routes(['register' => false]);
});

Route::get('/', function () {
    return view('errors.new-home');
});

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
    //Locations
    Route::resource('locations', 'LocationController');
    //User Roles & Permisions
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    //Brand Routes
    Route::resource('brands', 'BrandController');
    //Category Group
    Route::resource('category-groups', 'CategoryGroupController');
    //Categories Routes
    Route::resource('categories', 'CategoryController');
    //Products Routes
    Route::resource('products', 'ProductController');
    Route::delete('products/media/{id}', 'ProductController@deleteProductMedia')->name('products.media.delete');
    Route::get('import/products', 'ProductController@importForm')->name('products.import-form');
    Route::post('import/products', 'ProductController@importProducts')->name('products.import');
    Route::get('/export/products', 'ProductController@exportProducts')->name('products.export');

    //Advertisement Routes
    Route::get('ads/{type}', 'AdvertisementController@index')->name('ads.index');
    Route::get('ads/{type}/create', 'AdvertisementController@create')->name('ads.create');
    Route::post('ads/{type}', 'AdvertisementController@store')->name('ads.store');
    Route::get('ads/{type}/{id}/edit', 'AdvertisementController@edit')->name('ads.edit');
    Route::patch('ads/{type}/{id}', 'AdvertisementController@update')->name('ads.update');
    Route::delete('ads/{type}/{id}', 'AdvertisementController@destroy')->name('ads.destroy');
    Route::post('ads/{type}/{id}/status', 'AdvertisementController@updateAdvertisementStatus')->name('ads.update.status');

    Route::get('mobile-ads/{type}', 'MobileAdvertisementController@index')->name('mobile-ads.index');
    Route::get('mobile-ads/{type}/create', 'MobileAdvertisementController@create')->name('mobile-ads.create');
    Route::post('mobile-ads/{type}/create', 'MobileAdvertisementController@store')->name('mobile-ads.store');
    Route::get('mobile-ads/{type}/{id}/edit', 'MobileAdvertisementController@edit')->name('mobile-ads.edit');
    Route::patch('mobile-ads/{type}/{id}', 'MobileAdvertisementController@update')->name('mobile-ads.update');
    Route::delete('mobile-ads/{type}/{id}', 'MobileAdvertisementController@destroy')->name('mobile-ads.destroy');
    Route::post('mobile-ads/{type}/{id}/status', 'MobileAdvertisementController@updateAdvertisementStatus')->name('mobile-ads.update.status');


    //Orders Routes
    Route::get('orders', 'OrderController@index')->name('orders.index');
    Route::get('orders/{id}/edit', 'OrderController@edit')->name('orders.edit');
    Route::patch('orders/{id}/edit', 'OrderController@update')->name('orders.update');
    Route::get('orders/{id}/detail', 'OrderController@detail')->name('orders.detail');
    Route::get('township/{id}', 'OrderController@getTownshipView')->name('orders.township');
    Route::get('delivery/{id}','OrderController@deliveryDetail')->name('orders.delivery.detail');

    //Logistic Routes
    Route::get('logistics', 'LogisticController@index')->name('logistics.index');
    Route::get('logistics/create', 'LogisticController@create')->name('logistics.create');
    Route::post('logistics', 'LogisticController@store')->name('logistics.store');
    Route::get('logistics/{id}/edit', 'LogisticController@edit')->name('logistics.edit');
    Route::patch('logistics/{id}', 'LogisticController@update')->name('logistics.update');
    Route::delete('logistics/{id}', 'LogisticController@destroy')->name('logistics.destroy');

    //Customers Routes
    Route::get('customers', 'CustomerController@index')->name('customers.index');
    Route::get('customers/{id}', 'CustomerController@show')->name('customers.show');

    //Coupon
    Route::get('coupons/data', 'CouponController@ajaxDatatable')->name('coupons.ajax');
    Route::resource('coupons', 'CouponController');
    //Blog
    Route::resource('blogs', 'BlogController');
    Route::resource('blog-categories', 'BlogCategoryController');
    //Settings
    Route::get('settings', 'SettingController@index')->name('settings.index');
    Route::post('settings', 'SettingController@update')->name('settings.update');

    //report
    Route::get('monthlysalereport', 'ReportController@monthlysalereport')->name('report.monthlysalereport');
    Route::get('topcategorysalereport', 'ReportController@topcategorysalereport')->name('report.topcategorysalereport');
});

Route::post('/main-category-import', function(Request $request) {
    $request->validate([
        'file' => 'required'
    ]);
    Excel::import(new CategoryImport, $request->file);
    return redirect()->route('admin.categories.index')->with('success', 'Successfully imported!');

})->name('main-category-import');

Route::post('/sub-category-import', function(Request $request) {
    $request->validate([
        'file' => 'required'
    ]);
    Excel::import(new MainCategoryImport, $request->file);
    return redirect()->route('admin.categories.index')->with('success', 'Successfully imported!');

})->name('sub-category-import');

Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    Route::get('/cart-items', function () {
        $cart_detail = getCartDetails();
        return view('frontend.layouts.shared.mini-cart-item', compact('cart_detail'));
    })->name('get-cart-items');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('info/{name}', 'HomeController@infoPage')->name('info-page');
    Route::post('contact-form', 'HomeController@contactForm')->name('contact-form');
    //Bonous
    Route::get('/bonous', 'HomeController@bonous')->name('bonous');
    Route::get('info/about-us', 'HomeController@aboutUs')->name('aboutUs');
    Route::get('/forget-session','HomeController@forgetSession');

    //Auth
    Route::post('/register', 'AuthController@register')->name('register');
    Route::get('/login', 'AuthController@loginForm')->name('loginForm')->middleware('customer_is_not_authenticate');
    Route::post('/login', 'AuthController@login')->name('login');

    Route::get('/request-otp', 'AuthController@requestOTPForm')->name('requestOtpForm')->middleware('customer_is_not_authenticate');
    Route::post('/request-otp', 'AuthController@requestOTP')->name('requestOtp');
    Route::get('/verify-otp', 'AuthController@verifyOTPForm')->name('verifyOtpForm')->middleware('customer_is_not_authenticate');
    Route::post('/verify-otp', 'AuthController@verifyOTP')->name('verifyOtp');
    Route::post('/reset-password', 'AuthController@resetPassword')->name('resetPassword');

    //Product
    Route::get('/products/{slug}/detail', 'ProductController@detail')->name('products.detail');
    Route::get('/products', 'ProductController@index')->name('products.index');
    Route::post('/products/{id}', 'ProductController@quickView')->name('products.quick-view');

    //Blog
    Route::get('blogs', 'BlogController@index')->name('blogs.index');
    Route::get('blogs/{slug}', 'BlogController@show')->name('blogs.show');

    //Change Language
    Route::post('language/{locale}', 'LanguageController')->name('change-language');


    //
    Route::group(['middleware' => 'customer_is_authenticated'], function () {
        Route::get('/logout', 'AuthController@logout')->name('logout');

        Route::get('cart', 'CartController@index')->name('cart');
        Route::post('cart', 'CartController@update')->name('cart.update');
        Route::get('wishlist', 'CartController@wishlist')->name('wishlist');
        //Add To Cart
        Route::post('products/{id}/add-to-cart', 'CartController@addToCart')->name('products.add-to-cart');
        Route::post('products/{id}/add-to-wishlist', 'CartController@addToWishlist')->name('products.add-to-wishlist');
        //Remove From Cart
        Route::post('products/{id}/remove-from-cart', 'CartController@removeFromCart')->name('products.remove-from-cart');
        Route::post('products/{id}/remove-from-wishlist', 'CartController@removeFromWishlist')->name('products.remove-from-wishlist');
        //Checkout
        Route::get('checkout', 'CheckoutController@checkoutForm')->name('checkoutForm');
        Route::post('checkout', 'CheckoutController@checkout')->name('checkout');
        Route::get('township/{id}', 'CheckoutController@getTownshipView')->name('township');
        Route::get('delivery/{id}','CheckoutController@getDeliveryCharge')->name('delivery_charge');
        Route::post('cupon-data','CheckoutController@couponData')->name('coupon-data');
        //Account
        Route::get('/myaccount', 'AccountController@myaccount')->name('myaccount');
        Route::get('/myorder', 'AccountController@myorder');
        Route::post('/myaccount', 'AccountController@updateMyAccount')->name('update-myaccount');
        Route::get('/deactivate/{id}','AccountController@deactivateMyaccount')->name('deactivate-myaccount');
        Route::get('/delete/{id}','AccountController@deleteMyaccount')->name('delete-myaccount');

        //Order
        Route::Post('/order/detail/{id}', 'AccountController@myorderdetail')->name('order.detail-view');


    });
});
