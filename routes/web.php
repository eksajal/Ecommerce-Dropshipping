<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ResellerController;
use App\Models\Reseller;

Route::get('/redirect', [AdminController::class, 'redirect']);

Route::get('/', [AdminController::class, 'home']);


Route::get('/add_product_page', [AdminController::class, 'add_product_page']);

Route::post('/add_product', [AdminController::class, 'add_product']);

Route::get('/view_product_page', [AdminController::class, 'view_product_page']);

Route::get('/category_page', [AdminController::class, 'category_page']);

Route::post('/add_category', [AdminController::class, 'add_category']);

Route::get('/update_category_page/{id}', [AdminController::class, 'update_category_page']);

Route::post('/update_category/{id}', [AdminController::class, 'update_category']);

Route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);

Route::get('/edit_product_page/{id}', [AdminController::class, 'edit_product_page']);

Route::post('/update_product/{id}', [AdminController::class, 'update_product']);

Route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);




Route::get('/view_details_page/{id}', [HomeController::class, 'view_details_page']);

Route::get('/cart_page', [HomeController::class, 'cart_page']);

Route::get('/add_cart/{id}', [HomeController::class, 'add_cart']);

Route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart']);

Route::get('/checkout_page', [HomeController::class, 'checkout_page']);

Route::post('/checkout', [HomeController::class, 'checkout']);



Route::get('/order_page', [AdminController::class, 'order_page']);

Route::get('/status_OnTheWay/{id}', [AdminController::class, 'status_OnTheWay']);

Route::get('/status_rejected/{id}', [AdminController::class, 'status_rejected']);

Route::get('/delete_order/{id}', [AdminController::class, 'delete_order']);

Route::get('/order_history', [HomeController::class, 'order_history']);

Route::get('/shop', [HomeController::class, 'shop']);

Route::get('/contact', [HomeController::class, 'contact']);


Route::get('/shop/filter', [HomeController::class, 'filterByCategory'])->name('shop.filter');




// Reseller routes
Route::get('reseller_dashboard', [ResellerController::class, 'reseller_dashboard']);
Route::get('/reseller_product_details/{id}', [ResellerController::class, 'reseller_product_details']);
Route::get('/reseller_cart_page', [ResellerController::class, 'reseller_cart_page']);
Route::get('/reseller_checkout_page', [ResellerController::class, 'reseller_checkout_page']);
Route::get('/reseller_order_history', [ResellerController::class, 'reseller_order_history']);



Route::get('/reseller_shop/filter', [ResellerController::class, 'filterByCategory'])->name('reseller_shop.filter');



Route::get('/modify_product_page/{id}', [ResellerController::class, 'modify_product_page']);
Route::post('/reseller_checkout', [ResellerController::class, 'reseller_checkout']);




Route::get('/reseller_products_page', [AdminController::class, 'reseller_products_page']);


Route::get('/approval_accepted/{id}', [AdminController::class, 'approval_accepted']);

Route::get('/approval_rejected/{id}', [AdminController::class, 'approval_rejected']);

Route::get('/delete_reseller_product/{id}', [AdminController::class, 'delete_reseller_product']);







