<?php

use App\Http\Controllers\Admin\Attendee_CheckController;
use App\Http\Controllers\Admin\Attendence_CheckController;
use App\Http\Controllers\Admin\AttendentController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\PaymentPackageController;
use App\Http\Controllers\Admin\PaymentProviderController;
use App\Http\Controllers\Admin\PaymentRecordController;
use App\Http\Controllers\ProfileController;
use App\Models\PaymentRecord;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [
    App\Http\Controllers\Frontend\FrontendController::class,
    'index',
]);

Route::middleware(['auth'])->group(function () {
    Route::get('user_register', [
        App\Http\Controllers\Frontend\UserRegisterController::class,
        'index',
    ]);
    Route::post('create_qrcode', [
        App\Http\Controllers\Frontend\UserRegisterController::class,
        'createQRCode',
    ]);
    Route::get('user_qrcode', [
        App\Http\Controllers\Frontend\UserRegisterController::class,
        'showQRCode',
    ]);
    Route::get('package-details', [
        App\Http\Controllers\Frontend\UserRegisterController::class,
        'show',
    ]);
    Route::get('product-checkout', [
        App\Http\Controllers\Frontend\UserRegisterController::class,
        'showproduct',
    ]);
    Route::get('product-invoice', [
        App\Http\Controllers\Frontend\UserRegisterController::class,
        'showProductInvoice',
    ]);
    Route::get('class-detail', [
        App\Http\Controllers\Frontend\UserRegisterController::class,
        'detail',
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})

    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/members/{memberId}', [
        App\Http\Controllers\Admin\DashboardController::class,
        'show',
    ])->name('members.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name(
        'profile.edit'
    );
    Route::patch('/profile', [ProfileController::class, 'update'])->name(
        'profile.update'
    );
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name(
        'profile.destroy'
    );

    //PuKit
    Route::resource('payment_packages', PaymentPackageController::class);
    Route::resource('payment_providers', PaymentProviderController::class);
    Route::resource('payment_records', PaymentRecordController::class);
    Route::resource('attendents', AttendentController::class);

    Route::resource('attendent_check', Attendence_CheckController::class);
});

Route::prefix('admin')->group(function () {
    Route::get('/brands', App\Http\Livewire\Admin\Brands\Index::class);
    Route::controller(
        App\Http\Controllers\Admin\DashboardController::class
    )->group(function () {
        Route::get('dashboard', 'index');

        Route::get('members/{memberId}', 'show');
    });

    Route::controller(
        App\Http\Controllers\Admin\CustomerController::class
    )->group(function () {
        Route::get('/customers', 'index');
        Route::get('/customers/create', 'create');
        Route::post('/customers', 'store');
        Route::get('/customers/{customer}/edit', 'edit');
        Route::put('/customers/{customer}', 'update');
        Route::get('/customers/{customer_id}/delete', 'destroy');
        Route::post('/customers/fetch_township', 'fetchTownship');
        Route::post('/customers/fetch_street', 'fetchStreet');

        Route::get('/customers/{customer_id}/invoice', 'invoice');
        Route::get('/customers/{customer_id}/view', 'viewInvoice');
        Route::get('/customers/{customer_id}/generate', 'generateInvoice');
        Route::get('/customers/{customer_id}/mail', 'mailInvoice');
        Route::get('/expiredMembers', 'showExpiredMembers');
        Route::get('/{member_id}/addPayments', 'addPayments');
        Route::post('/payFees', 'payFees');
        Route::get('/customers/{customer_id}/print', 'print');
    });

    // Products
    Route::controller(
        App\Http\Controllers\Admin\ProductsController::class
    )->group(function () {
        Route::get('/products', 'index');
        Route::get('/products/create', 'create');
        Route::post('/products', 'store');
        Route::get('/products/{product}/edit', 'edit');
        Route::put('/products/{product}', 'update');
        Route::get('/products/{product_id}/delete', 'destroy');
    });

    // Brands
    Route::controller(
        App\Http\Controllers\Admin\BrandsController::class
    )->group(function () {
        Route::get('/brands', 'index');
        Route::get('/brands/create', 'create');
        Route::post('/brands', 'store');
        Route::get('/brands/{brand}/edit', 'edit');
        Route::put('/brands/{brand}', 'update');
        Route::get('/brands/{brand_id}/delete', 'destroy');
    });

    // Categories
    Route::controller(
        App\Http\Controllers\Admin\CategoryController::class
    )->group(function () {
        Route::get('/categories', 'index');
        Route::get('/categories/create', 'create');
        Route::post('/categories', 'store');
        Route::get('/categories/{category}/edit', 'edit');
        Route::put('/categories/{category}', 'update');
        Route::get('/categories/{category_id}/delete', 'destroy');
    });

    // shop types
    Route::controller(
        App\Http\Controllers\Admin\Shop\ShopTypeController::class
    )->group(function () {
        Route::get('/shoptypes', 'index');
        Route::get('/shoptypes/create', 'create');
        Route::post('/shoptypes', 'store');
        Route::get('/shoptypes/{shopttype}/edit', 'edit');
        Route::put('/shoptypes/{shopttype}', 'update');
        Route::get('/shoptypes/{shopttype_id}/delete', 'destroy');
    });

    Route::controller(
        App\Http\Controllers\Admin\EquipmentController::class
    )->group(function () {
        Route::get('/equipments', 'index');
        Route::get('/equipments/create', 'create');
        Route::post('/equipments', 'store');
        Route::get('/equipments/{equipment}/edit', 'edit');
        Route::put('/equipments/{equipment}', 'update');
        Route::get('/equipments/{equipment_id}/delete', 'destroy');
    });

    Route::controller(App\Http\Controllers\Admin\LogoController::class)->group(
        function () {
            Route::get('/logo', 'index');
            Route::get('/logo/create', 'create');
            Route::post('/logo', 'store');
            Route::get('/logo/{logo}/edit', 'edit');
            Route::put('/logo/{logo}', 'update');
            Route::get('/logo/{logo}/delete', 'destroy');
        }
    );

    Route::controller(
        App\Http\Controllers\Admin\SliderController::class
    )->group(function () {
        Route::get('/sliders', 'index');
        Route::get('/sliders/create', 'create');
        Route::post('/sliders', 'store');
        Route::get('/sliders/{slider}/edit', 'edit');
        Route::put('/sliders/{slider}', 'update');
        Route::get('/sliders/{slider}/delete', 'destroy');
    });

    Route::controller(
        App\Http\Controllers\Admin\TrainerController::class
    )->group(function () {
        Route::get('/trainers', 'index');
        Route::get('/trainers/create', 'create');
        Route::post('/trainers', 'store');
        Route::get('/trainers/{trainer}/edit', 'edit');
        Route::put('/trainers/{trainer}', 'update');
        Route::get('/trainers/{trainer_id}/delete', 'destroy');
    });
    Route::controller(App\Http\Controllers\Admin\PrintController::class)->group(
        function () {
            Route::get('/attendent/{attendent}/print', 'print');
        }
    );
    Route::controller(
        App\Http\Controllers\Admin\PartnerController::class
    )->group(function () {
        Route::get('/partner', 'index');
        Route::get('/partner/create', 'create');
        Route::post('/partner', 'store');
        Route::get('/partner/{partner}/edit', 'edit');
        Route::put('/partner/{partner}', 'update');
        Route::get('/partner/{partner}/delete', 'destroy');
    });
    Route::controller(App\Http\Controllers\Admin\ClassController::class)->group(
        function () {
            Route::get('/class', 'index');
            Route::get('/class/create', 'create');
            Route::post('/class', 'store');
            Route::get('/class/{class}/edit', 'edit');
            Route::put('/class/{class}', 'update');
            Route::get('/class/{class}/delete', 'destroy');
        }
    );
});

require __DIR__ . '/auth.php';
