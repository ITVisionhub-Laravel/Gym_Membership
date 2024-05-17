<?php

namespace App\Providers;

use App\Models\Setting;
use Laravel\Ui\Presets\Bootstrap;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Support\Facades\Validator;
use App\Http\View\Composers\DropdownComposer;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        view()->composer('components.partials.*', DropdownComposer::class . '@expensesDropdown');
        view()->composer('components.partials.*', DropdownComposer::class . '@transactionTypeDropdown');
        view()->composer('admin.products.*', DropdownComposer::class . '@brandDropdown');
        view()->composer('admin.products.*', DropdownComposer::class . '@categoryDropdown');
        view()->composer('admin.shops.*', DropdownComposer::class . '@shopTypeDropdown');
        view()->composer('admin.shops.*', DropdownComposer::class . '@productDropdown');
        Validator::extend('ReCaptcha', 'App\\Validators\\ReCaptcha@validate');

    Paginator::useBootstrap();
    // $websiteSetting = Setting::first();
    // View::share('appSetting',$websiteSetting);
    }
}
