<?php

namespace App\Http\Controllers\Guest\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Helpers\TranslateHelper;
use App\Models\Activity;
use App\Models\BrandPartner;
use App\Models\CompanyParameter;
use App\Models\Faq;
use App\Models\Message;
use App\Models\Monitoring;
use App\Models\Banner;
use App\Models\User;
use App\Models\Visitor;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Halaman utama (Home)
     */
    public function index()
    {
        // Ambil data produk terbatas 6 item
        $products = Product::take(6)->get();

        // Ambil semua banner/slider
        $sliders = Banner::all();

        // Ambil data perusahaan
        $company = CompanyParameter::first();

        // Ambil semua brand partner tanpa kolom 'order'
        $brands = BrandPartner::all();

        $locale = app()->getLocale();

        // Terjemahkan judul dan subtitle slider
        foreach ($sliders as $slider) {
            $slider->title = $slider->title !== null
                ? TranslateHelper::translate($slider->title, $locale)
                : null;

            if ($slider->subtitle !== null && $slider->subtitle !== 'Way to Know') {
                $slider->subtitle = TranslateHelper::translate($slider->subtitle, $locale);
            }
        }

        return view('guest.home.home', compact('products', 'sliders', 'company', 'brands'));
    }

    /**
     * Halaman FAQ
     */
    public function faq()
    {
        $faqs = Faq::all();
        $locale = app()->getLocale();

        foreach ($faqs as $faq) {
            if (!empty($faq->question)) {
                $faq->question = TranslateHelper::translate($faq->question, $locale);
            }

            if (!empty($faq->answer)) {
                $faq->answer = TranslateHelper::translate($faq->answer, $locale);
            }
        }

        return view('guest.faq.index', compact('faqs'));
    }
}
