<?php

namespace App\Http\View\Composers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Products;
use App\Models\ShopType;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\View\View;
use Illuminate\Support\Facades\Config;

class DropdownComposer
{
    public function transactionDropdown(View $view)
    {
        $variablesData = Config::get('variables.ONE');
        $transactions = Transaction::where('status', '!=', $variablesData)->get();
        
        $view->with('transactions', $transactions);
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