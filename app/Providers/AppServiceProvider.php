<?php

namespace App\Providers;

use App\Http\View\Composers\DropdownComposer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        view()->composer('components.partials.*', DropdownComposer::class . '@transactionDropdown');
        view()->composer('components.partials.*', DropdownComposer::class . '@transactionTypeDropdown');
        view()->composer('admin.products.*', DropdownComposer::class . '@brandDropdown');
        view()->composer('admin.products.*', DropdownComposer::class . '@categoryDropdown');
        view()->composer('admin.shops.*', DropdownComposer::class . '@shopTypeDropdown');
        view()->composer('admin.shops.*', DropdownComposer::class . '@productDropdown');
    }
}   