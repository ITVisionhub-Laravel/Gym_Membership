<?php

namespace App\Http\View\Composers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Expenses;
use App\Models\Products;
use App\Models\ShopType;
use App\Models\TransactionType;
use Illuminate\View\View;
use Illuminate\Support\Facades\Config;

class DropdownComposer
{
    public function expensesDropdown(View $view)
    {
        $variablesData = Config::get('variables.ONE');
        $expenses = Expenses::where('status', '!=', $variablesData)->get();
        
        $view->with('expenses', $expenses);
    }
    
    public function transactionTypeDropdown(View $view)
    {
        $transactionTypes = TransactionType::all();
        
        $view->with('transactionTypes', $transactionTypes);
    }
    
    public function brandDropdown(View $view)
    {
        $brands = Brand::get();
        
        $view->with('brands', $brands);
    }
    
    public function categoryDropdown(View $view)
    {
        $categories = Category::get();
        
        $view->with('categories', $categories);
    }
    
    public function shopTypeDropdown(View $view)
    {
        $shopTypes = ShopType::get();
        
        $view->with('shopTypes', $shopTypes);
    }
    
    public function productDropdown(View $view)
    {
        $products = Products::get();
        
        $view->with('products', $products);
    }
}