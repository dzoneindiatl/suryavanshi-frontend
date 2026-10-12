<?php

namespace App\View\Composers;

use App\Models\FooterCategory;
use App\Models\Setting;
use Illuminate\View\View;

Class FooterComposer 
{
    public function compose(View $view): void 
    {

        $footer = FooterCategory::with('subcategories')->get(); 

        $facebook = Setting::select('id','value')->where('key','Social.facebook')->first();
        $instagram = Setting::select('id','value')->where('key','Social.instagram')->first(); 
        $pinterst = Setting::select('id','value')->where('key','Social.pinterest')->first(); 
        $youtube = Setting::select('id','value')->where('key','Social.youtube')->first(); 
        $view->with([
            'facebook'=>$facebook,
            'instagram' =>$instagram,
            'pinterst'=>$pinterst,
            'youtube'=>$youtube,
            'footer'=>$footer,
        ]);
        
    }
}