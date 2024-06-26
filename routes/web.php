<?php

use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\TownshipController;
use App\Http\Controllers\WardController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StreetController;
use App\Models\PaymentRecord;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\ProfitSharingController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\ExpensesController;
use App\Http\Controllers\OurRevenueListController;
use App\Http\Controllers\Admin\AttendentController;
use App\Http\Controllers\Admin\SaleRecordController;
use App\Http\Controllers\Admin\PaymentRecordController;
use App\Http\Controllers\Admin\Attendee_CheckController;
use App\Http\Controllers\Admin\DebitAndCreditController;
use App\Http\Controllers\Admin\PaymentPackageController;
use App\Http\Controllers\Admin\PaymentProviderController;
use App\Http\Controllers\Frontend\UserRegisterController;
use App\Http\Controllers\Admin\Attendence_CheckController;
use App\Http\Controllers\Admin\GymClassCategoryController;


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
])->name('home');

Route::post('/create', [
    App\Http\Controllers\Frontend\FrontendController::class,
    'create',
])->name('create');

Route::middleware(['auth'])->group(function () {
    Route::get('user_register', [
        App\Http\Controllers\Frontend\UserRegisterController::class,
        'index',
    ]);
    Route::get('user_address', [
        UserRegisterController::class,
        'userAddress',
    ]);
    Route::post('create_qrcode', [
        App\Http\Controllers\Frontend\UserRegisterController::class,
        'createQRCode',
    ]);
    Route::post('create_user_address', [
        UserRegisterController::class,
        'createUserAddress',
    ]);
    Route::get('user_qrcode', [
        App\Http\Controllers\Frontend\UserRegisterController::class,
        'showQRCode',
    ]);
    Route::get('package-details', [
        App\Http\Controllers\Frontend\UserRegisterController::class,
        'show',
    ])->name('package.details');
    Route::get('product-checkout', [
        App\Http\Controllers\Frontend\UserRegisterController::class,
        'show',
    ])->name('product.checkout');
    Route::get('product-invoice', [
        App\Http\Controllers\Frontend\UserRegisterController::class,
        'showProductInvoice',
    ]);
    Route::get('class-list/{classCategoryId}', [
        App\Http\Controllers\Frontend\UserRegisterController::class,
        'show',
    ])->name('class.list');
    Route::get('class-details/{gymclassId}', [
        App\Http\Controllers\Frontend\UserRegisterController::class,
        'showGymClassDetails',
    ])->name('class.details');
    Route::get('user_details',[UserRegisterController::class,'userDetails'])->name('user.details');
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

    // Route::get('/profile', [ProfileController::class, 'edit'])->name(
    //     'profile.edit'
    // );
    // Route::patch('/profile', [ProfileController::class, 'update'])->name(
    //     'profile.update'
    // );
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name(
    //     'profile.destroy'
    // );

    //PuKit
    Route::resource('payment_packages', PaymentPackageController::class);
    Route::resource('payment_providers', PaymentProviderController::class);
    Route::resource('payment_records', PaymentRecordController::class);
    Route::resource('attendents', AttendentController::class);
    Route::resource('revenueList', OurRevenueListController::class);

});

Route::prefix('admin')->group(function () {
    Route::resource('attendent_check', Attendence_CheckController::class);
    Route::resource('salerecord', SaleRecordController::class);
    Route::resource('shareholders', SaleRecordController::class);
    Route::get('/brands', App\Http\Livewire\Admin\Brands\Index::class);

    Route::resource('debit-credit', DebitAndCreditController::class);
    Route::resource('expenses', ExpensesController::class);
    Route::resource('profitsharing', ProfitSharingController::class);

    Route::controller(
        App\Http\Controllers\Admin\DashboardController::class
    )->group(function () {
        Route::get('dashboard', 'index');

        Route::get('members/{memberId}', 'show');
    });

    Route::controller(
        App\Http\Controllers\Admin\MemberController::class
    )->group(function () {
        Route::get('/customers', 'index');
        Route::get('/customers/create', 'create');
        Route::post('/customers', 'store');
        Route::get('/customers/{customer}/edit', 'edit');
        Route::patch('/customers/{customer}', 'update');
        Route::get('/customers/{customer_id}/delete', 'destroy');
        Route::post('/customers/fetch_state', 'fetchState');
        Route::post('/customers/fetch_city', 'fetchCity');
        Route::post('/customers/fetch_township', 'fetchTownship');
        Route::post('/customers/fetch_ward', 'fetchWard');
        Route::post('/customers/fetch_street', 'fetchStreet');

        Route::get('/customers/{customer_id}/history', 'history');
        Route::get('/customers/{customer_id}/invoice', 'invoice');
        Route::get('/customers/{customer_id}/view', 'viewInvoice');
        Route::get('/customers/{customer_id}/generate', 'generateInvoice');
        Route::get('/customers/{customer_id}/mail', 'mailInvoice');
        Route::get('/expiredMembers', 'showExpiredMembers');
        Route::get('/{member_id}/addPayments', 'addPayments');
        Route::post('/payFees', 'payFees');
        Route::get('/customers/{customer_id}/print', 'print');
        Route::get('/customers/{customer_id}/print/package', 'printPackage');

        Route::post('/customers/daily', 'daily');
        Route::post('/customers/weekly', 'weekly');
        Route::post('/customers/monthlyProfit', 'profit');
        Route::post('/customers/yearly', 'yearly');
        Route::post('/customers/all', 'all');
    });

    Route::controller(
        App\Http\Controllers\OurRevenueListController::class
    )->group(function () {
        Route::post('filtering_our_income_and_expense', 'filteringOurIncome')->name('our_income_and_expense');
        // Route::post('weekly_profit', 'filteringOurIncome')->name('weekly_profit');
        // Route::post('monthly_profit', 'filteringOurIncome')->name('monthly_profit');
        // Route::post('yearly_profit', 'filteringOurIncome')->name('yearly_profit');
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

    // // Categories
    // Route::controller(
    //     App\Http\Controllers\Admin\CategoryController::class
    // )->group(function () {
    //     Route::get('/categories', 'index');
    //     Route::get('/categories/create', 'create');
    //     Route::post('/categories', 'store');
    //     Route::get('/categories/{category}/edit', 'edit');
    //     Route::put('/categories/{category}', 'update');
    //     Route::get('/categories/{category_id}/delete', 'destroy');
    // });


    // Category Class

    Route::controller(GymClassCategoryController::class)->group(function(){
        Route::get('/class-category','index')->name('class-category.index');
        Route::get('class-category/create','create')->name('classCategory.create');
        Route::post('class-category/','store')->name('classCategory.store');
        Route::get('class-category/{class}/edit','edit')->name('class-category.edit');
        Route::put('class-category/{class}','update')->name('classCategory.update');
        Route::get('class-category/{class}/delete','destroy')->name('classCategory.delete');
    });

    //Class
    Route::controller(ClassController::class)->group(function(){
        Route::get('class','index')->name('class.index');
        Route::get('class/create','create')->name('class.create');
        Route::post('class/store','store')->name('class.store');
        Route::get('class/{gymClass}/edit','edit')->name('class.edit');
        Route::put('class/{gymClass}','update')->name('class.update');
        Route::get('class/{gymClass}/delete','destroy')->name('class.delete');
    });

    // shop types
    Route::controller(
        App\Http\Controllers\Admin\Shop\ShopTypeController::class
    )->group(function () {
        Route::get('/shoptypes', 'index');
        Route::get('/shoptypes/create', 'create');
        Route::post('/shoptypes', 'store');
        Route::get('/shoptypes/{shoptype}/edit', 'edit');
        Route::put('/shoptypes/{shoptype}', 'update');
        Route::get('/shoptypes/{shoptype_id}/delete', 'destroy');
    });

    // delivery types
    Route::controller(
        App\Http\Controllers\Admin\Delivery\DeliveryTypeController::class
    )->group(function () {
        Route::get('/deliverytypes', 'index');
        Route::get('/deliverytypes/create', 'create');
        Route::post('/deliverytypes', 'store');
        Route::get('/deliverytypes/{deliver}/edit', 'edit');
        Route::put('/deliverytypes/{deliver}', 'update');
        Route::get('/deliverytypes/{deliver_id}/delete', 'destroy');
    });

    // shops
    Route::controller(
        App\Http\Controllers\Admin\Shop\ShopController::class
    )->group(function () {
        Route::get('/shops', 'index');
        Route::get('/shops/create', 'create');
        // Route::post('/shopkeepers', 'store');
        Route::post('/shops', 'store');
        Route::get('/shops/{shop}/edit', 'edit');
        Route::put('/shops/{shop}', 'update');
        Route::get('/shops/{shop_id}/delete', 'destroy');
    });

    //Country
    Route::controller(CountryController::class)->group(function(){
        Route::get('country','index')->name('country.index');
        Route::get('/country/create','create')->name('country.create');
        Route::post('/country/store','store')->name('country.store');
        Route::get('/country/{id}/edit','edit')->name('country.edit');
        Route::put('/country/{id}','update')->name('country.update');
        Route::get('/country/{id}/delete','destroy')->name('country.delete');
    });


    //State
    Route::controller(StateController::class)->group(function(){
        Route::get('state','index')->name('state.index');
        Route::get('state/create','create')->name('state.create');
        Route::post('state/store','store')->name('state.store');
        Route::get('state/{state}/edit','edit')->name('state.edit');
        Route::put('state/{state}/update','update')->name('state.update');
        Route::get('state/{state}/delete','destroy')->name('state.delete');
    });

    //city
    Route::controller(CityController::class)->group(function(){
        Route::get('city','index')->name('city.index');
        Route::get('city/create','create')->name('city.create');
        Route::post('city/store','store')->name('city.store');
        Route::get('city/{city}/edit','edit')->name('city.edit');
        Route::put('city/{city}/update','update')->name('city.update');
        Route::get('city/{city}/delete','destroy')->name('city.delete');
    });

     //township
     Route::controller(TownshipController::class)->group(function(){
        Route::get('township','index')->name('township.index');
        Route::get('township/create','create')->name('township.create');
        Route::post('township/store','store')->name('township.store');
        Route::get('township/{township}/edit','edit')->name('township.edit');
        Route::put('township/{township}/update','update')->name('township.update');
        Route::get('township/{township}/delete','destroy')->name('township.delete');
    });

     //ward
     Route::controller(WardController::class)->group(function(){
        Route::get('ward','index')->name('ward.index');
        Route::get('ward/create','create')->name('ward.create');
        Route::post('ward/store','store')->name('ward.store');
        Route::get('ward/{ward}/edit','edit')->name('ward.edit');
        Route::put('ward/{ward}/update','update')->name('ward.update');
        Route::get('ward/{ward}/delete','destroy')->name('ward.delete');
    });

    //street
    Route::controller(StreetController::class)->group(function(){
        Route::get('street','index')->name('street.index');
        Route::get('street/create','create')->name('street.create');
        Route::post('street/store','store')->name('street.store');
        Route::get('street/{street}/edit','edit')->name('street.edit');
        Route::put('street/{street}/update','update')->name('street.update');
        Route::get('street/{street}/delete','destroy')->name('street.delete');
    });

    // schedule
    Route::controller(ScheduleController::class)->group(function(){
        Route::get('schedule','index')->name('schedule.index');
        Route::get('schedule/create','create')->name('schedule.create');
        Route::post('schedule/store','store')->name('schedule.store');
        Route::get('schedule/{id}/edit','edit')->name('schedule.edit');
        Route::put('schedule/{id}/update','update')->name('schedule.update');
        Route::get('schedule/{id}/delete','destroy')->name('schedule.delete');
    });

    // setting
    Route::controller(SettingController::class)->group(function(){
        Route::get('setting','index')->name('setting.index');
        Route::post('setting','store')->name('setting.store');
    });






    // shopkeepers
    // Route::controller(
    //     App\Http\Controllers\Admin\RequestController::class
    // )->group(function () {
    //     Route::post('/shopkeepers', 'store');
    //     Route::get('/requests', 'index');
    // });

    // Route::controller(
    //     App\Http\Controllers\Admin\Shop\ShopController::class
    // )->group(function () {
    //     Route::get('/shops', 'index');
    //     Route::get('/shops/create', 'create');
    //     Route::post('/shops', 'store');
    //     Route::get('/shops/{shop}/edit', 'edit');
    //     Route::put('/shops/{shop}', 'update');
    //     Route::get('/shops/{shop_id}/delete', 'destroy');
    // });

    // Route::controller(
    //     App\Http\Controllers\Admin\EquipmentController::class
    // )->group(function () {
    //     Route::get('/equipments', 'index');
    //     Route::get('/equipments/create', 'create');
    //     Route::post('/equipments', 'store');
    //     Route::get('/equipments/{equipment}/edit', 'edit');
    //     Route::put('/equipments/{equipment}', 'update');
    //     Route::get('/equipments/{equipment_id}/delete', 'destroy');
    // });

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

    // Route::controller(
    //     App\Http\Controllers\Admin\SliderController::class
    // )->group(function () {
    //     Route::get('/sliders', 'index');
    //     Route::get('/sliders/create', 'create');
    //     Route::post('/sliders', 'store');
    //     Route::get('/sliders/{slider}/edit', 'edit');
    //     Route::put('/sliders/{slider}', 'update');
    //     Route::get('/sliders/{slider}/delete', 'destroy');
    // });

    Route::controller(
        App\Http\Controllers\Admin\TrainerController::class
    )->group(function () {
        Route::get('/trainers', 'index');
        Route::get('/organizationchart', 'organizationChart');
        Route::get('/trainers/create', 'create');
        Route::post('/trainers', 'store');
        Route::get('/trainers/{trainer}/edit', 'edit');
        Route::put('/trainers/{trainer}', 'update');
        Route::get('/trainers/{trainer_id}/delete', 'destroy');
    });
    Route::controller(App\Http\Controllers\Admin\PrintController::class)->group(
        function () {
            Route::get('/attendent/print', 'print');
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
});

require __DIR__ . '/auth.php';
