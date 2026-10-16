<?php

namespace App\View\Composers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\ProductCollection;
use Illuminate\View\View;
use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;
use App\Models\Product; 
use App\Models\ProductGraphics; 
use App\Models\PriceDrop;
use App\Models\NewCountry;

Class HeaderComposer 
{
    public function compose(View $view): void 
    {    
        $today = now()->toDateString();
        $priceDrop = PriceDrop::whereDate('start_date', '<=', $today)->whereDate('end_date', '>=', $today)->where('is_deleted',0)->latest()->first();
        $cartCount = Cart::where('user_id', Auth::guard('customer')->id())->count();
        $allCategory = Category::where('is_active',1)->where('is_deleted',0)->get(); 
        $parentCategories = $allCategory->select('id','name','slug','thumbnail_image','parent_id','show_on_menu')->whereNull('parent_id')->values();  
        $subCategories = $allCategory->whereIn('parent_id', $parentCategories->pluck('id'))->values();
        $childCategories = $allCategory->whereIn('parent_id', $subCategories->pluck('id'))->values();
        $newCountry = NewCountry::select('id','name','currency_symbol_name','exchange_rates','currency_code','currency_symbol','flag','iso2')->get(); 
        $view->with([
            'categories'=>$parentCategories,
            'cartTotal'=>$cartCount,
            'subCategories'=>$subCategories,
            'childCategories'=>$childCategories,
            'priceDrop'=>$priceDrop,
            'newcountries'=>$newCountry
        ]); 
    }
}


//developerDzone@#123