<?php

namespace App\Http\Controllers\Guest\Home;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Cache;
use App\Helpers\TranslateHelper;
use App\Models\Activity;
use App\Models\BrandPartner;
use App\Models\CompanyParameter;
use App\Models\Faq;
use App\Models\Kategori;
use App\Models\Message;
use App\Models\Monitoring;
use App\Models\Banner;
use App\Models\User;
use App\Models\Visitor;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::take(6)->get(); 
        $sliders = Banner::all(); 
        $company = CompanyParameter::first(); // Single object, not a collection
        
        $locale = app()->getLocale(); 
    
        // Terjemahkan nama produk
        foreach ($sliders as $slider) {
            $slider->title = $slider->title !== null 
                ? TranslateHelper::translate($slider->title, $locale) 
                : null;
        
            if ($slider->subtitle !== 'Way To Know' && $slider->subtitle !== null) {
                $slider->subtitle = TranslateHelper::translate($slider->subtitle, $locale);
            }
        
            $slider->button_text = $slider->button_text !== null 
                ? TranslateHelper::translate($slider->button_text, $locale) 
                : null;
        
            $slider->description = $slider->description !== null 
                ? TranslateHelper::translate($slider->description, $locale) 
                : null;
        }
        
    
        if ($company) {
            $company->short_history = TranslateHelper::translate($company->short_history, $locale);
        }
    
        return view('guest.home.home', compact('products', 'sliders', 'company',));
    }
    



    public function about()
    {
        $company = CompanyParameter::first();

        $locale = app()->getLocale(); 

        if ($company) {
            $company->short_history = TranslateHelper::translate($company->short_history, $locale);
        }

        if ($company) {
            $company->visi = TranslateHelper::translate($company->visi, $locale);
        }

        if ($company) {
            $company->misi = TranslateHelper::translate($company->misi, $locale);
        }

        return view('guest.about.about', compact('company',));
    }

    public function faq()
    {
        $locale = app()->getLocale(); 

        $company = CompanyParameter::first();
    
        // Retrieve all FAQs
        $faqs = Faq::all();
    
        // Iterate through each FAQ and translate the 'pertanyaan' and 'jawaban' fields
        foreach ($faqs as $faq) {
            $faq->questions = TranslateHelper::translate($faq->questions, $locale);
            $faq->answers = TranslateHelper::translate($faq->answers, $locale);
        }
    
        // Pass the translated FAQs to the view
        return view('guest.faq.index', compact('faqs', 'company'));
    }
    
}
