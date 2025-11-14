<?php

namespace App\Http\Controllers\Guest\Product;

use App\Helpers\TranslateHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductGuestController extends Controller
{
    public function index(Request $request, $categoryId = null)
    {
        // Get categories that have products
        $category = Category::whereHas('product')->get();

        // Filter products by category if categoryId is provided
        if ($categoryId) {
            $products = Product::where('category_id', $categoryId);
            $selectedCategory = Category::find($categoryId);
        } else {
            $products = Product::query();
            $selectedCategory = null;
        }

        // Apply sorting based on the selected option
        if ($request->has('sort')) {
            if ($request->sort == 'newest') {
                $products = $products->orderBy('created_at', 'desc');
            } elseif ($request->sort == 'oldest') {
                $products = $products->orderBy('created_at', 'asc');
            }
        } else {
            // Default sorting: newest
            $products = $products->orderBy('created_at', 'desc');
        }

        // Get total product count before pagination
        $totalProduct = $products->count();
        
        // Paginate results (12 items per page)
        $products = $products->paginate(12)->appends($request->except('page'));

        return view('guest.product.product', compact('products', 'category', 'selectedCategory', 'totalProduct'));
    }

    public function filterByCategory($slug, Request $request)
    {
        // Cari kategori berdasarkan slug
        $selectedCategory = Category::where('slug', $slug)->firstOrFail();

        // Filter produk berdasarkan kategori yang ditemukan
        $query = Product::where('category_id', $selectedCategory->id);

        // Apply sorting
        if ($request->has('sort')) {
            if ($request->sort == 'newest') {
                $query = $query->orderBy('created_at', 'desc');
            } elseif ($request->sort == 'oldest') {
                $query = $query->orderBy('created_at', 'asc');
            }
        } else {
            // Default sorting: newest
            $query = $query->orderBy('created_at', 'desc');
        }

        // Get total product count before pagination
        $totalProduct = $query->count();

        // Paginate results
        $products = $query->paginate(12)->appends($request->except('page'));

        // Ambil semua kategori yang memiliki produk
        $category = Category::whereHas('product')->get();

        return view('guest.product.product', compact('products', 'category', 'selectedCategory', 'totalProduct'));
    }

    public function show($slug)
    {
        // Cari product berdasarkan slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Ambil 4 product lainnya
        $productLainnya = Product::where('id', '!=', $product->id)->take(4)->get();

        $locale = app()->getLocale(); 
        $product->usage = TranslateHelper::translate($product->usage, $locale);

        return view('guest.product.detail', compact('product', 'productLainnya'));
    }
}