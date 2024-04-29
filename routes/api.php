<?php

use App\Http\Controllers\Admin\ScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\WardController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\StreetController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\TownshipController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Delivery\DeliveryTypeController;
use App\Http\Controllers\Admin\GymClassCategoryController;
use App\Http\Controllers\Admin\Shop\ShopController;
use App\Http\Controllers\Admin\Shop\ShopTypeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\Admin\DebitAndCreditController;
use App\Http\Controllers\Admin\ExpensesController;
use App\Http\Controllers\Admin\LogoController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\PaymentPackageController;
use App\Http\Controllers\Admin\PaymentProviderController;
use App\Http\Controllers\Admin\TrainerController;
use App\Http\Controllers\Admin\AttendentController;
use App\Http\Controllers\Admin\Attendence_CheckController;
use App\Http\Livewire\GymClassType;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route::prefix('admin')->middleware(['auth:sanctum', 'admin'])->group(function () {
// Shop Resource
Route::resource('shop', ShopController::class);
Route::resource('shop-types', ShopTypeController::class);
Route::resource('delivery-type', DeliveryTypeController::class);
Route::resource('attendence-check', Attendence_CheckController::class);
Route::resource('attendent', AttendentController::class);
Route::resource('brands', BrandsController::class);
Route::resource('categories', CategoryController::class); 
Route::resource('/country', CountryController::class);
Route::resource('/state', StateController::class);
Route::resource('/city', CityController::class);
Route::resource('/township', TownshipController::class);
Route::resource('/ward', WardController::class);
Route::resource('/street', StreetController::class);
Route::resource('/address', AddressController::class);
Route::resource('/gymclass-category', GymClassCategoryController::class);
Route::resource('/member',CustomerController::class);
Route::resource('/package', PaymentPackageController::class);
Route::resource('/payment-provider', PaymentProviderController::class);
Route::resource('/expenses', ExpensesController::class);
Route::resource('/debit-credit', DebitAndCreditController::class);
Route::resource('/logo', LogoController::class);
Route::resource('/partner', PartnerController::class);
Route::resource('/trainer', TrainerController::class);
Route::resource('/gymclass', ClassController::class);
Route::resource('/schedule',ScheduleController::class);
Route::resource('/dashboard', DashboardController::class);
Route::get('/payment-expired-members', [CustomerController::class, 'showExpiredMembers']);
Route::get('/gymclass-type/{gymClassCategoryId}', GymClassType::class);
// });
// });
